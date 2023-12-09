<?php
if (isset($_SESSION['message'])) :
?>
    <!-- Your existing code for displaying error messages -->
    <div class="alert <?= (isset($_SESSION['message_type']) && $_SESSION['message_type'] == 'error') ? 'alert-danger' : 'alert-warning'; ?> alert-dismissible fade show" role="alert">
        <strong><?= (isset($_SESSION['message_type']) && $_SESSION['message_type'] == 'error') ? 'Error!' : 'Pogi!'; ?></strong> <?= ($_SESSION['message']); ?>
        <?php
        if (isset($_SESSION['message_type']) && $_SESSION['message_type'] == 'error' && isset($_SESSION['error_details'])) {
            echo '<br>Error Details: ' . $_SESSION['error_details'];
        }
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

<?php
unset($_SESSION['message']);
unset($_SESSION['message_type']);
unset($_SESSION['error_details']);
elseif (isset($_SESSION['message'])) :
?>
    <!-- Your existing code for displaying non-error messages -->
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Pogi!</strong> <?= ($_SESSION['message']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

<?php
unset($_SESSION['message']);
endif;
?>