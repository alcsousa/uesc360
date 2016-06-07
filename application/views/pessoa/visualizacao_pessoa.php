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

<?php if(empty($pessoa)): ?>
  <div class="row"><div class="col s12 m8 offset-m2 l6 offset-l3 center lighten-4"><p class="flow-text">Oops... nenhum dado foi encontrado! :(</p></div></div>
<?php else: ?>
  <div class="row">
    <div class="col s12 m10 l9">

      <div class="row">
        <div class="col s12 center">

          <!-- Confirmação deletar -->
          <div id="deletar_pessoa" class="modal">
            <div class="modal-content red white-text left-align">
              <h4 class="white-text">Deletar Pessoa</h4>
              <p><b>Você tem certeza que deseja continuar?</b></p>
              <p><b>Após concluir essa ação você não poderá recuperar os dados da pessoa.</b></p>
            </div>
            <div class="modal-footer">
              <a href="<?php echo base_url('pessoa/deletar_usuario/'.$pessoa[0]->id_usuario); ?>" class="btn red modal-action modal-close waves-effect waves-green">Tenho certeza!</a>
            </div>
          </div>

          <a class="modal-trigger" href="#deletar_pessoa">
            <i class="material-icons right red-text">delete</i>
          </a>

          <?php if($pessoa[0]->ativo_usu == 1): ?>
            <a href="<?php echo base_url('pessoa/bloquear_usuario/'.$pessoa[0]->id_pessoa.'/0'); ?>" title="Clique para bloquear o usuário">
              <i class="material-icons right red-text">block</i>
            </a>
          <?php else: ?>
            <a href="<?php echo base_url('pessoa/bloquear_usuario/'.$pessoa[0]->id_pessoa.'/1'); ?>" title="Clique para desbloquear o usuário">
              <i class="material-icons right green-text">block</i>
            </a>
          <?php endif; ?>

          <a href="<?php echo base_url('pessoa/editar_pessoa/'.$pessoa[0]->id_pessoa); ?>" title="Clique para editar os dados">
            <i class="material-icons right grey-text">edit</i>
          </a>
        </div>

        <div class="col s12">
          <p class="flow-text grey-text">Pessoa <span class="black-text"><?php echo $pessoa[0]->nome_pes; ?></span></p>
        </div>

        <!-- DADOS DE ACESSO -->
        <div id="dados_ace" class="section scrollspy col s12 center indigo">
          <h5 class="white-text">Dados de Acesso</h5>
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
                <td>ID Usuário</td>
                <td><b><?php echo $pessoa[0]->fk_id_usuario; ?></b></td>
              </tr>
              <tr>
                <td>ID Pessoa</td>
                <td><b><?php echo $pessoa[0]->id_pessoa; ?></b></td>
              </tr>
              <tr>
                <td>Login</td>
                <td><b><?php echo $pessoa[0]->login_usu; ?></b></td>
              </tr>
              <tr>
                <td>Status</td>
                <td><b><?php echo $pessoa[0]->ativo_usu; ?></b></td>
              </tr>
            </tbody>
          </table>
          <br>
        </div>

        <!-- PERMISSÃO -->
        <div id="dados_ace" class="section scrollspy col s12 center indigo">
          <h5 class="white-text">Permissão</h5>
        </div>

        <div class="col s12">
          <?php
            foreach ($permissoes as $row):
              $arr_permissoes[] = $row->fk_id_permissao;
            endforeach;
          ?>

          <table class="bordered">
            <thead>
              <tr>
                <th>Permissão</th>
                <th>Status</th>
              </tr>
            </thead>

            <tbody>



              <tr>
                <td>Administrador</td>
                <?php if(in_array(1, $arr_permissoes)): ?>
                  <!-- Confirmation Modal -->
                  <div id="rmpa" class="modal">
                    <div class="modal-content red white-text left-align">
                      <h4 class="white-text">Remover permissão</h4>
                      <p><b>Você tem certeza que deseja continuar?</b></p>
                      <p><b>Após concluir essa ação você removerá os privilégios adicionais do usuário.</b></p>
                    </div>
                    <div class="modal-footer">
                      <a href="<?php echo base_url('pessoa/gerenciar_permissao/'.$pessoa[0]->id_pessoa.'/'.$pessoa[0]->fk_id_usuario.'/1/0'); ?>" class="btn red modal-action modal-close waves-effect waves-green">Tenho certeza!</a>
                    </div>
                  </div>
                  <!--  -->
                  <td><a href="#rmpa" class="modal-trigger btn-flat red-text white"><i class="material-icons left">remove</i>Remover</a></td>
                <?php else: ?>
                  <!-- Confirmation Modal -->
                  <div id="adpa" class="modal">
                    <div class="modal-content green white-text left-align">
                      <h4 class="white-text">Adicionar permissão</h4>
                      <p><b>Você tem certeza que deseja continuar?</b></p>
                      <p><b>Após concluir essa ação você concederá privilégios adicionais ao usuário.</b></p>
                    </div>
                    <div class="modal-footer">
                      <a href="<?php echo base_url('pessoa/gerenciar_permissao/'.$pessoa[0]->id_pessoa.'/'.$pessoa[0]->fk_id_usuario.'/1/1'); ?>" class="btn green modal-action modal-close waves-effect waves-green">Tenho certeza!</a>
                    </div>
                  </div>
                  <!--  -->
                  <td><a href="#adpa" class="modal-trigger btn-flat green-text white"><i class="material-icons left">add</i>Adicionar</a></td>
                <?php endif; ?>
              </tr>

              <tr>
                <td>Coordenador</td>
                <?php if(in_array(2, $arr_permissoes)): ?>
                  <!-- Confirmation Modal -->
                  <div id="rmpc" class="modal">
                    <div class="modal-content red white-text left-align">
                      <h4 class="white-text">Remover permissão</h4>
                      <p><b>Você tem certeza que deseja continuar?</b></p>
                      <p><b>Após concluir essa ação você removerá os privilégios adicionais do usuário.</b></p>
                    </div>
                    <div class="modal-footer">
                      <a href="<?php echo base_url('pessoa/gerenciar_permissao/'.$pessoa[0]->id_pessoa.'/'.$pessoa[0]->fk_id_usuario.'/2/0'); ?>" class="btn red modal-action modal-close waves-effect waves-green">Tenho certeza!</a>
                    </div>
                  </div>

                  <td><a href="#rmpc" class="modal-trigger btn-flat red-text white"><i class="material-icons left">remove</i>Remover</a></td>
                <?php else: ?>
                  <!-- Confirmation Modal -->
                  <div id="adpc" class="modal">
                    <div class="modal-content green white-text left-align">
                      <h4 class="white-text">Adicionar permissão</h4>
                      <p><b>Você tem certeza que deseja continuar?</b></p>
                      <p><b>Após concluir essa ação você concederá privilégios adicionais ao usuário.</b></p>
                    </div>
                    <div class="modal-footer">
                      <a href="<?php echo base_url('pessoa/gerenciar_permissao/'.$pessoa[0]->id_pessoa.'/'.$pessoa[0]->fk_id_usuario.'/2/1'); ?>" class="btn green modal-action modal-close waves-effect waves-green">Tenho certeza!</a>
                    </div>
                  </div>
                  <!--  -->
                  <td><a href="#adpc" class="modal-trigger btn-flat green-text white"><i class="material-icons left">add</i>Adicionar</a></td>
                <?php endif; ?>
              </tr>



              <tr>
                <td>Usuário (Padrão)</td>
                <?php if(in_array(3, $arr_permissoes)): ?>
                  <td><a href="" class="btn-flat grey-text white disabled"><i class="material-icons left">remove</i>Remover</a></td>
                <?php else: ?>
                  <td><a href="" class="btn-flat grey-text white disabled"><i class="material-icons left">add</i>Adicionar</a></td>
                <?php endif; ?>
              </tr>
            </tbody>
          </table>
        <br>
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
                <td>Data de Nascimento</td>
                <td><b><?php echo $pessoa[0]->birthday_pes; ?></b></td>
              </tr>
              <tr>
                <td>Sexo</td>
                <td><b><?php echo $pessoa[0]->sexo_pes; ?></b></td>
              </tr>
              <tr>
                <td>Tipo de pessoa</td>
                <td><b><?php echo $pessoa[0]->tipo_tip; ?></b></td>
              </tr>
              <tr>
                <td>Status</td>
                <td><b><?php echo $pessoa[0]->ativo_pes; ?></b></td>
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
                <th>Permissão</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach ($laboratorio_coordena as $row): ?>
                <tr>
                  <td><b><a href="<?php echo base_url('laboratorio/visualizar_laboratorio/'.$row->id_laboratorio); ?>" title="Clique para visualizar o laboratório"><?php echo $row->nome_lab; ?></a></b></td>
                  <td><b><?php echo $row->permissao_lhp; ?></b></td>
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
          <li><a href="#dados_ace">Dados de Acesso</a></li>
          <li><a href="#dados_pes">Dados Pessoais</a></li>
          <li><a href="#atividades_lab">Laboratórios onde realiza atividades</a></li>
        </ul>
      </div>
    </div>

  </div>
<?php endif; ?>