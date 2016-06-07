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

class Generica_consulta_model extends CI_Model
{
    public function listar_pessoas()
    {
        $this->db->select('pes.id_pessoa, pes.nome_pes, pes.email_pes, tip.tipo_tip');
        $this->db->from('pessoa as pes');
        $this->db->join('tipo_pessoa as tip', 'pes.fk_id_tipo_pessoa = tip.id_tipo_pessoa', 'inner');
        $this->db->where('ativo_pes', 1);
        $this->db->order_by('pes.nome_pes', "asc");
        return $this->db->get()->result();
    }

    public function listar_laboratorios($ordem=NULL)
    {
        $this->db->select('lab.id_laboratorio, lab.nome_lab, pes.nome_pes, pav.nome_pav');
        $this->db->from('laboratorio as lab');
        $this->db->join('pavilhao as pav', 'pav.id_pavilhao = lab.fk_id_pavilhao', 'left');
        $this->db->join('laboratorio_has_pessoa as lhp', 'lhp.fk_id_laboratorio = lab.id_laboratorio', 'left');
        $this->db->join('pessoa as pes', 'pes.id_pessoa = lhp.fk_id_pessoa', 'left');
        $this->db->where('ativo_lab', 1);
        $this->db->where('lhp.permissao_lhp', 2);

        if($ordem!=NULL && $ordem='lastmodified'):
            $this->db->order_by('lab.last_modified_lab', 'DESC');
        else:
            $this->db->order_by('lab.nome_lab', 'asc');
        endif;

        return $this->db->get()->result();
    }

    public function listar_equipamentos($ordem=NULL)
    {
        $this->db->select('eqp.id_equipamento, eqp.nome_eqp, eqp.quantidade_eqp, eqp.fabricante_eqp, lab.nome_lab');
        $this->db->from('equipamento as eqp');
        $this->db->join('laboratorio_has_equipamento as lhe', 'lhe.fk_id_equipamento = eqp.id_equipamento', 'left');
        $this->db->join('laboratorio as lab', 'lab.id_laboratorio = lhe.fk_id_laboratorio', 'left');
        $this->db->where('eqp.ativo_eqp', 1);

        if($ordem!=NULL && $ordem='lastmodified'):
            $this->db->order_by('eqp.last_modified_eqp', 'DESC');
        else:
            $this->db->order_by('eqp.nome_eqp', 'asc');
        endif;

        return $this->db->get()->result();
    }

    public function consulta_cursos_laboratorio_by_id($id_laboratorio=NULL)
    {
        if($id_laboratorio!=NULL):
            $this->db->select('id_curso');
            $this->db->from('curso');
            $this->db->join('laboratorio_has_curso', 'laboratorio_has_curso.fk_id_curso = curso.id_curso', 'left');
            $this->db->where('laboratorio_has_curso.fk_id_laboratorio', $id_laboratorio);
            return $this->db->get()->result();
        endif;
    }

    public function consulta_departamentos_laboratorio_by_id($id_laboratorio=NULL)
    {
        if($id_laboratorio!=NULL):
            $this->db->select('id_departamento');
            $this->db->from('departamento');
            $this->db->join('laboratorio_has_departamento', 'laboratorio_has_departamento.fk_id_departamento = departamento.id_departamento', 'left');
            $this->db->where('laboratorio_has_departamento.fk_id_laboratorio', $id_laboratorio);
            return $this->db->get()->result();
        endif;
    }


    public function consulta_pavilhoes()
    {
        $this->db->order_by('nome_pav', "asc");
        return $this->db->get('pavilhao')->result();
    }

    public function consulta_cursos()
    {
        $this->db->order_by('nome_cur', "asc");
        return $this->db->get('curso')->result();
    }

    public function consulta_departamentos()
    {
        return $this->db->get('departamento')->result();
    }

    public function consulta_coordenadores()
    {
        $this->db->select('id_pessoa, nome_pes, email_pes, lattes_pes');
        $this->db->from('pessoa');
        $this->db->join('usuario', 'pessoa.fk_id_usuario = usuario.id_usuario', 'left');
        $this->db->where('pessoa.ativo_pes', 1);
        $this->db->order_by('nome_pes', 'asc');
        return $this->db->get()->result();
    }

