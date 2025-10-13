</main>
<footer>
    <div class="footer-mobile">
        <a href=" <?php echo RAIZ_PROJETO;?>" class="text-pink"><i class="fas fa-home fa-lg"></i></a>
        <?php if(empty($_SESSION['email'])):?>
            <a href=" <?php echo RAIZ_PROJETO;?>auth/views/login.php" class="text-pink"><i class="fas fa-user fa-lg"></i></a>
        <?php else:?>
            <a href=" <?php echo RAIZ_PROJETO;?>usuarios/views/gerenciar_conta.php">
                <div class="div-login-user">
                    <img src="<?php echo RAIZ_PROJETO;?>usuarios/img/<?php echo $_SESSION['foto'];?>"
                    alt="foto do usuario" class="rounded-circle profile-img">
                </div>
            </a>
        <?php endif;?>
        <a href="#" class="text-pink"><i class="fas fa-cogs fa-lg"></i></a>
    </div>
</footer>

<script src="<?php echo RAIZ_PROJETO;?>assets/js/jquery-3.7.1.min.js"></script>
<script src="<?php echo RAIZ_PROJETO;?>assets/js/bootstrap_js/bootstrap.bundle.min.js"></script>
<script src="<?php echo RAIZ_PROJETO;?>assets/js/fontawesome_js/all.min.js"></script>
<script src="<?php echo RAIZ_PROJETO;?>assets/js/main.js"></script>
<script src="<?php echo RAIZ_PROJETO;?>assets/js/design.js"></script>
<script>
$(document).ready(() => {
    $("#foto").change(function() {
        const file = this.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function(event) {
                $("#imgPreview").attr("src", event.target.result);
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>
<!-- via cep -->
<script>
  $(function() {
    function limpa_form() {
      $("#cidade, #bairro, #rua").val("");
    }

    $("#cep").on("input", function() {
      this.value = this.value.replace(/\D/g, ''); // Só números
      const cep = $(this).val();

      if (cep.length === 8) { // CEP completo
        $.getJSON(`https://viacep.com.br/ws/${cep}/json/`, function(data) {
          if (!("erro" in data)) {
            $("#cidade").val(data.localidade);
            $("#bairro").val(data.bairro);
            $("#rua").val(data.logradouro);
          } else {
            limpa_form(); // CEP não encontrado
          }
        }).fail(function() {
          limpa_form();
        });
      } else {
        limpa_form();
      }
    });
  });
</script>
<script>
$(document).ready(function() {
    $('#verMaisModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // botão que abriu o modal
        var endereco = button.data('endereco');
        var complemento = button.data('complemento');
        var descricao = button.data('descricao');
        var data = button.data('data');

        var modal = $(this);
        modal.find('#modal-endereco').text(endereco);
        modal.find('#modal-complemento').text(complemento);
        modal.find('#modal-descricao').text(descricao);
        modal.find('#modal-data').text(data);
    });
});
</script>
<!-- busca campo gerenciar minhas visitas -->
<script>
$(document).ready(function() {
    // Filtro por texto (ID, CEP, Data)
    $('#pesquisar').on('keyup', function() {
        var valor = $(this).val().toLowerCase();
        $('table tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(valor) > -1);
        });
    });
});
</script>



</body>

</html>