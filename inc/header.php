<!DOCTYPE html>
<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $paginaAtual = basename($_SERVER['PHP_SELF']);
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zupinturas</title>
    <meta name="description" content="Site desenvolvivido com finaldade ">
    <meta name="author"
        content="Desenvolvido por formandos da escola tecnica ETEC Fernando Prestes do ano 2025. Gustavo Silva Prado, Caio Alves Vitor , Patricia Batista Pereira, Stella Costa de Azevedo, Samanta Prado">
    <!-- Favicon -->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- framework(local) de layout e icone -->
    <link rel="stylesheet" href="<?php echo RAIZ_PROJETO;?>assets/css/bootstrap_css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo RAIZ_PROJETO;?>assets/css/fontawesome_css/all.min.css">
    <!-- Google Fonts (opcional) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Hammersmith+One&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <link href='https://cdn.boxicons.com/fonts/brands/boxicons-brands.min.css' rel='stylesheet'>
    <!-- Meu css -->
    <link rel="stylesheet" href="<?php echo RAIZ_PROJETO;?>assets/css/style.css">

</head>

<body>
    <header>
        <div id="abrirMenu" class="mobile-menu-top">
            <i class="fas fa-bars"></i>
        </div>
        <div class="logo-mobile">
            <img src="<?php echo RAIZ_PROJETO;?>assets/img/logo.png" alt="logo">
        </div>
        <nav class="nav-desktop">
            <div class="logo-desktop">
                <img src="<?php echo RAIZ_PROJETO;?>assets/img/logo.png" alt="logo">
            </div>
            <ul class="navbar-nav nav-links header-font">
                <li class="nav-item">
                    <a href="<?php echo RAIZ_PROJETO; ?>"
                     class="nav-link <?php echo ($paginaAtual == 'index.php') ? 'active' : ''; ?>">
                     INÍCIO</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo RAIZ_PROJETO; ?>views/projetos.php"
                        class="nav-link <?php echo ($paginaAtual == 'projetos.php') ? 'active' : ''; ?>">
                        PROJETOS
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo RAIZ_PROJETO; ?>views/servicos.php"
                        class="nav-link <?php echo ($paginaAtual == 'servicos.php') ? 'active' : ''; ?>">
                        SERVIÇOS
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="servicosDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        MAIS INFORMAÇÕES
                    </a>
                    <ul class="dropdown-menu bg-dark" aria-labelledby="servicosDropdown">
                        <li><a class="dropdown-item" href="<?php echo RAIZ_PROJETO;?>views/termos.php"><i class="fa-solid fa-file-contract"></i> Termos de Uso</a></li>
                        <li><a class="dropdown-item" href="<?php echo RAIZ_PROJETO;?>views/politica.php"><i class="fa-solid fa-shield-halved"></i> Políticas de Privacidade</a></li>
                    </ul>
                </li>

                <?php  if(isset($_SESSION['email'])):?>
                <?php if($_SESSION['tipo']==="user"):?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="servicosDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        AGENDAMENTOS
                    </a>
                    <ul class="dropdown-menu bg-dark" aria-labelledby="servicosDropdown">
                        <li><a class="dropdown-item" href="<?php echo  RAIZ_PROJETO;?>usuarios/views/solicitar_visita.php"><i class="fa-solid fa-calendar-plus"></i> Novo Agendamento</a></li>
                        <li><a class="dropdown-item" href="<?php echo RAIZ_PROJETO; ?>usuarios/views/gerenciar_solicitacoes.php"><i class="fa-solid fa-calendar-days"></i> Meus Agendamentos</a></li>
                    </ul>
                </li>
                <?php else:?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="servicosDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        PAINEL DE CONTROLE
                    </a>
                    <ul class="dropdown-menu bg-dark" aria-labelledby="servicosDropdown">
                        <li><a class="dropdown-item" href="<?php echo RAIZ_PROJETO;?>admin/views/listar_usuarios.php"><i class="fa-solid fa-user"></i> Usuários Cadastrados</a></li>
                        <li><a class="dropdown-item" href="<?php echo RAIZ_PROJETO;?>admin/views/gerenciar_solicitacoes.php"><i class="fa-solid fa-calendar-check"></i> Solicitações de Visitas</a></li>
                    </ul>
                </li>
                <?php endif;?>
                <?php endif;?>
                <?php if(empty($_SESSION['email'])):?>
                <li>
                    <a href="<?php echo RAIZ_PROJETO;?>auth/views/login.php">
                        <div class="div-login-user">
                            <img src="<?php echo RAIZ_PROJETO;?>assets/img/login.png" alt="erro"
                                class="rounded-circle profile-img">
                        </div>
                    </a>
                </li>
                <?php else:?>
                <li>
                    <a id="abrirUserbar" href="#">
                        <div class="div-login-user">
                            <img src="<?php echo RAIZ_PROJETO;?>usuarios/img/<?php echo $_SESSION['foto'];?>"
                                alt="foto do usuario" class="rounded-circle profile-img">
                        </div>
                    </a>
                </li>
                <?php endif;?>
            </ul>
        </nav>
    </header>
    <main>