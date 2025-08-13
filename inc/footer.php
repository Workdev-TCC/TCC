</main>
<footer>
    <div class="footer-mobile">
        <a href=" <?php echo RAIZ_PROJETO;?>" class="text-pink"><i class="fas fa-home fa-lg"></i></a>
        <?php if(empty($_SESSION['email'])):?>
            <a href=" <?php echo RAIZ_PROJETO;?>auth/views/login.php" class="text-pink"><i class="fas fa-user fa-lg"></i></a>
        <?php else:?>
            <a href=" <?php echo RAIZ_PROJETO;?>usuarios/views/gerenciar_conta.php">
                <div class="div-login-user">
                    <img src="<?php echo RAIZ_PROJETO;?>usuarios/img/<?php echo $_SESSION['foto'];?>"
                    alt="foto do usuario" class="rounded-circle profile-img">
                </div>
            </a>
        <?php endif;?>
        <a href="#" class="text-pink"><i class="fas fa-cogs fa-lg"></i></a>
    </div>
</footer>

<script src="<?php echo RAIZ_PROJETO;?>assets/js/jquery-3.7.1.min.js"></script>
<script src="<?php echo RAIZ_PROJETO;?>assets/js/bootstrap_js/bootstrap.bundle.min.js"></script>
<script src="<?php echo RAIZ_PROJETO;?>assets/js/fontawesome_js/all.min.js"></script>
<script src="<?php echo RAIZ_PROJETO;?>assets/js/main.js"></script>
</body>

</html>