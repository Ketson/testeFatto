<?php if (isset($_SESSION['danger'])) { ?>
    <div id="danger-alert" class="alert alert-danger d-flex justify-content-center">
        <?php echo $_SESSION['danger']; ?>
    </div>
    <?php unset($_SESSION['danger']); ?>
<?php } ?>

<?php if (isset($_SESSION['success'])) { ?>
    <div id="success-alert" class="alert alert-success d-flex justify-content-center">
        <?php echo $_SESSION['success']; ?>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php } ?>