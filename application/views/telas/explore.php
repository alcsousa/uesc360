<div class="row">

	<div class="col s12 m10 offset-m1 l8 offset-l2">
		<p>Confira abaixo a lista completa de pessoas, laboratórios e equipamentos cadastrados.</p>
	</div>

	<div class="col s12 m10 offset-m1 l8 offset-l2 card-panel">

    <ul class="tabs">
      <li class="tab col s3"><a href="#tPes">Pessoas</a></li>
      <li class="tab col s3"><a href="#tLab">Laboratórios</a></li>
      <li class="tab col s3"><a href="#tEqp">Equipamentos</a></li>
    </ul>

    <div id="tPes" class="row">
    	<div class="col s12">
	      <table class="striped">
	      	<br>
	        <tbody>
          	<?php foreach($pessoa as $row): ?>
	          <tr>
	            <td>
	            	<a href="<?php echo base_url('search/pessoa/'.$row->id_pessoa); ?>">
		            	<i class="material-icons left">person</i>
	            		<?php echo $row->nome_pes; ?>
	            	</a>
            	</td>
	          </tr>
          	<?php endforeach; ?>
	        </tbody>
	      </table>
    	</div>
  	</div>

    <div id="tLab" class="col s12">
    	<div class="col s12">
	      <table class="striped">
	      	<br>
	        <tbody>
          	<?php foreach($laboratorio as $row): ?>
	          <tr>
	            <td>
	            	<a href="<?php echo base_url('search/laboratorio/'.$row->id_laboratorio); ?>">
		            	<i class="material-icons left">group_work</i>
	            		<?php echo $row->nome_lab; ?>
	            	</a>
            	</td>
	          </tr>
          	<?php endforeach; ?>
	        </tbody>
	      </table>
    	</div>
    </div>

    <div id="tEqp" class="col s12">
    	<div class="col s12">
	      <table class="striped">
	      	<br>
	        <tbody>
          	<?php foreach($equipamento as $row): ?>
	          <tr>
	            <td>
	            	<a href="<?php echo base_url('search/equipamento/'.$row->id_equipamento); ?>">
		            	<i class="material-icons left">build</i>
	            		<?php echo $row->nome_eqp; ?>
	            	</a>
            	</td>
	          </tr>
          	<?php endforeach; ?>
	        </tbody>
	      </table>
    	</div>
    </div>

	</div>
</div>

<div class="row">
  <div class="col s12 m10 offset-m1 l8 offset-l2 center">
    <!-- <p class="flow-text">Instale também em sua instituição!</p> -->
    <a href="http://voobex.com/" target="_blank">
      <img src="<?php echo base_url('assets/img/voobexBlue.png'); ?>" alt="Voobex" width="150">
    </a>
    <p><b>contato@voobex.com</b></p>
    <p>Entre em contato com a Voobex e saiba como instalar essa ferramenta em sua universidade.</p>
  </div>
</div>