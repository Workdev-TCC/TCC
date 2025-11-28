<?php
include("../../config.php");
include "../../inc/Banco.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_GET['id'])) {
    $_SESSION['message'] = "Solicitação inválida.";
    $_SESSION['type'] = "danger";
    header("Location: ../views/gerenciar_solicitacoes.php");
    exit;
}

$solicitacaoId = intval($_GET['id']);
$usuarioId = $_SESSION['id'];

try {
    $bd = new Banco;

    // Primeira verificação: só pode excluir se for dono da solicitação
    $solicitacao = $bd->select(
        "solicitacoes",
        "*",
        ["id" => $solicitacaoId, "usuario_id" => $usuarioId],
        false,
        1,
        'fetch_assoc'
    );

    if (!$solicitacao) {
        $_SESSION['message'] = "Você não tem permissão para excluir esta solicitação.";
        $_SESSION['type'] = "danger";
        header("Location: ../views/gerenciar_solicitacoes.php");
        exit;
    }

    // EXCLUSÃO (delete)
    $bd->delete("solicitacoes", ["id" => $solicitacaoId]);

    $_SESSION['message'] = "Solicitação excluída com sucesso!";
    $_SESSION['type'] = "success";

} catch (Exception $e) {
    $_SESSION['message'] = "Erro ao excluir: " . $e->getMessage();
    $_SESSION['type'] = "danger";
}

header("Location: ../views/gerenciar_solicitacoes.php");
exit;
