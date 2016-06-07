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

class Equipamento extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('funcoes');

        $this->form_validation->set_error_delimiters('<small class="red-text right">* ', '</small>');

        if (!$this->session->userdata('logged_in')):
            redirect('login/logoff');
        endif;

        $this->load->model('generica_consulta_model');
        $this->load->model('equipamento_model');
    }

    public function index()
    {
        echo "There is nothing here... :X";
    }

    public function visualizar_equipamento($id_equipamento=NULL)
    {
        $id_equipamento = $this->funcoes->antiInjection($id_equipamento);
        $this->security_model->youShallNotPass($id_equipamento, 'EQP');

        if($id_equipamento != NULL && is_numeric($id_equipamento)):
            $data['equipamento']     = $this->generica_consulta_model->consulta_equipamento_by_id($id_equipamento);
            $data['equipamento_img'] = $this->equipamento_model->recuperar_imagens_equipamento_by_id($id_equipamento);
        endif;

        $data['main'] = 'equipamento/visualizacao_equipamento';
        $this->load->view('templates/template_admin2', $data);
    }

    public function listar_equipamentos($ordem=NULL)
    {
        if($this->security_model->isAdmin() && $this->session->userdata('permissao_usu') == 1):
            $data['equipamento'] = $this->generica_consulta_model->listar_equipamentos($ordem);
        elseif($this->security_model->isCoord()):
            $data['equipamento'] = $this->generica_consulta_model->consulta_coordenador_equipamento($this->session->userdata('id_pessoa'));
        endif;

        $data['main'] = 'equipamento/listar_equipamentos';
        $this->load->view('templates/template_admin2', $data);
    }

    public function cadastrar_equipamento()
    {
        $this->form_validation->set_rules('laboratorio', 'SELECIONE LABORATÓRIO', 'callback_check_drop');
        $this->form_validation->set_rules('nome', 'NOME', 'required|max_length[45]');
        $this->form_validation->set_rules('fabricante', 'FABRICANTE', 'required|max_length[45]|ucwords');
        $this->form_validation->set_rules('quantidade', 'QUANTIDADE', 'trim|required|max_length[3]|numeric');
        $this->form_validation->set_rules('especificacao', 'ESPECIFICAÇÃO', 'required');
        $this->form_validation->set_rules('descricao', 'DESCRIÇÃO', 'required');

        if ($this->form_validation->run()==TRUE):
            $equipamento['nome_eqp'] = $this->input->post('nome');
            $equipamento['fabricante_eqp'] = $this->input->post('fabricante');
            $equipamento['quantidade_eqp'] = $this->input->post('quantidade');
            $equipamento['especificacao_eqp'] = $this->input->post('especificacao');
            $equipamento['descricao_eqp'] = $this->input->post('descricao');

            $ID_LABORATORIO = $this->input->post('laboratorio');
            $this->security_model->youShallNotPass($ID_LABORATORIO, 'LAB');
            $laboratorio_has_equipamento['fk_id_laboratorio'] = $ID_LABORATORIO;

            if($this->equipamento_model->cadastrar_equipamento($equipamento, $laboratorio_has_equipamento)):
                $data['sucesso'] = 'Equipamento salvo com sucesso! :)';
            else:
                $data['erro'] = 'Oops... Ocorreu algum problema! Os dados não foram salvos! :(';
            endif;
        endif;

        if($this->security_model->isAdmin()):
            $data['laboratorio'] = $this->generica_consulta_model->listar_laboratorios();
        elseif($this->security_model->isCoord()):
            $data['laboratorio'] = $this->generica_consulta_model->consulta_coordenador_laboratorio($this->funcoes->antiInjection($this->session->userdata('id_pessoa')));
        endif;

        $data['main'] = 'equipamento/cadastrar_equipamento';
        $this->load->view('templates/template_admin2', $data);
    }

    public function editar($id_equipamento=NULL)
    {
        $id_equipamento = $this->funcoes->antiInjection($id_equipamento);
        $this->security_model->youShallNotPass($id_equipamento, 'EQP');

        if($id_equipamento != NULL && is_numeric($id_equipamento)):
            $data['equipamento']     = $this->generica_consulta_model->consulta_equipamento_by_id($id_equipamento);
            $data['equipamento_img'] = $this->equipamento_model->recuperar_imagens_equipamento_by_id($id_equipamento);

            $data['main'] = 'equipamento/editar';
            $this->load->view('templates/template_admin2', $data);
        endif;
    }

    public function editar_dados($id_equipamento=NULL)
    {
        $id_equipamento = $this->funcoes->antiInjection($id_equipamento);
        $this->security_model->youShallNotPass($id_equipamento, 'EQP');

        if($id_equipamento != NULL && is_numeric($id_equipamento)):

            $this->form_validation->set_rules('nome', 'NOME', 'required|max_length[45]');
            $this->form_validation->set_rules('fabricante', 'FABRICANTE', 'required|max_length[45]|ucwords');
            $this->form_validation->set_rules('quantidade', 'QUANTIDADE', 'trim|required|max_length[3]|numeric');
            $this->form_validation->set_rules('especificacao', 'ESPECIFICACAO', 'required');
            $this->form_validation->set_rules('descricao', 'DESCRICAO', 'required');

            if ($this->form_validation->run()==TRUE):
                $equipamento['nome_eqp'] = $this->input->post('nome');
                $equipamento['fabricante_eqp'] = $this->input->post('fabricante');
                $equipamento['quantidade_eqp'] = $this->input->post('quantidade');
                $equipamento['especificacao_eqp'] = $this->input->post('especificacao');
                $equipamento['descricao_eqp'] = $this->input->post('descricao');

                if($this->equipamento_model->atualizar_dados_equipamento($id_equipamento, $equipamento) == TRUE):
                    $this->session->set_flashdata('sucesso', 'Dados atualizados com sucesso! :)');
                    redirect('equipamento/visualizar_equipamento/'.$id_equipamento);
                else:
                    $this->session->set_flashdata('erro', 'Oops... Ocorreu um erro ao atualizar os dados! :(');
                    redirect('equipamento/visualizar_equipamento/'.$id_equipamento);
                endif;
            endif;
            $data['equipamento'] = $this->generica_consulta_model->consulta_equipamento_by_id($id_equipamento);
            $data['laboratorio'] = $this->generica_consulta_model->listar_laboratorios();
        endif;
        $data['main'] = 'equipamento/editar_dados';
        $this->load->view('templates/template_admin2', $data);
    }

    public function editar_laboratorio_pertencente($id_equipamento=NULL)
    {
        $id_equipamento = $this->funcoes->antiInjection($id_equipamento);
        $this->security_model->youShallNotPass($id_equipamento, 'EQP');

        if($id_equipamento != NULL && is_numeric($id_equipamento)):

            $this->form_validation->set_rules('laboratorio', 'SELECIONE LABORATÓRIO', 'callback_check_drop');

            if ($this->form_validation->run()==TRUE):
                $ID_LABORATORIO = $this->input->post('laboratorio');
                $this->security_model->youShallNotPass($ID_LABORATORIO, 'LAB');
                $laboratorio_has_equipamento['fk_id_laboratorio'] = $ID_LABORATORIO;

                if($this->equipamento_model->atualizar_laboratorio_equipamento($id_equipamento, $laboratorio_has_equipamento) == TRUE):
                    $this->session->set_flashdata('sucesso', 'Dados atualizados com sucesso! :)');
                    redirect('equipamento/visualizar_equipamento/'.$id_equipamento);
                else:
                    $this->session->set_flashdata('erro', 'Oops... Ocorreu um erro ao atualizar os dados! :(');
                    redirect('equipamento/visualizar_equipamento/'.$id_equipamento);
                endif;
            endif;

            if($this->security_model->isAdmin()):
                $data['laboratorio'] = $this->generica_consulta_model->listar_laboratorios();
            elseif($this->security_model->isCoord()):
                $data['laboratorio'] = $this->generica_consulta_model->consulta_coordenador_laboratorio($this->funcoes->antiInjection($this->session->userdata('id_pessoa')));
            endif;
            $data['equipamento'] = $this->generica_consulta_model->consulta_equipamento_by_id($id_equipamento);

        endif;
        $data['main'] = 'equipamento/editar_laboratorio_pertencente';
        $this->load->view('templates/template_admin2', $data);
    }

    public function deletar_equipamento($id_laboratorio=NULL, $id_equipamento=NULL)
    {
        $id_laboratorio = $this->funcoes->antiInjection($id_laboratorio);
        $id_equipamento = $this->funcoes->antiInjection($id_equipamento);
        $this->security_model->youShallNotPass($id_equipamento, 'EQP');

        if($id_laboratorio != NULL && is_numeric($id_laboratorio) && $id_equipamento != NULL && is_numeric($id_equipamento)):

            if($this->equipamento_model->deletar_equipamento($id_laboratorio, $id_equipamento) == TRUE):
                $this->session->set_flashdata('sucesso', 'Equipamento removido com sucesso! :)');
                redirect('laboratorio/visualizar_laboratorio/'.$id_laboratorio);
            else:
                $this->session->set_flashdata('erro', 'Oops... Ocorreu um erro ao atualizar os dados! :(');
                redirect('laboratorio/visualizar_laboratorio/'.$id_laboratorio);
            endif;

        endif;
    }

    public function gerenciar_imagens_equipamento($id_equipamento=NULL)
    {
        $id_equipamento = $this->funcoes->antiInjection($id_equipamento);
        $this->security_model->youShallNotPass($id_equipamento, 'EQP');

        if($id_equipamento != NULL && is_numeric($id_equipamento)):

            $config['upload_path'] = './uploads/equipamento/';
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
                    $img_equipamento['nome_ime']        = $img['upload_data']['file_name'];
                    $img_equipamento['nome_antigo_ime'] = $img['upload_data']['orig_name'];
                    $img_equipamento['tamanho_ime']     = $img['upload_data']['file_size'];
                    $img_equipamento['extensao_ime']    = $img['upload_data']['file_ext'];

                    if($this->equipamento_model->inserir_imagem_equipamento($id_equipamento, $img_equipamento)):
                        $this->session->set_flashdata('sucesso', 'Imagem salva com sucesso! :)');
                        redirect('equipamento/gerenciar_imagens_equipamento/'.$id_equipamento);
                    else:
                        $this->session->set_flashdata('erro', 'Oops... Ocorreu um erro ao fazer o upload de imagem! :(');
                        redirect('equipamento/gerenciar_imagens_equipamento/'.$id_equipamento);
                    endif;
                endif;
            endif;

            $data['equipamento']     = $this->generica_consulta_model->consulta_equipamento_by_id($id_equipamento);
            $data['equipamento_img'] = $this->equipamento_model->recuperar_imagens_equipamento_by_id($id_equipamento);

            $data['main'] = 'equipamento/gerenciar_imagens';
            $this->load->view('templates/template_admin2', $data);
        endif;
    }

    public function deletar_imagem_equipamento($id_equipamento=NULL, $id_img_equipamento=NULL)
    {
        $id_equipamento = $this->funcoes->antiInjection($id_equipamento);
        $this->security_model->youShallNotPass($id_equipamento, 'EQP');
        $id_img_equipamento = $this->funcoes->antiInjection($id_img_equipamento);

        if($id_equipamento != NULL && is_numeric($id_equipamento) && $id_img_equipamento!=NULL && is_numeric($id_img_equipamento)):
            if($this->equipamento_model->deletar_imagem_equipamento($id_img_equipamento)):
                $this->session->set_flashdata('sucesso', 'Imagem removida com sucesso! :)');
                redirect('equipamento/gerenciar_imagens_equipamento/'.$id_equipamento);
            else:
                $this->session->set_flashdata('erro', 'Oops... Ocorreu um erro ao remover a imagem! :(');
                redirect('equipamento/gerenciar_imagens_equipamento/'.$id_equipamento);
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

/* End of file equipamento.php */
/* Location: ./application/controllers/equipamento.php */