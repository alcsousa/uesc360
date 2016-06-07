<?php if(empty($laboratorio)): ?>
  <div class="row"><div class="col s12 m8 offset-m2 l6 offset-l3 center lighten-4"><p class="flow-text">Oops... nenhum dado foi encontrado! :(</p></div></div>
<?php else: ?>

  <div class="row">
    <div class="col s12">
      <p class="grey-text flow-text">Editar localização de "<?php echo $laboratorio[0]->nome_lab; ?>"</p>
    </div>
  </div>

  <?php echo form_open('laboratorio/editar_localizacao/'.$laboratorio[0]->id_laboratorio); ?>

    <div class="row">
      <div class="input-field col s12 m6">
        <?php
          $options = array();
          $options['blank'] = '';
          foreach ($pavilhao as $row):
            $options[$row->id_pavilhao] = $row->nome_pav;
          endforeach;
          echo form_dropdown('pavilhao', $options, set_value('pavilhao', $laboratorio[0]->id_pavilhao));
        ?>
        <label>Localização</label>
        <?php echo form_error('pavilhao'); ?>
      </div>
    </div>

    <div class="row">
      <div class="col s12 m6">
        <button type="submit" class="btn right blue"><i class="material-icons left">save</i>Salvar Dados</button>
      </div>
    </div>

  <?php echo form_close(); ?>


<?php endif; ?>