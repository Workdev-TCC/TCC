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

      $(window).resize(function () {
      // Se a largura da tela for maior que 1024px (modo desktop)
      if ($(window).width() > 1024) {
        $(".sidebar").css("left", "-300px");      // Fecha o menu lateral
        $(".intocavel").css("display", "none");   // Some com o fundo escuro
        $(".userbar").css("right", "-400px");     // Fecha a userbar, se aberta
      }
    });
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
  //MODAL
  function autoHideMessages(time = 3000) {
      const msgs = document.querySelectorAll(".message-success, .message-danger");

      msgs.forEach(msg => {
          setTimeout(() => {
              msg.classList.add("fade-out");
              setTimeout(() => msg.remove(), 400);
          }, time);
      });
  }
  autoHideMessages(3500);

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

  $(".icon-eye-confirmar").click(function () {
    let input = $("#senha_atual");
    let icon = $("#eye-confirmar");

    if (input.attr("type") === "password") {
      input.attr("type", "text");
      icon.removeClass("fa-eye-slash").addClass("fa-eye");
    } else {
      input.attr("type", "password");
      icon.removeClass("fa-eye").addClass("fa-eye-slash");
    }
  }); 
  


  // email
  document.querySelector('.cadastro-form')?.addEventListener('submit', function(e) {
    const email = document.getElementById('email').value.trim();
    const emailValido = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailValido.test(email)) {
      e.preventDefault();
      alert('Por favor, digite um e-mail válido.');
    }
  });

  // tamanho senha
  document.querySelector(".cadastro-form")?.addEventListener("submit", function (e) {
    const senha = document.getElementById("senha").value;
    const confirmar = document.getElementById("confirmar_senha").value;
    const erroTamanho = document.getElementById("erro-tamanho");
    const erroConfirmacao = document.getElementById("erro-senha");

    let invalido = false;

    if (senha.length < 8) {
      erroTamanho.style.display = "block";
      invalido = true;
    } else {
      erroTamanho.style.display = "none";
    }

    if (senha !== confirmar) {
      erroConfirmacao.style.display = "block";
      invalido = true;
    } else {
      erroConfirmacao.style.display = "none";
    }

    if (invalido) {
      e.preventDefault();
    }
  });

  $("#senha").on("input", function () {
    const erroTamanho = $("#erro-tamanho");
    if ($(this).val().length < 8) {
      erroTamanho.show();
    } else {
      erroTamanho.hide();
    }
  });

  $("#confirmar_senha").on("input", function () {
    const senha = $("#senha").val();
    const confirmar = $(this).val();
    const erroConfirmacao = $("#erro-senha");

    if (confirmar.length > 0 && confirmar !== senha) {
      erroConfirmacao.show();
    } else {
      erroConfirmacao.hide();
    }
  });

  $("#senha").on("input", function () {
    const senha = $(this).val();
    const confirmarInput = $("#confirmar_senha");

    if (confirmarInput.length > 0) {
      const confirmar = confirmarInput.val();
      const erroConfirmacao = $("#erro-senha");

      if (confirmar.length > 0 && confirmar !== senha) {
        erroConfirmacao.show();
      } else {
        erroConfirmacao.hide();
      }
    }
  });

  // telefone
  $("#telefone").on("input", function () {
    let val = $(this).val();
    let digits = val.replace(/\D/g, "");

    if (digits.length > 11) digits = digits.slice(0, 11);

    let formatted = "";

    if (digits.length === 0) {
      formatted = "";
    } else if (digits.length <= 2) {
      formatted = "(" + digits;
    } else if (digits.length <= 6) {
      formatted = "(" + digits.slice(0, 2) + ") " + digits.slice(2);
    } else if (digits.length <= 10) {
      formatted =
        "(" + digits.slice(0, 2) + ") " + digits.slice(2, 6) + "-" + digits.slice(6);
    } else {
      formatted =
        "(" +
        digits.slice(0, 2) +
        ") " +
        digits.slice(2, 7) +
        "-" +
        digits.slice(7, 11);
    }

    $(this).val(formatted);

    const erroTelefone = $("#erro-telefone");
    if (digits.length < 10) {
      erroTelefone.show();
    } else {
      erroTelefone.hide();
    }
  });
});

// telefone
  $("#tel").on("input", function () {
    let val = $(this).val();
    let digits = val.replace(/\D/g, "");

    if (digits.length > 11) digits = digits.slice(0, 11);

    let formatted = "";

    if (digits.length === 0) {
      formatted = "";
    } else if (digits.length <= 2) {
      formatted = "(" + digits;
    } else if (digits.length <= 6) {
      formatted = "(" + digits.slice(0, 2) + ") " + digits.slice(2);
    } else if (digits.length <= 10) {
      formatted =
        "(" + digits.slice(0, 2) + ") " + digits.slice(2, 6) + "-" + digits.slice(6);
    } else {
      formatted =
        "(" +
        digits.slice(0, 2) +
        ") " +
        digits.slice(2, 7) +
        "-" +
        digits.slice(7, 11);
    }

    $(this).val(formatted);

    const erroTelefone = $("#erro-telefone");
    if (digits.length < 10) {
      erroTelefone.show();
    } else {
      erroTelefone.hide();
    }
});


window.onload = () => {
    const loading = document.getElementById("loading");
    const conteudo = document.getElementById("conteudo");

    loading.classList.add("fade-out");

    setTimeout(() => {
      loading.style.display = "none";
      conteudo.style.display = "block";
    }, 600);
  };