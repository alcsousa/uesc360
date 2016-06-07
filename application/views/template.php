<?php
$this->load->view('includes/header');
$this->load->view('includes/menu');
echo "<div class='conteudo'>";
if ($tela!='') $this->load->view($tela);
echo "</div>";
$this->load->view('includes/footer');
