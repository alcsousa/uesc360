<?php if(!isset($convite_sucesso)): ?>

<div class="row">
  <div class="col s12 m8 offset-m2 l6 offset-l3">

    <p class="center flow-text hide-on-small-only">Insira abaixo o seu email para solicitar o cadastro em nossa plataforma. Esse passo é necessário para que possamos validar o seu contato.</p>
    <p class="center hide-on-med-and-up">Insira abaixo o seu email para solicitar o cadastro em nossa plataforma. Esse passo é necessário para que possamos validar o seu contato.</p>

    <ul class="collection with-header card">

      <li class="collection-header indigo">
        <h4 class="white-text">Cadastro</h4>
      </li>

      <li class="collection-item">
        <div class="row">
					<?php if(isset($convite_erro)): ?>
					  <div class="col s12 card-panel red white-text">
							<p><?php echo $convite_erro; ?></p>
					  </div>
					<?php endif; ?>

          <?php echo form_open('cadastro'); ?>
            <br>
            <div class="input-field col s12">
              <i class="material-icons prefix">email</i>
              <input id="icon_email" type="text" name="email" value="<?php echo set_value('email'); ?>">
              <label for="icon_email">Insira o seu email</label>
              <?php echo form_error('email'); ?>
            </div>
            <button type="submit" class="btn waves-effect waves-light indigo accent-2 right"><i class="material-icons right">send</i>Solicitar convite</button>
          <?php echo form_close(); ?>
        </div>
      </li>
    </ul>
  </div>
</div>

<?php else: ?>
	<div class="row">
	  <div class="col s12 m10 offset-m1 l8 offset-l2 card-panel green white-text">
			<p><?php echo $convite_sucesso; ?></p>
	  </div>
	</div>
<?php endif; ?>