    public function consulta_pessoa_by_id($id_pessoa)
    {
        // $this->db->select('pes.id_pessoa, pes.nome_pes, pes.email_pes, tip.tipo_tip');
        $this->db->select('*');
        $this->db->from('pessoa as pes');
        $this->db->join('usuario as usu', 'pes.fk_id_usuario = usu.id_usuario', 'left');
        $this->db->join('tipo_pessoa as tip', 'pes.fk_id_tipo_pessoa = tip.id_tipo_pessoa', 'left');
        $this->db->join('departamento as dpt', 'pes.fk_id_departamento = dpt.id_departamento', 'left');
        $this->db->where('pes.ativo_pes', 1);
        $this->db->where('pes.id_pessoa', $id_pessoa);
        return $this->db->get()->result();
    }

    public function consulta_coordenador_laboratorio($id_pessoa)
    {
        if($id_pessoa!=NULL):
            $this->db->select('lab.id_laboratorio, lab.nome_lab, lhp.permissao_lhp, pes.nome_pes, pav.nome_pav');
            $this->db->from('laboratorio as lab');
            $this->db->join('pavilhao as pav', 'pav.id_pavilhao = lab.fk_id_pavilhao', 'left');
            $this->db->join('laboratorio_has_pessoa as lhp', 'lhp.fk_id_laboratorio = lab.id_laboratorio', 'left');
            $this->db->join('pessoa as pes', 'pes.id_pessoa = lhp.fk_id_pessoa', 'left');
            $this->db->where('lab.ativo_lab', 1);
            $this->db->where('lhp.fk_id_pessoa', $id_pessoa);
            $this->db->order_by('lab.nome_lab', 'asc');
            return $this->db->get()->result();
        endif;
        return false;
    }

    public function consulta_coordenador_equipamento($id_pessoa=NULL)
    {
        if($id_pessoa!=NULL):
            $this->db->select('*');
            $this->db->from('equipamento as eqp');
            $this->db->join('laboratorio_has_equipamento as lhe', 'lhe.fk_id_equipamento = eqp.id_equipamento', 'left');
            $this->db->join('laboratorio_has_pessoa as lhp', 'lhp.fk_id_laboratorio = lhe.fk_id_laboratorio', 'left');
            $this->db->join('laboratorio as lab', 'lab.id_laboratorio = lhe.fk_id_laboratorio', 'left');
            $this->db->where('lab.ativo_lab', 1);
            $this->db->where('lhp.fk_id_pessoa', $id_pessoa);
            $this->db->order_by('eqp.nome_eqp', 'asc');
            return $this->db->get()->result();
        endif;
        return false;
    }

    public function consulta_laboratorio_by_id($id_laboratorio)
    {
        $this->db->select('*');
        $this->db->from('laboratorio as lab');
        $this->db->join('pavilhao as pav', 'pav.id_pavilhao = lab.fk_id_pavilhao', 'left');
        $this->db->join('laboratorio_has_pessoa as lhp', 'lhp.fk_id_laboratorio = lab.id_laboratorio', 'left');
        $this->db->join('pessoa as pes', 'pes.id_pessoa = lhp.fk_id_pessoa', 'left');
        $this->db->where('lab.id_laboratorio', $id_laboratorio);
        return $this->db->get()->result();
    }

    public function consulta_departamento_laboratorio($id_laboratorio)
    {
        $this->db->select('dpt.nome_dpt');
        $this->db->from('laboratorio_has_departamento as lhd');
        $this->db->join('departamento as dpt', 'lhd.fk_id_departamento = dpt.id_departamento', 'left');
        $this->db->where('lhd.fk_id_laboratorio', $id_laboratorio);
        return $this->db->get()->result();
    }

    public function consulta_curso_laboratorio($id_laboratorio)
    {
        $this->db->select('cur.nome_cur');
        $this->db->from('laboratorio_has_curso as lhc');
        $this->db->join('curso as cur', 'lhc.fk_id_curso = cur.id_curso', 'left');
        $this->db->where('lhc.fk_id_laboratorio', $id_laboratorio);
        return $this->db->get()->result();
    }

