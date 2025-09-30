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

<form action="<?php echo RAIZ_PROJETO;?>usuarios/edit.php" method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="nome" class="form-label">Nome</label>
    <input type="text" class="form-control" id="nome" aria-describedby="emailHelp" name="nome">
  </div>
  <div class="mb-3">
    <label for="tel" class="form-label">Telefone</label>
    <input type="text" name="telefone" class="form-control" id="tel" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="foto" class="form-label">Foto</label>
    <input type="file" name="foto" class="form-control" id="foto" aria-describedby="emailHelp">
  </div>

  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="confirma">
    <label class="form-check-label" for="confirma">Confirma?</label>
  </div>
  <button type="submit" class="btn btn-primary">Enviar</button>
</form>
<?php
    include SIDEBAR;
    include USERBAR;
    include FOOTER_TEMPLATE;
?>