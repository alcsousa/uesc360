<?php if(empty($laboratorio)): ?>
  <div class="row"><div class="col s12 m8 offset-m2 l6 offset-l3 center lighten-4"><p class="flow-text">Oops... nenhum dado foi encontrado! :(</p></div></div>
<?php else: ?>

  <div class="row">
    <div class="col s12">
      <p class="grey-text flow-text">Editar departamentos de "<?php echo $laboratorio[0]->nome_lab; ?>"</p>
    </div>
  </div>

  <?php echo form_open('laboratorio/editar_departamentos/'.$laboratorio[0]->id_laboratorio); ?>

    <div class="row">
      <?php
        foreach ($departamentos_lab as $row):
          $departamentosLAB[] = $row->id_departamento;
        endforeach;
      ?>

      <fieldset>
        <legend class="grey-text">Selecione os departamentos</legend>
        <?php echo form_error('departamento'); ?>
        <div class="s12 col">
          <?php foreach ($departamento as $row): ?>
          <p>
            <?php if(in_array($row->id_departamento, $departamentosLAB)): ?>
              <?php
                $dataD = array(
                  'name'        => 'departamento[]',
                  'id'          => 'checkD'.$row->id_departamento,
                  'value'       => $row->id_departamento,
                  'checked'     => set_checkbox('departamento', $row->id_departamento, TRUE),
                );
              ?>
              <?php echo form_checkbox($dataD); ?>
            <?php else: ?>
              <?php
                $dataD = array(
                  'name'        => 'departamento[]',
                  'id'          => 'checkD'.$row->id_departamento,
                  'value'       => $row->id_departamento,
                  'checked'     => set_checkbox('departamento', $row->id_departamento),
                );
              ?>
              <?php echo form_checkbox($dataD); ?>
            <?php endif; ?>
            <label for="<?php echo "checkD{$row->id_departamento}"; ?>"><?php echo $row->nome_dpt; ?></label>
          </p>
          <?php endforeach; ?>
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