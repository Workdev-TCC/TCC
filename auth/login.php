<?php 
    include "../config.php";
    include DBAPI;
    include UTEIS;

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
        $email=$_POST["email"];
        $senha=$_POST["senha"];
        if(!empty($email) && !empty($senha)){
            $db=open_db();
            //$senha_cripto= 
            $dados=verifica_login($db,"usuarios","email","senha",$email,$senha);
            if(!empty($dados)){
                $id=$dados["id"];
                $nome=$dados["nome"];
                $email=$dados["email"];
                $foto=$dados["foto"];
                $telefone=$dados["telefone"];
                $tipo=$dados["tipo"];
                $data_criacao=$dados["data_criacao"];

                if(!empty($email)){
                     if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $_SESSION['message'] = "Bem vindo " . $nome;
                    $_SESSION['type'] = "success";
                    $_SESSION['nome'] = $nome;
                    $_SESSION['email'] = $email;
                    $_SESSION['id'] = $id;
                    $_SESSION['foto'] = $foto;
                    $_SESSION['telefone'] = $telefone;
                    $_SESSION['data_criacao'] = $data_criacao;
                    $_SESSION['tipo'] = $tipo;
                    
                    header("Location:" . RAIZ_PROJETO);
                    exit();
                }
            }
        }

    }
  







?>