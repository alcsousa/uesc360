<?php if(empty($pessoa)): ?>
  <div class="row"><div class="col s12 m8 offset-m2 l6 offset-l3 center lighten-4"><p class="flow-text">Oops... nenhum dado foi encontrado! :(</p></div></div>
<?php else: ?>
  <div class="row">
    <div class="col s12 m10 l9">

      <div class="row">

        <div class="col s12">
          <p class="flow-text grey-text">Pessoa <span class="black-text"><?php echo $pessoa[0]->nome_pes; ?></span></p>
        </div>

        <!-- DADOS PESSOAIS -->
        <div id="dados_pes" class="section scrollspy col s12 center indigo">
          <h5 class="white-text">Dados Pessoais</h5>
        </div>

        <div class="col s12">
          <table class="bordered">
            <thead>
              <tr>
                <th>Descrição</th>
                <th>Info</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                <td>Email</td>
                <td><b><?php echo $pessoa[0]->email_pes; ?></b></td>
              </tr>
              <tr>
                <td>Ramal</td>
                <td><b><?php echo $pessoa[0]->ramal_pes; ?></b></td>
              </tr>
              <tr>
                <td>Lattes</td>
                <td><b><?php echo $pessoa[0]->lattes_pes; ?></b></td>
              </tr>
              <tr>
                <td>Site</td>
                <td><b><?php echo $pessoa[0]->website_pes; ?></b></td>
              </tr>
              <tr>
                <td>Departamento</td>
                <td><b><?php echo $pessoa[0]->nome_dpt; ?></b></td>
              </tr>
              <tr>
                <td>Tipo de pessoa</td>
                <td><b><?php echo $pessoa[0]->tipo_tip; ?></b></td>
              </tr>
            </tbody>
          </table>
          <br>
        </div>

        <!-- ATIVIDADES NOS LABORATÓRIOS -->
        <div id="atividades_lab" class="section scrollspy col s12 center indigo">
          <h5 class="white-text">Laboratórios onde realiza atividades</h5>
        </div>

        <div class="col s12">
          <table class="bordered">
            <thead>
              <tr>
                <th>Laboratório</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach ($laboratorio_coordena as $row): ?>
                <tr>
                  <td><b><a href="<?php echo base_url('search/laboratorio/'.$row->id_laboratorio); ?>" title="Clique para visualizar o laboratório"><?php echo $row->nome_lab; ?></a></b></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col hide-on-small-only m2 l3">
      <div style="position:fixed;">
        <ul class="section table-of-contents">
          <li><a href="#dados_pes">Dados Pessoais</a></li>
          <li><a href="#atividades_lab">Laboratórios onde realiza atividades</a></li>
        </ul>
      </div>
    </div>

  </div>
<?php endif; ?>

<div class="row">
  <div class="col s12 m10 offset-m1 l8 offset-l2 card-panel center grey lighten-4">
    <p class="flow-text">Instale também em sua instituição!</p>
    <a href="http://voobex.com/" target="_blank">
      <img src="<?php echo base_url('assets/img/voobexBlue.png'); ?>" alt="Voobex" width="150">
    </a>
    <p class="flow-text"><b>contato@voobex.com</b></p>
    <p>Entre em contato e saiba como instalar essa ferramenta em sua universidade.</p>
  </div>
</div>