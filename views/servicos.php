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

    <div class="servicos-page">
        <div class="servico1">
            <div class="servico1-img">
                <div class="si1-img">
                    <img class="s1-img" src="<?php echo RAIZ_PROJETO;?>assets/img/servico.jpg" alt="erro">
                </div>
                <div class="s1-grid">
                    <div class="grid-a">
                        <img class="grid-img1" src="<?php echo RAIZ_PROJETO;?>assets/img/servico.jpg" alt="erro">
                        <img class="grid-img2" src="<?php echo RAIZ_PROJETO;?>assets/img/servico.jpg" alt="erro">
                    </div>
                    <div class="grid-b">
                        <img class="grid-img3" src="<?php echo RAIZ_PROJETO;?>assets/img/servico.jpg" alt="erro">
                        <img class="grid-img4" src="<?php echo RAIZ_PROJETO;?>assets/img/servico.jpg" alt="erro">
                    </div>
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
                <div class="s2-grid">
                    <div class="grid-a">
                        <img class="grid-img1" src="<?php echo RAIZ_PROJETO;?>assets/img/servico.jpg" alt="erro">
                        <img class="grid-img2" src="<?php echo RAIZ_PROJETO;?>assets/img/servico.jpg" alt="erro">
                    </div>
                    <div class="grid-b">
                        <img class="grid-img3" src="<?php echo RAIZ_PROJETO;?>assets/img/servico.jpg" alt="erro">
                        <img class="grid-img4" src="<?php echo RAIZ_PROJETO;?>assets/img/servico.jpg" alt="erro">
                    </div>
                </div>
            </div>
            <div class="servico2-text">
                <h1>Texturas</h1>
                <p>Transforme seu espaço com texturas exclusivas: areia, grafiato ou marmorizado!</p>
            </div>
        </div>
    </div>

    <div class="a-servico">
            <div class="a-img">
                 <div class="an-grid">
                    <div class="grid-c">
                        <img class="agrid-img1" src="<?php echo RAIZ_PROJETO;?>assets/img/servico.jpg" alt="erro">
                        <img class="agrid-img2" src="<?php echo RAIZ_PROJETO;?>assets/img/servico.jpg" alt="erro">
                    </div>
                    <div class="grid-d">
                        <img class="agrid-img3" src="<?php echo RAIZ_PROJETO;?>assets/img/servico.jpg" alt="erro">
                        <img class="agrid-img4" src="<?php echo RAIZ_PROJETO;?>assets/img/servico.jpg" alt="erro">
                    </div>
                </div>
            </div>

            <div class="a-text">
                    <div class="a1-text">
                        <h1>Outros Servicos</h1>
                        <div class="a-lista">
                            <ul>
                                <li>sdkas</li>
                                <li>sdkas</li>
                                <li>sdkas</li>
                            </ul>
                        </div>
                    </div>
            </div>
        </div>

<?php
    include SIDEBAR;
    include USERBAR;
    include FOOTER_TEMPLATE;
?>