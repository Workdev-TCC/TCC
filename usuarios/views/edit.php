<?php
include("../../config.php");
include HEADER_TEMPLATE;
include DBAPI;
include_once UTEIS;
?>

<?php if (!empty($_SESSION['message'])) : ?>
<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible fade show m-3" role="alert">
    <?php echo $_SESSION['message']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php clear_messages(); ?>
<?php endif; ?>
<section class="container-editar-dados">
  <div class="card-editar">
    <div class="cabecalho">
      <h2>Editar seus dados</h2>
      <p>Certifique-se de que seus dados estão corretos — é assim que seus clientes entram em contato com você.</p>
    </div>

    <form action="<?php echo RAIZ_PROJETO; ?>usuarios/edit.php" method="post" enctype="multipart/form-data">
      <div class="input-grupo">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($_SESSION['nome']); ?>" required>
      </div>

      <div class="input-grupo">
        <label for="tel">Telefone</label>
        <input type="text" name="telefone" id="tel" value="<?php echo htmlspecialchars($_SESSION['telefone']); ?>" placeholder="(00) 00000-0000" required>
      </div>

      <div class="preview-box">
        <div class="input-grupo">
          <label for="foto">Foto de Perfil</label>
          <input type="file" name="foto" id="foto" accept="image/*">
        </div>
        <div class="img-box">
          <img id="imgPreview"
            src="<?php echo !empty($_SESSION['foto']) ? RAIZ_PROJETO . 'usuarios/img/' . $_SESSION['foto'] : RAIZ_PROJETO . 'usuarios/img/semimagem.jpg'; ?>"
            alt="foto do usuario">
        </div>
      </div>

      <div class="confirmacao">
        <input type="checkbox" id="confirma" required>
        <label for="confirma">Confirmo que os dados estão corretos</label>
      </div>

      <div class="botoes">
        <button type="submit">Salvar</button>
        <a href="<?php echo RAIZ_PROJETO; ?>">Voltar</a>
      </div>
    </form>
  </div>
</section>



<script>
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
