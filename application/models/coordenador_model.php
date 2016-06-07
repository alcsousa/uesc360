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

class Coordenador_model extends CI_Model
{
	public function get_all_laboratorios()
	{
		$this->db->select('*');
		$this->db->from('laboratorio_has_pessoa');
		$this->db->join('laboratorio', 'laboratorio.id_laboratorio = laboratorio_has_pessoa.fk_id_laboratorio', 'left');
		$this->db->where('fk_id_pessoa', $this->session->userdata('id_pessoa'));
		$this->db->where('laboratorio.ativo_lab', 1);
		return $this->db->get()->result();
	}

	public function get_all_equipamentos()
	{
		$this->db->select('id_equipamento, nome_eqp, fabricante_eqp, quantidade_eqp, especificacao_eqp, descricao_eqp');
		$this->db->from('laboratorio_has_pessoa');
		$this->db->join('laboratorio', 'laboratorio.id_laboratorio = laboratorio_has_pessoa.fk_id_laboratorio', 'left');
		$this->db->join('laboratorio_has_equipamento', 'laboratorio_has_equipamento.fk_id_laboratorio = laboratorio.id_laboratorio', 'left');
		$this->db->join('equipamento', 'laboratorio_has_equipamento.fk_id_equipamento = equipamento.id_equipamento', 'left');
		$this->db->where('laboratorio_has_pessoa.fk_id_pessoa', $this->session->userdata('id_pessoa'));
		$this->db->where('equipamento.ativo_eqp', 1);

		$rs = $this->db->get();

		if($rs->num_rows() > 0):
			return $rs->result();
		endif;
	}

	public function get_all_equipamentos_by_id_lab($id=NULL)
	{
		if($id != NULL):
			$this->db->select('id_equipamento, nome_eqp, fabricante_eqp, quantidade_eqp, especificacao_eqp, descricao_eqp');
			$this->db->from('laboratorio_has_pessoa');
			$this->db->join('laboratorio', 'laboratorio.id_laboratorio = laboratorio_has_pessoa.fk_id_laboratorio', 'left');
			$this->db->join('laboratorio_has_equipamento', 'laboratorio_has_equipamento.fk_id_laboratorio = laboratorio.id_laboratorio', 'left');
			$this->db->join('equipamento', 'laboratorio_has_equipamento.fk_id_equipamento = equipamento.id_equipamento', 'left');
			$this->db->where('laboratorio_has_pessoa.fk_id_laboratorio', $id);
			$this->db->where('laboratorio_has_pessoa.fk_id_pessoa', $this->session->userdata('id_pessoa'));
			$this->db->where('equipamento.ativo_eqp', 1);
			// $this->db->where('laboratorio.ativo_lab', 1);
			$rs = $this->db->get();

			if($rs->num_rows() > 0):
				return $rs->result();
			else:
				return false;
			endif;
		endif;
		return false;
	}

	public function get_eqp_name($id)
	{
		$this->db->select('nome_eqp');
		$this->db->from('equipamento');
		$this->db->where('id_equipamento', $id);
		return $this->db->get()->result();
	}

	public function get_all_equipamentos_imagens_by_id($idEqp=NULL)
	{
		if($idEqp!=NULL):
            $this->db->select('*');
            $this->db->from('equipamento_has_img');
            $this->db->join('img_equipamento', 'equipamento_has_img.fk_id_img_equipamento = img_equipamento.id_img_equipamento', 'left');
            $this->db->where('equipamento_has_img.fk_id_equipamento', $idEqp);
            $this->db->where('img_equipamento.ativo_ime', 1);
            return $this->db->get()->result();
		endif;
	}

    public function remove_imagens_equipamento_by_id($idImgs=NULL)
    {
        if($idImgs!=NULL):
            $dados['ativo_ime'] = 0;
            $this->db->where_in('id_img_equipamento', $idImgs);
            $this->db->update('img_equipamento', $dados);
            return true;
        else:
            return false;
        endif;
    }

	public function get_lab_name($id)
	{
		$this->db->select('nome_lab');
		$this->db->from('laboratorio');
		$this->db->where('id_laboratorio', $id);
		return $this->db->get()->result();
	}

	public function get_all_laboratorios_imagens_by_id($idLab=NULL)
	{
		if($idLab!=NULL):
			$this->db->select('*');
			$this->db->from('laboratorio_has_img');
			$this->db->join('img_laboratorio', 'laboratorio_has_img.fk_id_img_laboratorio = img_laboratorio.id_img_laboratorio', 'left');
			$this->db->where('laboratorio_has_img.fk_id_laboratorio', $idLab);
			$this->db->where('img_laboratorio.ativo_iml', 1);
			return $this->db->get()->result();
		endif;
	}

	public function remove_imagens_laboratorio_by_id($idImgs=NULL)
	{
		if($idImgs!=NULL):
			$dados['ativo_iml'] = 0;
			$this->db->where_in('id_img_laboratorio', $idImgs);
			$this->db->update('img_laboratorio', $dados);
			return true;
		else:
			return false;
		endif;
	}

	public function get_all_laboratorios_ids($ids=NULL)
	{
		if($ids!=NULL):
			$this->db->select('pessoa.id_pessoa, pessoa.nome_pes, laboratorio.id_laboratorio, laboratorio.nome_lab');
			$this->db->from('laboratorio_has_pessoa');
			$this->db->join('laboratorio', 'laboratorio.id_laboratorio = laboratorio_has_pessoa.fk_id_laboratorio', 'left');
			$this->db->join('pessoa', 'pessoa.id_pessoa = laboratorio_has_pessoa.fk_id_pessoa', 'left');
			$this->db->where('laboratorio_has_pessoa.permissao_lhp', 4);
			$this->db->where_in('laboratorio_has_pessoa.fk_id_laboratorio', $ids);
			return $this->db->get()->result();
		else:
			return null;
		endif;
	}

	public function get_all_participantes_pendentes()
	{
		$this->db->select('fk_id_laboratorio');
		$this->db->from('laboratorio_has_pessoa');
		$this->db->where('fk_id_pessoa', $this->session->userdata('id_pessoa'));
		$this->db->where('permissao_lhp', 2);

		$x = $this->db->get()->result_array();
		$y=null;
		for ($i=0; $i < count($x); $i++) {
			$y[$i] = $x[$i]['fk_id_laboratorio'];
		}

		return $this->get_all_laboratorios_ids($y);
	}

	public function aceita_participante_lab($id_pessoa, $id_laboratorio)
	{
		$dados['permissao_lhp'] = 3;
		$this->db->where('fk_id_pessoa', $id_pessoa);
		$this->db->where('fk_id_laboratorio', $id_laboratorio);
		$this->db->update('laboratorio_has_pessoa', $dados);
	}

	public function recusa_participante_lab($id_pessoa, $id_laboratorio)
	{
		$this->db->where('fk_id_pessoa', $id_pessoa);
		$this->db->where('fk_id_laboratorio', $id_laboratorio);
		$this->db->where('permissao_lhp', 4);
		$this->db->delete('laboratorio_has_pessoa');
	}

}

/* End of file coordenador.php */
/* Location: ./application/models/coordenador.php */