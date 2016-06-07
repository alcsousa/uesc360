<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * UESC 360º
 *
 * Um software para mapeamento das capacidades e instalações das instituições
 *
 * @package     UESC360
 * @author      André Cardoso
 * @copyright   Copyright (c) 2015 - 2016, UNIVERSIDADE ESTADUAL DE SANTA CRUZ - UESC.
 * @license     http://nit.uesc.br/uesc360/licenca
 * @link        http://nit.uesc.br/uesc360
 * @since       Version 1.0
 * @filesource

Copyright 2015 - 2016, UNIVERSIDADE ESTADUAL DE SANTA CRUZ. All rights reserved.

 This file is part of UESC 360º.

    UESC 360º is free software: you can redistribute it and/or modify
    it under the terms of the GNU Lesser General Public License as published by
    the Free Software Foundation, either version 3 of the License.

    UESC 360º is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Lesser General Public License for more details.

    You should have received a copy of the GNU Lesser General Public License
    along with UESC 360º. If not, see <http://www.gnu.org/licenses/>.
*/

class Laboratorio extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('funcoes');
        $this->form_validation->set_error_delimiters('<small class="red-text right">* ', '</small>');

        $this->load->model('generica_consulta_model');
        $this->load->model('laboratorio_model');

        if(!$this->session->userdata('logged_in')):
            redirect('login/logoff');
        endif;

        if(!$this->security_model->isAdmin() && !$this->security_model->isCoord()):
            $this->session->set_flashdata('erro', 'Você não possui permissão para acessar essa página! :X');
            redirect('painel', 'refresh');
        endif;
    }

    public function index()
    {
        echo "There is nothing here... :X";
    }

    public function visualizar_laboratorio($id_laboratorio=NULL)
    {
        $id_laboratorio = $this->funcoes->antiInjection($id_laboratorio);
        $this->security_model->youShallNotPass($id_laboratorio, 'LAB');

        if($id_laboratorio != NULL && is_numeric($id_laboratorio)):
            $data['laboratorio']     = $this->generica_consulta_model->consulta_laboratorio_by_id($id_laboratorio);
            $data['laboratorio_img'] = $this->generica_consulta_model->consulta_imagem_laboratorio($id_laboratorio);
            $data['laboratorio_pes'] = $this->generica_consulta_model->consulta_pessoa_laboratorio($id_laboratorio);
            $data['laboratorio_dpt'] = $this->generica_consulta_model->consulta_departamento_laboratorio($id_laboratorio);
            $data['laboratorio_cur'] = $this->generica_consulta_model->consulta_curso_laboratorio($id_laboratorio);
            $data['laboratorio_eqp'] = $this->generica_consulta_model->consulta_equipamento_laboratorio($id_laboratorio);
            $data['coordenadores_lab'] = $this->generica_consulta_model->consulta_coordenadores_laboratorio_by_id($id_laboratorio);
        endif;

        $data['main'] = 'laboratorio/visualizacao_laboratorio';
        $this->load->view('templates/template_admin2', $data);
    }

    public function listar_laboratorios($ordem=NULL)
    {
        if($this->security_model->isAdmin() && $this->session->userdata('permissao_usu') == 1):
            $data['laboratorio'] = $this->generica_consulta_model->listar_laboratorios($ordem);
        elseif($this->security_model->isCoord()):
            $data['laboratorio'] = $this->generica_consulta_model->consulta_coordenador_laboratorio($this->funcoes->antiInjection($this->session->userdata('id_pessoa')));
        endif;

        $data['main'] = 'laboratorio/listar_laboratorios';
        $this->load->view('templates/template_admin2', $data);
    }

    public function cadastrar_laboratorio()
    {
        $this->form_validation->set_rules('coordenador', 'SELECIONE COORDENADOR', 'callback_check_drop');
        $this->form_validation->set_rules('pavilhao', 'SELECIONE PAVILHÃO', 'callback_check_drop');

        $this->form_validation->set_rules('departamento', 'SELECIONE DEPARTAMENTO', 'required');
        $this->form_validation->set_rules('curso', 'SELECIONE CURSO', 'required');

        $this->form_validation->set_rules('nome', 'NOME', 'trim|required|max_length[200]|is_unique[laboratorio.nome_lab]');
        $this->form_validation->set_rules('ramal', 'RAMAL', 'trim|required|min_length[14]|max_length[15]|alpha_numeric_spaces');
        $this->form_validation->set_rules('website', 'WEBSITE', 'trim|max_length[100]');

        $this->form_validation->set_rules('usa_ensino', 'ENSINO', 'max_length[3]');
        $this->form_validation->set_rules('usa_pesquisa', 'PESQUISA', 'max_length[3]');
        $this->form_validation->set_rules('usa_extensao', 'EXTENSÃO', 'max_length[3]');

        $this->form_validation->set_rules('multiusuario', 'MULTIUSUÁRIO', 'required');

        $this->form_validation->set_rules('descricao', 'DESCRICAO', 'required|max_length[600]');
        $this->form_validation->set_rules('atividades', 'ATIVIDADES', 'required|max_length[600]');
        $this->form_validation->set_rules('areas_atendidas', 'AREAS_ATENDIDAS', 'required|max_length[600]');

        $this->form_validation->set_rules('palavras_chave', 'PALAVRAS CHAVE', 'required|max_length[600]');

        if ($this->form_validation->run()==TRUE):

            $laboratorio['nome_lab'] = $this->input->post('nome');
            $laboratorio['ramal_lab'] = $this->input->post('ramal');
            $laboratorio['website_lab'] = $this->input->post('website');
            $laboratorio['descricao_lab'] = $this->input->post('descricao');
            $laboratorio['atividades_lab'] = $this->input->post('atividades');
            $laboratorio['areas_atendidas_lab'] = $this->input->post('areas_atendidas');
            $laboratorio['multiusuario_lab'] = $this->input->post('multiusuario');
            $laboratorio['usa_ensino_lab'] = $this->input->post('usa_ensino');
            $laboratorio['usa_pesquisa_lab'] = $this->input->post('usa_pesquisa');
            $laboratorio['usa_extensao_lab'] = $this->input->post('usa_extensao');
            $laboratorio['fk_id_pavilhao'] = $this->input->post('pavilhao');
            $laboratorio['palavras_chave'] = $this->input->post('palavras_chave');

            if ($laboratorio['usa_ensino_lab']==''):
                $laboratorio['usa_ensino_lab'] = 'Não';
            endif;

            if ($laboratorio['usa_pesquisa_lab']==''):
                $laboratorio['usa_pesquisa_lab'] = 'Não';
            endif;

            if ($laboratorio['usa_extensao_lab']==''):
                $laboratorio['usa_extensao_lab'] = 'Não';
            endif;

            if($this->security_model->isCoord()):
                $coordenador = $this->session->userdata('id_pessoa');
            elseif($this->security_model->isAdmin()):
                $coordenador = $this->input->post('coordenador');
            endif;

            $cursos = $this->input->post('curso');
            $departamentos = $this->input->post('departamento');

            if($this->laboratorio_model->cadastrar_laboratorio($laboratorio, $coordenador, $cursos, $departamentos)):
                $data['sucesso'] = 'Os dados do laboratório foram cadastrados com sucesso! :)';
            else:
                $data['erro'] = 'Oops... Ocorreu algum problema! Os dados não foram salvos! :(';
            endif;
        endif;

        if($this->security_model->isCoord()):
            $data['coordenador'] = $this->generica_consulta_model->consulta_pessoa_by_id($this->session->userdata('id_pessoa'));
        elseif($this->security_model->isAdmin()):
            $data['coordenador'] = $this->generica_consulta_model->consulta_coordenadores();
        endif;

        $data['pavilhao'] = $this->generica_consulta_model->consulta_pavilhoes();
        $data['curso'] = $this->generica_consulta_model->consulta_cursos();
        $data['departamento'] = $this->generica_consulta_model->consulta_departamentos();
        $data['main'] = 'laboratorio/cadastrar_laboratorio';
        $this->load->view('templates/template_admin2', $data);
    }

    public function editar($id_laboratorio=NULL)
    {
        $id_laboratorio = $this->funcoes->antiInjection($id_laboratorio);
        $this->security_model->youShallNotPass($id_laboratorio, 'LAB');

        if($id_laboratorio != NULL && is_numeric($id_laboratorio)):
            $data['laboratorio'] = $this->laboratorio_model->recuperar_laboratorio_by_id($id_laboratorio);
            $data['laboratorio_eqp'] = $this->generica_consulta_model->consulta_equipamento_laboratorio($id_laboratorio);
            $data['main'] = 'laboratorio/editar';
            $this->load->view('templates/template_admin2', $data);
        endif;
    }

    public function editar_dados($id_laboratorio=NULL)
    {
        $id_laboratorio = $this->funcoes->antiInjection($id_laboratorio);
        $this->security_model->youShallNotPass($id_laboratorio, 'LAB');

        if($id_laboratorio != NULL && is_numeric($id_laboratorio)):

            $this->form_validation->set_rules('nome', 'NOME', 'trim|required|max_length[200]');
            $this->form_validation->set_rules('ramal', 'RAMAL', 'trim|required|min_length[14]|max_length[15]|alpha_numeric_spaces');
            $this->form_validation->set_rules('website', 'WEBSITE', 'trim|max_length[100]');
            $this->form_validation->set_rules('descricao', 'DESCRICAO', 'max_length[600]');
            $this->form_validation->set_rules('atividades', 'ATIVIDADES', 'max_length[600]');
            $this->form_validation->set_rules('areas_atendidas', 'AREAS_ATENDIDAS', 'max_length[600]');
            $this->form_validation->set_rules('usa_ensino', 'ENSINO', 'max_length[3]');
            $this->form_validation->set_rules('usa_pesquisa', 'PESQUISA', 'max_length[3]');
            $this->form_validation->set_rules('usa_extensao', 'EXTENSÃO', 'max_length[3]');
            $this->form_validation->set_rules('multiusuario', 'MULTIUSUÁRIO', 'required');
            $this->form_validation->set_rules('palavras_chave', 'PALAVRAS CHAVE', 'required|max_length[600]');

            if($this->form_validation->run() === TRUE):
                $laboratorio['nome_lab'] = $this->input->post('nome');
                $laboratorio['ramal_lab'] = $this->input->post('ramal');
                $laboratorio['website_lab'] = $this->input->post('website');
                $laboratorio['descricao_lab'] = $this->input->post('descricao');
                $laboratorio['atividades_lab'] = $this->input->post('atividades');
                $laboratorio['areas_atendidas_lab'] = $this->input->post('areas_atendidas');
                $laboratorio['multiusuario_lab'] = $this->input->post('multiusuario');

                $laboratorio['usa_ensino_lab'] = $this->input->post('usa_ensino');
                $laboratorio['usa_pesquisa_lab'] = $this->input->post('usa_pesquisa');
                $laboratorio['usa_extensao_lab'] = $this->input->post('usa_extensao');
                $laboratorio['palavras_chave'] = $this->input->post('palavras_chave');

                if($laboratorio['usa_ensino_lab']==''):
                    $laboratorio['usa_ensino_lab'] = 'Não';
                endif;
                if($laboratorio['usa_pesquisa_lab']==''):
                    $laboratorio['usa_pesquisa_lab'] = 'Não';
                endif;
                if($laboratorio['usa_extensao_lab']==''):
                    $laboratorio['usa_extensao_lab'] = 'Não';
                endif;

                if($this->laboratorio_model->atualizar_dados_laboratorio($id_laboratorio, $laboratorio)):
                    $this->session->set_flashdata('sucesso', 'Dados atualizados com sucesso! :)');
                    redirect('laboratorio/visualizar_laboratorio/'.$id_laboratorio);
                else:
                    $this->session->set_flashdata('erro', 'Oops... Ocorreu um erro ao atualizar os dados! :(');
                    redirect('laboratorio/visualizar_laboratorio/'.$id_laboratorio);
                endif;
            endif;
            $data['laboratorio'] = $this->generica_consulta_model->consulta_laboratorio_by_id($id_laboratorio);
            $data['main'] = 'laboratorio/editar_dados';
            $this->load->view('templates/template_admin2', $data);
        endif;

    }

    public function editar_cursos($id_laboratorio=NULL)
    {
        $id_laboratorio = $this->funcoes->antiInjection($id_laboratorio);
        $this->security_model->youShallNotPass($id_laboratorio, 'LAB');

        if($id_laboratorio != NULL && is_numeric($id_laboratorio)):

            $this->form_validation->set_rules('curso', 'SELECIONE CURSO', 'required');

            if($this->form_validation->run() === TRUE):

                $cursos = $this->input->post('curso');

                if($this->laboratorio_model->atualizar_cursos_laboratorio($id_laboratorio, $cursos)):
                    $this->session->set_flashdata('sucesso', 'Dados atualizados com sucesso! :)');
                    redirect('laboratorio/visualizar_laboratorio/'.$id_laboratorio);
                else:
                    $this->session->set_flashdata('erro', 'Oops... Ocorreu um erro ao atualizar os dados! :(');
                    redirect('laboratorio/visualizar_laboratorio/'.$id_laboratorio);
                endif;

            endif;
            $data['laboratorio'] = $this->generica_consulta_model->consulta_laboratorio_by_id($id_laboratorio);
            $data['curso'] = $this->generica_consulta_model->consulta_cursos();
            $data['cursos_lab'] = $this->generica_consulta_model->consulta_cursos_laboratorio_by_id($id_laboratorio);
            $data['main'] = 'laboratorio/editar_cursos';
            $this->load->view('templates/template_admin2', $data);
        endif;
    }

    public function editar_departamentos($id_laboratorio=NULL)
    {
        $id_laboratorio = $this->funcoes->antiInjection($id_laboratorio);
        $this->security_model->youShallNotPass($id_laboratorio, 'LAB');

        if($id_laboratorio != NULL && is_numeric($id_laboratorio)):

            $this->form_validation->set_rules('departamento', 'SELECIONE DEPARTAMENTO', 'required');

            if($this->form_validation->run() === TRUE):

                $departamentos = $this->input->post('departamento');

                if($this->laboratorio_model->atualizar_departamentos_laboratorio($id_laboratorio, $departamentos)):
                    $this->session->set_flashdata('sucesso', 'Dados atualizados com sucesso! :)');
                    redirect('laboratorio/visualizar_laboratorio/'.$id_laboratorio);
                else:
                    $this->session->set_flashdata('erro', 'Oops... Ocorreu um erro ao atualizar os dados! :(');
                    redirect('laboratorio/visualizar_laboratorio/'.$id_laboratorio);
                endif;

            endif;

            $data['laboratorio'] = $this->generica_consulta_model->consulta_laboratorio_by_id($id_laboratorio);
            $data['departamento'] = $this->generica_consulta_model->consulta_departamentos();
            $data['departamentos_lab'] = $this->generica_consulta_model->consulta_departamentos_laboratorio_by_id($id_laboratorio);

            $data['main'] = 'laboratorio/editar_departamentos';
            $this->load->view('templates/template_admin2', $data);
        endif;

    }

    public function editar_localizacao($id_laboratorio=NULL)
    {
        $id_laboratorio = $this->funcoes->antiInjection($id_laboratorio);
        $this->security_model->youShallNotPass($id_laboratorio, 'LAB');

        if($id_laboratorio != NULL && is_numeric($id_laboratorio)):
            $this->form_validation->set_rules('pavilhao', 'SELECIONE A LOCALIZAÇÃO', 'callback_check_drop');

            if($this->form_validation->run() === TRUE):
                $laboratorio['fk_id_pavilhao'] = $this->input->post('pavilhao');
                if($this->laboratorio_model->atualizar_dados_laboratorio($id_laboratorio, $laboratorio)):
                    $this->session->set_flashdata('sucesso', 'Dados atualizados com sucesso! :)');
                    redirect('laboratorio/visualizar_laboratorio/'.$id_laboratorio);
                else:
                    $this->session->set_flashdata('erro', 'Oops... Ocorreu um erro ao atualizar os dados! :(');
                    redirect('laboratorio/visualizar_laboratorio/'.$id_laboratorio);
                endif;
            endif;
            $data['laboratorio'] = $this->generica_consulta_model->consulta_laboratorio_by_id($id_laboratorio);
            $data['pavilhao'] = $this->generica_consulta_model->consulta_pavilhoes();
            $data['main'] = 'laboratorio/editar_localizacao';
            $this->load->view('templates/template_admin2', $data);
        endif;
    }

    public function editar_coordenadores($id_laboratorio=NULL)
    {
        if(!$this->security_model->isAdmin()):
            $this->session->set_flashdata('erro', 'Você não possui permissão para acessar essa página! :X');
            redirect('painel','refresh');
        endif;

        $id_laboratorio = $this->funcoes->antiInjection($id_laboratorio);

        if($id_laboratorio != NULL && is_numeric($id_laboratorio)):

            $this->form_validation->set_rules('coordenador', 'SELECIONE COORDENADOR', 'callback_check_drop');

            if($this->form_validation->run() === TRUE):

                $coordenador = $this->input->post('coordenador');

                if(!$this->security_model->ownsTheHouseLab($coordenador, $id_laboratorio)):
                    if($this->laboratorio_model->adicionar_coordenador_laboratorio($id_laboratorio, $coordenador)):
                        $this->session->set_flashdata('sucesso', 'Dados atualizados com sucesso! :)');
                        redirect('laboratorio/editar_coordenadores/'.$id_laboratorio);
                    else:
                        $this->session->set_flashdata('erro', 'Oops... Ocorreu um erro ao atualizar os dados! :(');
                        redirect('laboratorio/editar_coordenadores/'.$id_laboratorio);
                    endif;
                else:
                    $this->session->set_flashdata('erro', 'Essa pessoa já é coordenador(a) do laboratório! :X');
                    redirect('laboratorio/editar_coordenadores/'.$id_laboratorio);
                endif;

            endif;

            $data['laboratorio'] = $this->generica_consulta_model->consulta_laboratorio_by_id($id_laboratorio);
            $data['coordenador'] = $this->generica_consulta_model->consulta_coordenadores();
            $data['coordenadores_lab'] = $this->generica_consulta_model->consulta_coordenadores_laboratorio_by_id($id_laboratorio);

            $data['main'] = 'laboratorio/editar_coordenadores';
            $this->load->view('templates/template_admin2', $data);
        endif;
    }

    public function pessoas_utilizam_laboratorio($id_laboratorio=NULL)
    {
        $this->load->model('usuario_model');

        if(!$this->security_model->isAdmin()):
            $this->session->set_flashdata('erro', 'Você não possui permissão para acessar essa página! :X');
            redirect('painel','refresh');
        endif;

        $id_laboratorio = $this->funcoes->antiInjection($id_laboratorio);

        if($id_laboratorio != NULL && is_numeric($id_laboratorio)):

            $this->form_validation->set_rules('usuario', 'SELECIONE UM USUÁRIO', 'callback_check_drop');

            if($this->form_validation->run() === TRUE):

                $usuario = $this->input->post('usuario');

                if(!$this->usuario_model->ja_participa($usuario, $id_laboratorio)):

                    $lhp['fk_id_pessoa'] = $usuario;
                    $lhp['fk_id_laboratorio'] = $id_laboratorio;
                    $lhp['permissao_lhp'] = 3;

                    if($this->usuario_model->add_participante($lhp)):
                        $this->session->set_flashdata('sucesso', 'Dados atualizados com sucesso! :)');
                        redirect('laboratorio/pessoas_utilizam_laboratorio/'.$id_laboratorio);
                    else:
                        $this->session->set_flashdata('erro', 'Oops... Ocorreu um erro ao atualizar os dados! :(');
                        redirect('laboratorio/pessoas_utilizam_laboratorio/'.$id_laboratorio);
                    endif;

                else:
                    $this->session->set_flashdata('erro', 'Essa pessoa já é coordenador(a) do laboratório! :X');
                    redirect('laboratorio/pessoas_utilizam_laboratorio/'.$id_laboratorio);
                endif;

            endif;

            $data['laboratorio'] = $this->generica_consulta_model->consulta_laboratorio_by_id($id_laboratorio);
            $data['usuarios'] = $this->usuario_model->get_all_possiveis_participantes($id_laboratorio);
            $data['laboratorio_pes'] = $this->generica_consulta_model->consulta_pessoa_laboratorio($id_laboratorio);

            $data['main'] = 'laboratorio/pessoas_utilizam_laboratorio';
            $this->load->view('templates/template_admin2', $data);
        endif;
    }

    public function deletar_laboratorio($id_laboratorio=NULL)
    {
        $id_laboratorio = $this->funcoes->antiInjection($id_laboratorio);
        $this->security_model->youShallNotPass($id_laboratorio, 'LAB');

        if($id_laboratorio != NULL && is_numeric($id_laboratorio)):
            $this->load->model('equipamento_model');

            $eqps = $this->generica_consulta_model->consulta_equipamento_laboratorio($id_laboratorio);
            foreach ($eqps as $row):
                $this->equipamento_model->deletar_equipamento($id_laboratorio, $row->id_equipamento);
            endforeach;

            if($this->laboratorio_model->deletar_laboratorio($id_laboratorio)):
                $this->session->set_flashdata('sucesso', 'Laboratório removido com sucesso! :)');
                redirect('laboratorio/listar_laboratorios');
            else:
                $this->session->set_flashdata('erro', 'Oops... Ocorreu um erro ao remover o laboratório! :(');
                redirect('laboratorio/listar_laboratorios');
            endif;
        endif;
    }

    public function deletar_coordenador_laboratorio($id_laboratorio=NULL, $id_pessoa=NULL)
    {
        if(!$this->security_model->isAdmin()):
            $this->session->set_flashdata('erro', 'Você não possui permissão para acessar essa página! :X');
            redirect('painel','refresh');
        endif;

        $id_laboratorio = $this->funcoes->antiInjection($id_laboratorio);
        $id_pessoa = $this->funcoes->antiInjection($id_pessoa);

        if($id_laboratorio != NULL && is_numeric($id_laboratorio) && $id_pessoa != NULL && is_numeric($id_pessoa)):
            if($this->laboratorio_model->remover_coordenador_laboratorio($id_laboratorio, $id_pessoa)):
                $this->session->set_flashdata('sucesso', 'Coordenador removido com sucesso! :)');
                redirect('laboratorio/editar_coordenadores/'.$id_laboratorio);
            else:
                $this->session->set_flashdata('erro', 'Oops... Ocorreu um erro ao remover o coordenador! :(');
                redirect('laboratorio/editar_coordenadores/'.$id_laboratorio);
            endif;
        endif;
    }

    public function deletar_participante_laboratorio($id_laboratorio=NULL, $id_pessoa=NULL)
    {
        $this->load->model('usuario_model');

        if(!$this->security_model->isAdmin()):
            $this->session->set_flashdata('erro', 'Você não possui permissão para acessar essa página! :X');
            redirect('painel','refresh');
        endif;

        $id_laboratorio = $this->funcoes->antiInjection($id_laboratorio);
        $id_pessoa = $this->funcoes->antiInjection($id_pessoa);

        if($id_laboratorio != NULL && is_numeric($id_laboratorio) && $id_pessoa != NULL && is_numeric($id_pessoa)):

            if($this->usuario_model->remove_participante($id_laboratorio, $id_pessoa)):
                $this->session->set_flashdata('sucesso', 'Usuário de laboratório removido com sucesso! :)');
                redirect('laboratorio/pessoas_utilizam_laboratorio/'.$id_laboratorio);
            else:
                $this->session->set_flashdata('erro', 'Oops... Ocorreu um erro ao remover o usuário do laboratório! :(');
                redirect('laboratorio/pessoas_utilizam_laboratorio/'.$id_laboratorio);
            endif;

        endif;
    }

    public function gerenciar_imagens_laboratorio($id_laboratorio=NULL)
    {
        $id_laboratorio = $this->funcoes->antiInjection($id_laboratorio);
        $this->security_model->youShallNotPass($id_laboratorio, 'LAB');

        if($id_laboratorio != NULL && is_numeric($id_laboratorio)):
            $config['upload_path'] = './uploads/laboratorio/';
            $config['allowed_types'] = 'jpg|jpeg';
            $config['max_size'] = '2048';
            $config['max_width']  = '4000';
            $config['max_height']  = '4000';
            $config['max_filename']  = '60';
            $config['overwrite'] = FALSE;
            $config['remove_spaces'] = TRUE;
            $config['encrypt_name'] = TRUE;

            $this->form_validation->set_rules('arquivo', 'ARQUIVO', 'trim|required|xss_clean');

            if($this->form_validation->run()===TRUE):

                $this->load->library('upload', $config);

                if(!$this->upload->do_upload()):
                    $data['error'] = $this->upload->display_errors();
                else:
                    $img['upload_data'] = $this->upload->data();
                    $img_laboratorio['nome_iml']        = $img['upload_data']['file_name'];
                    $img_laboratorio['nome_antigo_iml'] = $img['upload_data']['orig_name'];
                    $img_laboratorio['tamanho_iml']     = $img['upload_data']['file_size'];
                    $img_laboratorio['extensao_iml']    = $img['upload_data']['file_ext'];

                    if($this->laboratorio_model->inserir_imagem_laboratorio($id_laboratorio, $img_laboratorio)):
                        $this->session->set_flashdata('sucesso', 'Imagem salva com sucesso! :)');
                        redirect('laboratorio/gerenciar_imagens_laboratorio/'.$id_laboratorio);
                    else:
                        $this->session->set_flashdata('erro', 'Oops... Ocorreu um erro ao fazer o upload de imagem! :(');
                        redirect('laboratorio/gerenciar_imagens_laboratorio/'.$id_laboratorio);
                    endif;
                endif;
            endif;

            $data['laboratorio'] = $this->generica_consulta_model->consulta_laboratorio_by_id($id_laboratorio);
            $data['laboratorio_img'] = $this->generica_consulta_model->consulta_imagem_laboratorio($id_laboratorio);

            $data['main'] = 'laboratorio/gerenciar_imagens';
            $this->load->view('templates/template_admin2', $data);
        endif;
    }

    public function deletar_imagem_laboratorio($id_laboratorio=NULL, $id_img_laboratorio=NULL)
    {
        $id_laboratorio = $this->funcoes->antiInjection($id_laboratorio);
        $id_img_laboratorio = $this->funcoes->antiInjection($id_img_laboratorio);
        $this->security_model->youShallNotPass($id_laboratorio, 'LAB');

        if($id_laboratorio != NULL && is_numeric($id_laboratorio) && $id_img_laboratorio!=NULL && is_numeric($id_img_laboratorio)):
            if($this->laboratorio_model->deletar_imagem_laboratorio($id_img_laboratorio)):
                $this->session->set_flashdata('sucesso', 'Imagem removida com sucesso! :)');
                redirect('laboratorio/gerenciar_imagens_laboratorio/'.$id_laboratorio);
            else:
                $this->session->set_flashdata('erro', 'Oops... Ocorreu um erro ao remover a imagem! :(');
                redirect('laboratorio/gerenciar_imagens_laboratorio/'.$id_laboratorio);
            endif;
        endif;
    }

    public function check_drop($str)
    {
        if($str == 'blank'):
            $this->form_validation->set_message('check_drop', 'Por favor, selecione um item!');
            return FALSE;
        else:
            return true;
        endif;
    }


}

/* End of file Laboratorio.php */
/* Location: ./application/controllers/Laboratorio.php */
