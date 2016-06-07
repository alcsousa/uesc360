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

class Estatisticas_model extends CI_Model
{
    public function estatisticas_curso()
    {
        $this->db->select('count(*) as num_labs, cur.nome_cur as nome_curso');
        $this->db->from('laboratorio_has_curso as lhc');
        $this->db->join('laboratorio as lab', 'lab.id_laboratorio = lhc.fk_id_laboratorio', 'left');
        $this->db->join('curso as cur', 'cur.id_curso = lhc.fk_id_curso', 'left');
        $this->db->group_by('lhc.fk_id_curso');
        // $this->db->order_by('count(*)', 'desc');
        $this->db->order_by('count(*)', 'asc');
        return $this->db->get()->result();
    }

    public function estatisticas_departamento()
    {
        $this->db->select('count(*) as num_labs, dpt.nome_dpt as nome_departamento');
        $this->db->from('laboratorio_has_departamento as lhd');
        $this->db->join('laboratorio as lab', 'lab.id_laboratorio = lhd.fk_id_laboratorio', 'left');
        $this->db->join('departamento as dpt', 'dpt.id_departamento = lhd.fk_id_departamento', 'left');
        $this->db->group_by('lhd.fk_id_departamento');
        // $this->db->order_by('count(*)', 'desc');
        $this->db->order_by('count(*)', 'asc');
        return $this->db->get()->result();
    }
}

/* End of file estatisticas_model.php */
/* Location: ./application/models/estatisticas_model.php */