<div class="row">
  <div class="col s12">
    <h4 class="grey-text">Editar perfil</h4>
  </div>
</div>

<?php echo form_open('usuario/editar'); ?>

  <div class="row">

    <div class="input-field col s12">
      <?php echo form_input(array('id' => 'inome', 'name' => 'nome'), set_value('nome', $pessoa[0]->nome_pes)); ?>
      <label for="inome">Nome</label>
      <?php echo form_error('nome'); ?>
    </div>

    <div class="input-field col s12 m6">
      <?php echo form_input(array('id' => 'icpf', 'name' => 'cpf'), set_value('cpf', $pessoa[0]->cpf_pes)); ?>
      <label for="icpf">CPF</label>
      <?php echo form_error('cpf'); ?>
    </div>

    <div class="input-field col s12 m6">
      <?php echo form_input(array('id' => 'iemail', 'name' => 'email'), set_value('email', $pessoa[0]->email_pes)); ?>
      <label for="iemail">Email</label>
      <?php echo form_error('email'); ?>
    </div>

    <div class="input-field col s12">
      <?php
        $options = array();
        $options['blank'] = '';
        foreach ($departamento as $row):
          $options[$row->id_departamento] = $row->nome_dpt;
        endforeach;
        echo form_dropdown('departamento', $options, set_value('departamento', $pessoa[0]->fk_id_departamento));
      ?>
      <label>Departamento</label>
      <?php echo form_error('departamento'); ?>
    </div>

    <div class="input-field col s12 m6 l4">
      <?php
        $options = array();
        $options['blank'] = '';
        foreach ($tipo_pessoa as $row):
          $options[$row->id_tipo_pessoa] = $row->tipo_tip;
        endforeach;
        echo form_dropdown('tipo_pessoa', $options, set_value('tipo_pessoa', $pessoa[0]->id_tipo_pessoa));
      ?>
      <label>Cargo/Função</label>
      <?php echo form_error('tipo_pessoa'); ?>
    </div>

    <div class="input-field col s12 m6 l4">
      <?php echo form_input(array('id' => 'ibirthday', 'name' => 'birthday', 'class' => 'data_mask'), set_value('birthday', $this->funcoes->formatoDataHumano($pessoa[0]->birthday_pes))); ?>
      <label for="ibirthday">Data de Nascimento</label>
      <?php echo form_error('birthday'); ?>
    </div>

    <div class="input-field col s12 l4">
      <?php echo form_input(array('id' => 'itelefone', 'name' => 'ramal', 'placeholder' => '(73) 0000-0000'), set_value('ramal', $pessoa[0]->ramal_pes)); ?>
      <label for="itelefone">Ramal</label>
      <?php echo form_error('ramal'); ?>
    </div>

    <div class="input-field col s12">
      <?php echo form_input(array('id' => 'ilattes', 'name' => 'lattes', 'placeholder' => 'http://lattes.cnpq.br/9999999999999999'), set_value('lattes', $pessoa[0]->lattes_pes)); ?>
      <label for="ilattes">Currículo Lattes</label>
      <?php echo form_error('lattes'); ?>
    </div>

    <div class="input-field col s12">
      <?php echo form_input(array('id' => 'iwebsite', 'name' => 'website'), set_value('website', $pessoa[0]->website_pes)); ?>
      <label for="iwebsite">Site</label>
      <?php echo form_error('website'); ?>
    </div>

    <?php form_hidden('ID_PESSOA', $pessoa[0]->id_pessoa); ?>

    <div class="row">
      <div class="s12 col">
        <button type="submit" class="btn right blue"><i class="material-icons left">save</i>Salvar Alterações</button>
      </div>
    </div>

  </div>

<?php echo form_close(); ?>