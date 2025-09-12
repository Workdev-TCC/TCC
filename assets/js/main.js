$(document).ready(function () {
  //abrir mobile
  $("#abrirMenu").click(function () {
    $(".intocavel").css("display", "block");
    $(".sidebar").css("left", "0");
  });
  //fechar icone mobile
  $("#fecharMenu").click(function () {
    $(".intocavel").css("display", "none");
    $(".sidebar").css("left", "-300px");
  });
  //fechar pelo fundo mobile
  $(".intocavel").click(function (e) {
    if (!$(e.target).closest(".sidebar").length) {
      $(".intocavel").css("display", "none");
      $(".sidebar").css("left", "-300px");
    }
  });
  //----------------------------------------------------
  // abrir userbar
  $("#abrirUserbar").click(function (){
    // $(".userbar").css("display","flex");
    $(".userbar").css("right","20px");
  })
  // fechar pelo icon userbar
  $("#fecharUserbar").click(function(){
    $(".userbar").css("right","-400px")
  })

  //localização
    $(".maps").hover(
        function() {
            // mouse entra → iframe1 desaparece e iframe2 aparece com zoom
            $("#map1").stop().fadeTo(500, 0).css("transform", "scale(1)");
            $("#map2").stop().fadeTo(500, 1).css("transform", "scale(1)");
        },
        function() {
            // mouse sai → iframe2 desaparece e iframe1 volta
            $("#map2").stop().fadeTo(500, 0).css("transform", "scale(1)");
            $("#map1").stop().fadeTo(500, 1).css("transform", "scale(1)");
        }
    );
  
//password system front-end
$(".icon-eye").click(function () {
  var inputId = $(this).data("input");
  $("#" + inputId).focus();
  var icone=$("#eye");
  if(icone.hasClass("fa-eye")){
    icone.removeClass("fa-eye");
    icone.addClass("fa-eye-slash");
    $("#senha").attr("type","text");

  }else{
    icone.removeClass("fa-eye-slash");
    icone.addClass("fa-eye");
    $("#senha").attr("type", "password");
    
  }
     
});




});

