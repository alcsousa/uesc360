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


<?php if(empty($laboratorio)): ?>
	<div class="row"><div class="col s12 m8 offset-m2 l6 offset-l3 center lighten-4"><p class="flow-text">Oops... nenhum dado foi encontrado! :(</p></div></div>
<?php else: ?>

  <p class="flow-text grey-text">Adicionar imagens "<span class="black-text"><?php echo $laboratorio[0]->nome_lab; ?></span>"</p>
	<div class="divider"></div>

	<br>
	<div class="row">
		<div class="col s12 m10 offset-m1 l8 offset-l2 card-panel">

			<?php if(isset($error)): ?>
			<div class="row">
				<div class="col s12 red white-text card-panel">
					<?php print_r($error); ?>
				</div>
			</div>
			<?php endif; ?>


			<?php echo form_open_multipart('laboratorio/gerenciar_imagens_laboratorio/'.$this->uri->segment(3));?>
		    <div class="file-field input-field">
		      <div class="btn blue">
		        <span>Selecionar</span>
		        <input type="file" name="userfile">
		      </div>
		      <div class="file-path-wrapper">
		        <input class="file-path validate" type="text" name="arquivo" placeholder="Clique para selecionar a imagem">
		      </div>
		      	<?php echo form_error('arquivo'); ?>
		      	<br>
		    </div>

		    <div class="row">
		      <div class="col s12">
		        <button type="submit" class="btn right blue"><i class="material-icons left">save</i>Salvar Imagem</button>
		      </div>
		    </div>
			<?php echo form_close(); ?>

		</div>
	</div>

  <p class="flow-text grey-text">Imagens salvas</span></p>
	<div class="divider"></div>
	<br>

	<div class="row">
    <div class="col s12">
      <?php if(empty($laboratorio_img)): ?>
        <p>Não há imagens vinculadas ao laboratório. :(</p>
      <?php else: ?>

				<div class="row">
        <?php foreach ($laboratorio_img as $row): ?>
	        <div class="col s12 m6 l4">
	          <div class="card small">
	            <div class="card-image">
			          <img class="materialboxed" data-caption="<?php echo $laboratorio[0]->nome_lab; ?>" width="200" src="<?php echo base_url('uploads/laboratorio/'.$row->nome_iml); ?>">
	            </div>
	            <div class="card-action">

			          <a class="modal-trigger btn-flat waves-effect red-text" href="#rmi<?php echo $row->id_img_laboratorio; ?>">
			            <i class="material-icons left">delete</i> Remover
			          </a>

	            </div>
	          </div>
	        </div>

          <!-- Confirmação deletar -->
          <div id="rmi<?php echo $row->id_img_laboratorio; ?>" class="modal">
            <div class="modal-content red white-text left-align">
              <h4 class="white-text">Remover Imagem</h4>
              <p><b>Você tem certeza que deseja continuar?</b></p>
              <p><b>Após concluir essa ação você não poderá recuperar a imagem.</b></p>
            </div>
            <div class="modal-footer">
              <a href="<?php echo base_url('laboratorio/deletar_imagem_laboratorio/'.$laboratorio[0]->id_laboratorio.'/'.$row->id_img_laboratorio); ?>" class="btn red modal-action modal-close waves-effect waves-green">Tenho certeza!</a>
            </div>
          </div>

        <?php endforeach; ?>
				</div>

      <?php endif; ?>
    </div>
	</div>

<?php endif; ?>