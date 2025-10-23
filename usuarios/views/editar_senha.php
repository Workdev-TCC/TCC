<?php
include("../../config.php");
include("../../inc/Banco.php");
include HEADER_TEMPLATE;
include DBAPI;
include_once UTEIS;
    $ok=false;
 if ($_SERVER['REQUEST_METHOD']==='POST'&& !empty($_POST)){
    $senha_atual=$_POST['senha_atual'];
    if($senha_atual==$_SESSION['senha']){
        $ok=true;
    }else{
        $ok=false;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }   
        $_SESSION['message']="senha nao coincide";
        $_SESSION['type']="danger";

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

<?php if($ok===false):?>
    <div class="container-senha">
    <h1>Confirme sua senha atual</h1>
    <form action="<?php echo RAIZ_PROJETO;?>usuarios/views/editar_senha.php" method="post">
        <div class="campos">
            <label for="senha_atual" class="form-label">Senha atual</label>
            <input type="password" name="senha_atual" class="form-control" required>
            <span class="icon-eye"><i class="fa fa-eye"></i></span>
        </div>
        <button type="submit" class="btn btn-primary">Verificar</button>
    </form>
</div>
<?php endif; ?>

        <?php if($ok===true): ?>
        <form method="post" action="<?php echo RAIZ_PROJETO;?>usuarios/salvar_senha_nova.php">
            <div class="mb-3">
                <label for="nova_senha" class="form-label">Nova senha</label>
                <input name="senha_nova"type="password" id="nova_senha" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="confirmar_senha" class="form-label">Confirmar senha</label>
                <input name="confirma_senha"type="password" id="confirmar_senha" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Salvar nova senha</button>
        </form>
        <?php endif; ?>
      


<?php
include SIDEBAR;
include FOOTER_TEMPLATE;
?>
