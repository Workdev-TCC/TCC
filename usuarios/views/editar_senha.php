<?php
    include("../../config.php");
    include("../../inc/Banco.php");
    include HEADER_TEMPLATE;
    include DBAPI;
    include_once UTEIS;

    $ok = false;

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
        $senha_atual = $_POST['senha_atual'];
        $senha_crip = criptografia($senha_atual);

        if ($senha_crip == $_SESSION['senha']) {
            $ok = true;
        } else {
            $ok = false;
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['message'] = "A senha informada está incorreta.";
            $_SESSION['type'] = "danger";
        }
    }

    if (empty($_SESSION['tipo'])) {
        header("Location:" . RAIZ_PROJETO);
        exit;
    }

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>

<?php if (!empty($_SESSION['message'])) : ?>
    <div class="message-<?php echo $_SESSION['type']; ?>">
        <?php if ($_SESSION['type'] === "success") : ?>
            <i class="fas fa-check-circle icon-message"></i>
        <?php else : ?>
            <i class="fas fa-times-circle icon-message"></i>
        <?php endif; ?>
        <span><?php echo $_SESSION['message']; ?></span>
        <i class="fas fa-times btn-close" onclick="this.parentElement.remove()"></i>
    </div>
<?php unset($_SESSION['message']); unset($_SESSION['type']); ?>
<?php endif; ?>

<?php if ($ok === false) : ?>
<section class="container-edit-senha">
    <h1>Confirme a sua senha atual</h1>
    <div class="linha"></div>

    <form action="<?php echo RAIZ_PROJETO; ?>usuarios/views/editar_senha.php" method="post">
        <div class="input-grupo">
            <input type="password" placeholder="Digite a sua senha atual..." name="senha_atual" id="senha_atual" required>
            <div class="icon-eyes">
                <i class="fas fa-eye-slash"></i>
            </div>
        </div>
        <button type="submit" class="botao-verificar">Verificar</button>
    </form>
</section>
<?php endif; ?>

<?php if ($ok === true) : ?>
<section class="container-senha">
    <h1>Definir nova senha</h1>
    <div class="linha"></div>
    <form method="post" action="<?php echo RAIZ_PROJETO; ?>usuarios/salvar_senha_nova.php">
        <div class="input-grupo">
            <input name="senha_nova" placeholder="Digite a sua nova senha..." type="password" id="nova_senha" required>
            <div class="icon-eyes">
                <i class="fas fa-eye-slash"></i>
            </div>
        </div>
        <div class="input-grupo">
            <input name="confirma_senha" placeholder="Confirme a sua nova senha..." type="password" id="confirmar_senha" required>
            <div class="icon-eyes">
                <i class="fas fa-eye-slash"></i>
            </div>
        </div>
        <button type="submit" class="botao-salvar">Salvar nova senha <i class="fa-regular fa-floppy-disk"></i></button>
    </form>
</section>

<?php endif; ?>

<?php
    include SIDEBAR;
    include FOOTER_TEMPLATE;
?>

<script>
$(document).ready(function () {
    $(".icon-eye").click(function () {
        let input = $(this).siblings("input");
        let icone = $(this).find("i");

        if (input.attr("type") === "password") {
            input.attr("type", "text");
            icone.removeClass("fa-eye-slash").addClass("fa-eye");
        } else {
            input.attr("type", "password");
            icone.removeClass("fa-eye").addClass("fa-eye-slash");
        }
    });
});
</script>


