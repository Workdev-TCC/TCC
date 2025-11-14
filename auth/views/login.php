<?php 
    include "../../config.php";
    include DBAPI;

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zupinturas - Acesse a sua conta</title>
    <meta name="author"
        content="Desenvolvido por formandos da escola tecnica ETEC Fernando Prestes do ano 2025. Gustavo Silva Prado, Caio Alves Vitor , Patricia Batista Pereira, Stella Costa de Azevedo, Samanta Prado">
    <link rel="icon" href="<?php echo RAIZ_PROJETO; ?>assets/img/logo-reduzida.png" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo RAIZ_PROJETO; ?>assets/css/bootstrap_css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Hammersmith+One&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="<?php echo RAIZ_PROJETO; ?>assets/css/style.css">
</head>

<body>
    <main>
        <?php if (!empty($_SESSION['message'])) : ?>
            <div class="message-<?php echo $_SESSION['type']; ?>">
                <?php if ($_SESSION['type'] === "success") : ?>
                    <i class="fas fa-check-circle icon-message"></i>
                <?php else : ?>
                    <i class="fas fa-times-circle icon-message"></i>
                <?php endif; ?>
                <span><?php echo $_SESSION['message']; ?></span>
                <i class="fas fa-times btn-close" onclick="this.parentElement.remove()"></i>
            </div>
            <?php unset($_SESSION['message']); unset($_SESSION['type']); ?>
        <?php endif; ?>

        <section class="login-container">
    <div class="login-img">
        <h2 class="titulo-img"><span class="zu">ZU</span>PINTURAS</h2>
        <a href="<?php echo RAIZ_PROJETO; ?>" class="btn-voltar">Voltar ao Website <i class="fa-solid fa-arrow-right"></i></a>
    </div>
    <div class="login-content">
        <div class="login-box">
            <h1>Acesse a sua conta!</h1>
            <div class="linha"></div>
            <form class="login-form" action="<?php echo RAIZ_PROJETO;?>auth/login.php" method="post">
                <div class="input-wrapper">
                    <div class="icon"><i class="fa-solid fa-envelope"></i></div>
                    <input class="login-input" type="email" placeholder="Email" name="email" id="email">
                </div>
                <div class="input-wrapper">
                    <div class="icon"><i class="fa-solid fa-key"></i></div>
                    <input class="login-input-eye" type="password" placeholder="Senha" name="senha" id="senha">
                    <div class="icon-eye" data-input="senha">
                        <i class="fas fa-eye"></i> <!-- Começa com olho cortado -->
                    </div>
                </div>
                <button class="login-button" type="submit">ENTRAR</button>
            </form>
            <p>Novo no ZuPinturas? <a href="<?php echo RAIZ_PROJETO;?>auth/views/cadastro.php">Cadastre-se</a>.</p>
        </div>
    </div>
</section>
        <script src="<?php echo RAIZ_PROJETO; ?>assets/js/jquery-3.7.1.min.js"></script>
        <script src="<?php echo RAIZ_PROJETO; ?>assets/js/bootstrap_js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo RAIZ_PROJETO; ?>assets/js/fontawesome_js/all.min.js"></script>
        <script src="<?php echo RAIZ_PROJETO; ?>assets/js/main.js"></script>
        <script src="<?php echo RAIZ_PROJETO; ?>assets/js/design.js"></script>
    </main>
</body>
