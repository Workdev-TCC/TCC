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

    <div class="footer-desktop"> 
        <div class="footer-left"> 
            <h1>Zupinturas</h1> 
            <p> © 2025 Todos os direitos reservados para ZUPINTURAS </p> 
            <div class="footer-icons"> 
                <a href=""><i class="fa-brands fa-instagram"></i></a> 
                <a href=""><i class="fa-brands fa-facebook"></i></a> 
                <a href=""><i class="fa-brands fa-whatsapp"></i></a> 
            </div> 
        </div> 
        <div class="footer-right"> 
            <div class="footer-links"> 
                <ul> 
                    <li>
                        <a href="">Início</a>
                    </li>
                    <?php  if(isset($_SESSION['email'])):?>
                    <?php if($_SESSION['tipo']==="user"):?> 
                    <li>
                        <a href="">Agendamentos</a>
                    </li>
                    <?php endif;?>
                    <?php endif;?>
                     <li>
                        <a href="">Portifolio</a>
                    </li> 
                    <li>
                        <a href="">Serviços</a>
                    </li> 
                    <li>
                        <a href="">Projetos</a>
                    </li> 
                    <li>
                        <a href="">Perguntas Frequentes</a>
                    </li> 
                </ul> 
            </div> 
            <div class="footer-links2">
                 <div class="termos">
                    <a href="#">Termos de uso</a> | <a href="#">Politicas de Privacidade</a>
                </div>
             </div>
        </div>
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

<!-- listar usuarios logica  -->
 <script>
// Função para abrir o modal e buscar detalhes do usuário
$(document).on("click", ".btn-detalhes", function() {
    const id = $(this).data("id");

    $("#conteudoModal").html("<div class='text-center p-3'>Carregando...</div>");
    $("#modalUsuario").modal("show");

    $.ajax({
        url: "detalhes_usuario.php",
        method: "GET",
        data: { id },
        success: function(response) {
            $("#conteudoModal").html(response);
        },
        error: function() {
            $("#conteudoModal").html("<div class='alert alert-danger text-center'>Erro ao carregar dados.</div>");
        }
    });
});

// Função para excluir usuário (somente admin)
$(document).on("click", "#btnExcluirUsuario", function() {
    if (!confirm("Tem certeza que deseja excluir este usuário?")) return;

    const id = $(this).data("id");

    $.ajax({
        url: "excluir_usuario.php",
        method: "POST",
        data: { id },
        success: function(response) {
            alert(response);
            $("#modalUsuario").modal("hide");
            carregarUsuarios('');
        },
        error: function() {
            alert("Erro ao excluir o usuário.");
        }
    });
});
</script>

<script src="<?php echo RAIZ_PROJETO;?>assets/js/scripts.js"></script>
</body>

</html>