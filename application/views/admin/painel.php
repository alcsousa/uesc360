<!-- Mensagem de sucesso -->
<?php if($this->session->flashdata('sucesso') != ''): ?>
<div class="row">
  <div class="col s12 card-panel green white-text">
		<p><?php echo $this->session->flashdata('sucesso'); ?></p>
  </div>
</div>
<!-- Mensagem de erro -->
<?php elseif ($this->session->flashdata('erro') != ''): ?>
<div class="row">
  <div class="col s12 card-panel red white-text">
		<p><?php echo $this->session->flashdata('erro'); ?></p>
  </div>
</div>
<?php endif; ?>
<!-- fim feedback da ação ao usuário -->

<?php if($this->session->userdata('permissao_usu') == 1): ?>
  <div class="card-panel blue white-text">
    <span>Você está acessando a plataforma como <b>Administrador</b>.</span>
  </div>
<?php elseif($this->session->userdata('permissao_usu') == 2): ?>
  <div class="card-panel blue white-text">
    <span>Você está acessando a plataforma como <b>Coordenador</b>.</span>
  </div>
<?php endif; ?>


<p class="flow-text">Seja bem-vindo ao UESC 360º</p>
<p>Acesso o menu ao lado pra navegar.</p>