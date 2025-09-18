<?php
    include("config.php");
    include HEADER_TEMPLATE;
    include DBAPI;
    include_once UTEIS;
?>
<?php if (!empty($_SESSION['message'])) : ?>
<div class="alert message-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
    <div class="button-message"> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
    <div class="box-message"><strong><?php echo $_SESSION['message']; ?> <div class="icon-message" data-icon="<?php echo $_SESSION['type'];?>"><i id="icon-msg" class="fa-solid fa-circle-check"></i></div></strong></div>
</div>
<!-- <?php //clear_messages(); ?> -->
<?php endif; ?>
<?php
    include ("views/home.php");
    include SIDEBAR;
    include USERBAR;
    include FOOTER_TEMPLATE;
?>