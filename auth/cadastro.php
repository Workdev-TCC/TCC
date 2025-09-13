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

            $array= $_POST;
            if (!empty($nome) && !empty($email) && !empty($tel) && !empty($senha)){
                $bd= new Banco;
                $bd->save("usuarios",$array);
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