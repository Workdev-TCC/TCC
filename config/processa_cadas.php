<?php
require_once '../config.php';
include DBAPI;
$pdo = open_db();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['usuario'])) {
    $nome = $_POST['usuario']['name'];
    $email = $_POST['usuario']['email'];
    $senhaOriginal = $_POST['usuario']['senha']; // salva para usar depois no login
    $senha = password_hash($senhaOriginal, PASSWORD_DEFAULT); // Criptografia
    $telefone = $_POST['usuario']['telefone'];

    // Processa a foto (se enviada)
    $foto_nome = null;
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $pasta = '../usuarios/conta/uploads/';
        if (!is_dir($pasta)) {
            mkdir($pasta, 0755, true);
        }

        $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $foto_nome = uniqid() . "." . strtolower($extensao);
        move_uploaded_file($_FILES['foto']['tmp_name'], $pasta . $foto_nome);
    }

    // Verifica se o e-mail já existe
    $verifica = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email LIMIT 1");
    $verifica->bindParam(':email', $email, PDO::PARAM_STR);
    $verifica->execute();

    if ($verifica->rowCount() > 0) {
        // Email já cadastrado
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['message'] = "E-mail já cadastrado! Tente outro.";
        $_SESSION['type'] = "warning";
        header("Location: index.php"); // ou página de cadastro
        exit;
    }

    // Insere no banco
    $sql = "INSERT INTO usuarios (nome, email, senha, telefone, foto) 
            VALUES (:nome, :email, :senha, :telefone, :foto)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':senha' => $senha,
            ':telefone' => $telefone,
            ':foto' => $foto_nome
        ]);

        // Busca usuário recém cadastrado
        $sql = "SELECT id, nome, email, senha, telefone, tipo, criado_em AS data_criacao 
                FROM usuarios WHERE email = :email LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $dados = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($senhaOriginal, $dados['senha'])) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                $_SESSION['message'] = "Bem-vindo, " . $dados['nome'];
                $_SESSION['type'] = "success";
                $_SESSION['nome'] = $dados['nome'];
                $_SESSION['user'] = $dados['email'];
                $_SESSION['tel'] = $dados['telefone'];
                $_SESSION['data_criacao'] = $dados['data_criacao'];
                $_SESSION['user_tipo'] = $dados['tipo'] ?? 'user';
                $_SESSION['id'] = $dados['id'];

                header("Location: index.php"); // Página inicial
                exit;
            }
        }

        // Falha no login automático
        $_SESSION['message'] = "Erro ao autenticar após cadastro.";
        $_SESSION['type'] = "danger";
        header("Location: login.php");
        exit;

    } catch (PDOException $e) {
        echo "Erro ao cadastrar: " . $e->getMessage();
    }

} else {
    echo "Requisição inválida.";
}
?>
