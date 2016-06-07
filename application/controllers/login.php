<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<small class="red-text">* ', '</small>');
		$this->load->model('crud_model', 'crud');
		$this->load->model('acesso_model', 'acesso');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') && $this->session->userdata('permissao_usu')==1):
			redirect('painel');
		elseif ($this->session->userdata('logged_in') && $this->session->userdata('permissao_usu')==2):
			redirect('painel');
		elseif ($this->session->userdata('logged_in') && $this->session->userdata('permissao_usu')==3):
			redirect('painel');
		endif;

		$this->form_validation->set_rules('usuario', 'USUÁRIO', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('senha', 'SENHA', 'trim|required|sha1');

		if ($this->form_validation->run()==TRUE):

			$usuario = $this->input->post('usuario');
			$senha = $this->input->post('senha');

			$userIsLogged = $this->acesso->isValidLogin($usuario, $senha);

			if ($userIsLogged):
				$sess_data['id_usuario'] 	= $userIsLogged[0]->id_usuario;
				$sess_data['id_pessoa'] 	= $userIsLogged[0]->id_pessoa;
				$sess_data['username'] 		= $userIsLogged[0]->nome_pes;
				$sess_data['status'] 		= $userIsLogged[0]->ativo_usu;
				$sess_data['logged_in'] 	= TRUE;
				$sess_data['permissao_usu'] = $userIsLogged[0]->fk_id_permissao;
				$this->session->set_userdata($sess_data);

				$this->acesso->accessLog($sess_data['id_usuario']);

				switch ($sess_data['permissao_usu']):
					case 1:
						redirect('painel');
						break;
					case 2:
						redirect('painel');
						break;
					case 3:
						redirect('painel');
						break;

					default:
						$this->logoff();
						break;
				endswitch;

			endif;
			$dados['loginError'] = true;
		endif;

		$dados['main'] = 'telas/login';
		$this->load->view('templates/template_blank', $dados);
	}

	public function recuperar_senha()
	{
        $this->form_validation->set_rules('email', 'EMAIL', 'trim|required|min_length[7]|max_length[60]|xss_clean|valid_email|strtolower|callback_check_email');

        if($this->form_validation->run() === true):

            $email = $this->input->post('email');

			$this->load->model('cadastro_model');

            $token = $this->email_model->get_token();
            if ($this->cadastro_model->gravar_token(0, $email, $token, 'recuperar_senha')):
            	$link_recuperacao = base_url('cadastro/nova_senha/'.$token);
            	$link_cancelar 	  = base_url('cadastro/falso/'.$token);
                $mensagem = "Olá, você solicitou a redefinição da sua senha. Clique no link a seguir para continuar:
                <br/><br/>
                <a href=\"{$link_recuperacao}\">Recuperar senha</a>
                <br/><br/>
                Se você não solicitou a recuperação de senha, clique no link abaixo:
                <br/><br/>
                <a href=\"{$link_cancelar}\">Não solicitei</a>
                <br/><br/>";
                $this->email_model->enviar_email($email,'Recuperar Senha - UESC 360º', $mensagem);
                $data['sucesso'] = "Email de recuperação de senha enviado com sucesso! Por favor, verifique a sua caixa de entrada.";
            else:
                $data['erro'] = "Token não foi gravado!";
            endif;
        endif;
        $data['main'] = 'telas/recuperar_senha';
        $this->load->view('templates/template_home', $data);
	}

    public function login_as($permissao=NULL)
    {
        $this->load->library('funcoes');
        $permissao = $this->funcoes->antiInjection($permissao);

        if($permissao!=NULL && is_numeric($permissao) && ($permissao >= 1 && $permissao <= 3)):

            switch ($permissao)
            {
                case 1:
                    if($this->security_model->isAdmin()):
                        $this->session->set_userdata('permissao_usu', 1);
                        redirect('painel');
                    else:
                        redirect('login/logoff','refresh');
                    endif;
                break;

                case 2:
                    if($this->security_model->isAdmin()):
                        $this->session->set_userdata('permissao_usu', 2);
                        redirect('painel');
                    else:
                        redirect('login/logoff','refresh');
                    endif;
                break;

                default:
                    redirect('login/logoff','refresh');
                break;
            }
        else:
            redirect('login/logoff','refresh');
        endif;
    }

	public function logoff()
	{
	    $this->session->set_userdata(array('username' => '', 'logged_in' => FALSE));
		$this->session->sess_destroy();
		redirect('login', 'refresh');
	}

    public function check_email($email)
    {
        $this->load->model('generica_consulta_model');
        if($this->generica_consulta_model->existe_EMAIL($email)):
            return true;
        else:
            $this->form_validation->set_message('check_email', 'O email inserido é inválido!');
            return false;
        endif;
    }
}