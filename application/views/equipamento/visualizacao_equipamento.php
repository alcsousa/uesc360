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

<?php if(empty($equipamento)): ?>
  <div class="row"><div class="col s12 m8 offset-m2 l6 offset-l3 center lighten-4"><p class="flow-text">Oops... nenhum dado foi encontrado! :(</p></div></div>
<?php else: ?>
  <div class="row">
    <div class="col s12 m10 l9">

      <div class="row">
        <div class="col s12 center">

          <!-- Confirmação deletar -->
          <div id="deletar_equipamento" class="modal">
            <div class="modal-content red white-text left-align">
              <h4 class="white-text">Deletar Equipamento</h4>
              <p><b>Você tem certeza que deseja continuar?</b></p>
              <p><b>Após concluir essa ação você não poderá recuperar os dados do equipamento.</b></p>
            </div>
            <div class="modal-footer">
              <a href="<?php echo base_url('equipamento/deletar_equipamento/'.$equipamento[0]->id_laboratorio.'/'.$equipamento[0]->id_equipamento); ?>" class="btn red modal-action modal-close waves-effect waves-green">Tenho certeza!</a>
            </div>
          </div>

          <a class="modal-trigger" href="#deletar_equipamento">
            <i class="material-icons right red-text">delete</i>
          </a>

          <a href="<?php echo base_url('equipamento/editar/'.$equipamento[0]->id_equipamento); ?>">
            <i class="material-icons right black-text">edit</i>
          </a>

        </div>

        <div class="col s12">
          <p class="flow-text grey-text">Equipamento <span class="black-text"><?php echo $equipamento[0]->nome_eqp; ?></span></p>
        </div>

        <!-- DADOS DO EQUIPAMENTO -->
        <div id="dados_eqp" class="section scrollspy col s12 center indigo">
          <h5 class="white-text">Dados do Equipamento</h5>
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
                <td>Laboratório Pertencente</td>
                <td><b><a href="<?php echo base_url('laboratorio/visualizar_laboratorio/'.$equipamento[0]->id_laboratorio); ?>" title="Clique para visualizar o laboratório"><?php echo $equipamento[0]->nome_lab; ?></a></b></td>
              </tr>
              <tr>
                <td>Fabricante</td>
                <td><b><?php echo $equipamento[0]->fabricante_eqp; ?></b></td>
              </tr>
              <tr>
                <td>Quantidade</td>
                <td><b><?php echo $equipamento[0]->quantidade_eqp; ?></b></td>
              </tr>
              <tr>
                <td>Descrição</td>
                <td><b><?php echo $equipamento[0]->descricao_eqp; ?></b></td>
              </tr>
              <tr>
                <td>Especificação</td>
                <td><b><?php echo $equipamento[0]->especificacao_eqp; ?></b></td>
              </tr>
              <tr>
                <td>Status</td>
                <td><b><?php echo $equipamento[0]->ativo_eqp; ?></b></td>
              </tr>
            </tbody>
          </table>
          <br>
        </div>

        <!-- IMAGENS DO EQUIPAMENTO -->
        <div id="imagens_eqp" class="section scrollspy col s12 center indigo">
          <h5 class="white-text">Imagens do Equipamento</h5>
        </div>

        <div class="col s12">
          <?php foreach ($equipamento_img as $row): ?>
            <br>
            <img class="materialboxed" data-caption="<?php echo $equipamento[0]->nome_eqp; ?>" width="200" src="<?php echo base_url('uploads/equipamento/'.$row->nome_ime); ?>">
          <?php endforeach; ?>
        </div>

      </div>
    </div>

    <div class="col hide-on-small-only m2 l3">
      <div style="position:fixed;">
        <ul class="section table-of-contents">
          <li><a href="#dados_eqp">Dados do Equipamento</a></li>
          <li><a href="#imagens_eqp">Imagens do equipamento</a></li>
        </ul>
      </div>
    </div>

  </div>

<?php endif; ?>