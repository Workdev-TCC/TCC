<?php 
    include "../../config.php";
    include DBAPI;
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zupinturas - Cadastro</title>
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
            <div class="alert message-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
                <div class="button-message"> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                <div class="box-message"><strong><?php echo $_SESSION['message']; ?> <div class="icon-message" data-icon="<?php echo $_SESSION['type'];?>"><i id="icon-msg" class="fa-solid fa-circle-check"></i></div></strong></div>
            </div>
            <!-- <?php clear_messages(); ?> -->
        <?php endif; ?>

        <section class="login-container">
            <div class="login-img">
                <h2 class="titulo-img"><span class="zu">ZU</span>PINTURAS</h2>
                <a href="<?php echo RAIZ_PROJETO; ?>" class="btn-voltar">Voltar ao Website <i class="fa-solid fa-arrow-right"></i></a>
            </div>
            <div class="login-content">
                <div class="login-box">
                    <h1>Cadastra-se Aqui</h1>
                    <div class="linha"></div>
                    <form class="cadastro-form" action="<?php echo RAIZ_PROJETO;?>auth/cadastro.php" method="post">
                        <div class="input-wrapper">
                            <input class="login-input" type="text" placeholder="Digite o seu nome completo" name="nome" id="nome" required>
                        </div>
                        <div class="input-wrapper">
                            <input class="login-input" type="email" placeholder="Digite o seu email" name="email" id="email" required>
                        </div>
                        <div class="input-wrapper">
                            <input 
                                class="login-input" 
                                type="tel" 
                                placeholder="Digite o seu telefone (ex: 11 91234-5678)" 
                                name="telefone" 
                                id="telefone" 
                                maxlength="15"
                                required
                            >
                        </div>
                        <div class="input-wrapper">
                            <small id="erro-tamanho"><i class="fa-solid fa-circle-exclamation sm"></i> A senha deve conter no mínimo 8 caracteres.</small>
                            <input class="login-input-eye" type="password" placeholder="Digite a sua senha" name="senha" id="senha">
                            <div class="icon-eye" data-input="senha"><i class="fa-solid fa-eye-slash"></i></div>
                        </div>
                        <div class="input-wrapper">
                            <small id="erro-senha"><i class="fa-solid fa-circle-exclamation sm"></i> Senha incorreta! Tente novamente...</small>
                            <input class="login-input-eye" type="password" placeholder="Confirmar senha" id="confirmar_senha">
                            <div class="icon-eye " data-input="confirmar_senha"><i class="fa-solid fa-eye-slash"></i></div>
                        </div>
                        <button class="login-button" type="submit">CADASTRE-SE</button>
                    </form>
                    <p>Já possui uma Conta? <span><a href="<?php echo RAIZ_PROJETO;?>auth/views/login.php">Entre</a></span>.</p>
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
