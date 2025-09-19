<?php
    include "../config.php";
    include "../inc/Banco.php";
    include UTEIS;

    try {
        if ($_SERVER['REQUEST_METHOD']==='POST'&& !empty($_POST)) {
            $nome=$_POST['nome'];
            $email=$_POST['email'];
            $tel=$_POST['telefone'];
            $senha=$_POST['senha'];

            $usuarios= $_POST;
            $bd = new Banco;
            $verify=$bd->selectLogin("usuarios",$email,$senha);
            if($verify!==null){
                  if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['message']        = "Usuario já cadastrado";
                $_SESSION['type'] = "danger";
                header("Location: " . RAIZ_PROJETO. "auth/views/cadastro.php");
                exit();
            }

            
            if (!empty($nome) && !empty($email) && !empty($tel) && !empty($senha)){
                $bd->save("usuarios",$usuarios);
                $dados = $bd->selectLogin("usuarios", $email, $senha);

                $id = $dados["id"];
                $nome = $dados["nome"];
                $email = $dados["email"];
                $foto = $dados["foto"];
                $telefone = $dados["telefone"];
                $tipo = $dados["tipo"];
                $data_criacao = $dados["data_criacao"];

                 if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                $_SESSION['message']       = "Bem vindo " . $nome;
                $_SESSION['type']          = "success";
                $_SESSION['nome']          = $nome;
                $_SESSION['email']         = $email;
                $_SESSION['id']            = $id;
                $_SESSION['foto']          = $foto;
                $_SESSION['telefone']      = $telefone;
                $_SESSION['data_criacao']  = $data_criacao;
                $_SESSION['tipo']          = $tipo;
                header("Location:".RAIZ_PROJETO);
                exit();
            }else{
                 throw new Exeption("Por favor preencha os campos corretamente.");
            }

        }else{
            throw new Exeption("Nenhum dado de formulario recebido");
        }
    } catch (Exeption $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['type'] = 'danger';
        header("Location:".RAIZ_PROJETO);
        exit();
    }

?>