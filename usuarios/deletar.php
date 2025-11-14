<?php
    include "../config.php";
    include "../inc/Banco.php";
    include UTEIS;
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    try {
        $id=$_SESSION["id"];
        $bd= new Banco;
        $deletado=$bd->delete("usuarios",['id'=>$id]);
        if($deletado){
            session_start();//acessa a sesão existente
            session_destroy();//destroy a sessao
            session_start();//acessa a sesão existente
             $_SESSION['message'] = "Usuário deletado com sucesso!";
             $_SESSION['type'] = 'success';
            header("Location:". RAIZ_PROJETO);
            exit();
        }else{
            throw new Exception("Não foi possível excluir o usuário.");
        }

    } catch (Exception $e) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['message'] = "Ocorreu um erro: " . $e->getMessage();
        $_SESSION['type'] = 'danger';
        header("Location: " . RAIZ_PROJETO);
        exit();
    }
?>