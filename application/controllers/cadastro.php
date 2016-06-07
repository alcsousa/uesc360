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

class Cadastro extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<small class="red-text">* ', '</small>');

        $this->load->model('crud_model');
        $this->load->model('cadastro_model');
        $this->load->model('email_model');
    }

    public function index()
    {
        $this->form_validation->set_rules('departamento', 'SELECIONE DEPARTAMENTO', 'callback_check_drop');
        $this->form_validation->set_rules('tipo_pessoa', 'SELECIONE TIPO PESSOA', 'callback_check_drop');
        $this->form_validation->set_rules('dia', 'DIA', 'greater_than[0]|less_than[32]|callback_check_drop_date');
        $this->form_validation->set_rules('mes', 'MÊS', 'greater_than[0]|less_than[13]|callback_check_drop_date');
        $this->form_validation->set_rules('ano', 'ANO', 'greater_than[1929]|less_than[1999]|callback_check_drop_date');
        $this->form_validation->set_rules('sexo', 'SEXO', 'required|exact_length[1]');
        $this->form_validation->set_rules('nome', 'NOME', 'trim|required|max_length[50]|mb_strtoupper');
        $this->form_validation->set_rules('email', 'EMAIL', 'trim|required|max_length[90]|strtolower|valid_email|is_unique[pessoa.email_pes]');
        $this->form_validation->set_rules('ramal', 'RAMAL', 'trim|required|max_length[15]|alphanumeric');
        $this->form_validation->set_rules('lattes', 'LATTES', 'trim|required|max_length[70]');
        $this->form_validation->set_rules('website', 'WEBSITE', 'trim|max_length[50]|strtolower');
        $this->form_validation->set_rules('senha', 'SENHA', 'trim|required');
        $this->form_validation->set_message('matches', 'O campo %s está diferente do campo %s!');
        $this->form_validation->set_rules('senha2', 'REPETIR SENHA', 'trim|required|matches[senha]');
        $this->form_validation->set_rules('cpf', 'CPF', 'required|trim|exact_length[14]|is_unique[pessoa.cpf_pes]|callback_check_cpf');


        if($this->form_validation->run() == TRUE):
            $dia = $this->input->post('dia');
            $mes = $this->input->post('mes');
            $ano = $this->input->post('ano');
            $dados2 = array('nome_pes' => $this->input->post('nome'),
                            'email_pes' => $this->input->post('email'),
                            'ramal_pes' => $this->input->post('ramal'),
                            'lattes_pes' => $this->input->post('lattes'),
                            'website_pes' => $this->input->post('website'),
                            'fk_id_tipo_pessoa' => $this->input->post('tipo_pessoa'),
                            'fk_id_departamento' => $this->input->post('departamento'),
                            'cpf_pes' => $this->input->post('cpf'),
                            'birthday_pes' => $ano.'-'.$mes.'-'.$dia,
                            'sexo_pes' => $this->input->post('sexo'),
            );

            $dados1 = array('login_usu' => $this->input->post('email'),
                            'senha_usu' => sha1($this->input->post('senha'))
            );

            $this->crud_model->insertUsuario($dados1);
            $dados2['fk_id_usuario'] = $this->db->insert_id();
            $this->crud_model->insertPessoa($dados2);

            $dados3['fk_id_usuario'] = $dados2['fk_id_usuario'];
            $dados3['fk_id_permissao'] = 3;
            $this->crud_model->insertPermissao($dados3);

            $this->cadastro_model->invalida_token($token, 'pedido_cadastro');

            $this->session->set_flashdata('sucesso', 'Cadastro efetuado com sucesso! :)');
            redirect('login');
        endif;

        $data['departamento'] = $this->crud_model->getAllDepartamento()->result();
        $data['tipo_pessoa'] = $this->crud_model->getAllTipo_pessoa()->result();
        $data['main'] = 'telas/cadastro_finalizar';
        $this->load->view('templates/template_home', $data);
    }


    public function pedido_falso($value='')
    {
        $token = $this->uri->segment(3);
        if ($this->cadastro_model->verifica_token($token, 'pedido_cadastro')) {
            $this->cadastro_model->pedido_falso($token, 'pedido_cadastro');
        }

        $dados = array(
            'tela' => 'telas/home'
        );
        $this->load->view('template', $dados);
    }

    public function nova_senha($token=NULL)
    {
        if($token==NULL || !ctype_alnum($token)){redirect('home','refresh');}

        $retorno = $this->cadastro_model->verifica_token($token, 'recuperar_senha');
        if ($retorno) {
            $dados['token'] = $token;
            $dados['main'] = 'telas/nova_senha';
        } else {
            $dados['main'] = 'telas/recuperar_senha';
        }
        $this->load->view('templates/template_home', $dados);
    }

    public function falso($token=NULL)
    {
        if($token==NULL || !ctype_alnum($token)){redirect('home','refresh');}

        $retorno = $this->cadastro_model->verifica_token($token, 'recuperar_senha');
        if ($retorno) {
            $this->cadastro_model->pedido_falso($token, 'recuperar_senha');
            $data['main'] = 'telas/login';
        } else {
            $data['main'] = 'telas/login';
        }
        $this->load->view('templates/template_home', $data);
    }

    public function gravar_senha($token=NULL)
    {
        if($token==NULL || !ctype_alnum($token)){redirect('home','refresh');}

        $this->form_validation->set_rules('senha', 'NOVA SENHA', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('confirmar_senha', 'CONFIRMAR SENHA', 'trim|required|min_length[5]|matches[senha]');
        $email = $this->cadastro_model->verifica_token($token, 'recuperar_senha');
        $data['main'] = 'telas/nova_senha';

        if($email != false)
        {
            if ($this->form_validation->run()==TRUE):
                $senha = $this->input->post('senha');
                $pessoa = $this->crud_model->get_pessoa($email);
                $this->cadastro_model->update_senha($pessoa[0]['fk_id_usuario'], $senha);
                $this->cadastro_model->invalida_token($token, 'recuperar_senha');
                $data['main'] = 'telas/login';
                $data['sucesso'] = 'Senha alterada com sucesso!';
            endif;
        }
        else
        {
            $data['main'] = 'telas/recuperar_senha';
            $data['erro'] = 'Token inválido! Solicite outro link de recuperação de senha.';
        }
        $this->load->view('templates/template_home', $data);
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

    public function check_drop_date($str)
    {
        if(empty($str)):
            $this->form_validation->set_message('check_drop_date', 'Por favor, selecione um item!');
            return FALSE;
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

/* End of file cadastro.php */
/* Location: ./application/controllers/cadastro.php */