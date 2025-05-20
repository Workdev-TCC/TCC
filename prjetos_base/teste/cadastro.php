<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Cadastro de Usuário</h2>
        <?php if (isset($_SESSION['erro'])): ?>
        <div class="alert alert-danger"><?php echo $_SESSION['erro']; unset($_SESSION['erro']); ?></div>
        <?php endif; ?>
        <form action="processa_cadastro.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone">
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>
            <div class="mb-3">
                <label for="confirma_senha" class="form-label">Confirmar Senha</label>
                <input type="password" class="form-control" id="confirma_senha" name="confirma_senha" required>
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto de Perfil (opcional)</label>
                <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
            <a href="login.php" class="btn btn-link">Já tem conta? Faça login</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>