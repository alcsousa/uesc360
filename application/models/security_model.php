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

class Security_model extends CI_Model
{
	public function getPermissions($id_pessoa=NULL)
	{
		if($id_pessoa==NULL):
			$this->db->select('fk_id_permissao');
			$this->db->from('usuario_has_permissao');
			$this->db->where('fk_id_usuario', $this->session->userdata('id_usuario'));
			$this->db->order_by('fk_id_permissao', 'ASC');
			$rs = $this->db->get();
		elseif ($id_pessoa!=NULL && is_numeric($id_pessoa)):
			$this->db->select('fk_id_permissao');
			$this->db->from('usuario_has_permissao');
			$this->db->join('pessoa', 'pessoa.fk_id_usuario = usuario_has_permissao.fk_id_usuario', 'left');
			$this->db->where('pessoa.id_pessoa', $id_pessoa);
			$this->db->order_by('fk_id_permissao', 'ASC');
			$rs = $this->db->get();
		endif;

		if($rs->num_rows() > 0):
			return $rs->result();
		else:
			return false;
		endif;
	}

	public function isAdmin()
	{
		$this->db->where('fk_id_permissao', 1);
		$this->db->where('fk_id_usuario', $this->session->userdata('id_usuario'));
		$rs = $this->db->get('usuario_has_permissao');

		if($rs->num_rows() == 1):
			return true;
		else:
			return false;
		endif;
	}

	public function isCoord()
	{
		$this->db->where('fk_id_permissao', 2);
		$this->db->where('fk_id_usuario', $this->session->userdata('id_usuario'));
		$rs = $this->db->get('usuario_has_permissao');

		if($rs->num_rows() == 1):
			return true;
		else:
			return false;
		endif;
	}

	public function youShallNotPass($IDENTITY_ID=NULL, $IDENTITY_TYPE=NULL)
	{
		$PERSON_ID 	= $this->session->userdata('id_pessoa');
		$PERMISSION = $this->session->userdata('permissao_usu');

		if($IDENTITY_ID!=NULL && $IDENTITY_TYPE!=NULL && $PERSON_ID!=NULL && $PERMISSION!=NULL):

			switch ($PERMISSION)
			{
				// ADMIN
				case '1':
					// Open the gaaaaaaaaates! You shall pass!
					break;

				// COORDENADOR
				case '2':
					switch ($IDENTITY_TYPE)
					{
						case 'LAB':
							if(!$this->ownsTheHouseLab($PERSON_ID, $IDENTITY_ID)):
								$this->getTheFuckOut();
					        endif;
							break;

						case 'EQP':
							if(!$this->ownsTheHouseEqp($PERSON_ID, $IDENTITY_ID)):
								$this->getTheFuckOut();
					        endif;
							break;

						default:
							$this->getTheFuckOut();
							break;
					}
					break;

				default:
					$this->getTheFuckOut();
					break;
			}
		endif;
	}

	public function getTheFuckOut()
	{
        $this->session->set_flashdata('erro', 'Você não possui permissão para acessar essa página! :X');
        redirect('painel','refresh');
	}

	public function ownsTheHouseLab($id_pessoa, $id_laboratorio)
	{
		$this->db->where('fk_id_pessoa', $id_pessoa);
		$this->db->where('fk_id_laboratorio', $id_laboratorio);
		$this->db->where('permissao_lhp', 2);
		$query = $this->db->get('laboratorio_has_pessoa');

		if($query->num_rows() == 1):
			return true;
		else:
			return false;
		endif;
	}

	public function ownsTheHouseEqp($id_pessoa, $id_equipamento)
	{
		$this->db->select('*');
		$this->db->from('laboratorio_has_pessoa as lhp');
		$this->db->join('laboratorio_has_equipamento as lhe', 'lhp.fk_id_laboratorio = lhe.fk_id_laboratorio' , 'inner');
		$this->db->where('fk_id_pessoa', $id_pessoa);
		$this->db->where('fk_id_equipamento', $id_equipamento);
		$query = $this->db->get();

		if($query->num_rows() == 1):
			return true;
		else:
			return false;
		endif;
	}

	public function acesso_laboratorio($personID, $idLab)
	{
		$this->db->select('*');
		$this->db->from('laboratorio_has_pessoa');
		$this->db->where('fk_id_pessoa', $personID);
		$this->db->where('fk_id_laboratorio', $idLab);
		$query = $this->db->get();

		if($query->num_rows() > 0):
			return true;
		else:
			return false;
		endif;
	}

	public function acesso_equipamento($personID, $idEqp)
	{
		$this->db->select('*');
		$this->db->from('laboratorio_has_pessoa as lhp');
		$this->db->join('laboratorio_has_equipamento as lhe', 'lhp.fk_id_laboratorio = lhe.fk_id_laboratorio' , 'inner');
		$this->db->where('fk_id_pessoa', $personID);
		$this->db->where('fk_id_equipamento', $idEqp);
		$query = $this->db->get();

		if($query->num_rows() > 0):
			return true;
		else:
			return false;
		endif;
	}
}