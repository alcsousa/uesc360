<?php
if(isset($sucesso)): 
  echo '<div data-alert class="alert-box success radius">';
  echo $sucesso;
  echo '<a href="#" class="close">&times;</a>';
  echo '</div>';
endif;
?>

<?php
if ($this->session->flashdata('notAllowed') != ""): 
	echo '<div data-alert class="alert-box alert radius">';
	echo $this->session->flashdata('notAllowed');
	echo '<a href="#" class="close">&times;</a>';
	echo '</div>';
endif;
?>

<?php
if ($this->session->flashdata('error') != ""): 
	echo '<div data-alert class="alert-box alert radius">';
	echo $this->session->flashdata('error');
	echo '<a href="#" class="close">&times;</a>';
	echo '</div>';
endif;
?>

<?php
if ($this->session->flashdata('success') != ""): 
	echo '<div data-alert class="alert-box success radius">';
	echo $this->session->flashdata('success');
	echo '<a href="#" class="close">&times;</a>';
	echo '</div>';
endif;
?>

<h3>Olá, <?php echo $this->session->userdata('username'); ?>!</h3>
<hr>

<h1><?php echo $this->session->userdata('permissao_usu'); ?></h1>
