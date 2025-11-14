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
            <div class="opc"><i class="fa-solid fa-circle-question"></i><a href="#">Perguntas Frequentes</a></div>
            <div class="opc"><i class="fa-solid fa-paintbrush"></i><a href="<?php echo RAIZ_PROJETO; ?>views/servicos.php">Serviços</a></div>
            <div class="opc"><i class="fa-solid fa-brush"></i><a href="<?php echo RAIZ_PROJETO; ?>views/projetos.php">Projetos</a></div>
        </div>

        <div class="menu-section">
            <h4>Recursos</h4>
            <hr>
            <?php if (!empty($_SESSION['email'])): ?>
                <?php if ($_SESSION['tipo'] == "user"): ?>
                    <a href="#">Ver meus agendamentos</a>
                    <a href="#">Solicitar novo agendamento</a>
                <?php else: ?>
                    <a href="<?php echo RAIZ_PROJETO; ?>admin/views/gerenciar_solicitacoes.php">Gerenciar Solicitações</a>
                    <a href="<?php echo RAIZ_PROJETO; ?>admin/views/listar_usuarios.php">Gerenciar Usuarios</a>
                <?php endif; ?>
            <?php endif; ?>
            <!-- <a href="#">Ajuda</a> -->
            <div class="opc"><a href="<?php echo RAIZ_PROJETO; ?>views/termos.php">Termos de Uso</a></div>
            <div class="opc"><a href="<?php echo RAIZ_PROJETO; ?>views/politica.php">Política de Privacidade</a></div>
        </div>

        <div class="rodape">
            <div class="logo">
                <p>© 2025 Todos os direitos reservados</p>
                <p>para <strong>ZUPINTURAS</strong></p>
            </div>
        </div>
    </div>
</div>