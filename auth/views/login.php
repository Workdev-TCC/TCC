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
    <div class="login-container">
        <div class="login-form">
            <h1>LOGIN</h1>
            <form action="" class="">
                <input type="text" placeholder="Email">
                <input type="text" placeholder="Senha">
                <p>Não tem conta?<a href="#"> Cadastre aqui</a><a href="#" class="forget"> Esqueceu a senha?</a></p>
                <button type="submit">Login</button>
            </form>
        </div>
        <div class="login-img">
           
        </div>
    </div>
<?php
include FOOTER_TEMPLATE;
?>