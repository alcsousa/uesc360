<!DOCTYPE html>
<html>
  <head>
    <title>UESC 360º</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" href="<?php echo base_url('assets/img/icone.ico'); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/materialize/css/materialize.min.css'); ?>"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/materialize/css/estilo.css'); ?>"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/materialize/css/app.css'); ?>"  media="screen,projection"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.maskedinput.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/masks.js'); ?>"></script>
    <?php $this->load->view('analytics'); ?>
  </head>
  <body class="grey lighten-3">

    <?php $this->load->view('includes/menuUsuarioLogado'); ?>

    <!-- menu inicio -->
    <div id="myMenu" class="row indigo" style="padding:0; margin:0;">
      <div class="col s12">

        <a href="<?php echo base_url('home'); ?>" class="brand-logo center hide-on-med-and-down">
          <img class="center" id="nav-bar-logo" src="<?php echo base_url('assets/img/logoB.png'); ?>" alt="logo-uesc360" />
        </a>

        <nav class="transparent z-depth-0">
          <div class="nav-wrapper">

            <ul class="left hide-on-med-and-down">

              <li class="<?php if($this->uri->segment(1) == 'home' or $this->uri->segment(1) == null){echo 'ativo';} ?>">
                <a href="<?php echo base_url('home'); ?>">Home</a>
              </li>

              <li class="<?php if($this->uri->segment(1) == 'explore'){echo 'ativo';} ?>">
                <a href="<?php echo base_url('explore'); ?>">Explore</a>
              </li>

              <?php if(!$this->session->userdata('logged_in')): ?>
              <li class="<?php if($this->uri->segment(1) == 'cadastro'){echo 'ativo';} ?>">
                <a href="<?php echo base_url('cadastro'); ?>">Cadastro</a>
              </li>
              <?php endif; ?>

              <li class="<?php if($this->uri->segment(1) == 'contato'){echo 'ativo';} ?>">
                <a href="<?php echo base_url('contato'); ?>">Contato</a>
              </li>

              <li class="<?php if($this->uri->segment(1) == 'sobre'){echo 'ativo';} ?>">
                <a href="<?php echo base_url('sobre'); ?>">Sobre</a>
              </li>

            </ul>

            <ul class="right hide-on-med-and-down">
              <?php if(!$this->session->userdata('logged_in')): ?>
              <li><a href="<?php echo base_url('login'); ?>" class="btn blue accent-2">Login</a></li>
              <?php endif; ?>
            </ul>

            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
            <a href="<?php echo base_url('home'); ?>" class="brand-logo hide-on-large-only">UESC 360º</a>
            <ul class="side-nav" id="mobile-demo">
              <li><a href="<?php echo base_url('home'); ?>">Home</a></li>
              <li><a href="<?php echo base_url('explore'); ?>">Explore</a></li>

              <?php if(!$this->session->userdata('logged_in')): ?>
              <li><a href="<?php echo base_url('cadastro'); ?>">Cadastro</a></li>
              <?php endif; ?>

              <li><a href="<?php echo base_url('contato'); ?>">Contato</a></li>
              <li><a href="<?php echo base_url('sobre'); ?>">Sobre</a></li>
              <?php if($this->session->userdata('logged_in')): ?>
              <li><a class="indigo white-text" href="<?php echo base_url('painel'); ?>"><i class="material-icons left">dashboard</i> painel</a></li>
              <?php else: ?>
              <li><a class="indigo white-text" href="<?php echo base_url('login'); ?>"><i class="material-icons left">lock</i> login</a></li>
              <?php endif; ?>
            </ul>
          </div>
        </nav>

      </div>
    </div>
    <!-- menu fim -->


    <?php $this->load->view($main); ?>


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