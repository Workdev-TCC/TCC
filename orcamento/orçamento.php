
<?php      
  include('config.php');
  include DBAPI;
  include HEADER_TEMPLATE;
?>

<div class="container"></div>
    <?php 
        if (!empty($_SESSION['message'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php clear_messages(); ?>
    <?php endif; ?>

    <h1 class="h1-orça">Orçamento de Pintura</h1>

    <?php
   
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $area = $_POST['area'];
      $demao = $_POST['demao'];
      $rendimento = $_POST['rendimento'];
      $precoTinta = $_POST['precoTinta'];
      $maoObra = $_POST['maoObra'];
    }
    ?>

  <form method="post" id="formOrcamento">
    <label class="label-orça" for="area">Área total a ser pintada (m²):</label>
    <input class="input-orça" type="number" id="area" name="area" placeholder="Ex: 150" required>

    <label class="label-orça" for="demao">Número de demãos:</label>
    <input class="input-orça"type="number" id="demao" name="demao" placeholder="Ex: 2" required>

    <label class="label-orça" for="rendimento">Rendimento da tinta (m² por litro):</label>
    <input class="input-orça" type="number" id="rendimento" name="rendimento" placeholder="Ex: 10" required>

    <label class="label-orça" for="precoTinta">Preço por litro da tinta (R$):</label>
    <input class="input-orça" type="number" id="precoTinta" name="precoTinta" placeholder="Ex: 25.00" required>

    <label class="label-orça" for="maoObra">Valor da mão de obra por m² (R$):</label>
    <input class="input-orça" type="number" id="maoObra" name="maoObra" placeholder="Ex: 12.00" required>

    <label class="label-orça" for="extras">Valor de extras (R$):</label>
    <input class="input-orça"type="number" id="extras" name="extras" value="0" placeholder="Ex: 150.00">

    <button class="button-orça" type="button" id="calcular">Calcular Orçamento</button>
  </form>

  <div class="resultado" id="resultado"></div>

  <button class="button-orça" type="button" id="salvar" style="display: none;">Salvar Orçamento</button>
</div>

<?php  include FOOTER_TEMPLATE;?>
