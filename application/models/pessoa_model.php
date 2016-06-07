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

class Pessoa_model extends CI_Model
{

    public function cadastrar_pessoa($usuario=NULL, $pessoa=NULL, $permissao=NULL)
    {
        if($usuario!=NULL && $pessoa!=NULL && $permissao!=NULL):
            $this->db->trans_start();

            $this->db->insert('usuario', $usuario);

            $userID = $this->db->insert_id();
            $pessoa['fk_id_usuario'] = $userID;
            $this->db->insert('pessoa', $pessoa);

            $permissao_usuario['fk_id_usuario'] = $userID;
            $permissao_usuario['fk_id_permissao'] = $permissao;

            $this->db->insert('usuario_has_permissao', $permissao_usuario);

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE):
                return false;
            else:
                return true;
            endif;
        endif;
    }

    public function atualizar_pessoa($id_pessoa=NULL, $pessoa=NULL, $usuario=NULL)
    {
        if($id_pessoa!=NULL && $pessoa!=NULL && $usuario!=NULL):

            $this->db->trans_begin();

            $this->db->select('fk_id_usuario');
            $this->db->from('pessoa');
            $this->db->where('id_pessoa', $id_pessoa);
            $ID_USU = $this->db->get()->row()->fk_id_usuario;

            $this->db->where('id_usuario', $ID_USU);
            $this->db->update('usuario', $usuario);

            $this->db->where('id_pessoa', $id_pessoa);
            $this->db->update('pessoa', $pessoa);

            if($this->db->trans_status() === FALSE):
                $this->db->trans_rollback();
                return false;
            else:
                $this->db->trans_commit();
                return true;
            endif;


        else:
            return false;
        endif;
    }

}

/* End of file pessoa_model.php */
/* Location: ./application/models/pessoa_model.php */