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

});
