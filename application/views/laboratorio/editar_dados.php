<?php if(empty($laboratorio)): ?>
  <div class="row"><div class="col s12 m8 offset-m2 l6 offset-l3 center lighten-4"><p class="flow-text">Oops... nenhum dado foi encontrado! :(</p></div></div>
<?php else: ?>

  <div class="row">
    <div class="col s12">
      <p class="grey-text flow-text">Editar dados de "<?php echo $laboratorio[0]->nome_lab; ?>"</p>
    </div>
  </div>

  <?php echo form_open('laboratorio/editar_dados/'.$laboratorio[0]->id_laboratorio); ?>

    <div class="row">
      <div class="input-field col s12">
        <?php echo form_input(array('id' => 'inome', 'name' => 'nome'), set_value('nome', $laboratorio[0]->nome_lab)); ?>
        <label for="inome">Nome</label>
        <?php echo form_error('nome'); ?>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12 m6">
        <?php echo form_input(array('id' => 'itelefone', 'name' => 'ramal', 'placeholder' => '(73) 3680-0000'), set_value('ramal', $laboratorio[0]->ramal_lab)); ?>
        <label for="itelefone">Telefone / Ramal</label>
        <?php echo form_error('ramal'); ?>
      </div>

      <div class="input-field col s12 m6">
        <?php echo form_input(array('id' => 'iwebsite', 'name' => 'website'), set_value('website', $laboratorio[0]->website_lab)); ?>
        <label for="iwebsite">Website</label>
        <?php echo form_error('website'); ?>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12">
        <?php echo form_textarea(array('name' => 'areas_atendidas', 'id' => 'iareas_atendidas', 'class' => 'materialize-textarea'), set_value('areas_atendidas', $laboratorio[0]->areas_atendidas_lab)); ?>
        <label for="iareas_atendidas">Áreas atendidas</label>
        <?php echo form_error('especificacao'); ?>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12">
        <?php echo form_textarea(array('name' => 'descricao', 'id' => 'idescricao', 'class' => 'materialize-textarea'), set_value('descricao', $laboratorio[0]->descricao_lab)); ?>
        <label for="idescricao">Descrição</label>
        <?php echo form_error('especificacao'); ?>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12">
        <?php echo form_textarea(array('name' => 'atividades', 'id' => 'iatividades', 'class' => 'materialize-textarea'), set_value('atividades', $laboratorio[0]->atividades_lab)); ?>
        <label for="iatividades">Atividades desenvolvidas</label>
        <?php echo form_error('atividades'); ?>
      </div>
    </div>

    <div class="row">
      <p>* Insira palavras chaves separadas APENAS por espaço. Ex.: "inovação web software engenharia"</p>
      <div class="input-field col s12">
        <?php echo form_textarea(array('name' => 'palavras_chave', 'id' => 'ipalavras_chave', 'class' => 'materialize-textarea'), set_value('palavras_chave', $laboratorio[0]->palavras_chave)); ?>
        <label for="ipalavras_chave">Palavras-chave</label>
        <?php echo form_error('palavras_chave'); ?>
      </div>
    </div>

    <div class="row">
      <fieldset>
        <legend class="grey-text">Laboratório utilizado para:</legend>
        <div class="s12 col">
          <p>
          	<?php
              $dataCEN['name'] 	= 'usa_ensino';
              $dataCEN['id'] 		= 'checkEns';
              $dataCEN['value'] = 'Sim';

          		if($laboratorio[0]->usa_ensino_lab == "Sim"):
	                $dataCEN['checked'] = set_checkbox('usa_ensino', $laboratorio[0]->usa_ensino_lab, TRUE);
 							else:
	                $dataCEN['checked'] = set_checkbox('usa_ensino', $laboratorio[0]->usa_ensino_lab);
							endif;
	            echo form_checkbox($dataCEN);
						?>
            <label for="checkEns">Ensino</label>
          </p>

          <p>
          	<?php
              $dataCPE['name'] 	= 'usa_pesquisa';
              $dataCPE['id'] 		= 'checkPes';
              $dataCPE['value'] = 'Sim';

          		if($laboratorio[0]->usa_pesquisa_lab == "Sim"):
	                $dataCPE['checked'] = set_checkbox('usa_pesquisa', $laboratorio[0]->usa_pesquisa_lab, TRUE);
 							else:
	                $dataCPE['checked'] = set_checkbox('usa_pesquisa', $laboratorio[0]->usa_pesquisa_lab);
							endif;
	            echo form_checkbox($dataCPE);
						?>
            <label for="checkPes">Pesquisa</label>
          </p>

          <p>
          	<?php
              $dataCEX['name'] 	= 'usa_extensao';
              $dataCEX['id'] 		= 'checkExt';
              $dataCEX['value'] = 'Sim';

          		if($laboratorio[0]->usa_extensao_lab == "Sim"):
	                $dataCEX['checked'] = set_checkbox('usa_extensao', $laboratorio[0]->usa_extensao_lab, TRUE);
 							else:
	                $dataCEX['checked'] = set_checkbox('usa_extensao', $laboratorio[0]->usa_extensao_lab);
							endif;
	            echo form_checkbox($dataCEX);
						?>
            <label for="checkExt">Extensão</label>
          </p>

        </div>
      </fieldset>
    </div>

    <div class="row">
      <fieldset>
        <legend class="grey-text">É multiusuário?</legend>
        <div class="s12 col">
          <?php echo form_error('multiusuario'); ?>
          <p>
	        	<?php if($laboratorio[0]->multiusuario_lab == "Sim"): ?>
            <input type="radio" name="multiusuario" id="rSim" value="Sim" <?php echo set_radio('multiusuario', 'Sim', TRUE); ?> />
						<?php else: ?>
            <input type="radio" name="multiusuario" id="rSim" value="Sim" <?php echo set_radio('multiusuario', 'Sim'); ?> />
						<?php endif; ?>
            <label for="rSim">Sim</label>
          </p>
          <p>
	        	<?php if($laboratorio[0]->multiusuario_lab == "Não"): ?>
            <input type="radio" name="multiusuario" id="rNao" value="Não" <?php echo set_radio('multiusuario', 'Não', TRUE); ?> />
						<?php else: ?>
            <input type="radio" name="multiusuario" id="rNao" value="Não" <?php echo set_radio('multiusuario', 'Não'); ?> />
						<?php endif; ?>
            <label for="rNao">Não</label>
          </p>
        </div>
      </fieldset>
    </div>

    <div class="row">
      <div class="s12 col">
        <button type="submit" class="btn right blue"><i class="material-icons left">save</i>Salvar Dados</button>
      </div>
    </div>

  <?php echo form_close(); ?>

<?php endif; ?>