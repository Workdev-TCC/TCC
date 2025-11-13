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

<div class="solicitar-visita-page">
  <h1>Solicitar Visita</h1>
  <form action="<?php echo RAIZ_PROJETO;?>usuarios/solicitar_visita.php" method="post" class="container mt-4">
    <div class="row g-3">

      <!-- 🔹 CEP agora é OPCIONAL -->
      <div class="col-md-4">
        <label for="cep" class="form-label">CEP (opcional)</label>
        <input type="text" class="form-control" id="cep" name="cep" maxlength="9" placeholder="Digite o CEP">
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
        <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Ex: Pintura detalhada, retoque, etc.">
      </div>

      <!-- 🆕 NOVO DROPDOWN: Tipo de serviço -->
<div class="col-md-12">
  <label for="tipo_servico" class="form-label">Tipos de Serviço</label>

  <div id="servicos-container">
    <div class="input-group mb-2 servico-item">
      <select name="tipo_servico[]" class="form-control" required>
        <option value="">Selecione um tipo de serviço</option>
        <option value="pintura interna">Pintura Interna</option>
        <option value="pintura de fachada">Pintura de Fachada</option>
        <option value="pintura de portoes">Pintura de Portões</option>
        <option value="pintura decorativa">Pintura Decorativa</option>
        <option value="aplicação de texturas">Aplicação de Texturas</option>
        <option value="pintura predial">Pintura Predial</option>
      </select>
      <button type="button" class="btn btn-danger btn-remover-servico">Remover</button>
    </div>
  </div>

  <button type="button" class="btn btn-outline-primary mt-2" id="btn-add-servico">
    + Adicionar outro serviço
  </button>
</div>

      <div class="col-12 text-end mt-3">
        <button type="submit" class="btn btn-info px-4">Enviar</button>
        <a href="<?php echo RAIZ_PROJETO;?>usuarios/views/gerenciar_solicitacoes.php" class="btn btn-info px-4">Voltar</a>
      </div>
    </div>
  </form>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const container = document.getElementById("servicos-container");
  const btnAdd = document.getElementById("btn-add-servico");

  btnAdd.addEventListener("click", function () {
    const newItem = document.createElement("div");
    newItem.classList.add("input-group", "mb-2", "servico-item");
    newItem.innerHTML = `
      <select name="tipo_servico[]" class="form-control" required>
        <option value="">Selecione um tipo de serviço</option>
        <option value="pintura interna">Pintura Interna</option>
        <option value="pintura de fachada">Pintura de Fachada</option>
        <option value="pintura de portoes">Pintura de Portões</option>
        <option value="pintura decorativa">Pintura Decorativa</option>
        <option value="aplicação de texturas">Aplicação de Texturas</option>
        <option value="pintura predial">Pintura Predial</option>
      </select>
      <button type="button" class="btn btn-danger btn-remover-servico">Remover</button>
    `;
    container.appendChild(newItem);
  });

  container.addEventListener("click", function (e) {
    if (e.target.classList.contains("btn-remover-servico")) {
      e.target.parentElement.remove();
    }
  });
});
</script>

<?php
    include SIDEBAR;
    include USERBAR;
    include FOOTER_TEMPLATE;
?>
