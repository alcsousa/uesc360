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

class Usuario extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// library
		$this->load->library('funcoes');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<small class="red-text">* ', '</small>');
		// model
		$this->load->model('usuario_model', 'usuario');
		$this->load->model('crud_model', 'crud');

		if (!$this->session->userdata('logged_in')):
			redirect('login/logoff');
		endif;
	}

	public function index()
	{
		$data['main'] = '/usuario/painel';
		$this->load->view('templates/template_usuario', $data);
	}

	public function perfil()
	{
		$data['pessoa'] = $this->usuario->get_info_pessoa($this->session->userdata('id_pessoa'));
		$data['main'] = '/usuario/perfil';
		$this->load->view('templates/template_admin2', $data);
	}

	public function editar()
	{
		$this->form_validation->set_rules('nome', 'NOME', 'trim|required|min_length[15]|max_length[50]|mb_strtoupper');
		$this->form_validation->set_rules('email', 'EMAIL', 'trim|required|max_length[45]|strtolower|valid_email|callback_check_email_unique');
        $this->form_validation->set_rules('ramal', 'RAMAL', 'trim|required|min_length[14]|max_length[15]|alpha_numeric_spaces');
		$this->form_validation->set_rules('lattes', 'LATTES', 'trim|max_length[70]');
		$this->form_validation->set_rules('website', 'WEBSITE', 'trim|max_length[50]|prep_url');
		$this->form_validation->set_rules('tipo_pessoa', 'SELECIONE TIPO DE PESSOA', 'callback_check_drop');
        $this->form_validation->set_rules('cpf', 'CPF', 'required|trim|exact_length[14]|callback_check_cpf|callback_check_cpf_unique');
        $this->form_validation->set_rules('birthday', 'DATA DE NASCIMENTO', 'required|trim|exact_length[10]|alphanumeric');

		if ($this->form_validation->run()==TRUE):

			$id = $this->session->userdata('id_pessoa');

			$dados = array('nome_pes' => $this->input->post('nome'),
							'email_pes' => $this->input->post('email'),
							'ramal_pes' => $this->input->post('ramal'),
							'lattes_pes' => $this->input->post('lattes'),
							'website_pes' => $this->input->post('website'),
							'birthday_pes' => $this->funcoes->formatoDataBanco($this->input->post('birthday')),
							'fk_id_tipo_pessoa' => $this->input->post('tipo_pessoa'),
							'fk_id_departamento' => $this->input->post('departamento'),
			);

			$dataU['login_usu'] = $this->input->post('email');

			$this->crud->updatePessoa($id, $dados);
			$this->crud->updateUsuario($this->session->userdata('id_usuario'), $dataU);
			$this->session->set_userdata('username', $dados['nome_pes']);
			$this->session->set_flashdata('success', 'Dados alterados com sucesso!');
			redirect('usuario/perfil');
		endif;

		$data['tipo_pessoa'] = $this->crud->getAllTipo_pessoa()->result();
		$data['departamento'] = $this->crud->getAllDepartamento()->result();
		$data['pessoa'] = $this->usuario->get_info_pessoa($this->session->userdata('id_pessoa'));
		$data['main'] = '/usuario/editar_usuario';
		$this->load->view('templates/template_admin2', $data);
	}

	public function senha()
	{
		$this->form_validation->set_rules('senha', 'SENHA ATUAL', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('senha2', 'NOVA SENHA', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('senha3', 'REPETIR SENHA', 'trim|required|min_length[5]|matches[senha2]');

		if($this->form_validation->run()==true):

			$id_usuario = $this->session->userdata('id_usuario');

			$senha_atual = sha1($this->input->post('senha'));

			if($this->usuario->senha_valida($id_usuario, $senha_atual)==true):
				$nova_senha = sha1($this->input->post('senha2'));
				$this->usuario->change_password($id_usuario, $nova_senha);

				$this->session->set_flashdata('sucesso', 'Senha alterada com sucesso!');

				redirect('usuario/perfil');
			else:
				$data['error'] = "Senha atual foi digitada de forma incorreta!";
			endif;
		endif;

		$data['main'] = '/usuario/senha';
		$this->load->view('templates/template_admin2', $data);
	}

	public function participante()
	{
		$data['fk_id_laboratorio'] = $this->input->post('ID_LABORATORIO');
		$data['fk_id_pessoa'] = $this->session->userdata('id_pessoa');
		// $data['permissao_lhp'] = 3;
		$data['permissao_lhp'] = 4;
		$this->usuario->add_participante($data);
		redirect(base_url().'search/laboratorio/'.$data['fk_id_laboratorio'].'/');
	}

	public function nao_participante()
	{
		$this->usuario->remove_participante($this->input->post('ID_LABORATORIO'), $this->session->userdata('id_pessoa'));
		redirect(base_url().'search/laboratorio/'.$this->input->post('ID_LABORATORIO').'/');
	}

	public function laboratorios()
	{
		$data['laboratorios'] = $this->usuario->get_meus_laboratorios();
		$data['main'] = '/usuario/laboratorios';
		$this->load->view('templates/template_usuario', $data);
	}

	public function check_drop($str)
	{
		if($str == 'blank'):
			$this->form_validation->set_message('check_drop', 'Por favor, selecione um item!');
			return false;
		else:
			return true;
		endif;
	}

	public function check_cpf_unique($cpf)
	{
    	$this->load->model('generica_consulta_model');
		if($this->generica_consulta_model->existe_CPF($this->session->userdata('id_pessoa'), $cpf)):
			$this->form_validation->set_message('check_cpf_unique', 'CPF já existe! Insira outro.');
			return false;
		else:
			return true;
		endif;
	}

	public function check_email_unique($email)
	{
    	$this->load->model('generica_consulta_model');
		if($this->generica_consulta_model->existe_EMAIL_ACESSO($this->session->userdata('id_usuario'), $email)):
			$this->form_validation->set_message('check_email_unique', 'Email já existe! Insira outro.');
			return false;
		else:
			return true;
		endif;
	}

    public function check_cpf($cpf)
    {
        $this->form_validation->set_message('check_cpf', 'O %s informado não é válido.');
        if($cpf == ''):
            return true;
        endif;
        $cpf = preg_replace('/[^0-9]/','',$cpf);
        if(strlen($cpf) != 11 || preg_match('/^([0-9])\1+$/', $cpf)){
            return false;
        }
        $digit = substr($cpf, 0, 9);
        for($j=10; $j <= 11; $j++){
            $sum = 0;
            for($i=0; $i< $j-1; $i++){
                $sum += ($j-$i) * ((int) $digit[$i]);
            }
            $summod11 = $sum % 11;
            $digit[$j-1] = $summod11 < 2 ? 0 : 11 - $summod11;
        }
        return $digit[9] == ((int)$cpf[9]) && $digit[10] == ((int)$cpf[10]);
    }

}

/* End of file usuario.php */
/* Location: ./application/controllers/usuario.php */