<style>
.main-wrapper
{
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
}

</style>

<div class="main-wrapper valign-wrapper">

  <div class="row">
    <div class="col s12 m10 offset-m1">
      <p class="center flow-text hide-on-small-only">Insira uma nova senha abaixo.</p>

      <ul class="collection with-header card">
        <li class="collection-header indigo">
          <h4 class="white-text">Nova senha</h4>
        </li>

        <li class="collection-item">
          <?php echo form_open('cadastro/gravar_senha/'.$this->uri->segment(3)); ?>
            <div class="row">
              <?php echo form_error('token'); ?>
              <div class="input-field col s12">
                <i class="material-icons prefix">lock</i>
                <input id="icon_password" type="password" name="senha" value="<?php echo set_value('senha'); ?>">
                <label for="icon_password">Nova senha</label>
                <?php echo form_error('senha'); ?>
              </div>

              <div class="input-field col s12">
                <i class="material-icons prefix">lock</i>
                <input id="icon_password2" type="password" name="confirmar_senha" value="<?php echo set_value('confirmar_senha'); ?>">
                <label for="icon_password2">Confirmar senha</label>
                <?php echo form_error('confirmar_senha'); ?>
              </div>

              <button type="submit" class="btn waves-effect waves-light indigo accent-2 right"><i class="material-icons right">save</i> Salvar</button>
            </div>
          <?php echo form_close(); ?>
        </li>
      </ul>
    </div>
  </div>

</div>