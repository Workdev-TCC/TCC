<?php
  include("../../config.php");
  include HEADER_TEMPLATE;
  include DBAPI;
  include_once UTEIS;
?>

<?php if (!empty($_SESSION['message'])) : ?>
<div class="message-<?php echo $_SESSION['type']; ?>">
    <?php if ($_SESSION['type'] === "success") : ?>
        <i class="fas fa-check-circle icon-message"></i>
    <?php else : ?>
        <i class="fas fa-times-circle icon-message"></i>
    <?php endif; ?>
    <span><?php echo $_SESSION['message']; ?></span>
    <i class="fas fa-times btn-close" onclick="this.parentElement.remove()"></i>
</div>
<?php unset($_SESSION['message']); unset($_SESSION['type']); ?>
<?php clear_messages(); ?>
<?php endif; ?>
<section class="container-editar-dados">
  <div class="card-editar">
    <div class="cabecalho">
      <h2>Edite seus dados</h2>
      <div class="linha"></div>
      <p>Certifique-se de que os dados de contato estão corretos, pois eles são fundamentais para a comunicação.</p>
    </div>

    <form action="<?php echo RAIZ_PROJETO; ?>usuarios/edit.php" method="post" enctype="multipart/form-data">
      <div class="input-grupo">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" maxlength="50" value="<?php echo htmlspecialchars($_SESSION['nome']); ?>" required>
      </div>

      <div class="input-grupo">
        <label for="tel">Telefone</label>
        <input type="text" name="telefone" id="tel" maxlength="15" value="<?php echo htmlspecialchars($_SESSION['telefone']); ?>" placeholder="(00) 00000-0000" required>
      </div>

      <div class="input-grupo">
        <label for="foto">Foto de Perfil</label>
        <div class="custom-file-upload">
          <label for="foto" class="btn-file">Escolher imagem</label>
          <span id="file-name">Nenhum arquivo selecionado.</span>
          <input type="file" name="foto" id="foto" accept="image/*" hidden>
        </div>
      </div>

      <div class="preview-box">
        <div class="img-box">
          <img id="imgPreview"
            src="<?php echo !empty($_SESSION['foto']) ? RAIZ_PROJETO . 'usuarios/img/' . $_SESSION['foto'] : RAIZ_PROJETO . 'usuarios/img/semimagem.jpg'; ?>"
            alt="foto do usuario">
        </div>
      </div>

      <div class="confirmacao">
        <input type="checkbox" id="confirma" required>
        <label for="confirma">Confirmo que todos os dados estão corretos.</label>
      </div>

      <div class="botoes">
        <button type="submit">Salvar <i class="fa-regular fa-floppy-disk"></i></button>
        <a href="<?php echo RAIZ_PROJETO; ?>">Voltar <i class="fa-solid fa-arrow-right"></i></a>
      </div>
    </form>
  </div>
</section>

<script>
  const fotoInput = document.getElementById("foto");
const fileName = document.getElementById("file-name");

fotoInput.addEventListener("change", function () {
  const file = this.files[0]; // Pega o primeiro arquivo selecionado
  if (file) {
    fileName.textContent = file.name; // Atualiza o nome do arquivo
  } else {
    fileName.textContent = "Nenhum arquivo selecionado"; // Caso o usuário não selecione nenhum arquivo
  }
});

// Pré-visualização da imagem
document.getElementById("foto").addEventListener("change", function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById("imgPreview");
    if (file) {
        const reader = new FileReader();
        reader.onload = function(ev) {
            preview.src = ev.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>

<?php
include SIDEBAR;
include USERBAR;
include FOOTER_TEMPLATE;
?>
