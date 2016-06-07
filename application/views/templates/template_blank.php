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
    <?php $this->load->view('analytics'); ?>
  </head>
  <body class="grey lighten-3">

    <?php $this->load->view($main); ?>


    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/materialize/js/materialize.min.js'); ?>"></script>
  </body>
</html>