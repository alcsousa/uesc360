<div class="indigo darken-2">
  <?php if (!$this->session->userdata('logged_in')): ?>
    <span class="left btn-flat white-text hide-on-small-only">Seja bem-vindo ao UESC 360º!</span>
  <?php elseif($this->session->userdata('logged_in')): ?>
    <a href="<?php echo base_url('login'); ?>" class="left white-text btn-flat hide-on-small-only">Olá, <?php echo $this->session->userdata('username'); ?>!</a>
  <?php endif; ?>

  <div class="right-align">
    <?php if (!$this->session->userdata('logged_in')): ?>
      <a href="<?php echo base_url('cadastro'); ?>" class="white-text btn-flat"><i class="material-icons left">assignment</i> Cadastre-se</a>
      <a href="<?php echo base_url('login'); ?>" class="white-text btn-flat"><i class="material-icons left">lock</i>Login</a>
    <?php elseif($this->session->userdata('logged_in')): ?>
      <a class="dropdown-button btn-flat white-text" href="#" data-activates="dropdown1"><i class="material-icons left">account_circle</i>Área Restrita</a>

      <ul id='dropdown1' class='dropdown-content'>
        <li><a href="<?php echo base_url('login'); ?>" class="blue-text"><i class="material-icons left">dashboard</i> Painel</a></li>
        <li class="divider"></li>
        <?php foreach ($this->security_model->getPermissions() as $row): ?>
          <?php if($row->fk_id_permissao == 1): ?>
            <li><a href="<?php echo base_url('login/login_as/1'); ?>" class="indigo-text"><i class="material-icons left">account_circle</i> Administrador</a></li>
          <?php elseif($row->fk_id_permissao == 2): ?>
            <li><a href="<?php echo base_url('login/login_as/2'); ?>" class="indigo-text"><i class="material-icons left">account_circle</i> Coordenador</a></li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>
      <a href="<?php echo base_url('login/logoff'); ?>" class="white-text btn-flat"><i class="material-icons left">power_settings_new</i>Sair</a>
    <?php endif; ?>

  </div>
</div>