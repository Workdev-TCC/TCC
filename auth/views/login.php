<?php 
include "../../config.php";
include HEADER_TEMPLATE;
include SIDEBAR;
?>
<div class="fundo-login">
    <div class="login-wrapper">
        <form class="login-box" action="<?php echo RAIZ_PROJETO;?>auth/login.php">
            <div class="img-login">
                <img src="<?php echo RAIZ_PROJETO;?>assets/img/logo.png" alt="logo">
            </div>

            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Digite seu email" name="email" required>
            </div>

            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Digite sua senha" name="senha" required>
            </div>

            <div class="forgot">
                <a href="#">Esqueceu a senha?</a>
            </div>

            <button class="login-btn" type="submit">LOGIN</button>

            <p class="signup-link"> Não tem conta? <a href="<?php echo RAIZ_PROJETO;?>auth/views/cadastro.php">
                    Cadastre-se já!</a></p>
        </form>
    </div>
</div>
<?php
include FOOTER_TEMPLATE;
?>