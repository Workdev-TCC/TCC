
<div id="userbar" class="userbar">
    <div class="body">
        <div class="img-userbar">
            <?php if(empty($_SESSION['foto'])):?>
                <img src="<?php echo RAIZ_PROJETO;?>usuarios/img/semimagem.jpg" alt="imagem">
            <?php else:?>
                 <img src="<?php echo RAIZ_PROJETO;?>usuarios/img/<?php echo $_SESSION['foto'];?>" alt="imagem">
            <?php endif;?>
            <h2><?php echo $_SESSION['nome'];?></h2>
                <div class="header">
        <button id="fecharUserbar" class="close-button"><i class="fas fa-times"></i></button>
    </div>
           
        </div>
        <div class="links-userbar">
            <div class="icon">
            <a href="#"><i class="fa-solid fa-key" id="icon1"></i>Alterar senha<i class="fa-solid fa-arrow-right" id="icon2"></i></a>
            <a href="#"><i class="fa-solid fa-image"id="icon1"></i>Alterar foto<i class="fa-solid fa-arrow-right" id="icon2"></i></a>
            <a href="<?php echo RAIZ_PROJETO;?>auth/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"id="icon1"></i>Logout<i class="fa-solid fa-arrow-right" id="icon2"></i></a>
            <a href="#"><i class="fa-solid fa-trash"id="icon1"></i><strong>Deletar conta</strong><i class="fa-solid fa-arrow-right" id="icon2"></i></a>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="rodape">
            © 2025 Todos os direitos reservados<br>
            para <strong>ZUPINTURAS</strong>
        </div>
    </div>
</div>