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

<div class="row">
  <div class="input-field col s12">
    <i class="material-icons prefix">search</i>
    <input class="validate" type="text" name="search" value="" id="id_search" />
    <label for="id_search">Procure por um nome aqui</label>
  </div>
</div>

  <ul class="collection" id="quicksearch">
    <?php foreach ($pessoa as $row): ?>
      <li class="collection-item avatar">
        <i class="material-icons circle indigo">person</i>
        <span class="title"><b><a href="<?php echo base_url('pessoa/visualizar_pessoa/'.$row->id_pessoa); ?>" title="Clique para visualizar o perfil" class="blue-text text-accent-2"><?php echo $row->nome_pes; ?></a></b></span>
        <p>
          <?php echo $row->email_pes; ?><br>
          <?php echo $row->tipo_tip; ?>
        </p>

        <a href="<?php echo base_url('pessoa/visualizar_pessoa/'.$row->id_pessoa); ?>" target="_blank" title="Clique para visualizar o perfil em uma nova janela" class="secondary-content"><i class="material-icons blue-text text-accent-2">open_in_new</i></a>
        <!-- <a href="#!" class="secondary-content" style="margin-right:25px;"><i class="material-icons blue-text">settings</i></a> -->
      </li>
    <?php endforeach; ?>
  </ul>
