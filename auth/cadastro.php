<?php
include "../config.php";
include "../inc/Banco.php";
include UTEIS;

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
        $nome  = $_POST['nome'];
        $email = $_POST['email'];
        $tel   = $_POST['telefone'];
        $senha = $_POST['senha'];

        $usuarios = [
            'nome'     => $nome,
            'email'    => $email,
            'telefone' => $tel,
            'senha'    => criptografia($senha)
        ];

        $bd = new Banco();

        $verify = $bd->select("usuarios", "*", ['email' => $email], false, 1, "fetch_assoc");
        if ($verify !== null) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['message'] = "Já existe uma conta cadastrada com este e-mail.";
            $_SESSION['type'] = "danger";
            header("Location: " . RAIZ_PROJETO . "auth/views/cadastro.php");
            exit();
        }

        if (!empty($nome) && !empty($email) && !empty($tel) && !empty($senha)) {
            $bd->save("usuarios", $usuarios);

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION['message'] = "Cadastro realizado com sucesso! Faça login para continuar.";
            $_SESSION['type'] = "success";

            header("Location: " . RAIZ_PROJETO . "auth/views/login.php");
            exit();
        } else {
            throw new Exception("Por favor, preencha todos os campos corretamente.");
        }

    } else {
        throw new Exception("Nenhum dado de formulário recebido.");
    }
} catch (Exception $e) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['message'] = $e->getMessage();
    $_SESSION['type'] = 'danger';
    header("Location: " . RAIZ_PROJETO . "auth/views/cadastro.php");
    exit();
}
?>