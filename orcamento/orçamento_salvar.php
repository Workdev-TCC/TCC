<?php
include("../config.php");
include(DBAPI);

$pdo= open_db();
$data = $_POST;

// Validação mínima (exemplo)
if (!isset($data['area']) || empty($data['area'])) {
    die("Campo 'area' é obrigatório");
}

try {
   $sql = "INSERT INTO orcamentos (
    area, demao, rendimento, preco_tinta, mao_obra, extras,
    litros_necessarios, gasto_material, gasto_mao_obra,
    total_extras, lucro_aplicado, valor_sem_lucro, valor_final
    ) VALUES (
        :area, :demao, :rendimento, :preco_tinta, :mao_obra, :extras,
        :litros_necessarios, :gasto_material, :gasto_mao_obra,
        :total_extras, :lucro_aplicado, :valor_sem_lucro, :valor_final
    )";

    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([
        ':area' => $data['area'],
        ':demao' => $data['demao'],
        ':rendimento' => $data['rendimento'],
        ':preco_tinta' => $data['preco_tinta'],
        ':mao_obra' => $data['mao_obra'],
        ':extras' => $data['extras'],
        ':litros_necessarios' => $data['litros_necessarios'],
        ':gasto_material' => $data['gasto_material'],
        ':gasto_mao_obra' => $data['gasto_mao_obra'],
        ':total_extras' => $data['total_extras'],
        ':lucro_aplicado' => $data['lucro_aplicado'],
        ':valor_sem_lucro' => $data['valor_sem_lucro'],
        ':valor_final' => $data['valor_final']
    ]);

    
} catch (Exception $e) {
    $_SESSION['message'] = $e->getMessage();
    $_SESSION['type'] = 'danger';
    header("location:orçamento.php");
           
}
?>