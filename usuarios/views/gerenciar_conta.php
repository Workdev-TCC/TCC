<?php
    include("../../config.php");
    include HEADER_TEMPLATE;
    include DBAPI;
    include_once UTEIS;
?>
<?php if (!empty($_SESSION['message'])) : ?>
<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
    <?php echo $_SESSION['message']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php clear_messages(); ?>
<?php endif; ?>
<div class="fundo-gerenciar-conta">
    <div class="box">
        <div class="closebox">
            <button class="close-button"><i class="fas fa-times"></i></button>
        </div>
        <div class="imgbox">
            <img src="" alt="img-perfil">
            <h2></h2>
        </div>
        <div class="linksbox">
            <a href="<?php echo RAIZ_PROJETO;?>auth/logout.php"><i class="fas fa-arrow-left"></i>Logout</a>
            <a href="">Termos de uso</a>
            <a href="">politica de privacidade</a>
        </div>
    </div>
</div>
<?php
    include SIDEBAR;
    include FOOTER_TEMPLATE;
?>