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

class Pessoa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('funcoes');

        $this->form_validation->set_error_delimiters('<small class="red-text right">* ', '</small>');

        $this->load->model('admin_gerencia_model');
        $this->load->model('generica_consulta_model');
        $this->load->model('crud_model');
        $this->load->model('email_model');
        $this->load->model('pessoa_model');

        if (!$this->session->userdata('logged_in')):
            redirect('login/logoff');
        endif;

        if(!$this->security_model->isAdmin() || $this->session->userdata('permissao_usu') != 1):
            $this->session->set_flashdata('erro', 'Você não possui permissão para acessar essa página! :X');
            redirect('painel', 'refresh');
        endif;
    }

    public function index()
    {
        echo "There is nothing here... :X";
    }

    public function visualizar_pessoa($id_pessoa=NULL)
    {
        if($id_pessoa != NULL && is_numeric($id_pessoa)):
            $data['pessoa']               = $this->generica_consulta_model->consulta_pessoa_by_id($this->funcoes->antiInjection($id_pessoa));
            $data['laboratorio_coordena'] = $this->generica_consulta_model->consulta_coordenador_laboratorio($this->funcoes->antiInjection($id_pessoa));
            $data['permissoes'] = $this->security_model->getPermissions($this->funcoes->antiInjection($id_pessoa));
        endif;
        $data['main'] = 'pessoa/visualizacao_pessoa';
        $this->load->view('templates/template_admin2', $data);
    }

    public function listar_pessoas()
    {
        $data['pessoa'] = $this->generica_consulta_model->listar_pessoas();
        $data['main'] = 'pessoa/listar_pessoas';
        $this->load->view('templates/template_admin2', $data);
    }

    public function cadastrar_pessoa()
    {
        $this->form_validation->set_rules('departamento', 'SELECIONE DEPARTAMENTO', 'callback_check_drop');
        $this->form_validation->set_rules('tipo_pessoa', 'SELECIONE TIPO PESSOA', 'callback_check_drop');
        $this->form_validation->set_rules('nome', 'NOME', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('email', 'EMAIL', 'trim|required|max_length[45]|strtolower|valid_email|is_unique[usuario.login_usu]');
        $this->form_validation->set_rules('ramal', 'RAMAL', 'trim|required|max_length[15]|alphanumeric');
        $this->form_validation->set_rules('lattes', 'LATTES', 'trim|max_length[70]');
        $this->form_validation->set_rules('website', 'WEBSITE', 'trim|max_length[50]');
        $this->form_validation->set_rules('permissao', 'SELECIONE A PERMISSÃO DO USUÁRIO', 'callback_check_drop');

        if ($this->form_validation->run()==TRUE):

            $senha = random_string('alnum', 10);

            $usuario['login_usu'] = $this->input->post('email');
            $usuario['senha_usu'] = sha1($senha);

            $pessoa['nome_pes'] = $this->input->post('nome');
            $pessoa['email_pes'] = $this->input->post('email');
            $pessoa['ramal_pes'] = $this->input->post('ramal');
            $pessoa['lattes_pes'] = $this->input->post('lattes');
            $pessoa['website_pes'] = $this->input->post('website');
            $pessoa['fk_id_tipo_pessoa'] = $this->input->post('tipo_pessoa');
            $pessoa['fk_id_departamento'] = $this->input->post('departamento');

            $permissao = $this->input->post('permissao');

            if($this->pessoa_model->cadastrar_pessoa($usuario, $pessoa, $permissao)==true):
                $email = $pessoa['email_pes'];
                $assunto = "Seja bem-vindo ao UESC 360º!";
                $mensagem = "Você foi cadastrado na plataforma UESC 360º!<br> Usuário: ".$usuario['login_usu']."<br> Senha: ".$senha;

                if($this->email_model->enviar_email($email, $assunto, $mensagem)==true):
                    $data['sucesso'] = 'Dados cadastrados com sucesso! (Email enviado ao usuário '.$usuario['login_usu'].')';
                else:
                    $data['sucesso'] = 'Dados cadastrados com sucesso! (Email <b>NÃO</b> enviado ao usuário '.$usuario['login_usu'].')';
                endif;
            else:
                $data['erro'] = 'Oops... Os dados inseridos não foram cadastrados! :(';
            endif;

        endif;

        $data['main'] = 'pessoa/cadastrar_pessoa';
        $data['departamento'] = $this->crud_model->getAllDepartamento()->result();
        $data['tipo_pessoa'] = $this->crud_model->getAllTipo_pessoa()->result();
        $this->load->view('templates/template_admin2', $data);
    }

    public function editar_pessoa($id_pessoa=NULL)
    {
        $id_pessoa = $this->funcoes->antiInjection($id_pessoa);

        if($id_pessoa != NULL && is_numeric($id_pessoa)):

            $this->form_validation->set_rules('nome', 'NOME', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('email', 'EMAIL', 'trim|required|max_length[45]|strtolower|valid_email');
            $this->form_validation->set_rules('ramal', 'RAMAL', 'trim|required|min_length[14]|max_length[15]|alpha_numeric_spaces');
            $this->form_validation->set_rules('lattes', 'LATTES', 'trim|max_length[70]');
            $this->form_validation->set_rules('website', 'WEBSITE', 'trim|max_length[50]');
            $this->form_validation->set_rules('departamento', 'SELECIONE DEPARTAMENTO', 'callback_check_drop');
            $this->form_validation->set_rules('tipo_pessoa', 'SELECIONE TIPO PESSOA', 'callback_check_drop');

            if($this->form_validation->run() == TRUE):
                $pessoa['nome_pes'] = $this->input->post('nome');
                $pessoa['email_pes'] = $this->input->post('email');
                $pessoa['ramal_pes'] = $this->input->post('ramal');
                $pessoa['lattes_pes'] = $this->input->post('lattes');
                $pessoa['website_pes'] = $this->input->post('website');
                $pessoa['fk_id_tipo_pessoa'] = $this->input->post('tipo_pessoa');
                $pessoa['fk_id_departamento'] = $this->input->post('departamento');

                $usuario['login_usu'] = $this->input->post('email');

                if($this->pessoa_model->atualizar_pessoa($id_pessoa, $pessoa, $usuario) == TRUE):
                    $this->session->set_flashdata('sucesso', 'Dados atualizados com sucesso! :)');
                    redirect('pessoa/visualizar_pessoa/'.$id_pessoa);
                else:
                    $this->session->set_flashdata('erro', 'Oops... Ocorreu um erro ao atualizar os dados! :(');
                    redirect('pessoa/visualizar_pessoa/'.$id_pessoa);
                endif;
            endif;
            $data['pessoa'] = $this->generica_consulta_model->consulta_pessoa_by_id($id_pessoa);
            $data['departamento'] = $this->generica_consulta_model->consulta_departamentos();
            $data['tipo_pessoa'] = $this->crud_model->getAllTipo_pessoa()->result();
        endif;
        $data['main'] = 'pessoa/editar_pessoa';
        $this->load->view('templates/template_admin2', $data);
    }

    public function deletar_usuario($id_usuario=NULL)
    {
        $id_usuario = $this->funcoes->antiInjection($id_usuario);

        if($id_usuario!=NULL && is_numeric($id_usuario)):
            if($this->admin_gerencia_model->deleta_usuario($id_usuario)):
                $this->session->set_flashdata('sucesso', 'Usuário removido com sucesso! :)');
                redirect('pessoa/listar_pessoas');
            endif;
            $this->session->set_flashdata('erro', 'Erro! Usuário NÃO foi removido! :(');
            redirect('pessoa/listar_pessoas');
        endif;
        $this->session->set_flashdata('erro', 'Erro! Dado inválido. Usuário NÃO foi removido! :(');
        redirect('pessoa/listar_pessoas');
    }

    /**
     * Bloqueia ou desbloqueia o usuário.
     * $status = 1 (usuário ativo), $status = 0 (usuário inativo)
     */
    public function bloquear_usuario($id_pessoa=NULL, $status=NULL)
    {
        $id_pessoa = $this->funcoes->antiInjection($id_pessoa);

        if($id_pessoa!=NULL && is_numeric($id_pessoa) && $status!=NULL && is_numeric($status) && ($status==0 || $status==1)):

            if($this->admin_gerencia_model->bloqueia_usuario($id_pessoa, $status)):
                if($status==0):
                    $this->session->set_flashdata('sucesso', 'Usuário bloqueado com sucesso! :)');
                elseif($status==1):
                    $this->session->set_flashdata('sucesso', 'Usuário desbloqueado com sucesso! :)');
                endif;
            else:
                $this->session->set_flashdata('erro', 'Oops... Ocorreu algum erro! Tente novamente. :(');
            endif;
            redirect('pessoa/visualizar_pessoa/'.$id_pessoa);
        else:
            redirect('pessoa/listar_pessoas');
        endif;
    }

    public function gerenciar_permissao($id_pessoa=NULL, $id_usuario=NULL, $permissao=NULL, $status=NULL)
    {
        $id_pessoa = $this->funcoes->antiInjection($id_pessoa);
        $id_usuario = $this->funcoes->antiInjection($id_usuario);
        $permissao = $this->funcoes->antiInjection($permissao);

        if($id_pessoa!=NULL && is_numeric($id_pessoa) && $id_usuario!=NULL && is_numeric($id_usuario) && $status!=NULL && is_numeric($status) && ($status==0 || $status==1) && $permissao!=NULL && is_numeric($permissao) && ($permissao >= 1 && $permissao < 3)):

            if($this->admin_gerencia_model->gerenciar_permissao($id_usuario, $permissao, $status) == true):
                if($status==0):
                    $this->session->set_flashdata('sucesso', 'Permissão removida com sucesso! :)');
                elseif($status==1):
                    $this->session->set_flashdata('sucesso', 'Permissão adicionada com sucesso! :)');
                endif;
            else:
                $this->session->set_flashdata('erro', 'Oops... Ocorreu algum erro! Tente novamente. :(');
            endif;
            redirect('pessoa/visualizar_pessoa/'.$id_pessoa);

        else:
            redirect('login/logoff');
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

/* End of file pessoa.php */
/* Location: ./application/controllers/pessoa.php */