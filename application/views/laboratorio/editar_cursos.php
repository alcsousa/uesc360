<?php if(empty($laboratorio)): ?>
  <div class="row"><div class="col s12 m8 offset-m2 l6 offset-l3 center lighten-4"><p class="flow-text">Oops... nenhum dado foi encontrado! :(</p></div></div>
<?php else: ?>

  <div class="row">
    <div class="col s12">
      <p class="grey-text flow-text">Editar cursos de "<?php echo $laboratorio[0]->nome_lab; ?>"</p>
    </div>
  </div>

  <?php echo form_open('laboratorio/editar_cursos/'.$laboratorio[0]->id_laboratorio); ?>

    <div class="row">
			<?php
				foreach ($cursos_lab as $row):
					$cursosLAB[] = $row->id_curso;
				endforeach;
			?>

      <fieldset>
        <legend class="grey-text">Selecione os cursos</legend>
        <?php echo form_error('curso'); ?>
        <div class="s12 m6 col">
          <?php for( $iPos=0; $iPos < (count($curso)/2); $iPos++ ): ?>
          <p>
          	<?php if(in_array($curso[$iPos]->id_curso, $cursosLAB)): ?>
	            <?php
	              $data = array(
	                'name'        => 'curso[]',
	                'id'          => 'checkC'.$curso[$iPos]->id_curso,
	                'value'       => $curso[$iPos]->id_curso,
	                'checked'     => set_checkbox('curso', $curso[$iPos]->id_curso, TRUE),
	              );
	            ?>
	            <?php echo form_checkbox($data); ?>
          	<?php else: ?>
	            <?php
	              $data = array(
	                'name'        => 'curso[]',
	                'id'          => 'checkC'.$curso[$iPos]->id_curso,
	                'value'       => $curso[$iPos]->id_curso,
	                'checked'     => set_checkbox('curso', $curso[$iPos]->id_curso),
	              );
	            ?>
	            <?php echo form_checkbox($data); ?>
          	<?php endif; ?>
            <label for="<?php echo "checkC{$curso[$iPos]->id_curso}"; ?>"><?php echo $curso[$iPos]->nome_cur; ?></label>
          </p>
          <?php endfor; ?>
        </div>

        <div class="s12 m6 col">
          <?php for( $iPos=(count($curso)/2)+1; $iPos < count($curso); $iPos++ ): ?>
          <p>
          	<?php if(in_array($curso[$iPos]->id_curso, $cursosLAB)): ?>

	            <?php
	              $data = array(
	                'name'        => 'curso[]',
	                'id'          => 'checkC'.$curso[$iPos]->id_curso,
	                'value'       => $curso[$iPos]->id_curso,
	                'checked'     => set_checkbox('curso', $curso[$iPos]->id_curso, TRUE),
	              );
	            ?>
	            <?php echo form_checkbox($data); ?>
          	<?php else: ?>
	            <?php
	              $data = array(
	                'name'        => 'curso[]',
	                'id'          => 'checkC'.$curso[$iPos]->id_curso,
	                'value'       => $curso[$iPos]->id_curso,
	                'checked'     => set_checkbox('curso', $curso[$iPos]->id_curso),
	              );
	            ?>
	            <?php echo form_checkbox($data); ?>
          	<?php endif; ?>
            <label for="<?php echo "checkC{$curso[$iPos]->id_curso}"; ?>"><?php echo $curso[$iPos]->nome_cur; ?></label>
          </p>
          <?php endfor; ?>
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