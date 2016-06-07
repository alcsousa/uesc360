<?php if(empty($equipamento)): ?>
  <div class="row"><div class="col s12 m8 offset-m2 l6 offset-l3 center lighten-4"><p class="flow-text">Oops... nenhum dado foi encontrado! :(</p></div></div>
<?php else: ?>

  <div class="row">
    <div class="col s12">
      <p class="grey-text flow-text">Editar laboratório pertencente de "<?php echo $equipamento[0]->nome_eqp; ?>"</p>
    </div>
  </div>

  <?php echo form_open('equipamento/editar_laboratorio_pertencente/'.$equipamento[0]->id_equipamento); ?>

    <div class="row">
      <div class="input-field col s12 m6">
        <?php
          $options = array();
          $options['blank'] = '';
          foreach ($laboratorio as $row):
            $options[$row->id_laboratorio] = $row->nome_lab;
          endforeach;
          echo form_dropdown('laboratorio', $options, set_value('laboratorio', $equipamento[0]->id_laboratorio));
        ?>
        <label>Laboratório pertencente</label>
        <?php echo form_error('laboratorio'); ?>
      </div>
    </div>

    <div class="row">
      <div class="col s12 m6">
        <button type="submit" class="btn right blue"><i class="material-icons left">save</i>Salvar Dados</button>
      </div>
    </div>

  <?php echo form_close(); ?>


<?php endif; ?>