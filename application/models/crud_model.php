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

class Crud_model extends CI_Model
{

    public function get_allPessoa($value='')
    {
        $this->db->select('*');
        $this->db->from('pessoa');
        $retorno = $this->db->get();
        return $retorno->result();
    }

    public function get_pessoa($email)
    {
        $this->db->select('*');
        $this->db->from('pessoa');
        $this->db->where('email_pes',$email);
        return $this->db->get()->result_array();
    }

	public function getAllDepartamento()
	{
		$this->db->order_by('nome_dpt', "asc");
		return $this->db->get('departamento');
	}

	public function getAllTipo_pessoa()
	{
		$this->db->order_by('tipo_tip', "asc");
		return $this->db->get('tipo_pessoa');
	}

	public function getPessoaWithoutUser()
	{
		$this->db->select('id_pessoa, nome_pes, email_pes');
		$this->db->from('pessoa');
		$this->db->where('fk_id_usuario is NULL');
		$this->db->where('ativo_pes', 1);
		$this->db->order_by('nome_pes', "asc");
		return $this->db->get();
	}

	public function getAllCurso()
	{
		$this->db->order_by('nome_cur', "asc");
		return $this->db->get('curso');
	}

	public function getAllPavilhao()
	{
		$this->db->order_by('nome_pav', "asc");
		return $this->db->get('pavilhao');
	}

	public function getAllLaboratorio()
	{
		$this->db->select('*');
		$this->db->from('laboratorio');
		$this->db->where('ativo_lab', 1);
		return $this->db->get();
	}

	public function getAllCoordenadores()
	{
		$this->db->select('id_pessoa, nome_pes, email_pes, lattes_pes');
		$this->db->from('pessoa');
		$this->db->join('usuario', 'pessoa.fk_id_usuario = usuario.id_usuario', 'left');
		$this->db->where('pessoa.ativo_pes', 1);
		$this->db->order_by('nome_pes', 'asc');
		return $this->db->get();
	}

	public function getUsername($id)
	{
		$this->db->select('nome_pes');
		$this->db->from('pessoa');
		$this->db->where('fk_id_usuario = '.$id);
		return $this->db->get();
	}

	public function insertUsuario($dados=NULL)
	{
		if ($dados!=NULL):
			$this->db->insert('usuario', $dados);
		endif;
	}

	public function insertPermissao($dados=NULL)
	{
		if ($dados!=NULL):
			$this->db->insert('usuario_has_permissao', $dados);
		endif;
	}

	public function insertPessoa($dados=NULL)
	{
		if ($dados!=NULL):
			$this->db->insert('pessoa', $dados);
		endif;
	}

	public function insertLaboratorio($dados=NULL)
	{
		if ($dados!=NULL):
			$this->db->insert('laboratorio', $dados);
		endif;
	}

	public function insertEquipamento($dados=NULL)
	{
		if ($dados!=NULL):
			$this->db->insert('equipamento', $dados);
		endif;
	}

	public function insertLaboratorio_has_curso($dados=NULL)
	{
		if ($dados!=NULL):
			$this->db->insert('laboratorio_has_curso', $dados);
		endif;
	}

	public function insertLaboratorio_has_pessoa($dados=NULL)
	{
		if ($dados!=NULL):
			$this->db->insert('laboratorio_has_pessoa', $dados);
		endif;
	}

	public function insertLaboratorio_has_departamento($dados=NULL)
	{
		if ($dados!=NULL):
			$this->db->insert('laboratorio_has_departamento', $dados);
		endif;
	}

	public function insertLaboratorio_has_equipamento($dados=NULL)
	{
		if ($dados!=NULL):
			$this->db->insert('laboratorio_has_equipamento', $dados);
		endif;
	}

	public function insertImg_equipamento($dados=NULL)
	{
		if ($dados!=NULL):
			$this->db->insert('img_equipamento', $dados);
		endif;
	}

	public function insertImg_laboratorio($dados=NULL)
	{
		if ($dados!=NULL):
			$this->db->insert('img_laboratorio', $dados);
		endif;
	}