    public function consulta_coordenadores_laboratorio_by_id($id_laboratorio)
    {
        $this->db->select('pes.id_pessoa, pes.nome_pes');
        $this->db->from('laboratorio_has_pessoa as lhp');
        $this->db->join('pessoa as pes', 'lhp.fk_id_pessoa = pes.id_pessoa', 'left');
        $this->db->where('lhp.fk_id_laboratorio', $id_laboratorio);
        $this->db->where('lhp.permissao_lhp', 2);
        $this->db->where('pes.ativo_pes', 1);
        return $this->db->get()->result();
    }

    public function consulta_pessoa_laboratorio($id_laboratorio)
    {
        $this->db->select('pes.id_pessoa, pes.nome_pes');
        $this->db->from('laboratorio_has_pessoa as lhp');
        $this->db->join('pessoa as pes', 'lhp.fk_id_pessoa = pes.id_pessoa', 'left');
        $this->db->where('lhp.fk_id_laboratorio', $id_laboratorio);
        $this->db->where('lhp.permissao_lhp', 3);
        $this->db->where('pes.ativo_pes', 1);
        return $this->db->get()->result();
    }

    public function consulta_equipamento_laboratorio($id_laboratorio)
    {
        $this->db->select('eqp.id_equipamento, eqp.nome_eqp');
        $this->db->from('laboratorio_has_equipamento as lhe');
        $this->db->join('equipamento as eqp', 'lhe.fk_id_equipamento = eqp.id_equipamento', 'left');
        $this->db->where('lhe.fk_id_laboratorio', $id_laboratorio);
        return $this->db->get()->result();
    }

    public function consulta_imagem_laboratorio($id_laboratorio)
    {
        $this->db->select('iml.id_img_laboratorio, iml.nome_iml');
        $this->db->from('img_laboratorio as iml');
        $this->db->join('laboratorio_has_img as lhi', 'lhi.fk_id_img_laboratorio = iml.id_img_laboratorio', 'left');
        $this->db->where('lhi.fk_id_laboratorio', $id_laboratorio);
        return $this->db->get()->result();
    }

    public function consulta_equipamento_by_id($id_equipamento)
    {
        $this->db->select('lab.id_laboratorio, lab.nome_lab, eqp.id_equipamento, eqp.nome_eqp, eqp.fabricante_eqp, eqp.quantidade_eqp, eqp.especificacao_eqp, eqp.descricao_eqp, eqp.ativo_eqp');
        $this->db->from('equipamento as eqp');
        $this->db->join('laboratorio_has_equipamento as lhe', 'lhe.fk_id_equipamento = eqp.id_equipamento', 'left');
        $this->db->join('laboratorio as lab', 'lab.id_laboratorio = lhe.fk_id_laboratorio', 'left');
        $this->db->where('eqp.id_equipamento', $id_equipamento);
        $this->db->where('eqp.ativo_eqp', 1);
        return $this->db->get()->result();
    }

    public function existe_CPF($id_pessoa=NULL, $cpf=NULL)
    {
        if($id_pessoa!=NULL && $cpf!=NULL):
            $this->db->where('id_pessoa !=', $id_pessoa);
            $this->db->where('cpf_pes', $cpf);
            $rs = $this->db->get('pessoa');

            if($rs->num_rows() >= 1):
                return true;
            else:
                return false;
            endif;
        endif;
        return false;
    }

    public function existe_EMAIL_ACESSO($id_usuario=NULL, $email=NULL)
    {
        if($id_usuario!=NULL && $email!=NULL):
            $this->db->where('id_usuario !=', $id_usuario);
            $this->db->where('login_usu', $email);
            $rs = $this->db->get('usuario');

            if($rs->num_rows() >= 1):
                return true;
            else:
                return false;
            endif;
        endif;
        return false;
    }

    public function existe_EMAIL($email=NULL)
    {
        if($email!=NULL):
            $this->db->where('login_usu', $email);
            $rs = $this->db->get('usuario');

            if($rs->num_rows() == 1):
                return true;
            else:
                return false;
            endif;
        endif;
        return false;
    }

}

/* End of file generica_consulta_model.php */
/* Location: ./application/models/generica_consulta_model.php */