<!DOCTYPE html>
<html>
  <head>
    <title>UESC 360º</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <link rel="shortcut icon" href="<?php echo base_url('assets/img/icone.ico'); ?>">

    <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/materialize/css/materialize.min.css'); ?>"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/materialize/css/estilo.css'); ?>"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/materialize/css/ghpages-materialize.css');?>"  media="screen,projection"/>


    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <?php $this->load->view('analytics'); ?>
  </head>
  <body>

    <header>

      <?php if(isset($titulo)): ?>
      <nav class="top-nav blue darken-1">
        <div class="container">
          <div class="nav-wrapper">
            <a class="page-title"><?php echo $titulo; ?></a>
          </div>
        </div>
      </nav>
      <?php endif; ?>

      <div class="container">
        <ul class="left">
          <a href="#!" id="sidebar" data-activates="nav-mobile" class=" hide-on-large-only button-collapse top-nav full white-text">
            <i class="mdi-navigation-menu"></i>
          </a>
        </ul>
      </div>

      <ul id="nav-mobile" class="side-nav fixed" style="width: 240px;">
        <li class="logo">
          <a href="<?php echo base_url('home'); ?>" class="brand-logo center hide-on-small-only"><img id="nav-bar-logo" src="<?php echo base_url('assets/img/logoB.png'); ?>" alt="logo-uesc360" /></a>
          <a href="<?php echo base_url('home'); ?>" class="brand-logo center hide-on-med-and-up"><img id="nav-bar-logo-s" src="<?php echo base_url('assets/img/logoB.png'); ?>" alt="logo-uesc360" /></a>
          <br>
        </li>
        <!--  -->
        <li class="bold"><a href="<?php echo base_url('home'); ?>" class="waves-effect waves-teal"><i class="material-icons left">home</i>Home</a></li>
        <li class="bold"><a href="<?php echo base_url('admin'); ?>" class="waves-effect waves-teal"><i class="material-icons left">dashboard</i>Painel de Controle</a></li>
        <!--  -->
        <li class="no-padding">
          <ul class="collapsible collapsible-accordion">

            <li class="bold"><a class="waves-effect waves-teal collapsible-header"><i class="material-icons left">settings</i>Configurações</a>
              <div class="collapsible-body">
                <ul>
                  <li><a href="<?php echo base_url('usuario/editar'); ?>">Editar Perfil</a></li>
                  <li><a href="<?php echo base_url('usuario/password'); ?>">Alterar Senha</a></li>
                </ul>
              </div>
            </li>

          </ul>
        </li>
        <!--  -->
        <li class="no-padding">
          <ul class="collapsible collapsible-accordion">

            <li class="bold"><a class="waves-effect waves-teal collapsible-header"><i class="material-icons left">add_box</i>Cadastro</a>
              <div class="collapsible-body">
                <ul>
                  <!-- <li><a href="<?php echo base_url('admin/cadastro_usuario'); ?>">Usuário</a></li> -->
                  <li><a href="<?php echo base_url('admin/cadastro_pessoa'); ?>">Pessoa</a></li>
                  <li><a href="<?php echo base_url('admin/cadastro_laboratorio'); ?>">Laboratório</a></li>
                  <li><a href="<?php echo base_url('admin/cadastro_equipamento'); ?>">Equipamento</a></li>
                </ul>
              </div>
            </li>

          </ul>
        </li>
        <!--  -->
        <li class="no-padding">
          <ul class="collapsible collapsible-accordion">

            <li class="bold"><a class="collapsible-header waves-effect waves-teal"><i class="material-icons left">search</i>Consulta</a>
              <div class="collapsible-body">
                <ul>
                  <!-- <li><a href="<?php echo base_url('admin/consulta_usuario'); ?>">Usuário</a></li> -->
                  <li><a href="<?php echo base_url('admin/consulta_pessoa'); ?>">Pessoa</a></li>
                  <li><a href="<?php echo base_url('admin/consulta_laboratorio'); ?>">Laboratório</a></li>
                  <li><a href="<?php echo base_url('admin/consulta_equipamento'); ?>">Equipamento</a></li>
                </ul>
              </div>
            </li>

          </ul>
        </li>
        <!--  -->
        <li class="bold"><a href="<?php echo base_url('login/logoff'); ?>" class="waves-effect waves-teal"><i class="material-icons left">exit_to_app</i>Sair</a></li>
      </ul>
    </header>

    <!-- header here -->

    <main>
      <div class="row">
        <div class="s12 col">
          <?php $this->load->view($main); ?>
        </div>
      </div>
    </main>

    <!-- footer here -->

    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/materialize/js/materialize.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.quicksearch.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.jscroll.min.js'); ?>"></script>
    <script type="text/javascript" charset="utf-8">
      $( document ).ready(function(){
        $(".button-collapse").sideNav();
        $("select").material_select();
        $('input#id_search').quicksearch('ul#quicksearch li.collection-item');
        $(".scrollspy").scrollSpy();
        $('.infinite-scroll').jscroll();
      });
    </script>
  </body>
</html>