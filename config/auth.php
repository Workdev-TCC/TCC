<?php 
    include "../config.php";
    include DBAPI;
   
    if(!empty($_POST["email"]) || !empty($_POST["senha"])){
        $bd= open_db();
        $email=$_POST["email"];
        $senha= $_POST["senha"];

        try{
            $sql="SELECT id, nome, email, senha, foto, telefone, tipo, data_criacao FROM usuarios WHERE email= :email AND senha= :senha LIMIT 1; ";
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
                $foto= $dados["foto"];
                $telefone= $dados["telefone"];
                $tipo= $dados["tipo"];
                $data_criacao= $dados["data_criacao"];
                if(!empty($id)){
                    if (session_status() === PHP_SESSION_NONE) {
                         session_start();
                    }
                  
                    $_SESSION['nome'] = $nome;
                    $_SESSION['user'] = $email;
                    $_SESSION['foto'] = $foto;
                    $_SESSION['tel'] = $telefone;
                    $_SESSION['data_criacao'] = $data_criacao;
                    $_SESSION['user_tipo'] = $tipo;
                    $_SESSION['id'] = $id;
                    $_SESSION['message'] = "Bem vindo " .$_SESSION['nome'];
                    $_SESSION['type'] = "success";

                     header("Location:" . RAIZ_PROJETO);
                    exit();
                }
            }
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
           }
            // Se nenhum usuário foi encontrado, redireciona para a página principal
            $_SESSION['message'] = "Usuário não encontrado";
            $_SESSION['type'] = "danger";
            header("Location:" . RAIZ_PROJETO);
            exit();
        }catch(Exception $e){
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
           }
            $_SESSION['message'] = "Ocorreu um erro: " . $e->getMessage();
            $_SESSION['type'] = 'danger';
            header("Location:" . RAIZ_PROJETO);
            exit();
        }
    }else{
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
       }
            $_SESSION['message'] = "Nao recebi email ou senha!";
            $_SESSION['type'] = "danger";
            header("Location:" . RAIZ_PROJETO);
            exit();
    }

   


    include FOOTER_TEMPLATE;
?>