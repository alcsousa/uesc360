<ul class="side-nav">
  <li><span class="icon-home3"></span> Principal</li>
  <li><?php echo anchor('home', 'Home'); ?></li>
  <li><?php echo anchor('usuario/perfil', 'Meu Perfil'); ?></li>
  <li><?php echo anchor('usuario', 'Painel de Controle'); ?></li>

  <li><span class="icon-gear"></span> Configurações</li>
  <li><?php echo anchor('usuario/editar', 'Editar Perfil'); ?></li>
  <li><?php echo anchor('usuario/password', 'Alterar Senha'); ?></li>

  <li><span class="icon-search3"></span> Consulta</li>
  <li><?php echo anchor('usuario/laboratorios', 'Meus Laboratórios'); ?></li>
</ul>
