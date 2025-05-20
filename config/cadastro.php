<!-- Modal de Cadastro -->
<?php 
    include('../config.php');
    include DBAPI;
    include HEADER_TEMPLATE;
?>

<?php if (!empty($_SESSION['message'])) : ?>
<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
    <?php echo $_SESSION['message']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php clear_messages(); ?>
<?php endif; ?>

<div class="form-wrapper">
    <div class="card shadow w-100" style="max-width: 700px;">
        <!-- Cabeçalho -->
        <div class="card-header bg-dark text-white text-center py-3">
            <i class="fas fa-user-plus fa-3x mb-2"></i>
            <h4 class="mb-0">Cadastro de Usuário</h4>
        </div>

        <!-- Formulário -->
        <div class="card-body">
            <form method="post" action="processa_cadastro.php" enctype="multipart/form-data">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nome" class="form-label"><i class="fas fa-user me-2"></i>Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="col-md-6">
                        <label for="emailCadastro" class="form-label"><i class="fas fa-envelope me-2"></i>E-mail</label>
                        <input type="email" class="form-control" id="emailCadastro" name="email" required>
                    </div>

                    <div class="col-md-6">
                        <label for="senhaCadastro" class="form-label"><i class="fas fa-lock me-2"></i>Senha</label>
                        <input type="password" class="form-control" id="senhaCadastro" name="senha" required>
                    </div>
                    <div class="col-md-6">
                        <label for="telefone" class="form-label"><i class="fas fa-phone me-2"></i>Telefone</label>
                        <input type="text" class="form-control" id="telefone" name="tel" required>
                    </div>

                    <div class="col-12">
                        <label for="foto" class="form-label"><i class="fas fa-image me-2"></i>Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto">
                    </div>
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-dark btn-lg rounded-pill">
                        <i class="fas fa-user-plus me-2"></i>Cadastrar
                    </button>
                </div>

                <div class="text-center mt-3">
                    <p class="mb-0">Já tem uma conta?
                        <a href="<?php echo empty($_SESSION['user']) ? 'login.php' : '#'; ?>"
                            class="text-dark fw-bold">Login</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include FOOTER_TEMPLATE; ?>