<?php 
    include('../config.php');
    include DBAPI;
    include UTEIS;
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    try{
        if ($_SERVER['REQUEST_METHOD'] == "POST"){
            $conn=open_db();
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $telefone = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_STRING);
            $senha = $_POST['senha'];
        
            if (empty($nome) || empty($email) || empty($senha)) {
                throw new Exception("Todos os campos obrigatorios devem ser preenchidos");
            }
        
            $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
            $stmt->execute([$email]);

            if ($stmt->rowCount() > 0) {
                throw new Exception("Email ja cadastrado va na opção de login");
            }
            close_db($conn);
            
             // Processa a foto
            $foto_perfil=null;
            if(isset ($_FILES['foto'])){
                $arquivo= $_FILES['foto'];
            }           
           
            if(!empty($arquivo['name'])){
                $destino="../usuarios/img";
                if(upload2($arquivo,$destino)){
                    $foto_perfil=basename($arquivo['name']);
                }   
            }
            $usuarios = [
                'nome'=> $nome,
                'senha'=>$senha,
                'email'=>$email,
                'telefone'=>$telefone,
                'foto'=>$foto_perfil
                
            ];
            
            if(save("usuarios",$usuarios)){
                $db=open_db();
                $id = $db->lastInsertId();
                close_db($db);
                date_default_timezone_set('America/Sao_Paulo');
                $data= date('Y-m-d H:i:s');
                $tipo="user";
                $_SESSION['message'] = "Bem vindo " . $usuarios['nome'];
                $_SESSION['type'] = "success";
                $_SESSION['nome'] = $usuarios['nome'];
                $_SESSION['user'] = $usuarios['email'];
                $_SESSION['foto'] = $usuarios['foto'];
                $_SESSION['tel'] = $usuarios['telefone'];
                $_SESSION['data_criacao'] =$data;
                $_SESSION['user_tipo'] = $tipo;
                $_SESSION['id'] = $id;
            }
            header("Location: ../index.php");
            exit();
        }else{
            throw new Exception("Formulario não recebido");
        }
    }catch(Exception $e){
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['type'] = 'danger';
        header("Location: ../index.php");
        exit();
    }
   



     

?>