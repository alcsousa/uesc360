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

class Email_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('email');
    }

    /**
     * @autor Raul Cardoso
     * @version 1.0.0
     */
    public function enviar_email($email, $assunto, $mensagem)
    {
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com';
        $config['smtp_port'] = '465';
        $config['smtp_timeout'] = '7';
        // $config['smtp_user'] = 'email@domain.com';
        // $config['smtp_pass'] = 'senha';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n"; //use double quotes to comply with RFC 822 standard
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;
        $config['priority'] = 1;

        $this->email->initialize($config);

        $corpo_mensagem =

        "<html lang=\"pt-br\">
        <head>
            <meta charset=\"utf-8\" />

          <style type=\"text/css\">
            body {margin: 0; padding: 0; min-width: 100%!important;}
            .content {width: 100%; max-width: 600px;}
          </style>
        </head>

        <body bgcolor=\"#d7d7d7\">

            <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
              <tr>
                <td>
                  <table class=\"content\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">

                    <tr>
                      <td bgcolor=\"#FFFFFF\" style=\"border:0; padding:10px;\">
                        {$mensagem}
                      </td>
                    </tr>

                  </table>
                </td>
              </tr>
            </table>
        </body>
        </html>";

        $this->email->from('email@domain.com', 'UESC 360 - Núcleo de Inovação Tecnológica UESC');
        $this->email->to($email);
        $this->email->subject($assunto);
        $this->email->message($corpo_mensagem);

        if($this->email->send()):
            return true;
        else:
            return false;
        endif;
    }

    public function get_token()
    {
        return sha1(date("d/m/y h:i:s"));
    }

}