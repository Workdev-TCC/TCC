<?php
include("../../config.php");
include HEADER_TEMPLATE;
include DBAPI;
include_once UTEIS;
?>

<?php if (!empty($_SESSION['message'])) : ?>
<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible fade show m-3" role="alert">
    <?php echo $_SESSION['message']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php clear_messages(); ?>
<?php endif; ?>

<div class="container py-5 text-light bg-dark min-vh-100">
    <div class="card bg-secondary text-light shadow-lg mx-auto" style="max-width: 500px; border-radius: 1rem;">
        <div class="card-body">
            <h2 class="text-center mb-3 fw-bold">Editar seus dados</h2>
            <p class="text-center text-light small mb-4">
                Certifique-se de que seus dados estão corretos — é assim que seus clientes entram em contato com você.
            </p>

            <form action="<?php echo RAIZ_PROJETO; ?>usuarios/edit.php" method="post" enctype="multipart/form-data">

                <!-- Nome -->
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" 
                           class="form-control bg-dark text-light border-secondary" 
                           id="nome" 
                           name="nome" 
                           value="<?php echo htmlspecialchars($_SESSION['nome']); ?>" 
                           required>
                </div>

                <!-- Telefone -->
                <div class="mb-3">
                    <label for="tel" class="form-label">Telefone</label>
                    <input type="text" 
                           name="telefone" 
                           class="form-control bg-dark text-light border-secondary" 
                           id="tel" 
                           value="<?php echo htmlspecialchars($_SESSION['telefone']); ?>" 
                           placeholder="(00) 00000-0000"
                           required>
                </div>

                <!-- Foto e Preview -->
                <div class="mb-4 text-center">
                    <label for="foto" class="form-label fw-semibold">Foto de Perfil</label>
                    <input type="file" class="form-control bg-dark text-light border-secondary mb-3" name="foto" id="foto" accept="image/*">

                    <div class="preview-box mx-auto">
                        <img id="imgPreview"
                             src="<?php echo !empty($_SESSION['foto']) ? RAIZ_PROJETO . 'usuarios/img/' . $_SESSION['foto'] : RAIZ_PROJETO . 'usuarios/img/semimagem.jpg'; ?>"
                             alt="foto do usuario"
                             class="rounded shadow border border-secondary"
                             style="width: 130px; height: 130px; object-fit: cover;">
                    </div>
                </div>

                <!-- Confirmação -->
                <div class="form-check mb-4 text-center">
                    <input type="checkbox" class="form-check-input" id="confirma" required>
                    <label class="form-check-label small" for="confirma">Confirmo que os dados estão corretos</label>
                </div>

                <!-- Botões -->
                <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fa-solid fa-paper-plane me-1"></i> Enviar
                    </button>
                    <a href="<?php echo RAIZ_PROJETO; ?>" class="btn btn-danger w-100">
                        <i class="fa-solid fa-arrow-left me-1"></i> Voltar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Pré-visualização da imagem
document.getElementById("foto").addEventListener("change", function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById("imgPreview");
    if (file) {
        const reader = new FileReader();
        reader.onload = function(ev) {
            preview.src = ev.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>

<?php
include SIDEBAR;
include USERBAR;
include FOOTER_TEMPLATE;
?>
