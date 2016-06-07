<?php if(empty($equipamento)): ?>
  <div class="row"><div class="col s12 m8 offset-m2 l6 offset-l3 center lighten-4"><p class="flow-text">Oops... nenhum dado foi encontrado! :(</p></div></div>
<?php else: ?>

	<p class="flow-text grey-text">Editar <span class="black-text"><?php echo $equipamento[0]->nome_eqp; ?></span></p>
	<p>Selecione abaixo os dados que deseja alterar.</p>

  <ul class="collapsible z-depth-0" data-collapsible="accordion">

    <li>
    	<a href="<?php echo base_url('equipamento/editar_dados/'.$equipamento[0]->id_equipamento); ?>"><div class="collapsible-header"><i class="material-icons">description</i>Dados Gerais</div></a>
    </li>

    <li>
    	<a href="<?php echo base_url('equipamento/editar_laboratorio_pertencente/'.$equipamento[0]->id_equipamento); ?>"><div class="collapsible-header"><i class="material-icons">place</i>Laboratório Pertencente</div></a>
    </li>

    <li>
    	<a href="<?php echo base_url('equipamento/gerenciar_imagens_equipamento/'.$equipamento[0]->id_equipamento); ?>"><div class="collapsible-header"><i class="material-icons">image</i>Imagens</div></a>
    </li>

  </ul>
<?php endif; ?>
