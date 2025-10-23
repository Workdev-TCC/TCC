<?php
include("../../config.php");
include("../../inc/Banco.php");
include HEADER_TEMPLATE;
include DBAPI;
include_once UTEIS;

if (empty($_SESSION['tipo'])) {
    header("Location:" . RAIZ_PROJETO);
    exit;
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<?php if (!empty($_SESSION['message'])) : ?>
<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
    <?php echo $_SESSION['message']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php clear_messages(); ?>
<?php endif; ?>

<div class="fundo-gerenciar-conta">
    <div class="box">
        <!-- Foto de perfil -->
        <div class="imgbox" data-bs-toggle="modal" data-bs-target="#modalFoto">
            <img src="<?php echo RAIZ_PROJETO; ?>usuarios/img/<?php echo $_SESSION['foto'] ?: 'semimagem.jpg'; ?>" alt="img-perfil">
        </div>

        <!-- Nome -->
        <h2><?php echo htmlspecialchars($_SESSION['nome']); ?></h2>

        <!-- Links -->
        <div class="linksbox">
            <a href="<?php echo RAIZ_PROJETO; ?>auth/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
            <a href="<?php echo RAIZ_PROJETO; ?>usuarios/views/edit.php"><i class="fa-solid fa-user-pen"></i> Editar Dados</a>
            <a href="<?php echo RAIZ_PROJETO;?>usuarios/views/editar_senha.php"><i class="fa-solid fa-key"></i> Editar Senha</a>
            <a href="#"><i class="fa-solid fa-file-contract"></i> Termos de uso</a>
            <a href="#"><i class="fa-solid fa-shield-halved"></i> Política de privacidade</a>
            <a href="#"><i class="fa-solid fa-trash text-danger"></i> <strong>Deletar conta</strong></a>
        </div>
    </div>
</div>

<!-- Modal da foto ampliada -->
<div class="modal fade" id="modalFoto" tabindex="-1" aria-labelledby="modalFotoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark text-light text-center">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="modalFotoLabel">Foto de Perfil</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <img src="<?php echo RAIZ_PROJETO; ?>usuarios/img/<?php echo $_SESSION['foto'] ?: 'semimagem.jpg'; ?>" 
             alt="foto ampliada" class="img-fluid rounded shadow" style="max-width:300px;">
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<?php
include SIDEBAR;
include FOOTER_TEMPLATE;
?>
