<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Conexão com o banco de dados
$host = 'localhost';
$db = 'zupinturas';  // Altere aqui
$user = 'root';      // Altere aqui
$pass = '';        // Altere aqui

try {
  $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
} catch (PDOException $e) {
  die("Erro na conexão: " . $e->getMessage());
}

// Consulta para buscar orçamentos
$sql = "SELECT * FROM orcamentos ORDER BY data_cadastro DESC";
$stmt = $pdo->query($sql);
$orcamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Lista de Orçamentos</title>
  <link rel="stylesheet" href="assets/css/my_css/orçamento.css"> <!-- Opcional: se quiser aplicar estilo -->
    
</head>
<body>
   <?php      
      include('config.php');
      include DBAPI;
      include HEADER_TEMPLATE;
      ?>
<h2>Lista de Orçamentos</h2>

  <?php if (count($orcamentos) === 0): ?>
    <p>Nenhum orçamento encontrado.</p>
  <?php else: ?>
    <table border="1" cellpadding="5" cellspacing="0">
      <thead>
        <tr>
          <th>ID</th>
          <th>Área</th>
          <th>Demãos</th>
          <th>Rendimento</th>
          <th>Preço Tinta</th>
          <th>Mão de Obra</th>
          <th>Extras</th>
          <th>Litros</th>
          <th>Material</th>
          <th>Lucro</th>
          <th>Total sem lucro</th>
          <th>Total final</th>
          <th>Data</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($orcamentos as $orc): ?>
          <tr>
            <td><?= $orc['id'] ?></td>
            <td><?= $orc['area'] ?> m²</td>
            <td><?= $orc['demao'] ?></td>
            <td><?= $orc['rendimento'] ?> m²/L</td>
            <td>R$ <?= $orc['preco_tinta'] ?></td>
            <td>R$ <?= $orc['mao_obra'] ?></td>
            <td>R$ <?= $orc['extras'] ?></td>
            <td><?= $orc['litros_necessarios'] ?> L</td>
            <td>R$ <?= $orc['gasto_material'] ?></td>
            <td>R$ <?= $orc['lucro_aplicado'] ?></td>
            <td>R$ <?= $orc['valor_sem_lucro'] ?></td>
            <td><strong>R$ <?= $orc['valor_final'] ?></strong></td>
            <td><?= $orc['data_cadastro'] ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</body>
</html>
