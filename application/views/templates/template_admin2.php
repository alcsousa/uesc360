<!DOCTYPE html>
<html>
  <head>
    <title>UESC 360º</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <link rel="shortcut icon" href="<?php echo base_url('assets/img/icone.ico'); ?>">

    <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/materialize/css/materialize.min.css'); ?>"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/materialize/css/estilo.css'); ?>"  media="screen,projection"/>
    <!-- adaptação de layout -->
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
    <div class="row indigo" style="padding-bottom:0; margin-bottom:0; padding:0; margin:0;">
      <div class="col s12">

        <a href="<?php echo base_url('home'); ?>" class="brand-logo center hide-on-med-and-down">
          <img class="center" id="nav-bar-logo" src="<?php echo base_url('assets/img/logoB.png'); ?>" alt="logo-uesc360" />
        </a>

      </div>
    </div>
    <!-- menu fim -->

    <div class="row">
      <div class="col s12 m3 l2" style="padding:0;">
        <?php $this->load->view('admin/menuLateral'); ?>
      </div>

      <div class="col s12 m9 l10">
        <div class="card-panel">
          <?php $this->load->view($main); ?>
        </div>
      </div>
    </div>

    <!-- footer here -->

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
        $('.modal-trigger').leanModal();
      });
    </script>
  </body>
</html>