<?php 
    include("../config.php");
    try{
        session_start();//acessa a sesão existente
        session_destroy();//destroy a sessao
        session_start();//acessa a sesão existente
        $_SESSION['message'] ="Você saiu da conta";
		$_SESSION['type'] = 'success';
        header("Location: ".RAIZ_PROJETO."index.php");
    }catch(Exception $e){
        $_SESSION['message'] ="Ocorreu um erro ". $e->GetMessage();
		$_SESSION['type'] = 'danger';
    }

?>