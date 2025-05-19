<?php 
include("../../config.php");
include UTEIS;
include DBAPI;


 if(!empty($_POST['usuario'])){
    try{
            $usuario=$_POST['usuario'];
			if(!empty($usuario['password'])){		
				$senha= criptografia($usuario['password']);
				$usuario['password']= $senha;
			}
            if(!empty($_FILES['foto']['name'])){
                $arquivo=$_FILES['foto'];
                $pasta_destino="../uploads";
                $arquivo_destino=$pasta_destino.basename($arquivo["name"]);
                $nomearquivo=basename($arquivo["name"]);
                $resolucao_arquivo=getimagesize($arquivo["tmp_name"]);
                $tamanho_arquivo=$arquivo["size"];
                $nome_temp=$arquivo["tmp_name"];
                $tipo_arquivo= strtolower(pathinfo($arquivo_destino,PATHINFO_EXTENSION));

                if(upload($pasta_destino,$arquivo_destino,$tipo_arquivo,$nome_temp,$tamanho_arquivo)){
                    $usuario['foto']=$nomearquivo;
                }
                if(save("usuarios", $usuario)){
                   
                //    ---------------------------------------------------------------------------------
                //   em teste n meixa
                $bd= open_db();
                    $email=$usuario['email'];
                    $senha= $usuario['senha'];

             
                        $sql="SELECT id, nome, email, senha,foto, telefone, tipo, data_criacao FROM usuarios WHERE email= :email AND senha= :senha LIMIT 1; ";
                        $stmt= $bd->prepare($sql);
                        $stmt->bindParam(":email",$email,PDO::PARAM_STR);
                        //alterar aki qndo tiver criptografia
                        $stmt->bindParam(":senha",$senha,PDO::PARAM_STR);
                        $stmt->execute();

                        if($stmt->rowCount()> 0){
                            $dados= $stmt->fetch(PDO::FETCH_ASSOC);
                            $id= $dados["id"];
                            $nome= $dados["nome"];
                            $email= $dados["email"];
                            $foto=$dados["foto"];
                            $telefone= $dados["telefone"];
                            $tipo= $dados["tipo"];
                            $data_criacao= $dados["data_criacao"];
                        }
                        if (session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }
                        $_SESSION['message'] = "Bem vindo " . $usuario['nome'];
                        $_SESSION['type'] = "success";
                        $_SESSION['nome'] = $$usuario['nome'];
                        $_SESSION['user'] = $$usuario['email'];
                        $_SESSION['tel'] = $telefone;
                        $_SESSION['data_criacao'] = $data_criacao;
                        $_SESSION['user_tipo'] = $tipo;
                        $_SESSION['id'] = $id;
                }

                // -------------------------------------------------------------------------------------- 
            }
        }catch(Exception $e){
            $_SESSION['message']="falhou";
            $_SESSION['type']="danger";
        }
 }






?>