	public function insertEquipamento_has_img($dados=NULL)
	{
		if ($dados!=NULL):
			$this->db->insert('equipamento_has_img', $dados);
		endif;
	}

	public function insertLaboratorio_has_img($dados=NULL)
	{
		if ($dados!=NULL):
			$this->db->insert('laboratorio_has_img', $dados);
		endif;
	}

	public function getBasicInfoPessoa()
	{
		$this->db->select('pes.id_pessoa, pes.nome_pes');
		$this->db->from('pessoa as pes');
		$this->db->where('ativo_pes', 1);
		$this->db->where('fk_id_tipo_pessoa >', 1);
		$this->db->order_by('pes.nome_pes', "asc");
		return $this->db->get();
	}

	public function selectPessoa()
	{
		$this->db->select('pes.id_pessoa, pes.nome_pes, pes.email_pes, pes.ramal_pes, pes.lattes_pes, pes.website_pes, pes.status_pes, tip.tipo_tip, dep.nome_dpt');
		$this->db->from('pessoa as pes');
		$this->db->join('tipo_pessoa as tip', 'pes.fk_id_tipo_pessoa = tip.id_tipo_pessoa', 'inner');
		$this->db->join('departamento as dep', 'pes.fk_id_departamento = dep.id_departamento', 'inner');
		$this->db->where('ativo_pes', 1);
		$this->db->order_by('pes.id_pessoa', "asc");
		return $this->db->get();
	}

