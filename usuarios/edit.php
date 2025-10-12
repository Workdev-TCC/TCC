<?php
    include "../config.php";
    include "../inc/Banco.php";
    include UTEIS;
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    try {
    
        if ($_SERVER['REQUEST_METHOD']==='POST'&& !empty($_POST)) {
            $nome=$_POST['nome'];
            $telefone=$_POST['telefone'];
            $foto_file=$_FILES['foto'];

            $foto_name=uploadImg($foto_file);
            $new_dados= $_POST;
            if($foto_name===false){
               $new_dados['foto']=$_SESSION['foto'];
            }
            else{
                $new_dados['foto']=$foto_name;
            }
            $where=[
                'id'=>$_SESSION['id']
            ];
            


            $db=new Banco;
            if($db->update("usuarios",$new_dados,$where)){
                $_SESSION['nome']          = $new_dados['nome'];
                $_SESSION['foto']          = $new_dados['foto'];
                $_SESSION['telefone']      = $new_dados['telefone'];
                if(limparDir($db)){
                    // echo "limpou";
                    // die();
                    header("Location: " . RAIZ_PROJETO);
                    exit();
                }
                else{
                    echo "nao limpou";
                    die();
                }

                
            }
            
           
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