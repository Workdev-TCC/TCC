<?php 
    include('config.php');
      include DBAPI;
    include HEADER_TEMPLATE;
?>
<?php 
    if (!empty($_SESSION['message'])) : ?>
<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
    <?php echo $_SESSION['message']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php clear_messages(); ?>
<?php endif; ?>
<?php 
        include('config/modal_login.php');
        include('config/modal_cadas.php');
    ?>
<?php 
    include FOOTER_TEMPLATE;
?>