	public function selectPessoaByID($id=NULL)
	{
		if($id!=NULL):
			$this->db->select('pes.nome_pes, pes.email_pes, pes.ramal_pes, pes.lattes_pes,
							   pes.website_pes, pes.fk_id_departamento, pes.fk_id_tipo_pessoa, tip.tipo_tip, dep.nome_dpt');
			$this->db->join('tipo_pessoa as tip', 'pes.fk_id_tipo_pessoa = tip.id_tipo_pessoa', 'inner');
			$this->db->join('departamento as dep', 'pes.fk_id_departamento = dep.id_departamento', 'inner');
			$this->db->from('pessoa as pes');
			$this->db->where('pes.id_pessoa', $id);
			$this->db->where('pes.ativo_pes', 1);
			return $this->db->get();
		else:
			die ('Erro ao tentar recuperar dados! :(');
		endif;
	}

	public function updateUsuario($id_usuario, $dados)
	{
		$this->db->where('id_usuario', $id_usuario);
		$this->db->update('usuario', $dados);
	}

	public function updatePessoa($id, $dados)
	{
		$this->db->where('id_pessoa', $id);
		$this->db->update('pessoa', $dados);
	}

	public function deletePessoa($id, $dados)
	{
		$this->db->where('id_pessoa', $id);
		$this->db->update('pessoa', $dados);
	}

	public function getBasicInfoLaboratorio()
	{
		$this->db->select('lab.id_laboratorio, lab.nome_lab');
		$this->db->from('laboratorio as lab');
		$this->db->where('ativo_lab', 1);
		$this->db->order_by('lab.nome_lab', "asc");
		return $this->db->get();
	}

	public function selectLaboratorio()
	{
		$this->db->select('lab.id_laboratorio, lab.nome_lab, lab.ramal_lab, lab.website_lab, lab.descricao_lab,
						   lab.atividades_lab, lab.areas_atendidas_lab, lab.multiusuario_lab, lab.usa_ensino_lab,
						   lab.usa_pesquisa_lab, lab.usa_extensao_lab, lab.last_modified_lab, lab.status_lab,
						   pav.nome_pav');
		$this->db->from('laboratorio as lab');
		$this->db->join('pavilhao as pav', 'lab.fk_id_pavilhao = pav.id_pavilhao', 'inner');
		$this->db->where('ativo_lab', 1);
		return $this->db->get();
	}

	public function selectLaboratorioByPessoa($id=NULL)
	{
		if($id!=NULL):
			$this->db->select('lab.id_laboratorio, lab.nome_lab');
			$this->db->from('laboratorio_has_pessoa as lhp');
			$this->db->join('laboratorio as lab', 'lab.id_laboratorio = lhp.fk_id_laboratorio', 'inner');
			$this->db->where('lhp.fk_id_pessoa', $id);
			$this->db->where('lab.ativo_lab', 1);

			return $this->db->get();
		else:
			die('Erro! Não foi possível listar os laboratórios. :(');
		endif;
	}

	public function selectLaboratorioByID($id)
	{
		$this->db->select('lhp.id_laboratorio_pessoa, pes.id_pessoa, lab.id_laboratorio, lab.nome_lab,
							lab.ramal_lab, lab.website_lab, lab.descricao_lab, lab.atividades_lab,
							lab.areas_atendidas_lab, lab.multiusuario_lab, lab.usa_ensino_lab,
						   	lab.usa_pesquisa_lab, lab.usa_extensao_lab, lab.last_modified_lab,
						   	lab.fk_id_pavilhao, pav.nome_pav');
		$this->db->from('laboratorio_has_pessoa as lhp');
		$this->db->join('pessoa as pes', 'pes.id_pessoa = lhp.fk_id_pessoa', 'inner');
		$this->db->join('laboratorio as lab', 'lab.id_laboratorio = lhp.fk_id_laboratorio', 'inner');
		$this->db->join('pavilhao as pav', 'lab.fk_id_pavilhao = pav.id_pavilhao', 'inner');
		$this->db->where('lab.id_laboratorio = '.$id);
		$this->db->where('lab.ativo_lab', 1);
		return $this->db->get();
	}

	public function selectCoordenadorByID($id)
	{
		$this->db->select('pes.id_pessoa');
		$this->db->from('laboratorio_has_pessoa as lhp');
		$this->db->join('laboratorio as lab', 'lab.id_laboratorio = lhp.fk_id_laboratorio', 'inner');
		$this->db->join('pessoa as pes', 'pes.id_pessoa = lhp.fk_id_pessoa', 'inner');
		$this->db->where('lab.id_laboratorio = '.$id);
		return $this->db->get();
	}

	public function selectCursoLab($id)
	{
		$this->db->select('id_curso, nome_cur');
		$this->db->from('curso, laboratorio_has_curso');
		$this->db->where('fk_id_curso = id_curso and fk_id_laboratorio = '.$id);
		return $this->db->get();
	}

	public function selectCoordenadorLab($id)
	{
		$this->db->select('id_pessoa, nome_pes');
		$this->db->from('pessoa, laboratorio_has_pessoa');
		$this->db->where('fk_id_pessoa = id_pessoa and fk_id_laboratorio = '.$id);
		return $this->db->get();
	}

	public function selectDepartamentoLab($id)
	{
		$this->db->select('id_departamento, nome_dpt');
		$this->db->from('departamento, laboratorio_has_departamento');
		$this->db->where('fk_id_departamento = id_departamento and fk_id_laboratorio = '.$id);
		return $this->db->get();
	}

	public function selectImgLab($id)
	{
		$this->db->select('nome_iml');
		$this->db->from('laboratorio_has_img, img_laboratorio');
		$this->db->where('fk_id_img_laboratorio = id_img_laboratorio and fk_id_laboratorio = '.$id);
		$this->db->where('img_laboratorio.ativo_iml', 1);
		return $this->db->get();
	}

	public function updateLaboratorio($id, $dados)
	{
		$this->db->where('id_laboratorio', $id);
		$this->db->update('laboratorio', $dados);
	}

	public function updateLaboratorioHasPessoa($id, $dados)
	{
		$this->db->where('id_laboratorio_pessoa', $id);
		$this->db->update('laboratorio_has_pessoa', $dados);
	}

	public function deleteLaboratorio($id, $dados)
	{
		$this->db->where('id_laboratorio', $id);
		$this->db->update('laboratorio', $dados);
	}

	public function deleteEquipamentoDpt($id)
	{
		$this->db->where('fk_id_laboratorio', $id);
		$this->db->delete('laboratorio_has_departamento');
	}

	public function deleteEquipamentoCursos($id)
	{
		$this->db->where('fk_id_laboratorio', $id);
		$this->db->delete('laboratorio_has_curso');
	}

	public function getBasicInfoEquipamento()
	{
		$this->db->select('eqp.id_equipamento, eqp.nome_eqp');
		$this->db->from('equipamento as eqp');
		$this->db->where('ativo_eqp', 1);
		$this->db->order_by('eqp.nome_eqp', "asc");
		return $this->db->get();
	}

	public function selectEquipamento()
	{
		$this->db->select('lab.id_laboratorio, lab.nome_lab, eqp.id_equipamento, eqp.nome_eqp, eqp.fabricante_eqp,
						   eqp.quantidade_eqp, eqp.especificacao_eqp, eqp.descricao_eqp, eqp.status_eqp');
		$this->db->from('laboratorio_has_equipamento');
		$this->db->join('laboratorio as lab', 'fk_id_laboratorio = id_laboratorio', 'inner');
		$this->db->join('equipamento as eqp', 'fk_id_equipamento = id_equipamento', 'inner');
		$this->db->where('ativo_eqp', 1);
		return $this->db->get();
	}

	public function selectEquipamentoByID($id)
	{
		$this->db->select('lhe.id_laboratorio_equipamento, lab.id_laboratorio, lab.nome_lab, eqp.id_equipamento, eqp.nome_eqp,
							eqp.fabricante_eqp, eqp.quantidade_eqp, eqp.especificacao_eqp, eqp.descricao_eqp');
		$this->db->from('laboratorio_has_equipamento as lhe');
		$this->db->join('laboratorio as lab', 'lhe.fk_id_laboratorio = lab.id_laboratorio', 'inner');
		$this->db->join('equipamento as eqp', 'lhe.fk_id_equipamento = eqp.id_equipamento', 'inner');
		$this->db->where('eqp.id_equipamento = '.$id);
		$this->db->where('eqp.ativo_eqp', 1);
		return $this->db->get();
	}

	public function selectEquipamentoByLab($labID=NULL)
	{
		if($labID!=NULL):
			$this->db->select('eqp.id_equipamento, eqp.nome_eqp, eqp.fabricante_eqp,
							   eqp.quantidade_eqp, eqp.especificacao_eqp, eqp.descricao_eqp');
			$this->db->from('equipamento as eqp');
			$this->db->join('laboratorio_has_equipamento as lhe', 'lhe.fk_id_equipamento = eqp.id_equipamento', 'inner');
			$this->db->where('eqp.ativo_eqp', 1);
			$this->db->where('lhe.fk_id_laboratorio', $labID);
		return $this->db->get();

		else:
			die('Erro ao tentar recuperar informações! :(');
		endif;
	}

	public function selectLabEquipamento($id)
	{
		$this->db->select('nome_lab');
		$this->db->from('laboratorio, laboratorio_has_equipamento');
		$this->db->where('fk_id_laboratorio = id_laboratorio and fk_id_equipamento = '.$id);
		return $this->db->get();
	}

	public function selectImgEqp($id)
	{
		$this->db->select('nome_ime');
		$this->db->from('equipamento_has_img, img_equipamento');
		$this->db->where('fk_id_img_equipamento = id_img_equipamento and fk_id_equipamento = '.$id);
		$this->db->where('img_equipamento.ativo_ime', 1);
		return $this->db->get();
	}

	public function updateEquipamento($id, $dados)
	{
		$this->db->where('id_equipamento', $id);
		$this->db->update('equipamento', $dados);
	}

	public function updateLaboratorioHasEquipamento($id, $dados)
	{
		$this->db->where('id_laboratorio_equipamento', $id);
		$this->db->update('laboratorio_has_equipamento', $dados);
	}

	public function deleteEquipamento($id, $dados)
	{
		$this->db->where('id_equipamento', $id);
		$this->db->update('equipamento', $dados);
	}
}