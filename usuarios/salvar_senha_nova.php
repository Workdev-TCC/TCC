<?php
include("../config.php");
include("../inc/Banco.php");
include_once UTEIS;
  if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

 if ($_SERVER['REQUEST_METHOD']==='POST'&& !empty($_POST)){
    $senha_nova=$_POST['senha_nova'];
    $confirma=$_POST['confirma_senha'];
    if($senha_nova!==$confirma){
         $_SESSION['message'] = "As senhas não coincidem.";
        $_SESSION['type'] = "danger";
        header("Location:" . RAIZ_PROJETO . "usuarios/views/editar_senha.php");
        exit;
    }
    $senha_hash=criptografia($senha_nova);

    $bd= new Banco;
    $upload_ok=$bd->update("usuarios",["senha"=>$senha_hash],["id"=>$_SESSION['id']]);
    if($upload_ok){
        $dados2=$bd->select("usuarios","*",["id"=>$_SESSION['id']],false,1,"fetch_assoc");
        if(!empty($dados2['senha'])){
            $_SESSION['senha']=$dados2['senha'];
            $_SESSION['message']="senha atualizada com sucesso";
            $_SESSION['type']="success";
            header("Location:".RAIZ_PROJETO);
            exit();
        }else{
            
        }

    }else{
         $_SESSION['message']="senha n fez update";
            $_SESSION['type']="danger";
            header("Location:".RAIZ_PROJETO);
            exit();
    }
    
 }
