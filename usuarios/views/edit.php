<?php
    include("../../config.php");
    include HEADER_TEMPLATE;
    include DBAPI;
    include_once UTEIS;
?>
<?php if (!empty($_SESSION['message'])) : ?>
<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
    <?php echo $_SESSION['message']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php clear_messages(); ?>
<?php endif; ?>
<h1>Edite seus dados aqui.</h1>
<p>certifique-se que eles estão corretos pois é assim que seus clientes entraram em contato.</p>
<form action="<?php echo RAIZ_PROJETO;?>usuarios/edit.php" method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="nome" class="form-label">Nome</label>
    <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $_SESSION['nome']; ?>">
  </div>
  <div class="mb-3">
    <label for="tel" class="form-label">Telefone</label>
    <input type="text" name="telefone" class="form-control" id="tel" value="<?php echo $_SESSION['telefone']; ?>">
  </div>
  <div class="row">
      <div class="form-group col-md-4">
          <label for="foto">Foto:</label>
          <input type="file" class="form-control" name="foto" id="foto">
      </div>
      <div class="form-group col-md-4">
          <label for="foto">Pre-Visualização</label>
          <img class="form-control shadow p-1 mb-1 bg-body rounded" id="imgPreview"
              src="../img/semimagem.jpg" width="200px" alt="foto do usuario">
      </div>
  </div>

  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="confirma">
    <label class="form-check-label" for="confirma">Confirma?</label>
  </div>
  <button type="submit" class="btn btn-primary">Enviar</button>
  <a href="<?php echo RAIZ_PROJETO;?>" class="btn btn-danger">Voltar</a>
</form>
<?php
    include SIDEBAR;
    include USERBAR;
    include FOOTER_TEMPLATE;
?>