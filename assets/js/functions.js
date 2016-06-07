//Add departamento em cadastroLaboratorio
$(function () {
  function removeCampo() {
    $(".removerCampo").unbind("click");
    $(".removerCampo").bind("click", function () {
      i=0;
      $(".dptDinamico label.campoDpt").each(function () {
        i++;
      });
      if (i>1) {
        $(this).parent().remove();
      }
    });
  }
  removeCampo();
  $(".adicionarCampo").click(function () {
    novoCampo = $(".dptDinamico label.campoDpt:first").clone();
    novoCampo.find("input").val("");
    novoCampo.insertAfter(".dptDinamico label.campoDpt:last");
    removeCampo();
  });
});


//Add curso em cadastroLaboratorio
$(function () {
  function removeCampo() {
    $(".removerCampo2").unbind("click");
    $(".removerCampo2").bind("click", function () {
      i=0;
      $(".cursoDinamico label.campoCurso").each(function () {
        i++;
      });
      if (i>1) {
        $(this).parent().remove();
      }
    });
  }
  removeCampo();
  $(".adicionarCampo2").click(function () {
    novoCampo = $(".cursoDinamico label.campoCurso:first").clone();
    novoCampo.find("input").val("");
    novoCampo.insertAfter(".cursoDinamico label.campoCurso:last");
    removeCampo();
  });
});

// $(document).ready(function(){
//   $('select[name="coordenador"]').change(function() {
   // $("#lattesin").val("Cindy");
//   });
// });


// $(document).ready(function(){
//   $("select[name='nome']").change(function(){
//     var endereco = $("input[name='lattes']");
//     var telefone = $("input[name='email']");

//     $( endereco ).val('Carregando...');
//     $( telefone ).val('Carregando...');

//       $.getJSON(
//         'function.php',
//         { idCliente: $( this ).val() },
//         function( json )
//         {
//           $( endereco ).val( json.endereco );
//           $( telefone ).val( json.telefone );
//         }
//       );
//   });
// });












// $(function () {
//   function removeCampo() {
//     $(".removerCampo").unbind("click");
//     $(".removerCampo").bind("click", function () {
//       i=0;
//       $(".teste label.campoTeste").each(function () {
//         i++;
//       });
//       if (i>1) {
//         $(this).parent().remove();
//       }
//     });
//   }
//   removeCampo();
//   $(".adicionarCampo").click(function () {
//     novoCampo = $(".teste label.campoTeste:first").clone();
//     novoCampo.find("input").val("");
//     novoCampo.insertAfter(".teste label.campoTeste:last");
//     removeCampo();
//   });
// });





// $(function () {
//   function removeCampo() {
//     $(".removerCampo2").unbind("click");
//     $(".removerCampo2").bind("click", function () {
//       i=0;
//       $(".teste2 label.campoTeste2").each(function () {
//         i++;
//       });
//       if (i>1) {
//         $(this).parent().remove();
//       }
//     });
//   }
//   removeCampo();
//   $(".adicionarCampo2").click(function () {
//     novoCampo = $(".teste2 label.campoTeste2:first").clone();
//     novoCampo.find("input").val("");
//     novoCampo.insertAfter(".teste2 label.campoTeste2:last");
//     removeCampo();
//   });
// });