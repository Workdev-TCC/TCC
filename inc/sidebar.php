<div class="intocavel">
    <div class="sidebar">
        <div class="header-sidebar">
            <div class="empresa">
                <!-- <img src="<?php echo RAIZ_PROJETO;?>assets/img/logo.png" width="70px" alt="Logo"> -->
                <h1><span class="zu">ZU</span>PINTURAS</h1>
            </div>
            <button id="fecharMenu" class="close-button"><i class="fas fa-times"></i></button>
        </div>

        <div class="menu-section-1">
            <span><a href="<?php echo RAIZ_PROJETO; ?>"><i class="fas fa-home"></i> Home</a></span>
            <?php if (empty($_SESSION['email'])): ?>
                <a href="<?php echo RAIZ_PROJETO; ?>auth/views/login.php"><i class="fas fa-user"></i> Login</a>
            <?php endif; ?>
        </div>


        <div class="menu-section">
            <h4>Empresa</h4>
            <hr>
            <div class="opc"><a href="#"><i class="fa-solid fa-circle-question"></i>Perguntas Frequentes</a></div>
            <div class="opc"><i class="fa-solid fa-paintbrush"></i><a href="#">Serviços</a></div>
            <div class="opc"><i class="fa-solid fa-brush"></i><a href="#">Projetos</a></div>
        </div>

        <div class="menu-section">
            <h4>Recursos</h4>
            <hr>
            <?php if (!empty($_SESSION['email'])): ?>
                <?php if ($_SESSION['tipo'] == "user"): ?>
                    <a href="#">Ver meu agendamento</a>
                    <a href="#">Solicitar agendamento</a>
                <?php else: ?>
                    <a href="<?php echo RAIZ_PROJETO; ?>admin/views/gerenciar_solicitacoes.php">Gerenciar Solicitações</a>
                    <a href="<?php echo RAIZ_PROJETO; ?>admin/views/listar_usuarios.php">Gerenciar Usuarios</a>
                <?php endif; ?>
            <?php endif; ?>
            <a href="#">Ajuda</a>
            <a href="#">Termos de Uso</a>
            <a href="#">Política de Privacidade</a>

        </div>

        <!-- <div class="menu-section contatos">
            <h4>Contatos</h4>
            <hr>
            <p><i class="fas fa-phone"></i> (15) 99629-8263</p>
            <a href="#"><i class="fab fa-instagram"></i> @zu_pinturas</a>
            <a href="#"><i class="fab fa-whatsapp"></i> @zu_pinturas</a>
        </div> -->

        <div class="rodape">
            <div class="logo">
                <img src="<?php echo RAIZ_PROJETO;?>assets/img/logo.png" width="150px" alt="Logo">
                <p>© 2025 Todos os direitos reservados</p>
                <p>para <strong>ZUPINTURAS</strong></p>
            </div>
        </div>
    </div>
</div>