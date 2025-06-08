<?php
include("../config.php");
include(DBAPI);


$data = $_POST;
// Validação mínima (exemplo)
if (!isset($data['area']) || empty($data['area'])) {
    if(session_status()===PHP_SESSION_NONE){
        session_start();
    }
    $_SESSION['message'] ="campo area vazio";
    $_SESSION['type'] = 'danger';
    header("location:orçamento.php");
    exit();
}


try {
    if(!empty($data)){

        save("orcamentos",$data);
        header("Location:listar.php");
        
    }
} catch (Exception $e) {
    $_SESSION['message'] = $e->getMessage();
    $_SESSION['type'] = 'danger';
    header("location:orçamento.php");
           
}
?>