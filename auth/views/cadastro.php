<?php 
include "../../config.php";
include HEADER_TEMPLATE;
include SIDEBAR;
?>
<div class="fundo-login">
    <div class="login-wrapper">
        <form class="login-box" action="<? echo RAIZ_PROJETO;?>auth/cadastro.php">
            <div class="img-login">
                <img src="<?php echo RAIZ_PROJETO;?>assets/img/logo.png" alt="logo">
            </div>

            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Digite seu nome" name="nome" required>
            </div>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Digite seu email" name="email" required>
            </div>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Digite seu numero de telefone" name="telefone" required>
            </div>

            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Digite sua senha" name="senha" required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Confirme sua senha" required>
            </div>

            <button class="login-btn" type="submit">Cadastrar</button>
            <p class="signup-link"> Já tem conta? <a href="<?php echo RAIZ_PROJETO;?>auth/views/login.php"> Então faça
                    seu login!</a></p>
        </form>
    </div>
</div>
<?php
include FOOTER_TEMPLATE;
?>