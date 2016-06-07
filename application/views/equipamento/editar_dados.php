<?php if(empty($equipamento)): ?>
  <div class="row">
    <div class="col s12 m8 offset-m2 l6 offset-l3 center card-panel indigo lighten-4">
      <p class="flow-text">Oops... nenhum dado foi encontrado! :(</p>
    </div>
  </div>
<?php else: ?>

	<div class="row">
		<div class="col s12">
			<h4 class="grey-text">Editar dados de <?php echo $equipamento[0]->nome_eqp; ?></h4>
		</div>
	</div>

  <?php echo form_open('equipamento/editar_dados/'.$equipamento[0]->id_equipamento); ?>

    <div class="row">
      <div class="input-field col s12">
        <?php echo form_input(array('id' => 'inome', 'name' => 'nome'), set_value('nome', $equipamento[0]->nome_eqp)); ?>
        <label for="inome">Nome</label>
        <?php echo form_error('nome'); ?>
      </div>

    </div>

    <div class="row">
      <div class="input-field col s12 m6">
        <?php echo form_input(array('id' => 'ifabricante', 'name' => 'fabricante'), set_value('fabricante', $equipamento[0]->fabricante_eqp)); ?>
        <label for="ifabricante">Fabricante</label>
        <?php echo form_error('fabricante'); ?>
      </div>

      <div class="input-field col s12 m6">
        <?php echo form_input(array('id' => 'iquantidade', 'name' => 'quantidade'), set_value('quantidade', $equipamento[0]->quantidade_eqp)); ?>
        <label for="iquantidade">Quantidade</label>
        <?php echo form_error('quantidade'); ?>
      </div>

    </div>

    <div class="row">
      <div class="input-field col s12">
        <?php echo form_textarea(array('name' => 'especificacao', 'id' => 'iespecificacao', 'class' => 'materialize-textarea'), set_value('especificacao', $equipamento[0]->especificacao_eqp)); ?>
        <label for="iespecificacao">Especificação</label>
        <?php echo form_error('especificacao'); ?>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12">
        <?php echo form_textarea(array('name' => 'descricao', 'id' => 'idescricao', 'class' => 'materialize-textarea'), set_value('descricao', $equipamento[0]->descricao_eqp)); ?>
        <label for="idescricao">Descrição</label>
        <?php echo form_error('descricao'); ?>
      </div>
    </div>

    <div class="row">
      <div class="s12 col">
        <button type="submit" class="btn right blue"><i class="material-icons left">save</i>Salvar Alterações</button>
      </div>
    </div>

  <?php echo form_close(); ?>

<?php endif; ?>