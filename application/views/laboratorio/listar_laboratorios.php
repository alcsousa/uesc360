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

<a class='dropdown-button btn-flat grey lighten-2' href='#' data-activates='dropsort'><i class="material-icons sort left">sort</i>Ordenar</a>

<ul id='dropsort' class='dropdown-content'>
  <li><a class="blue-text" href="<?php echo base_url('laboratorio/listar_laboratorios/lastmodified'); ?>">Atualizados recentemente</a></li>
  <li><a class="blue-text" href="<?php echo base_url('laboratorio/listar_laboratorios'); ?>">Nome</a></li>
</ul>

<div class="row">
  <div class="input-field col s12">
    <i class="material-icons prefix">search</i>
    <input class="validate" type="text" name="search" value="" id="id_search" />
    <label for="id_search">Procure por um nome aqui</label>
  </div>
</div>


<ul class="collection" id="quicksearch">
  <?php foreach ($laboratorio as $row): ?>
    <li class="collection-item avatar">
      <i class="material-icons circle indigo">group_work</i>
      <span class="title"><b><a href="<?php echo base_url('laboratorio/visualizar_laboratorio/'.$row->id_laboratorio); ?>" title="Clique para visualizar o laboratório" class="blue-text text-accent-2"><?php echo $row->nome_lab; ?></a></b></span>
      <p>
        <?php echo $row->nome_pes; ?><br>
        <?php echo $row->nome_pav; ?>
      </p>
      <a href="<?php echo base_url('laboratorio/visualizar_laboratorio/'.$row->id_laboratorio); ?>" target="_blank" title="Clique para visualizar o laboratório em uma nova janela" class="secondary-content"><i class="material-icons blue-text text-accent-2">open_in_new</i></a>
    </li>
  <?php endforeach; ?>
</ul>

<?php if(empty($laboratorio)): ?>
  <div class="row">
    <div class="col s12 m10 offset-m1 l8 offset-l2 center">
      <p class="flow-text">Você não possui laboratórios cadastrados. :(</p>
      <p><a href="<?php echo base_url('laboratorio/cadastrar_laboratorio'); ?>">Clique aqui</a> para cadastrar um novo laboratório.</p>
    </div>
  </div>
<?php endif; ?>