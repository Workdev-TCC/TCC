<?php
    include("config.php");
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
<?php
    include ("views/projetos.php");
    include SIDEBAR;
    include FOOTER_TEMPLATE;
?>