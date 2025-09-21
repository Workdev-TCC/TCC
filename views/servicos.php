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

    <div class="hero-servicos">
        <div class="servicos-text">
            <div class="hero-h1">
                <h1>Conheça nossos Serviços</h1>
            </div>
            <div class="hero-p">
                <p>Transforme seu espaço com pintura profissional! Residencial, comercial ou decorativa</p>
            </div>
        </div>
    </div>

    <div class="servicos-about">
        <div class="about1-text">
            <h1>Nossos serviços</h1>
            <div class="linha">

            </div>
        </div>
    </div>

    <div class="s-page">
        <div class="servicos-page">
            <div class="servico1">
                <div class="servico1-img">
                    <div class="si1-img">
                        <img class="s1-img" src="<?php echo RAIZ_PROJETO;?>assets/img/servico.jpg" alt="erro">
                    </div>
                </div>
                <div class="servico1-text">
                    <h1>pinturas</h1>
                    <p>Transforme suas paredes com pinturas exclusivas: residencial, comercial ou industrial!</p>
                </div>
            </div>
            <div class="servico2">
                <div class="servico2-img">
                    <div class="si2-img">
                        <img class="s2-img" src="<?php echo RAIZ_PROJETO;?>assets/img/servico.jpg" alt="erro">
                    </div>
                </div>
                <div class="servico2-text">
                    <h1>Texturas</h1>
                    <p>Transforme seu espaço com texturas exclusivas: areia, grafiato ou marmorizado!</p>
                </div>
            </div>
            <div class="servico3">
                <div class="servico3-img">
                    <div class="si3-img">
                        <img class="s3-img" src="<?php echo RAIZ_PROJETO;?>assets/img/servico.jpg" alt="erro">
                    </div>
                </div>
                <div class="servico3-text">
                    <h1>Texturas</h1>
                    <p>Transforme seu espaço com texturas exclusivas: areia, grafiato ou marmorizado!</p>
                </div>
            </div>
        </div>
        <div class="servicos-page2">
            <div class="servico4">
                <div class="servico4-img">
                    <div class="si4-img">
                        <img class="s4-img" src="<?php echo RAIZ_PROJETO;?>assets/img/servico.jpg" alt="erro">
                    </div>
                </div>
                <div class="servico4-text">
                    <h1>pinturas</h1>
                    <p>Transforme suas paredes com pinturas exclusivas: residencial, comercial ou industrial!</p>
                </div>
            </div>
            <div class="servico5">
                <div class="servico5-img">
                    <div class="si5-img">
                        <img class="s5-img" src="<?php echo RAIZ_PROJETO;?>assets/img/servico.jpg" alt="erro">
                    </div>
                </div>
                <div class="servico5-text">
                    <h1>Texturas</h1>
                    <p>Transforme seu espaço com texturas exclusivas: areia, grafiato ou marmorizado!</p>
                </div>
            </div>
            <div class="servico6">
                <div class="servico6-img">
                    <div class="si6-img">
                        <img class="s6-img" src="<?php echo RAIZ_PROJETO;?>assets/img/servico.jpg" alt="erro">
                    </div>
                </div>
                <div class="servico6-text">
                    <h1>Texturas</h1>
                    <p>Transforme seu espaço com texturas exclusivas: areia, grafiato ou marmorizado!</p>
                </div>
            </div>
        </div>
    </div>
<?php
    include SIDEBAR;
    include USERBAR;
    include FOOTER_TEMPLATE;
?>