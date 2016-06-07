<?php
$this->load->view('includes/header');
$this->load->view('includes/menu2');

echo "<div class='conteudo'>";
echo "<br>";
echo "<div class='row'>";

echo '<div class="large-2 columns">';

if($this->session->userdata('permissao_usu')==3):
  $this->load->view('usuario/menuLateral');
elseif($this->session->userdata('permissao_usu')==2):
  $this->load->view('coordenador/menuLateral');
elseif($this->session->userdata('permissao_usu')==1):
  $this->load->view('includes/menuLateral');
endif;

echo "</div>";


if ($tela!='') $this->load->view($tela);

echo "</div>";
echo "</div>";

$this->load->view('includes/footer');