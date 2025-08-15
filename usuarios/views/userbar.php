<div id="userbar" class="userbar">
    <div class="header">
         <button id="fecharUserbar" class="close-button"><i class="fas fa-times"></i></button>
    </div>
    <div class="body">
        <div class="img-userbar">
            <?php if(empty($_SESSION['foto'])):?>
                <img src="<?php echo RAIZ_PROJETO;?>usuarios/img/semimagem.jpg" alt="imagem">
            <?php else:?>
                 <img src="<?php echo RAIZ_PROJETO;?>usuarios/img/<?php echo $_SESSION['foto'];?>" alt="imagem">
            <?php endif;?>
            <h2><?php echo $_SESSION['nome'];?></h2>
           
        </div>
        <div class="links-userbar">
            <a href="<?php echo RAIZ_PROJETO;?>auth/logout.php">Logout</a>
            <a href="#">Deletar conta</a>
            <a href="#">Alterar senha</a>
            <a href="#">Alterar foto</a>
        </div>
    </div>
    <div class="footer">
        <div class="rodape">
            © 2025 Todos os direitos reservados<br>
            para <strong>ZUPINTURAS</strong>
        </div>
    </div>
</div>