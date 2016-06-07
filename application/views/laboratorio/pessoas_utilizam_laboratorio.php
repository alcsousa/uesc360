<!-- Mensagem de sucesso -->
<?php if($this->session->flashdata('sucesso') != ''): ?>
<div class="row">
  <div class="col s12 card-panel green white-text">
    <p><?php echo $this->session->flashdata('sucesso'); ?></p>
  </div>
</div>
<!-- Mensagem de erro -->
<?php elseif ($this->session->flashdata('erro') != ''): ?>
<div class="row">
  <div class="col s12 card-panel red white-text">
    <p><?php echo $this->session->flashdata('erro'); ?></p>
  </div>
</div>
<?php endif; ?>
<!-- fim feedback da ação ao usuário -->

<?php if(empty($laboratorio)): ?>
  <div class="row"><div class="col s12 m8 offset-m2 l6 offset-l3 center lighten-4"><p class="flow-text">Oops... nenhum dado foi encontrado! :(</p></div></div>
<?php else: ?>

  <div class="row">
    <div class="col s12">
      <p class="grey-text flow-text">Pessoas que utilizam "<?php echo $laboratorio[0]->nome_lab; ?>"</p>
    </div>
  </div>

  <?php echo form_open('laboratorio/pessoas_utilizam_laboratorio/'.$laboratorio[0]->id_laboratorio); ?>

    <div class="row">
      <div class="input-field col s12 m6">
        <?php
          $options = array();
          $options['blank'] = '';
          foreach ($usuarios as $row):
            $options[$row->id_pessoa] = $row->nome_pes;
          endforeach;
          echo form_dropdown('usuario', $options, set_value('usuario'));
        ?>
        <label>Adicionar usuário do laboratório</label>
        <?php echo form_error('usuario'); ?>
      </div>
    </div>

    <div class="row">
      <div class="col s12 m6">
        <button type="submit" class="btn right blue"><i class="material-icons left">save</i>Salvar Dados</button>
      </div>
    </div>

  <?php echo form_close(); ?>


  <div class="row">
    <div class="col s12">
      <table class="striped">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Remover</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($laboratorio_pes as $row): ?>
          <tr>
            <td><?php echo $options[$row->id_pessoa] = $row->nome_pes; ?></td>
            <td><a href="<?php echo base_url('laboratorio/deletar_participante_laboratorio/'.$laboratorio[0]->id_laboratorio.'/'.$row->id_pessoa); ?>" class="btn-flat red-text"><i class="material-icons left">delete</i>Remover</a></td>
          </tr>
          <?php  endforeach; ?>
        </tbody>

      </table>
    </div>
  </div>






<?php endif; ?>