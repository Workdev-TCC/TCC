<div class="intocavel">
    <div class="sidebar">
        <div class="header-sidebar">
            <img src="<?php echo RAIZ_PROJETO;?>assets/img/logo.png" width="70px" alt="Logo">
            <button id="fecharMenu" class="close-button"><i class="fas fa-times"></i></button>
        </div>
      
        <div class="menu-section-1">
            <a href="<?php echo RAIZ_PROJETO;?>"><i class="fas fa-home"></i> Home</a>
            <?php if(empty($_SESSION['email'])):?>
                <a href="<?php echo RAIZ_PROJETO;?>auth/views/login.php"><i class="fas fa-user"></i> Login</a>
            <?php endif;?>
        </div>
       

        <div class="menu-section">
            <h4>Empresa</h4>
            <a href="#">FAQs</a>
            <a href="<?php echo RAIZ_PROJETO;?>views/servicos.php">Serviços</a>
            <a href="<?php echo RAIZ_PROJETO;?>views/projetos.php">Projetos</a>
        </div>

        <div class="menu-section">
            <h4>Recursos</h4>
            <?php if(!empty($_SESSION['email'])):?>
                <?php if($_SESSION['tipo']=="user"):?>
                    <a href="#">Ver meu agendamento</a>
                    <a href="#">Solicitar agendamento</a>
                <?php else:?>
                    <a href="#">Gerenciar Solicitações</a>
                    <a href="#">Gerenciar Usuarios</a>
                <?php endif;?>
            <?php endif;?>
            <a href="#">Ajuda</a>
            <a href="#">Termos de Uso</a>
            <a href="#">Política de Privacidade</a>

        </div>

        <div class="menu-section contatos">
            <h4>Contatos</h4>
            <p><i class="fas fa-phone"></i> (15) 99629-8263</p>
            <a href="#"><i class="fab fa-instagram"></i> @zu_pinturas</a>
            <a href="#"><i class="fab fa-whatsapp"></i> @zu_pinturas</a>
        </div>

        <div class="rodape">
            © 2025 Todos os direitos reservados<br>
            para <strong>ZUPINTURAS</strong>
        </div>
    </div>
</div>