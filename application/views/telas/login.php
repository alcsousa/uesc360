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
		<div class="col s12 m10 offset-m1 center">
	    <a href="http://voobex.com/" target="_blank">
      	<img src="<?php echo base_url('assets/img/voobexBlue.png'); ?>" alt="Voobex" width="150">
		  </a>
			<p class="center flow-text hide-on-small-only">Faça login para acessar sua área restrita do UESC 360º</p>

      <ul class="collection with-header card">

        <li class="collection-header indigo">
        	<h4 class="white-text">Login</h4>
      	</li>

        <li class="collection-item">
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
					<?php
					if(isset($sucesso)):
					  echo '<div class="green card-panel white-text">';
					  echo $sucesso;
					  echo '</div>';
					endif;
					?>

					<?php echo form_open('login'); ?>
						<?php if(isset($loginError)): echo '<small class="red-text">* Dados Inválidos!</small>'; endif; ?>
						<br>
						<div class="row">
			        <div class="input-field col s12">
			          <i class="material-icons prefix">person</i>
			          <input id="icon_user" type="text" name="usuario" value="<?php echo set_value('usuario'); ?>" class="validate">
			          <label for="icon_user">Usuário</label>
								<?php echo form_error('usuario'); ?>
			        </div>


			        <div class="input-field col s12">
			          <i class="material-icons prefix">lock</i>
			          <input id="icon_password" type="password" name="senha">
			          <label for="icon_password">Senha</label>
								<?php echo form_error('senha'); ?>
			        </div>

							<button type="submit" class="btn waves-effect waves-light indigo accent-2 right"><i class="material-icons right">send</i> ENTRAR</button>
						</div>
					<?php echo form_close(); ?>
        </li>

        <li class="collection-item indigoa lighten-4">
					<a class="left grey-text text-darken-2" href="<?php echo base_url('login/recuperar_senha'); ?>">Esqueceu a senha?</a>
					<a class="right grey-text text-darken-2" href="<?php echo base_url('cadastro'); ?>">Cadastre-se</a>
					<br>
				</li>

      </ul>

			<div class="row center">
				<div class="col s12">
					<a href="<?php echo base_url('home'); ?>" class="btn-flat waves-effect waves-light grey-text text-darken-1"><i class="material-icons left">home</i>acessar página principal</a>
				</div>

			</div>


		</div>
	</div>

</div>