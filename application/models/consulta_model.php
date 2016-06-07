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

class Consulta_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('funcoes');
	}

	public function busca($input)
	{
		$rs = $this->db->query
		("
			SELECT pessoa.id_pessoa as 'id', pessoa.nome_pes as 'name', 'p' as type, pessoa.email_pes as 'info1', pessoa.lattes_pes as 'info2', pessoa.website_pes as 'info3'
			FROM pessoa
			WHERE pessoa.nome_pes LIKE '%".$this->db->escape_like_str($input)."%'

			UNION ALL

			SELECT laboratorio.id_laboratorio as 'id', laboratorio.nome_lab as 'name', 'l' as type, laboratorio.descricao_lab as 'info1', laboratorio.atividades_lab as 'info2', laboratorio.areas_atendidas_lab as 'info3'
			FROM laboratorio
			WHERE laboratorio.nome_lab LIKE '%".$this->db->escape_like_str($input)."%'
			OR laboratorio.palavras_chave LIKE '%".$this->db->escape_like_str($input)."%'

			UNION ALL

			SELECT equipamento.id_equipamento as 'id', equipamento.nome_eqp as 'name', 'e' as type, equipamento.descricao_eqp as 'info1', equipamento.especificacao_eqp as 'info2', equipamento.fabricante_eqp as 'info3'
			FROM equipamento
			WHERE equipamento.nome_eqp LIKE '%".$this->db->escape_like_str($input)."%'
		");
		return $rs->result();
	}

}