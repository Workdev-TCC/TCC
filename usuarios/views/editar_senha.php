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
        $_SESSION['message'] = "Senha não coincide";
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
<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
    <?php echo $_SESSION['message']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php clear_messages(); ?>
<?php endif; ?>

<?php if ($ok === false) : ?>
<section class="container-edit-senha">
    <h1>Confirme a sua senha atual</h1>
    <div class="linha"></div>

    <form action="<?php echo RAIZ_PROJETO; ?>usuarios/views/editar_senha.php" method="post">
        <div class="">
            <div class="input-grupo">
                <input type="password" placeholder="Digite sua senha atual" name="senha_atual" id="senha_atual" required>
                <span class="icon-eye"><i class="fa fa-eye"></i></span>
            </div>
        </div>
        <button type="submit" class="botao-verificar">Verificar</button>
    </form>
</section>
<?php endif; ?>

<?php if ($ok === true) : ?>
<section class="container-senha">
    <h1>Definir nova senha</h1>

    <form method="post" action="<?php echo RAIZ_PROJETO; ?>usuarios/salvar_senha_nova.php">
        <div class="input-grupo">
            <label for="nova_senha">Nova senha</label>
            <input name="senha_nova" type="password" id="nova_senha" required>
        </div>

        <div class="input-grupo">
            <label for="confirmar_senha">Confirmar senha</label>
            <input name="confirma_senha" type="password" id="confirmar_senha" required>
        </div>

        <button type="submit" class="botao-salvar">Salvar nova senha</button>
    </form>
</section>
<?php endif; ?>

<?php
include SIDEBAR;
include FOOTER_TEMPLATE;
?>
