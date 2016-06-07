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

<a href="<?php echo base_url('usuario/editar'); ?>" class="btn-floating btn-large blue accent-2 right" title="Editar Perfil"><i class="material-icons left">edit</i></a>
<h4 class="grey-text">Meu Perfil</h4>
<div class="divider"></div>
<ul class="collection with-header" style="border:none;">
  <li class="collection-item avatar" style="border:none;">
    <i class="material-icons circle indigo">person</i>
    <span class="title">Nome</span>
    <p class="grey-text"><?php echo $pessoa[0]->nome_pes; ?></p>
  </li>
  <li class="collection-item avatar" style="border:none;">
    <i class="material-icons circle indigo">mail</i>
    <span class="title">Email</span>
    <p class="grey-text"><?php echo $pessoa[0]->email_pes; ?><p>
  </li>

  <li class="collection-item avatar" style="border:none;">
    <i class="material-icons circle indigo">credit_card</i>
    <span class="title">CPF</span>
    <?php if(!empty($pessoa[0]->cpf_pes)): ?>
      <p class="grey-text"><?php echo $pessoa[0]->cpf_pes; ?><p>
    <?php else: ?>
      <p class="red-text">*** Não especificado ***<p>
    <?php endif; ?>
  </li>

  <li class="collection-item avatar" style="border:none;">
    <i class="material-icons circle indigo">phone</i>
    <span class="title">Telefone</span>
    <?php if(!empty($pessoa[0]->ramal_pes)): ?>
      <p class="grey-text"><?php echo $pessoa[0]->ramal_pes; ?><p>
    <?php else: ?>
      <p class="grey-text">-<p>
    <?php endif; ?>
  </li>
  <li class="collection-item avatar" style="border:none;">
    <i class="material-icons circle indigo">open_in_new</i>
    <span class="title">Lattes</span>
    <?php if(!empty($pessoa[0]->lattes_pes)): ?>
      <p class="grey-text"><a href="<?php echo $pessoa[0]->lattes_pes; ?>" target="_blank">Link Externo</a><p>
    <?php else: ?>
      <p class="grey-text">-<p>
    <?php endif; ?>
  </li>
  <li class="collection-item avatar" style="border:none;">
    <i class="material-icons circle indigo">open_in_new</i>
    <span class="title">Site</span>
    <?php if(!empty($pessoa[0]->website_pes)): ?>
      <p class="grey-text"><a href="<?php echo $pessoa[0]->website_pes; ?>" target="_blank"><?php echo $pessoa[0]->website_pes; ?></a><p>
    <?php else: ?>
      <p class="grey-text">-<p>
    <?php endif; ?>
  </li>
  <li class="collection-item avatar" style="border:none;">
    <i class="material-icons circle indigo">business</i>
    <span class="title">Departamento</span>
    <?php if(!empty($pessoa[0]->nome_dpt)): ?>
      <p class="grey-text"><?php echo $pessoa[0]->nome_dpt; ?><p>
    <?php else: ?>
      <p class="grey-text">-<p>
    <?php endif; ?>
  </li>
  <li class="collection-item avatar" style="border:none;">
    <i class="material-icons circle indigo">today</i>
    <span class="title">Data de Nascimento</span>
    <?php if(!empty($pessoa[0]->birthday_pes)): ?>
      <p class="grey-text"><?php echo $this->funcoes->formatoDataHumano($pessoa[0]->birthday_pes); ?><p>
    <?php else: ?>
      <p class="grey-text">-<p>
    <?php endif; ?>
  </li>
  <li class="collection-item avatar" style="border:none;">
    <i class="material-icons circle indigo">school</i>
    <span class="title">Cargo</span>
    <?php if(!empty($pessoa[0]->tipo_tip)): ?>
      <p class="grey-text"><?php echo $pessoa[0]->tipo_tip; ?><p>
    <?php else: ?>
      <p class="grey-text">-<p>
    <?php endif; ?>
  </li>
</ul>