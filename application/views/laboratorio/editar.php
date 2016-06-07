<?php if(empty($laboratorio)): ?>
  <div class="row"><div class="col s12 m8 offset-m2 l6 offset-l3 center lighten-4"><p class="flow-text">Oops... nenhum dado foi encontrado! :(</p></div></div>
<?php else: ?>

	<p class="flow-text grey-text">Editar <span class="black-text"><?php echo $laboratorio[0]->nome_lab; ?></span></p>
	<p>Selecione abaixo os dados que deseja alterar.</p>

  <ul class="collapsible z-depth-0" data-collapsible="accordion">

    <?php if($this->security_model->isAdmin()): ?>
      <li>
      	<a href="<?php echo base_url('laboratorio/editar_coordenadores/'.$laboratorio[0]->id_laboratorio); ?>">
        	<div class="collapsible-header"><i class="material-icons">person</i>Coordenadores</div>
      	</a>
      </li>
    <?php endif; ?>

    <li>
    	<a href="<?php echo base_url('laboratorio/pessoas_utilizam_laboratorio/'.$laboratorio[0]->id_laboratorio); ?>"><div class="collapsible-header"><i class="material-icons">supervisor_account</i>Pessoa que utilizam</div></a>
    </li>

    <li>
      <a href="<?php echo base_url('laboratorio/editar_dados/'.$laboratorio[0]->id_laboratorio); ?>"><div class="collapsible-header"><i class="material-icons">description</i>Dados Gerais</div></a>
    </li>

    <li>
    	<a href="<?php echo base_url('laboratorio/editar_localizacao/'.$laboratorio[0]->id_laboratorio); ?>"><div class="collapsible-header"><i class="material-icons">place</i>Localização</div></a>
    </li>

    <li>
    	<a href="<?php echo base_url('laboratorio/editar_cursos/'.$laboratorio[0]->id_laboratorio); ?>"><div class="collapsible-header"><i class="material-icons">school</i>Cursos</div></a>
    </li>

    <li>
    	<a href="<?php echo base_url('laboratorio/editar_departamentos/'.$laboratorio[0]->id_laboratorio); ?>"><div class="collapsible-header"><i class="material-icons">domain</i>Departamentos</div></a>
    </li>


    <li>
    	<a href="<?php echo base_url('laboratorio/gerenciar_imagens_laboratorio/'.$laboratorio[0]->id_laboratorio); ?>"><div class="collapsible-header"><i class="material-icons">image</i>Imagens</div></a>
    </li>

    <li class="blue-text">
      <div class="collapsible-header"><i class="material-icons">build</i>Equipamentos</div>
      <div class="collapsible-body grey lighten-4 black-text">
      	<?php if(!empty($laboratorio_eqp)): ?>
					<ul class="collection">
						<?php foreach ($laboratorio_eqp as $row): ?>
						<li><a href="<?php echo base_url('equipamento/editar/'.$row->id_equipamento); ?>" class="collection-item blue-text"><?php echo $row->nome_eqp; ?></a></li>
						<?php endforeach; ?>
					</ul>
				<?php else: ?>
					<p class="grey lighten-4 black-text">Não há equipamentos cadastrados.</p>
				<?php endif; ?>
    	</div>
    </li>
  </ul>
<?php endif; ?>
