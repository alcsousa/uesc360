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

class Cadastro_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('funcoes');
        $this->load->model('email_model');
    }

    /**
     * @autor Raul Cardoso
     * @version 1.0.0
     */
    public function nova_senha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false)
    {
        $lmin = 'abcdefghijklmnopqrstuvwxyz';
        $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '1234567890';
        $simb = '!@#$%*-';

        $retorno = '';
        $caracteres = '';

        $caracteres .= $lmin;
        if ($maiusculas) $caracteres .= $lmai;
        if ($numeros) $caracteres .= $num;
        if ($simbolos) $caracteres .= $simb;

        $len = strlen($caracteres);

        for ($n = 1; $n <= $tamanho; $n++) {
            $rand = mt_rand(1, $len);
            $retorno .= $caracteres[$rand-1];
        }

        return $retorno;
    }

    /**
     * Funcao verifica se o token de cadastro existe e se esta valido
     * @autor Raul Cardoso
     * @version 1.0.0
     * @param String $token Chave registrada no pedido de cadastro
     * @param String $tabela Tabela onde o token deve ser procurado
     * @return Boolean Retorna true caso o token exista e esteja valido, retorna false caso o token esteja invalido ou inexistente
     */
    public function verifica_token($token, $tabela)
    {
        $this->db->select('*');
        $this->db->from($tabela);
        $this->db->where('token', $token);
        $this->db->where('validate', 1);
        $count = $this->db->count_all_results();
        if ($count == 1) {
            $this->db->select('email');
            $this->db->from($tabela);
            $this->db->where('token', $token);
            $this->db->where('validate', 1);
            $query = $this->db->get();
            $row = $query->row_array();
            return $row['email'];
        } else {
            return false;
        }
    }

    /**
     * Funcao para registrar o token ao solicitar pedido de cadastro ou convite de cadastro
     * @autor Raul Cardoso
     * @version 1.0.0
     * @param int $fk_id_pessoa Numero referente a pessoa que solicitou o envio do convite
     * @param String $email Email referente ao que recebera o convite
     * @param String $token Chave de registro do pedido de convite
     * @param String $tabela Tabela onde seram inserido os dados, pedido cadastro / pedido de recuperar senha
     * @return Boolean Retorna true caso os dados forem inseridos com sucesso, e false caso contrario
     */
    public function gravar_token($fk_id_pessoa, $email, $token, $tabela)
    {
        if ($fk_id_pessoa) {

            $data = array(
               'fk_id_pessoa' => $fk_id_pessoa,
               'email' => $email,
               'token' => $token,
               'validate' => 1
            );

        } else {
            $data = array(
           'email' => $email,
           'token' => $token,
           'validate' => 1
        );
        }

        if($this->db->insert($tabela, $data)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Funcao para invalidar token apos o uso
     * @param String $token Chave registrada no pedido de cadastro / pedido de redefinição de senha
     * @param String $tabela Especifica em que tabela o token será invalidado, pedido de cadastro / redefinir senha
     * @return Boolean Retorna true caso o token foi invalidado, retorna false caso contrario
     */
    public function invalida_token($token, $tabela)
    {
        $data = array(
           'validate' => 0,
           'data_uso' => date('Y-m-d H:i:s')
        );

        $this->db->where('token', $token);

        if ($this->db->update($tabela, $data)) {
            return true;
        } else {
            return false;
        }

    }

    public function pedido_falso($token, $tabela){
        $data = array(
           'validate' => 0,
           'falso' => 1
        );

        $this->db->where('token', $token);
        if($this->db->update($tabela, $data)){
            return true;
        }else{
            return false;
        }
    }

    public function update_senha($id_usuario, $senha)
    {
        $data['senha_usu'] = sha1($senha);

        $this->db->where('id_usuario', $id_usuario);
        $this->db->update('usuario', $data);
    }

    public function pedido_solicitado($email)
    {
        $this->db->select('*');
        $this->db->from('pedido_cadastro');
        $this->db->where('email', $email);
        $this->db->where('validate', 1);
        $query = $this->db->get();
        $count = $query->num_rows();

        if ($count == 1):
            return true;
        else:
            return false;
        endif;
    }

    public function convite_solicitado($email)
    {
        $this->db->select('*');
        $this->db->from('convite');
        $this->db->where('email', $email);
        $this->db->where('validate', 1);
        $query = $this->db->get();
        $count = $query->num_rows();

        if ($count == 1):
            return true;
        else:
            return false;
        endif;
    }

    public function recuperar_solicitado($email)
    {
        $this->db->select('*');
        $this->db->from('recuperar_senha');
        $this->db->where('email', $email);
        $this->db->where('validate', 1);

        $query = $this->db->get();
        $count = $query->num_rows();

        if ($count == 1):
            return true;
        else:
            return false;
        endif;
    }

    public function insert_user($usuario=NULL, $pessoa=NULL)
    {
        if($usuario!=NULL && $pessoa!=NULL):

            $this->db->trans_start();
            $this->db->insert('usuario', $usuario);
            $userID = $this->db->insert_id();
            $pessoa['fk_id_usuario'] = $userID;
            $this->db->insert('pessoa', $pessoa);
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE):
                return false;
            else:
                return true;
            endif;
        endif;
    }
}


