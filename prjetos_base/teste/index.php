<?php
require_once 'config.php';
$usuario_logado = isset($_SESSION['usuario_id']);
$foto_perfil = $usuario_logado ? ($_SESSION['foto_perfil'] ?? 'imagens/default.png') : 'imagens/default.png';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <header class="bg-dark text-white p-3">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h4">Sistema</h1>
            <div class="d-flex align-items-center">
                <?php if ($usuario_logado): ?>
                <a href="logout.php" class="btn btn-outline-light me-2">Sair</a>
                <a href="#" data-bs-toggle="modal" data-bs-target="#perfilModal">
                    <img src="<?php echo htmlspecialchars($foto_perfil); ?>" alt="Foto de Perfil" class="rounded-circle"
                        style="width: 40px; height: 40px; object-fit: cover;">
                </a>
                <?php else: ?>
                <a href="login.php" class="btn btn-outline-light me-2">Login</a>
                <a href="cadastro.php" class="btn btn-outline-light me-2">Cadastrar</a>
                <img src="imagens/default.png" alt="Foto Padrão" class="rounded-circle"
                    style="width: 40px; height: 40px; object-fit: cover;">
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- Modal de Perfil -->
    <?php if ($usuario_logado): ?>
    <div class="modal fade" id="perfilModal" tabindex="-1" aria-labelledby="perfilModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-slide-right">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="perfilModalLabel">Perfil</h5>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-times me-2 close-icon" style="cursor: pointer; font-size: 1.2rem;"></i>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                <div class="modal-body text-center">
                    <img src="<?php echo htmlspecialchars($foto_perfil); ?>" alt="Foto de Perfil"
                        class="img-perfil mb-3">
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none">Minha Conta</a></li>
                        <li><a href="#" class="text-decoration-none">Configurações</a></li>
                        <li><a href="#" class="text-decoration-none">Atividade</a></li>
                        <li><a href="#" class="text-decoration-none">Suporte</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="container mt-5">
        <h2>Bem-vindo ao Sistema</h2>
        <?php if ($usuario_logado): ?>
        <p>Olá, <?php echo htmlspecialchars($_SESSION['nome']); ?>!</p>
        <?php else: ?>
        <p>Faça login ou cadastre-se para continuar.</p>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('perfilModal');
        const modalDialog = modal.querySelector('.modal-dialog');
        const closeIcon = modal.querySelector('.close-icon');

        modal.addEventListener('show.bs.modal', function() {
            gsap.fromTo(modalDialog, {
                x: '-100%'
            }, {
                x: 0,
                duration: 0.3,
                ease: 'power2.out'
            });
        });

        modal.addEventListener('hide.bs.modal', function() {
            gsap.to(modalDialog, {
                x: '100%',
                duration: 0.3,
                ease: 'power2.in',
                onComplete: function() {
                    modalDialog.style.transform = 'none';
                }
            });
        });

        // Fecha o modal ao clicar no ícone do Font Awesome
        closeIcon.addEventListener('click', function() {
            const modalInstance = bootstrap.Modal.getInstance(modal);
            modalInstance.hide();
        });
    });
    </script>
</body>

</html>