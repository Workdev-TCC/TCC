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

<form action="<?php echo RAIZ_PROJETO;?>usuarios/solicitar_visita.php" method="post" class="container mt-4">
  <div class="row g-3">
    <div class="col-md-4">
      <label for="cep" class="form-label">CEP</label>
      <input type="text" class="form-control" id="cep" name="cep" maxlength="9" placeholder="Digite o CEP" required>
    </div>

    <div class="col-md-4">
      <label for="cidade" class="form-label">Cidade</label>
      <input type="text" class="form-control" id="cidade" name="cidade" readonly>
    </div>

    <div class="col-md-4">
      <label for="bairro" class="form-label">Bairro</label>
      <input type="text" class="form-control" id="bairro" name="bairro" readonly>
    </div>

    <div class="col-md-8">
      <label for="rua" class="form-label">Rua</label>
      <input type="text" class="form-control" id="rua" name="rua" readonly>
    </div>

    <div class="col-md-4">
      <label for="complemento" class="form-label">Complemento</label>
      <input type="text" class="form-control" id="complemento" name="complemento">
    </div>

    <div class="col-md-3">
      <label for="numero" class="form-label">Número do Imóvel</label>
      <input type="text" class="form-control" id="numero" name="numero" maxlength="5">
    </div>

    <div class="col-md-9">
      <label for="descricao" class="form-label">Descrição do Serviço Desejado</label>
      <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Ex: Instalação elétrica, pintura, etc.">
    </div>

    <div class="col-12 text-end mt-3">
      <button type="submit" class="btn btn-info px-4">Enviar</button>
      <a href="<?php echo RAIZ_PROJETO;?>usuarios/views/gerenciar_solicitacoes.php" class="btn btn-info px-4">Voltar</a>
    </div>
  </div>
</form>
<?php
    include SIDEBAR;
    include USERBAR;
    include FOOTER_TEMPLATE;
?>