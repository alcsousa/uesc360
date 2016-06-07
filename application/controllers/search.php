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

class Search extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('funcoes');
        $this->load->model('generica_consulta_model');
        $this->load->model('equipamento_model');
	}

	public function index()
	{
        echo "There is nothing here... :X";
	}

	public function pessoa($id_pessoa=NULL)
	{
        if($id_pessoa != NULL && is_numeric($id_pessoa)):
            $data['pessoa']               = $this->generica_consulta_model->consulta_pessoa_by_id($this->funcoes->antiInjection($id_pessoa));
            $data['laboratorio_coordena'] = $this->generica_consulta_model->consulta_coordenador_laboratorio($this->funcoes->antiInjection($id_pessoa));
        endif;

		$data['main'] = 'search/pessoa2';
		$this->load->view('templates/template_publico', $data);
	}

	public function laboratorio($id_laboratorio=NULL)
	{
        $id_laboratorio = $this->funcoes->antiInjection($id_laboratorio);

        if($id_laboratorio != NULL && is_numeric($id_laboratorio)):
            $data['laboratorio']     = $this->generica_consulta_model->consulta_laboratorio_by_id($id_laboratorio);
            $data['laboratorio_img'] = $this->generica_consulta_model->consulta_imagem_laboratorio($id_laboratorio);
            $data['laboratorio_pes'] = $this->generica_consulta_model->consulta_pessoa_laboratorio($id_laboratorio);
            $data['laboratorio_dpt'] = $this->generica_consulta_model->consulta_departamento_laboratorio($id_laboratorio);
            $data['laboratorio_cur'] = $this->generica_consulta_model->consulta_curso_laboratorio($id_laboratorio);
            $data['laboratorio_eqp'] = $this->generica_consulta_model->consulta_equipamento_laboratorio($id_laboratorio);
            $data['coordenadores_lab'] = $this->generica_consulta_model->consulta_coordenadores_laboratorio_by_id($id_laboratorio);
        endif;

		$data['main'] = 'search/laboratorio2';
		$this->load->view('templates/template_publico', $data);
	}

    public function equipamento($id_equipamento=NULL)
    {
        $id_equipamento = $this->funcoes->antiInjection($id_equipamento);

        if($id_equipamento != NULL && is_numeric($id_equipamento)):
            $data['equipamento']     = $this->generica_consulta_model->consulta_equipamento_by_id($id_equipamento);
            $data['equipamento_img'] = $this->equipamento_model->recuperar_imagens_equipamento_by_id($id_equipamento);
        endif;

		$data['main'] = 'search/equipamento2';
		$this->load->view('templates/template_publico', $data);
    }

}