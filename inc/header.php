<!DOCTYPE html>
<?php session_start();?>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>CRUD</title>
    <link rel="stylesheet" href="<?php echo RAIZ_PROJETO;?>assets/css/bootstrap_css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo RAIZ_PROJETO;?>assets/css/fontawesome_css/all.min.css">
    <link rel="stylesheet" href="<?php echo RAIZ_PROJETO;?>assets/css/my_css/global.css">

</head>

<body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container-fluid">
            <!-- Logo à esquerda -->
            <a class="navbar-brand" href="#">Zupinturas</a>

            <!-- Botão do menu para mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Centro e direita da navbar -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Links centralizados -->
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sobre</a>
                    </li>
                    <?php if(isset($_SESSION['user'])):?>
                    <?php if($_SESSION['user_tipo'] ==='user'):?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Serviços
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Agendar Visita</a></li>
                            <li><a class="dropdown-item" href="#">Meus Agendamentos</a></li>
                        </ul>
                    </li>
                    <?php endif;?>
                    <?php if($_SESSION['user_tipo'] ==='admin'):?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Dashboard
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Consultar Usuarios</a></li>
                            <li><a class="dropdown-item" href="#">Consultar Pedidos </a></li>
                            <li><a class="dropdown-item" href="<?php echo RAIZ_PROJETO;?>orcamento/orcamento.php">Calculadora de Orçamento </a></li>
                            <li><a class="dropdown-item" href="listar.php">Listar orçamentos </a></li>
                        </ul>
                    </li>
                    <?php endif;?>
                    <?php endif;?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">FAQs</a>
                    </li>
                    <?php if(isset($_SESSION['user'])):?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo RAIZ_PROJETO; ?>config/logout.php"><i
                                class="fas fa-arrow-left"></i> Sair</a>
                    </li>
                    <?php endif;?>
                </ul>

                <div class="d-flex">
                    <?php 
                        if(isset($_SESSION['foto'])){
                           $image= RAIZ_PROJETO."usuarios/img/".$_SESSION['foto'];
                        }else{
                            $image= RAIZ_PROJETO."assets/img/login.png";
                        }

                    ?>
                    <?php if(isset($_SESSION['user'])):?>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#perfilModal">
                        <img src="<?php echo $image;?>" alt="erro" class="rounded-circle profile-img">
                    </a>
                    <?php else:?>
                    <a href="<?php  echo RAIZ_PROJETO . 'config/login.php';?>">
                        <img src="<?php echo $image;?>" alt="erro" class="rounded-circle profile-img">
                    </a>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </nav>