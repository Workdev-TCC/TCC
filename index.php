<?php
    include("config.php");
    include HEADER_TEMPLATE;
    include DBAPI;
    include_once UTEIS;
?>
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
<!-- <?php clear_messages(); ?> -->
<?php endif; ?>
<?php
    include ("views/home.php");
    include SIDEBAR;
    include USERBAR;
    include FOOTER_TEMPLATE;
?>