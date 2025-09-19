$(document).ready(function () {
  $(".login-input, .login-input-eye")
    .focus(function () {
      $(this).closest(".input-wrapper").css({
        padding: "4px",
        border: "1px solid #A020F0", // roxo
        "box-shadow": "0 0 5px #FF69B4", // rosa
      });
    })
    .blur(function () {
      $(this).closest(".input-wrapper").css({
        padding: "4px",
        border: "1px solid #ccc", // cor normal ao perder o foco
        "box-shadow": "none",
      });
    });

  //alert
  //alert icon
  var iconMessageBox = $(".icon-message");
  let tipo = iconMessageBox.data("icon");
  let icone = $("#icon-msg");

  if (tipo === "danger") {
    icone.removeClass("fa-circle-check").addClass("fa-circle-xmark");
  } else if (tipo === "success") {
    icone.removeClass("fa-circle-xmark").addClass("fa-circle-check");
  }
});
