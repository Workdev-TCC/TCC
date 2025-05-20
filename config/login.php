<?php 
    include('../config.php');
    include DBAPI;
    include HEADER_TEMPLATE;
?>
<?php 
    if (!empty($_SESSION['message'])) : ?>
<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
    <?php echo $_SESSION['message']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php clear_messages(); ?>
<?php endif; ?>
<div class="card mx-auto">
    <!-- Cabeçalho do card -->
    <div class="card-header bg-dark text-white text-center p-4">
        <i class="fas fa-user-circle fa-4x mb-3"></i>
        <h2 class="card-title w-100">Formulário de Login</h2>
    </div>

    <!-- Corpo do card -->
    <div class="card-body p-5">
        <form method="post" action="auth.php">
            <div class="mb-4">
                <label for="email" class="form-label">
                    <i class="fas fa-envelope me-2"></i>E-mail
                </label>
                <input type="email" class="form-control form-control-lg rounded-3" id="email" name="email" required
                    autofocus>
            </div>

            <div class="mb-4">
                <label for="senha" class="form-label">
                    <i class="fas fa-lock me-2"></i>Senha
                </label>
                <input type="password" class="form-control form-control-lg rounded-3" id="senha" name="senha" required>
            </div>

            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-dark btn-lg rounded-pill">
                    <i class="fas fa-sign-in-alt me-2"></i>Entrar
                </button>
            </div>

            <div class="text-center mt-4">
                <p class="mb-0">Não tem cadastro?
                    <a href="
                        <?php 
                            if(empty($_SESSION['user'])){
                                echo 'cadastro.php';
                            }else{
                                echo '#';
                            }
                        ?>
                    
                    ">Cadastre-se!</a>
                </p>
            </div>
        </form>
    </div>
</div>
<?php 
    include FOOTER_TEMPLATE;
?>