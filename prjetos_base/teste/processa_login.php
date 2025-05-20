<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = $_POST['senha'];

    if (empty($email) || empty($senha)) {
        $_SESSION['erro'] = "Email e senha são obrigatórios.";
        header("Location: login.php");
        exit;
    }

    $stmt = $conn->prepare("SELECT id, nome, senha, foto_perfil FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['foto_perfil'] = $usuario['foto_perfil'];
        header("Location: index.php");
        exit;
    } else {
        $_SESSION['erro'] = "Email ou senha inválidos.";
        header("Location: login.php");
        exit;
    }
}
?>