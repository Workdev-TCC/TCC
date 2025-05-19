<?php 
include UTEIS;

    $usuarios = null;
    $usuario = null;

    if($_SERVER["REQUEST_METHOD"]==="POST"){
        $nome= $_POST['nome'];
        $email= $_POST['email'];
        $senha= $_POST['senha'];
        $telefone = $_POST['telefone'] ?? '';
        $foto=null;

        if(!empty($senha)){		
				$senhacrip= criptografia($senha);
				$_POST['senha']= $senhacrip;
        }
         if(!empty($_FILES['foto']['name'])){
                $arquivo=$_FILES['foto'];
                $pasta_destino="../usurios/uploads";
                $arquivo_destino=$pasta_destino.basename($arquivo["name"]);
                $nomearquivo=basename($arquivo["name"]);
                $resolucao_arquivo=getimagesize($arquivo["tmp_name"]);
                $tamanho_arquivo=$arquivo["size"];
                $nome_temp=$arquivo["tmp_name"];
                $tipo_arquivo= strtolower(pathinfo($arquivo_destino,PATHINFO_EXTENSION));

                if(upload($pasta_destino,$arquivo_destino,$tipo_arquivo,$nome_temp,$tamanho_arquivo)){
                    $foto=$nomearquivo;
                }
            }


    }







?>