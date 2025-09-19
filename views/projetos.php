<?php
    include("../config.php");
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

    <div class="hero-projetos">
        <div class="projetos-text">
            <h1>Conheça nossos Projetos</h1>
            <p>Oferecemos serviços profissionais para transformar seu ambiente, incluindo pintura residencial, comercial, reformas de fachadas e pintura decorativa. Agende uma visita e descubra qual opção é ideal para o seu espaço!</p>
        </div>
    </div>

    <div class="projetos-about">
        <div class="about-text">
            <h1>Nossos Projetos</h1>
            <div class="linha">

            </div>
            <p>Oferecemos serviços profissionais para transformar seu ambiente, incluindo pintura residencial, comercial, reformas de fachadas e pintura decorativa. Agende uma visita e descubra qual opção é ideal para o seu espaço!</p>
        </div>
    </div>

    <div class="projetos">
        <div class="img">
            <div class="a-side">
                <img class="img1" src="<?php echo RAIZ_PROJETO;?>assets/img/servico.jpg" alt="erro">
                <img class="img2" src="<?php echo RAIZ_PROJETO;?>assets/img/servico.jpg" alt="erro">
            </div>
            <div class="b-side">
                <img class="img3" src="<?php echo RAIZ_PROJETO;?>assets/img/servico.jpg" alt="erro">
                <img class="img4" src="<?php echo RAIZ_PROJETO;?>assets/img/servico.jpg" alt="erro">
                <img class="img5" src="<?php echo RAIZ_PROJETO;?>assets/img/servico.jpg" alt="erro">
            </div>
            
        </div>
    </div>


<?php
    include SIDEBAR;
    include USERBAR;
    include FOOTER_TEMPLATE;
?>