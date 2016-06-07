<div class="row">
  <div class="col s12">
    <h4 class="grey-text">Cadastro de laboratório</h4>

    <?php if(isset($sucesso)): ?>
    <div class="row">
      <div class="col s12 m10 offset-m1 l8 offset-l2 center">
        <div class="card-panel green accent-4 white-text">
          <i class="material-icons small">done</i>
          <br>
          <span><?php echo $sucesso; ?></span>
          <br>
          <br>
          <a href="<?php echo base_url('laboratorio/cadastrar_laboratorio'); ?>" class="btn green darken-3">Efetuar novo cadastro</a>
        </div>
      </div>
    </div>

    <?php elseif (isset($erro)): ?>

    <div class="row">
      <div class="col s12 m10 offset-m1 l8 offset-l2 center">
        <div class="card-panel red accent-4 white-text">
          <i class="material-icons small">error_outline</i>
          <br>
          <span><?php echo $erro; ?></span>
          <br>
          <br>
          <a href="<?php echo base_url('laboratorio/cadastrar_laboratorio'); ?>" class="btn green darken-3">Tentar novamente</a>
        </div>
      </div>
    </div>

    <?php else: ?>

    <?php echo form_open('laboratorio/cadastrar_laboratorio'); ?>

      <div class="row">
        <div class="input-field col s12">
          <?php echo form_input(array('id' => 'inome', 'name' => 'nome'), set_value('nome'), 'autofocus'); ?>
          <label for="inome">Nome</label>
          <?php echo form_error('nome'); ?>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12 m6">
          <?php
            $options = array();
            $options['blank'] = '';
            foreach ($coordenador as $row):
              $options[$row->id_pessoa] = $row->nome_pes;
            endforeach;
            echo form_dropdown('coordenador', $options, set_value('coordenador'));
          ?>
          <label>Coordenador</label>
          <?php echo form_error('coordenador'); ?>
        </div>

        <div class="input-field col s12 m6">
          <?php
            $options = array();
            $options['blank'] = '';
            foreach ($pavilhao as $row):
              $options[$row->id_pavilhao] = $row->nome_pav;
            endforeach;
            echo form_dropdown('pavilhao', $options, set_value('pavilhao'));
          ?>
          <label>Localização</label>
          <?php echo form_error('pavilhao'); ?>
        </div>
      </div>




      <div class="row">
        <div class="input-field col s12 m6">
          <?php echo form_input(array('id' => 'itelefone', 'name' => 'ramal', 'placeholder' => '(73) 3680-0000'), set_value('ramal')); ?>
          <label for="itelefone">Telefone / Ramal</label>
          <?php echo form_error('ramal'); ?>
        </div>

        <div class="input-field col s12 m6">
          <?php echo form_input(array('id' => 'iwebsite', 'name' => 'website'), set_value('website')); ?>
          <label for="iwebsite">Website</label>
          <?php echo form_error('website'); ?>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12">
          <?php echo form_textarea(array('name' => 'areas_atendidas', 'id' => 'iareas_atendidas', 'class' => 'materialize-textarea'), set_value('areas_atendidas')); ?>
          <label for="iareas_atendidas">Áreas atendidas</label>
          <?php echo form_error('areas_atendidas'); ?>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12">
          <?php echo form_textarea(array('name' => 'descricao', 'id' => 'idescricao', 'class' => 'materialize-textarea'), set_value('descricao')); ?>
          <label for="idescricao">Descrição</label>
          <?php echo form_error('descricao'); ?>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12">
          <?php echo form_textarea(array('name' => 'atividades', 'id' => 'iatividades', 'class' => 'materialize-textarea'), set_value('atividades')); ?>
          <label for="iatividades">Atividades desenvolvidas</label>
          <?php echo form_error('atividades'); ?>
        </div>
      </div>

      <div class="row">
        <p>* Insira palavras chaves separadas APENAS por espaço. Ex.: "inovação web software engenharia"</p>
        <div class="input-field col s12">
          <?php echo form_textarea(array('name' => 'palavras_chave', 'id' => 'ipalavras_chave', 'class' => 'materialize-textarea'), set_value('palavras_chave')); ?>
          <label for="ipalavras_chave">Palavras-chave</label>
          <?php echo form_error('palavras_chave'); ?>
        </div>
      </div>

      <div class="row">
        <fieldset>
          <legend class="grey-text">Selecione os cursos</legend>
          <?php echo form_error('curso'); ?>
          <div class="s12 m6 col">
            <?php for( $iPos=0; $iPos < (count($curso)/2); $iPos++ ): ?>
            <?php
              $data = array(
                'name'        => 'curso[]',
                'id'          => 'checkC'.$curso[$iPos]->id_curso,
                'value'       => $curso[$iPos]->id_curso,
                'checked'     => set_checkbox('curso', $curso[$iPos]->id_curso),
              );
            ?>
            <p>
              <?php echo form_checkbox($data); ?>
              <label for="<?php echo "checkC{$curso[$iPos]->id_curso}"; ?>"><?php echo $curso[$iPos]->nome_cur; ?></label>
            </p>
            <?php endfor; ?>
          </div>

          <div class="s12 m6 col">
            <?php for( $iPos=(count($curso)/2)+1; $iPos < count($curso); $iPos++ ): ?>
            <?php
              $data = array(
                'name'        => 'curso[]',
                'id'          => 'checkC'.$curso[$iPos]->id_curso,
                'value'       => $curso[$iPos]->id_curso,
                'checked'     => set_checkbox('curso', $curso[$iPos]->id_curso),
              );
            ?>
            <p>
              <?php echo form_checkbox($data); ?>
              <label for="<?php echo "checkC{$curso[$iPos]->id_curso}"; ?>"><?php echo $curso[$iPos]->nome_cur; ?></label>
            </p>
            <?php endfor; ?>
          </div>
        </fieldset>
      </div>

      <div class="row">
        <fieldset>
          <legend class="grey-text">Selecione os departamentos</legend>
          <?php echo form_error('departamento'); ?>
          <div class="s12 col">
            <?php foreach ($departamento as $row): ?>
            <p>
              <?php
                $dataD = array(
                  'name'        => 'departamento[]',
                  'id'          => 'checkD'.$row->id_departamento,
                  'value'       => $row->id_departamento,
                  'checked'     => set_checkbox('departamento', $row->id_departamento),
                );
              ?>
              <?php echo form_checkbox($dataD); ?>
              <label for="<?php echo "checkD{$row->id_departamento}"; ?>"><?php echo $row->nome_dpt; ?></label>
            </p>
            <?php endforeach; ?>
          </div>
        </fieldset>
      </div>

      <div class="row">
        <fieldset>
          <legend class="grey-text">Laboratório utilizado para:</legend>
          <div class="s12 col">
            <p>
              <?php
                $dataCEN = array(
                  'name'        => 'usa_ensino',
                  'id'          => 'checkEns',
                  'value'       => 'Sim',
                  'checked'     => set_checkbox('usa_ensino', 'Sim'),
                );
              ?>
              <?php echo form_checkbox($dataCEN); ?>
              <label for="checkEns">Ensino</label>
            </p>

            <p>
              <?php
                $dataCPE = array(
                  'name'        => 'usa_pesquisa',
                  'id'          => 'checkPes',
                  'value'       => 'Sim',
                  'checked'     => set_checkbox('usa_pesquisa', 'Sim'),
                );
              ?>
              <?php echo form_checkbox($dataCPE); ?>
              <label for="checkPes">Pesquisa</label>
            </p>

            <p>
              <?php
                $dataCEX = array(
                  'name'        => 'usa_extensao',
                  'id'          => 'checkExt',
                  'value'       => 'Sim',
                  'checked'     => set_checkbox('usa_extensao', 'Sim'),
                );
              ?>
              <?php echo form_checkbox($dataCEX); ?>
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
              <input type="radio" name="multiusuario" id="rSim" value="Sim" <?php echo set_radio('multiusuario', 'Sim', TRUE); ?> />
              <label for="rSim">Sim</label>
            </p>
            <p>
              <input type="radio" name="multiusuario" id="rNao" value="Não" <?php echo set_radio('multiusuario', 'Não'); ?> />
              <label for="rNao">Não</label>
            </p>
          </div>
        </fieldset>
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