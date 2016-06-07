<div class="row">
  <div class="col s12">
    <span class="flow-text grey-text">Cadastro de pessoa</span>
    <p><b>* Ao finalizar o cadastro um email com dados de acesso será enviado para o endereço de email cadastrado.</b></p>

    <?php if(isset($sucesso)): ?>
    <div class="row">
      <div class="col s12 m10 offset-m1 l8 offset-l2 center">
        <div class="card-panel green accent-4 white-text">
          <i class="material-icons small">done</i>
          <br>
          <span><?php echo $sucesso; ?></span>
          <br>
          <br>
          <a href="<?php echo base_url('pessoa/cadastrar_pessoa'); ?>" class="btn green darken-3">Efetuar novo cadastro</a>
        </div>
      </div>
    </div>

    <?php else: ?>

    <?php echo form_open('pessoa/cadastrar_pessoa'); ?>
      <div class="row">
        <div class="input-field col s12 m6">
          <?php echo form_input(array('id' => 'inome', 'name' => 'nome'), set_value('nome'), 'autofocus'); ?>
          <label for="inome">Nome</label>
          <?php echo form_error('nome'); ?>
        </div>

        <div class="input-field col s12 m6">
          <?php echo form_input(array('id' => 'iemail', 'name' => 'email'), set_value('email')); ?>
          <label for="iemail">Email</label>
          <?php echo form_error('email'); ?>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12 m6">
          <?php
            $options = array();
            $options['blank'] = '';
            foreach ($departamento as $row):
              $options[$row->id_departamento] = $row->nome_dpt;
            endforeach;
            echo form_dropdown('departamento', $options, set_value('departamento'));
          ?>
          <label>Departamento</label>
          <?php echo form_error('departamento'); ?>
        </div>

        <div class="input-field col s12 m6">
          <?php
            $options = array();
            $options['blank'] = '';
            foreach ($tipo_pessoa as $row):
              $options[$row->id_tipo_pessoa] = $row->tipo_tip;
            endforeach;
            echo form_dropdown('tipo_pessoa', $options, set_value('tipo_pessoa'));
          ?>
          <label>Tipo de Pessoa</label>
          <?php echo form_error('tipo_pessoa'); ?>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12 m6">
          <select name="permissao">
            <option value="3" selected>Padrão</option>
            <option value="2">Coordenador</option>
          </select>
          <label>Permissão do Usuário</label>
        </div>

        <div class="input-field col s12 m6">
          <?php echo form_input(array('id' => 'itelefone', 'name' => 'ramal'), set_value('ramal')); ?>
          <label for="itelefone">Telefone</label>
          <?php echo form_error('ramal'); ?>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12 m6">
          <?php echo form_input(array('id' => 'ilattes', 'name' => 'lattes', 'placeholder' => 'http://lattes.cnpq.br/9999999999999999'), set_value('lattes')); ?>
          <label for="ilattes">Currículo Lattes</label>
          <?php echo form_error('lattes'); ?>
        </div>

        <div class="input-field col s12 m6">
          <?php echo form_input(array('id' => 'iwebsite', 'name' => 'website'), set_value('website')); ?>
          <label for="iwebsite">Site</label>
          <?php echo form_error('website'); ?>
        </div>
      </div>

      <div class="row">
        <div class="s12 col">
          <button type="reset" class="btn left grey hide-on-small-only"><i class="material-icons left">clear</i>Limpar</button>
          <button type="submit" class="btn right blue"><i class="material-icons left">save</i>Salvar Dados</button>
        </div>
      </div>

    <?php echo form_close(); ?>

    <?php endif; ?>


  </div>
</div>
