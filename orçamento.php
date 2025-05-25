<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Orçamento de Pintura</title>
  <link rel="stylesheet" href="assets/css/my_css/orçamento.css">
  <!-- jQuery CDN -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="assets/js/script.js" defer></script>
</head>
<body>
      <?php      
      include('config.php');
      include DBAPI;
      include HEADER_TEMPLATE;
      ?>

<div class="container">
    <h1>Orçamento de Pintura</h1>

    <?php
    // Exemplo futuro: mostrar mensagens ou processar formulário via PHP
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $area = $_POST['area'];
      $demao = $_POST['demao'];
      $rendimento = $_POST['rendimento'];
      $precoTinta = $_POST['precoTinta'];
      $maoObra = $_POST['maoObra'];
      // Aqui você pode salvar no banco, gerar PDF, etc.
      echo "<p><strong>Orçamento enviado com sucesso!</strong></p>";
    }
    ?>

 <form method="post" id="formOrcamento">
  <label for="area">Área total a ser pintada (m²):</label>
  <input type="number" id="area" name="area" placeholder="Ex: 150" required>

  <label for="demao">Número de demãos:</label>
  <input type="number" id="demao" name="demao" placeholder="Ex: 2" required>

  <label for="rendimento">Rendimento da tinta (m² por litro):</label>
  <input type="number" id="rendimento" name="rendimento" placeholder="Ex: 10" required>

  <label for="precoTinta">Preço por litro da tinta (R$):</label>
  <input type="number" id="precoTinta" name="precoTinta" placeholder="Ex: 25.00" required>

  <label for="maoObra">Valor da mão de obra por m² (R$):</label>
  <input type="number" id="maoObra" name="maoObra" placeholder="Ex: 12.00" required>

  <label for="extras">Valor de extras (R$):</label>
  <input type="number" id="extras" name="extras" value="0" placeholder="Ex: 150.00">

  <button type="button" id="calcular">Calcular Orçamento</button>
</form>

<div id="resultado"></div>

<button type="button" id="salvar" style="display: none;">Salvar Orçamento</button>

  </div>

  <?php  include FOOTER_TEMPLATE;?>
</body>
</html>
