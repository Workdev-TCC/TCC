<?php
include "../config.php";
include "../inc/Banco.php";
include "../inc/Banco.php";
include DBAPI;
include UTEIS;

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
        
        $email = $_POST["email"] ?? '';
        $senha = $_POST["senha"] ?? '';

        if (empty($email) || empty($senha)) {
            throw new Exception("E-mail e senha são obrigatórios.");
        }

        $db = new Banco;
        $db = new Banco;

        // Exemplo: $senha_cripto = password_hash($senha, PASSWORD_DEFAULT);
       $array = [
        'email'=>$email,
        'senha'=>$senha
       ];
       $dados=$db->select("usuarios","*",$array,false,1,"fetch_assoc");
       if (empty($dados)) {
            throw new Exception("Usuário ou senha inválidos.");
        }

        //o variáveis
        //o variáveis
        $id           = $dados["id"];
        $nome         = $dados["nome"];
        $email        = $dados["email"];
        $foto         = $dados["foto"];
        $telefone     = $dados["telefone"];
        $tipo         = $dados["tipo"];
        $data_criacao = $dados["data_criacao"];
        
        
        // Definind
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

      
        $_SESSION['nome']          = $nome;
        $_SESSION['email']         = $email;
        $_SESSION['id']            = $id;
        $_SESSION['foto']          = $foto;
        $_SESSION['telefone']      = $telefone;
        $_SESSION['data_criacao']  = $data_criacao;
        $_SESSION['tipo']          = $tipo;

        if(!empty($_SESSION['id'])){
            $_SESSION['message']       = "Bem vindo " . $nome;
            $_SESSION['type']          = "success";
            header("Location: " . RAIZ_PROJETO);
            exit();
        }
        $_SESSION['message']       = "erro ao iniciar";
        $_SESSION['type']          = "danger";
        header("Location: " . RAIZ_PROJETO);
        exit();
    } else {
        throw new Exception("Nenhum dado recebido.");
    }

} catch (Exception $e) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['message'] = "Ocorreu um erro: " . $e->getMessage();
    $_SESSION['type'] = 'danger';
    if($_SESSION['message']=="Ocorreu um erro: Nenhum dado recebido."){
        header("Location: " . RAIZ_PROJETO."auth/views/login.php");
        exit();
    }
    header("Location: " . RAIZ_PROJETO. "auth/views/login.php");
    exit();
}
