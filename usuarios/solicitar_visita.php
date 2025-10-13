<?php
    include "../config.php";
    include "../inc/Banco.php";
    include UTEIS;
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    try {
         if ($_SERVER['REQUEST_METHOD']==='POST'&& !empty($_POST)){
            $id_usuario=$_SESSION['id'];
            $descricao=$_POST['descricao'];
            $cep=$_POST['cep'];
            $cidade=$_POST['cidade'];
            $bairro=$_POST['bairro'];
            $complemento=$_POST['complemento'];
            $rua=$_POST['rua'];
            $numero=$_POST['numero'];
            $endereco=$cidade.", ".$bairro.", ".$rua.", ".$numero."º.";
            $status="pendente";

            if(!empty($cep)&&!empty($cidade)&&!empty($bairro)&&!empty($rua)&&!empty($numero) ){
                $bd=new Banco;
                $array=[
                    "usuario_id"=>$id_usuario,
                    "descricao"=>$descricao,
                    "cep"=>$cep,
                    "endereco"=>$endereco,
                    "complemento"=>$complemento,
                    "status"=>"pendente"
                ];
                $bd->save("solicitacoes",$array);
                header("Location: ".RAIZ_PROJETO);
                exit();

            }



         }else{

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