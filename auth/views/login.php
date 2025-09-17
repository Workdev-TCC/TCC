<?php 
include "../../config.php";
include HEADER_TEMPLATE;
include SIDEBAR;
include DBAPI;
?>
<?php if (!empty($_SESSION['message'])) : ?>
<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
    <?php echo $_SESSION['message']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php clear_messages(); ?>
<?php endif; ?>
    <section class="login-container">
        <div class="login-content">
            <h1 class="h1-Hammersmith">LOGIN</h1>
            <form class="login-form" action="<?php echo RAIZ_PROJETO;?>auth/login.php" method="post">
                <div class="input-wrapper"><input class="login-input" type="text" placeholder="Email" name="email" id="email"></div>
                <div class="input-wrapper">
                    <input class="login-input-eye" type="password" placeholder="Senha" name="senha" id="senha">
                    <div class="icon-eye" data-input="senha"><i id="eye" class="fas fa-eye"></i></div>
                </div>
                <button class="login-button" type="submit">Logar</button>
            </form>
            <p>Não tem uma conta? Faça ja seu <span><a href="<?php echo RAIZ_PROJETO;?>auth/views/cadastro.php">Cadastro</a></span></p>
        </div>
        <div class="login-img"></div>
    </section>
<?php
include FOOTER_TEMPLATE;
?>