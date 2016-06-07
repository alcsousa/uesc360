<?php
	$dia = array();
	$dia[0] = '';
	for ($i=1; $i <= 31; $i++):
		$dia[$i] = $i;
	endfor;

	$mes[0] = '';
	$mes[1] = 'Janeiro';
	$mes[2] = 'Fevereiro';
	$mes[3] = 'Março';
	$mes[4] = 'Abril';
	$mes[5] = 'Maio';
	$mes[6] = 'Junho';
	$mes[7] = 'Julho';
	$mes[8] = 'Agosto';
	$mes[9] = 'Setembro';
	$mes[10] = 'Outubro';
	$mes[11] = 'Novembro';
	$mes[12] = 'Dezembro';

	$ano = array();
	$ano[0] = '';
	for ($i=1930; $i <= 1999; $i++):
		$ano[$i] = $i;
	endfor;
?>

<div class="row">

  <div class="col s12 m10 offset-m1 l8 offset-l2 card-panel">
    <p class="flow-text grey-text">Cadasto</p>

    <?php echo form_open('cadastro'); ?>

      <div class="row">

        <div class="input-field col s12">
          <?php echo form_input(array('id' => 'inome', 'name' => 'nome'), set_value('nome'), 'autofocus'); ?>
          <label for="inome">Nome</label>
          <?php echo form_error('nome'); ?>
        </div>

        <div class="input-field col s12 m6">
          <?php echo form_input(array('id' => 'icpf', 'name' => 'cpf'), set_value('cpf')); ?>
          <label for="icpf">CPF</label>
          <?php echo form_error('cpf'); ?>
        </div>

        <div class="input-field col s12 m6">
          <?php echo form_input(array('id' => 'iemail', 'name' => 'email'), set_value('email')); ?>
          <label for="iemail">Email</label>
          <?php echo form_error('email'); ?>
        </div>

        <div class="input-field col s12 m6">
          <?php echo form_password(array('id' => 'isenha', 'name' => 'senha'), set_value('senha')); ?>
          <label for="isenha">Senha</label>
          <?php echo form_error('senha'); ?>
        </div>

        <div class="input-field col s12 m6">
          <?php echo form_password(array('id' => 'isenha2', 'name' => 'senha2'), set_value('senha2')); ?>
          <label for="isenha2">Confirmar senha</label>
          <?php echo form_error('senha2'); ?>
        </div>

        <div class="input-field col s12 m6">
          <?php
            $options = array();
            $options['blank'] = '';
            foreach ($departamento as $row):
              $options[$row->id_departamento] = $row->nome_dpt;
            endforeach;
            echo form_dropdown('departamento', $options);
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
            echo form_dropdown('tipo_pessoa', $options);
          ?>
          <label>Cargo/Função</label>
          <?php echo form_error('tipo_pessoa'); ?>
        </div>

        <div class="input-field col s12 m6">
          <?php echo form_input(array('id' => 'itelefone', 'name' => 'ramal', 'placeholder' => '(73) 9999-9999'), set_value('ramal')); ?>
          <label for="itelefone">Telefone/Ramal</label>
          <?php echo form_error('ramal'); ?>
        </div>

        <div class="input-field col s12 m6">
          <?php echo form_input(array('id' => 'ilattes', 'name' => 'lattes', 'placeholder' => 'http://lattes.cnpq.br/xxxxxxxxxxxxxxxx'), set_value('lattes')); ?>
          <label for="isenha">Currículo Lattes</label>
          <?php echo form_error('lattes'); ?>
        </div>

        <div class="input-field col s12">
          <?php echo form_input(array('id' => 'iwebsite', 'name' => 'website'), set_value('website')); ?>
          <label for="itelefone">Website</label>
          <?php echo form_error('website'); ?>
        </div>


        <div class="row">
          <div class="input-field col s4">
            <?php echo form_dropdown('dia', $dia); ?>
            <label>Data de Nascimento</label>
            <?php echo form_error('dia'); ?>
          </div>

          <div class="input-field col s4">
            <?php echo form_dropdown('mes', $mes); ?>
            <?php echo form_error('mes'); ?>
          </div>

          <div class="input-field col s4">
            <?php echo form_dropdown('ano', $ano); ?>
            <?php echo form_error('ano'); ?>
          </div>
        </div>

        <fieldset>
          <legend class="grey-text">Sexo</legend>
          <div class="s12 col">
            <?php echo form_error('sexo'); ?>
            <p>
              <input type="radio" name="sexo" id="rsm" value="M" <?php echo set_radio('sexo', 'M', TRUE); ?> />
              <label for="rsm">Masculino</label>
            </p>
            <p>
              <input type="radio" name="sexo" id="rsf" value="F" <?php echo set_radio('sexo', 'F'); ?> />
              <label for="rsf">Feminino</label>
            </p>
          </div>
        </fieldset>

      </div>

      <div class="row">
        <div class="col s12">
          <!-- <?php echo form_hidden('email', $email); ?> -->
          <?php echo form_reset(array('class' => 'btn left grey'), 'Limpar Formulário'); ?>
          <?php echo form_submit(array('class' => 'btn right blue'), 'Cadastrar'); ?>
        </div>
      </div>

    <?php echo form_close(); ?>

  </div>
</div>

<div class="row">
  <div class="col s12 m10 offset-m1 l8 offset-l2 card-panel center">
    <p class="flow-text">Instale também em sua instituição!</p>
    <a href="http://voobex.com/" target="_blank">
      <img src="<?php echo base_url('assets/img/voobexBlue.png'); ?>" alt="Voobex" width="150">
    </a>
    <p class="flow-text"><b>contato@voobex.com</b></p>
    <p>Entre em contato e saiba como instalar essa ferramenta em sua universidade.</p>
  </div>
</div>