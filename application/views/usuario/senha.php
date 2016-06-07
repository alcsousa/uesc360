<h4 class="grey-text">Alterar senha de acesso</h4>
<div class="divider"></div>

  <?php echo form_open('usuario/senha'); ?>

    <?php if(isset($error)): echo '<small class="red-text">'.$error.'</small>'; endif; ?>

    <div class="row">
      <div class="input-field col s12 l4">
        <?php echo form_password(array('id' => 'isenha', 'name' => 'senha')); ?>
        <?php echo form_error('senha'); ?>
        <label for="isenha">Senha Atual</label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12 l4">
        <?php echo form_password(array('id' =>'isenha2', 'name' => 'senha2')); ?>
        <?php echo form_error('senha2'); ?>
        <label for="isenha2">Nova Senha</label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12 l4">
        <?php echo form_password(array('id' => 'senha3', 'name' => 'senha3')); ?>
        <?php echo form_error('senha3'); ?>
        <label for="senha3">Confirmar Nova Senha</label>
      </div>
    </div>

    <div class="row">
      <div class=" col s12 m6 l4 right">
        <button type="submit" class="btn blue accent-2 waves-effect waves-light right"><i class="material-icons left">check</i> Alterar Senha</button>
      </div>
    </div>

<?php echo form_close(); ?>