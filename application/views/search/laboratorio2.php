<?php if(empty($laboratorio)): ?>
  <div class="row"><div class="col s12 m8 offset-m2 l6 offset-l3 center lighten-4"><p class="flow-text">Oops... nenhum dado foi encontrado! :(</p></div></div>
<?php else: ?>
  <div class="row">

    <div class="col s12 m10 l9">
      <div class="row">

        <div class="col s12">
          <span class="flow-text grey-text">Laboratório <span class="black-text"><?php echo $laboratorio[0]->nome_lab; ?></span></span>
          <br>
          <small><?php echo $this->funcoes->lastModified($laboratorio[0]->last_modified_lab); ?></small>
          <br>
          <br>
        </div>

        <!-- DADOS DO laboratorio -->
        <div id="dados_lab" class="section scrollspy col s12 center indigo">
          <h5 class="white-text">Dados do Laboratório</h5>
        </div>

        <div class="col s12">
          <table class="bordered">
            <tbody>
              <tr>
                <td>Coordenador</td>
                <td>
                  <?php foreach ($coordenadores_lab as $row): ?>
                    <p><b><a href="<?php echo base_url('search/pessoa/'.$row->id_pessoa); ?>" title="Clique para visualizar o perfil"><?php echo $row->nome_pes; ?></b></a>
                  <?php  endforeach; ?>
                </td>              </tr>
              <tr>
                <td>Ramal</td>
                <td><b><?php echo $laboratorio[0]->ramal_lab; ?></b></td>
              </tr>
              <tr>
                <td>Site</td>
                <td><b><?php echo $laboratorio[0]->website_lab; ?></b></td>
              </tr>
              <tr>
                <td>Descrição</td>
                <td><b><?php echo $laboratorio[0]->descricao_lab; ?></b></td>
              </tr>
              <tr>
                <td>Atividades Realizadas</td>
                <td><b><?php echo $laboratorio[0]->atividades_lab; ?></b></td>
              </tr>
              <tr>
                <td>Áreas Atendidas</td>
                <td><b><?php echo $laboratorio[0]->areas_atendidas_lab; ?></b></td>
              </tr>
              <tr>
                <td>Multiusuário</td>
                <td><b><?php echo $laboratorio[0]->multiusuario_lab; ?></b></td>
              </tr>
              <tr>
                <td>Ensino</td>
                <td><b><?php echo $laboratorio[0]->usa_ensino_lab; ?></b></td>
              </tr>
              <tr>
                <td>Pesquisa</td>
                <td><b><?php echo $laboratorio[0]->usa_pesquisa_lab; ?></b></td>
              </tr>
              <tr>
                <td>Extensão</td>
                <td><b><?php echo $laboratorio[0]->usa_extensao_lab; ?></b></td>
              </tr>
              <tr>
                <td>Localização</td>
                <td><b><?php echo $laboratorio[0]->nome_pav; ?></b></td>
              </tr>
            </tbody>
          </table>
          <br>
        </div>

        <!-- PESSOAS QUE UTILIZAM O LABORATÓRIO -->
        <div id="pessoas_lab" class="section scrollspy col s12 indigo">
          <h5 class="white-text">Pessoas que utilizam o laboratório</h5>
        </div>
        <div class="col s12">
          <?php if(empty($laboratorio_pes)): ?>
            <div class="divider"></div>
            <p>Não há pessoas vinculadas ao laboratório.</p>
          <?php else: ?>
            <div class="collection">
            <?php foreach ($laboratorio_pes as $row): ?>
              <a class="collection-item blue-text" href="<?php echo base_url('search/pessoa/'.$row->id_pessoa); ?>" title="Clique para visualizar o perfil"><b><?php echo $row->nome_pes; ?></b></a>
            <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>

        <!-- DEPARTAMENTOS RELACIONADOS AO LABORATÓRIO -->
        <div id="departamentos_lab" class="section scrollspy col s12 indigo">
          <h5 class="white-text">Departamentos</h5>
        </div>
        <div class="col s12">
          <?php if(empty($laboratorio_dpt)): ?>
            <div class="divider"></div>
            <p>Não há departamentos vinculados ao laboratório.</p>
          <?php else: ?>
            <ul class="collection">
            <?php foreach ($laboratorio_dpt as $row): ?>
              <li class="collection-item"><?php echo $row->nome_dpt; ?></li>
            <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </div>

        <!-- CURSOS RELACIONADOS AO LABORATÓRIO -->
        <div id="cursos_lab" class="section scrollspy col s12 indigo">
          <h5 class="white-text">Cursos</h5>
        </div>
        <div class="col s12">
          <?php if(empty($laboratorio_cur)): ?>
            <div class="divider"></div>
            <p>Não há cursos vinculados ao laboratório.</p>
          <?php else: ?>
            <ul class="collection">
            <?php foreach ($laboratorio_cur as $row): ?>
              <li class="collection-item"><?php echo $row->nome_cur; ?></li>
            <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </div>

        <!-- EQUIPAMENTOS RELACIONADOS AO LABORATÓRIO -->
        <div id="equipamentos_lab" class="section scrollspy col s12 indigo">
          <h5 class="white-text">Equipamentos</h5>
        </div>
        <div class="col s12">
          <?php if(empty($laboratorio_eqp)): ?>
            <div class="divider"></div>
            <p>Não há equipamentos vinculados ao laboratório.</p>
          <?php else: ?>
            <div class="collection">
            <?php foreach ($laboratorio_eqp as $row): ?>
              <a class="collection-item blue-text" href="<?php echo base_url('search/equipamento/'.$row->id_equipamento); ?>" title="Clique para visualizar o equipamento"><b><?php echo $row->nome_eqp; ?></b></a>
            <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>

        <!-- IMAGENS DO LABORATÓRIO -->
        <div id="imagens_lab" class="section scrollspy col s12 indigo">
          <h5 class="white-text">Imagens do laboratório</h5>
        </div>
        <div class="col s12">
          <?php if(empty($laboratorio_img)): ?>
            <div class="divider"></div>
            <p>Não há imagens vinculadas ao laboratório.</p>
          <?php else: ?>
            <div class="divider"></div>
            <?php foreach ($laboratorio_img as $row): ?>
              <br>
              <img class="materialboxed" data-caption="<?php echo $laboratorio[0]->nome_lab; ?>" width="200" src="<?php echo base_url('uploads/laboratorio/'.$row->nome_iml); ?>">
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <div class="col hide-on-small-only m2 l3">
      <div style="position:fixed;">
        <ul class="section table-of-contents">
          <li><a href="#dados_lab">Dados do laboratorio</a></li>
          <li><a href="#pessoas_lab">Pessoas</a></li>
          <li><a href="#departamentos_lab">Departametos</a></li>
          <li><a href="#cursos_lab">Cursos</a></li>
          <li><a href="#equipamentos_lab">Equipamentos</a></li>
          <li><a href="#imagens_lab">Imagens</a></li>
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