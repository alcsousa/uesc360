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
  <li><a class="blue-text" href="<?php echo base_url('equipamento/listar_equipamentos/lastmodified'); ?>">Atualizados recentemente</a></li>
  <li><a class="blue-text" href="<?php echo base_url('equipamento/listar_equipamentos'); ?>">Nome</a></li>
</ul>

<div class="row">
  <div class="input-field col s12">
    <i class="material-icons prefix">search</i>
    <input class="validate" type="text" name="search" value="" id="id_search" />
    <label for="id_search">Procure por um nome aqui</label>
  </div>
</div>


<ul class="collection" id="quicksearch">
  <?php foreach ($equipamento as $row): ?>
    <li class="collection-item avatar">
      <i class="material-icons circle indigo">build</i>
      <span class="title"><b><a href="<?php echo base_url('equipamento/visualizar_equipamento/'.$row->id_equipamento); ?>" title="Clique para visualizar o equipamento" class="blue-text text-accent-2"><?php echo $row->nome_eqp; ?></a></b></span>
      <p>
        <?php echo $row->nome_lab; ?><br>
        <?php echo $row->fabricante_eqp; ?>
      </p>
      <a href="<?php echo base_url('equipamento/visualizar_equipamento/'.$row->id_equipamento); ?>" target="_blank" title="Clique para visualizar o equipamento em uma nova janela" class="secondary-content"><i class="material-icons blue-text text-accent-2">open_in_new</i></a>
    </li>
  <?php endforeach; ?>
</ul>

<?php if(empty($equipamento)): ?>
  <div class="row">
    <div class="col s12 m10 offset-m1 l8 offset-l2 center">
      <p class="flow-text">Você não possui equipamentos cadastrados. :(</p>
    </div>
  </div>
<?php endif; ?>
