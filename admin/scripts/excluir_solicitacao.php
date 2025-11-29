<?php
header("Content-Type: application/json");
session_start();

include "../../config.php";
include "../../inc/Banco.php";
include_once "../../inc/uteis.php";

if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin') {
    echo json_encode(["success" => false, "message" => "Acesso negado"]);
    exit;
}

if (!isset($_POST['id'])) {
    echo json_encode(["success" => false, "message" => "ID inválido"]);
    exit;
}

$id = intval($_POST['id']);

try {
    $bd = new Banco();

    // Exclui visitas vinculadas
    $bd->delete("visitas_agendadas", ["solicitacao_id" => $id]);

    // Exclui solicitação - remove a verificação do $res
    $bd->delete("solicitacoes", ["id" => $id]);

    // Se chegou aqui sem erro, foi bem sucedido
    echo json_encode(["success" => true, "message" => "Solicitação excluída com sucesso!"]);

} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
?>