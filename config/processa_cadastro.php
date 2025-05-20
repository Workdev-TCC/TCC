<?php 
    include('../config.php');
    include DBAPI;
    include UTEIS;

    $conn=open_db();
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $telefone = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_STRING);
    $senha = $_POST['senha'];

    if (empty($nome) || empty($email) || empty($senha)) {
        $_SESSION['message'] = "Todos os campos obrigatórios devem ser preenchidos.";
        $_SESSION['type'] = "danger";
        header("Location: cadastro.php");
        exit;
    }

    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        $_SESSION['message'] = "Email ja cadastrado vá na opção de login";
        $_SESSION['type'] = "danger";
        header("Location: cadastro.php");
        exit;
    }
     // Processa a foto
    $arquivo= $_FILES['foto'];
    if(!empty($arquivo['name'])){
        $pasta_destino="../".IMGUSERS;
        $arquivo_destino=$pasta_destino.basename($arquivo["name"]);
        $nomearquivo=basename($arquivo["name"]);
        $resolucao_arquivo=getimagesize($arquivo["tmp_name"]);
        $tamanho_arquivo=$arquivo["size"];
        $nome_temp=$arquivo["tmp_name"];
        $tipo_arquivo=strtolower(pathinfo($arquivo_destino,PATHINFO_EXTENSION));

        if(upload($pasta_destino,$arquivo_destino,$tipo_arquivo,$nome_temp,$tamanho_arquivo)){
            $foto_perfil=$nomearquivo;
        }else{
            $foto_perfil=null;
        }
    }



     

?>