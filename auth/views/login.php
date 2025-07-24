<?php 
include "../../config.php";
include HEADER_TEMPLATE;
include SIDEBAR;
?>
<div class="fundo-login">
    <div class="login-wrapper">
        <form class="login-box">
            <div class="img-login">
                <img src="<?php echo RAIZ_PROJETO;?>assets/img/logo.png" alt="logo">
            </div>

            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Digite seu email" required>
            </div>

            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Digite sua senha" required>
            </div>

            <div class="forgot">
                <a href="#">Esqueceu a senha?</a>
            </div>

            <button class="login-btn" type="submit">LOGIN</button>

            <p class="signup-text">Ou faça login com:</p>

            <div class="social-login">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-google"></i></a>
            </div>

            <p class="signup-link"> Não tem conta? <a href="#"> Cadastre-se já!</a></p>
        </form>
    </div>
</div>
<?php
include FOOTER_TEMPLATE;
?>