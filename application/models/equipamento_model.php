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

class Equipamento_model extends CI_Model
{

    public function cadastrar_equipamento($equipamento=NULL, $laboratorio_has_equipamento=NULL)
    {
        if($equipamento!=NULL && $laboratorio_has_equipamento!=NULL):
            $this->db->trans_start();

            $this->db->insert('equipamento', $equipamento);
            $eqpID = $this->db->insert_id();
            $laboratorio_has_equipamento['fk_id_equipamento'] = $eqpID;
            $this->db->insert('laboratorio_has_equipamento', $laboratorio_has_equipamento);

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE):
                return false;
            else:
                return true;
            endif;
        endif;
    }

    public function inserir_imagem_equipamento($id_equipamento=NULL, $img_equipamento)
    {
        if($id_equipamento!=NULL && $img_equipamento!=NULL):

            $this->db->trans_begin();

            $this->db->insert('img_equipamento', $img_equipamento);

            $id_img_equipamento = $this->db->insert_id();

            $equipamento_has_img['fk_id_equipamento']     = $id_equipamento;
            $equipamento_has_img['fk_id_img_equipamento'] = $id_img_equipamento;

            $this->db->insert('equipamento_has_img', $equipamento_has_img);


            if ($this->db->trans_status() === FALSE):
                $this->db->trans_rollback();
                return false;
            else:
                $this->db->trans_commit();
                return true;
            endif;
        endif;
        return false;
    }

    public function recuperar_imagens_equipamento_by_id($id_equipamento=NULL)
    {
    	if($id_equipamento!=NULL):
	        $this->db->select('ime.id_img_equipamento,ime.nome_ime');
	        $this->db->from('img_equipamento as ime');
	        $this->db->join('equipamento_has_img as ehi', 'ehi.fk_id_img_equipamento = ime.id_img_equipamento', 'left');
	        $this->db->where('ehi.fk_id_equipamento', $id_equipamento);
	        return $this->db->get()->result();
    	endif;
	    return false;
    }

    public function atualizar_dados_equipamento($id_equipamento=NULL, $equipamento=NULL)
    {
        if($id_equipamento!=NULL && $equipamento!=NULL):
            $this->db->trans_begin();
            $this->db->where('id_equipamento', $id_equipamento);
            $this->db->update('equipamento', $equipamento);

            if ($this->db->trans_status() === FALSE):
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

    public function atualizar_laboratorio_equipamento($id_equipamento=NULL, $laboratorio_has_equipamento=NULL)
    {
        if($id_equipamento!=NULL && $laboratorio_has_equipamento!=NULL):
            $this->db->trans_begin();

            $this->db->where('fk_id_equipamento', $id_equipamento);
            $this->db->update('laboratorio_has_equipamento', $laboratorio_has_equipamento);

            if ($this->db->trans_status() === FALSE):
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

    public function deletar_equipamento($id_laboratorio=NULL, $id_equipamento=NULL)
    {
    	if($id_laboratorio!=NULL && $id_equipamento!=NULL):

            $this->db->trans_begin();

        	$this->db->where('fk_id_equipamento', $id_equipamento);
        	$this->db->where('fk_id_laboratorio', $id_laboratorio);
        	$rs = $this->db->get('laboratorio_has_equipamento');

        	if($rs->num_rows() == 1):
        		$imgs_eqp = $this->recuperar_imagens_equipamento_by_id($id_equipamento);
        		if($imgs_eqp):
        			foreach ($imgs_eqp as $row):
        				$this->deletar_imagem_equipamento($row->id_img_equipamento);
        			endforeach;
        		endif;
    			$this->db->where('id_equipamento', $id_equipamento);
    			$this->db->delete('equipamento');
        	else:
                return false;
        	endif;

            if ($this->db->trans_status() === FALSE):
                $this->db->trans_rollback();
                return false;
            else:
                $this->db->trans_commit();
                return true;
            endif;

    	endif;
    	return false;
    }

    public function deletar_imagem_equipamento($id_img_equipamento=NULL)
    {
        if($id_img_equipamento!=NULL):

            $this->db->select('nome_ime');
            $this->db->from('img_equipamento');
            $this->db->where('id_img_equipamento', $id_img_equipamento);
            $path = './uploads/equipamento/'.$this->db->get()->row()->nome_ime;

            if($path!=NULL && file_exists($path)):
                unlink($path);
                $this->db->where('id_img_equipamento', $id_img_equipamento);
                $this->db->delete('img_equipamento');
                return true;
            endif;
        endif;
        return false;
    }

}

/* End of file equipamento_model.php */
/* Location: ./application/models/equipamento_model.php */