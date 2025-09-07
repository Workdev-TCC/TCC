$(document).ready(function () {
  $(".login-input, .login-input-eye")
    .focus(function () {
      $(this).closest(".input-wrapper").css({
        padding: "10px",
        border: "1px solid #A020F0", // roxo
        "box-shadow": "0 0 5px #FF69B4", // rosa
      });
    })
    .blur(function () {
      $(this).closest(".input-wrapper").css({
        padding: "5px",
        border: "1px solid #ccc", // cor normal ao perder o foco
        "box-shadow": "none",
      });
    });
});
