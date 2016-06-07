<form data-abide action="<?php echo base_url('home/consulta'); ?>" id="myForm" method="post" onsubmit="return false;">
  <div class="input-field col s12 white card myform" style="margin: 0;">
    <i class="material-icons">search</i>
    <input id="busca" type="search" placeholder="Pesquisa" autocomplete="off" name="busca" onkeyup="myFunction()" autofocus />
  </div>
</form>

<div class="row" id="loading" style="display: none;">
  <div class="col s12 center">
    <div class="preloader-wrapper small active">
      <div class="spinner-layer spinner-blue-only">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col s12 m10 offset-m1 l8 offset-l2" id="div_busca">
    <!-- retorno da pesquisa   -->
  </div>
</div>

<div class="row" id="cards-info">
  <div class="col s4 m2 l2">
    <img src="<?php echo base_url('assets/img/seta1.png'); ?>" width="90" alt="seta" class="right">
  </div>

  <div class="col s8 m4 l3">
    <p class="flow-text tutorFont">Digite aqui o nome de uma pessoa, laboratório ou equipamento</p>
  </div>

  <div class="col s12 m10 offset-m1 center">
    <div class="divider"></div>
    <br>
    <a href="http://voobex.com/" target="_blank">
      <img src="<?php echo base_url('assets/img/voobexBlack.png'); ?>" alt="Voobex" width="150">
    </a>
  </div>
</div>

<script>
  function MySubmit()
  {
    var form = $("#myForm");
    $.ajax({
      type : "POST",
      url : form.attr("action"),
      data : form.serialize(),
      success : function(response) {
        $('#div_busca').html(response);
      },
      beforeSend: function(){
        $('#cards-info').css({display:"none"});
        $('#myMenu').css({display:"none"});
        $('#loading').css({display:"block"});
      },
      complete: function(msg){
        $('#loading').css({display:"none"});
      }
    });
  }

  function myFunction()
  {
    MySubmit();
    if($('input#busca').val()==''){
      $('#cards-info').css({display:"block"});
      $('#myMenu').css({display:"block"});
    }
  }
</script>