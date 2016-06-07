<div class="row">
  <div class="col s12 m8 offset-m2 l6 offset-l3">

    <p class="center flow-text hide-on-small-only">Insira abaixo o seu email para solicitar a recuperação de senha.</p>
    <p class="center hide-on-med-and-up">Insira abaixo o seu email para solicitar a recuperação de senha.</p>

    <?php
    if(isset($sucesso)):
      echo '<div class="card-panel green white-text">';
      echo $sucesso;
      echo '</div>';
    endif;
    ?>

    <?php
    if(isset($erro)):
      echo '<div class="card-panel red white-text">';
      echo $erro;
      echo '</div>';
    endif;
    ?>

    <ul class="collection with-header card">
      <li class="collection-header indigo">
        <h4 class="white-text">Recuperar Senha</h4>
      </li>

      <li class="collection-item">
        <div class="row">
  				<?php echo form_open('login/recuperar_senha'); ?>
            <br>
            <div class="input-field col s12">
              <i class="material-icons prefix">email</i>
              <input id="icon_email" type="text" name="email" value="<?php echo set_value('email'); ?>">
              <label for="icon_email">Insira o seu email</label>
              <?php echo form_error('email'); ?>
            </div>
            <button type="submit" class="btn waves-effect waves-light indigo accent-2 right"><i class="material-icons right">send</i>Recuperar senha</button>
          <?php echo form_close(); ?>
        </div>
      </li>
    </ul>

  </div>
</div>