<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zupinturas</title>
    <meta name="description" content="Site desenvolvivido com finaldade ">
    <meta name="author"
        content="Desenvolvido por formandos da escola tecnica ETEC Fernando Prestes do ano 2025. Gustavo Silva Prado, Caio Alves Vitor , Patricia Batistata Pereira, Stella Costa de Azevedo, Samanta Prado">
    <!-- Favicon -->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- framework(local) de layout e icone -->
    <link rel="stylesheet" href="<?php echo RAIZ_PROJETO;?>assets/css/bootstrap_css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo RAIZ_PROJETO;?>assets/css/fontawesome_css/all.min.css">
    <!-- Google Fonts (opcional) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
                    <a class="nav-link active" aria-current="page" href="#">INICIO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">SOBRE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">CONTATOS</a>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="servicosDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        SERVIÇOS
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="servicosDropdown">
                        <li><a class="dropdown-item" href="#">Design</a></li>
                        <li><a class="dropdown-item" href="#">Desenvolvimento</a></li>
                        <li><a class="dropdown-item" href="#">Consultoria</a></li>
                    </ul>
                </li>
            </ul>
            <div class="div-login-user">
                <a href="#" data-bs-toggle="modal" data-bs-target="#perfilModal">
                    <img src="<?php echo RAIZ_PROJETO;?>assets/img/pintura.png" alt="erro"
                        class="rounded-circle profile-img">
                </a>
            </div>
        </nav>
    </header>
    <main>