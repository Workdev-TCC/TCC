<?php
include("../../config.php");
include "../../inc/Banco.php";

session_start();

if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin') {
    http_response_code(403);
    echo "Acesso negado.";
    exit;
}

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

if ($id <= 0) {
    echo "ID inválido.";
    exit;
}

$bd = new Banco;
$conn = $bd->open_db();

// Verifica se o usuário não é admin
$stmt = $conn->prepare("SELECT tipo FROM usuarios WHERE id = :id");
$stmt->execute([':id' => $id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "Usuário não encontrado.";
    exit;
}

if ($user['tipo'] === 'admin') {
    echo "Você não pode excluir outro administrador.";
    exit;
}

// Exclui o usuário
$stmt = $conn->prepare("DELETE FROM usuarios WHERE id = :id");
$stmt->execute([':id' => $id]);

echo "Usuário excluído com sucesso.";
