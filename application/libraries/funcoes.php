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

class Funcoes
{
	public function antiInjection($sql)
	{
		$sqlWords = "/([Ff][Rr][Oo][Mm]|[Ss][Ee][Ll][Ee][Cc][Tt]|[Cc][Oo][Uu][Nn][Tt]|[Tt][Rr][Uu][Nn][Cc][Aa][Tt][Ee]|[Ee][Xx][Pp][Ll][Aa][Ii][Nn]|[Ii][Nn][Ss][Ee][Rr][Tt]|[Dd][Ee][Ll][Ee][Tt][Ee]|[Ww][Hh][Ee][Rr][Ee]|[Uu][Pp][Dd][Aa][Tt][Ee]|[Ee][Mm][Pp][Tt][Yy]|[Dd][Rr][Oo][Pp] [Tt][Aa][Bb][Ll][Ee]|[Ll][Ii][Mm][Ii][Tt]|[Ss][Hh][Oo][Ww] [Tt][Aa][Bb][Ll][Ee][Ss]|[Oo][Rr]|[Oo][Rr][Dd][Ee][Rr] [Bb][Yy]|#|\*|--|\\\)/";

		$sql = preg_replace($sqlWords, "", $sql);
		$sql = trim($sql);
		$sql = strip_tags($sql);
		$sql = addslashes($sql);
		return $sql;
	}

	//Entrada: 	aaaa-mm-dd hh:mm:ss
	//Saída:	Última modificação em dd/mm/aaaa às hh:mm:ss
	public function lastModified($date)
	{
		$ano = substr($date, 0, 4);
		$mes = substr($date, 5, 2);
		$dia = substr($date, 8, 2);
		$hor = substr($date, 11, 8);
		return 'Última modificação em '.$dia.'/'.$mes.'/'.$ano.' às '.$hor;
	}

	//Entrada: 	aaaa-mm-dd
	// ou
	//Entrada: 	aaaa-mm-dd hh:mm:ss
	//Saída:	dd/mm/aaaa
	public function formatoDataHumano($date)
	{
		$ano = substr($date, 0, 4);
		$mes = substr($date, 5, 2);
		$dia = substr($date, 8, 2);
		return $dia.'/'.$mes.'/'.$ano;
	}

	//Entrada:	dd/mm/aaaa
	//Saída: 	aaaa-mm-dd
	public function formatoDataBanco($date)
	{
		$dia = substr($date, 0, 2);
		$mes = substr($date, 3, 2);
		$ano = substr($date, 6, 4);
		return $ano.'-'.$mes.'-'.$dia;
	}

}