<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
    $senha = $_POST['senha'];
    $confirma_senha = $_POST['confirma_senha'];

    // Validações
    if (empty($nome) || empty($email) || empty($senha) || empty($confirma_senha)) {
        $_SESSION['erro'] = "Todos os campos obrigatórios devem ser preenchidos.";
        header("Location: cadastro.php");
        exit;
    }

    if ($senha !== $confirma_senha) {
        $_SESSION['erro'] = "As senhas não coincidem.";
        header("Location: cadastro.php");
        exit;
    }

    // Verifica se o email já existe
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        $_SESSION['erro'] = "Email já cadastrado.";
        header("Location: cadastro.php");
        exit;
    }

    // Processa a foto
    $foto_perfil = 'imagens/default.png';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $extensoes_permitidas = ['jpg', 'jpeg', 'png', 'gif'];
        $extensao = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        if (in_array($extensao, $extensoes_permitidas)) {
            $nome_arquivo = uniqid() . '.' . $extensao;
            $caminho = 'imagens/' . $nome_arquivo;
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $caminho)) {
                $foto_perfil = $caminho;
            } else {
                $_SESSION['erro'] = "Erro ao fazer upload da foto.";
                header("Location: cadastro.php");
                exit;
            }
        } else {
            $_SESSION['erro'] = "Formato de imagem inválido.";
            header("Location: cadastro.php");
            exit;
        }
    }

    // Insere no banco
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, telefone, foto_perfil) VALUES (?, ?, ?, ?, ?)");
    try {
        $stmt->execute([$nome, $email, $senha_hash, $telefone, $foto_perfil]);
        
        // Inicia a sessão do usuário automaticamente
        $usuario_id = $conn->lastInsertId();
        $_SESSION['usuario_id'] = $usuario_id;
        $_SESSION['nome'] = $nome;
        $_SESSION['foto_perfil'] = $foto_perfil;
        
        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        $_SESSION['erro'] = "Erro ao cadastrar: " . $e->getMessage();
        header("Location: cadastro.php");
        exit;
    }
}
?>