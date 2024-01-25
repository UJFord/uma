<?php
// get current page
$current_page = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
require('../../html/navfoot/connection.php');
require('../functions.php');
require('../search.php');

// sites to make crop highlight
$atcrop = strpos($current_page, '/uma/admin/crop/list.php') === 0 ||
    strpos($current_page, '/uma/admin/crop/crop.php') === 0 ||
    strpos($current_page, '/uma/admin/crop/create.php') === 0;

// sites to make users highlight
$atuser = strpos($current_page, '/uma/admin/users/list.php') === 0 ||
    strpos($current_page, '/uma/admin/users/user.php') === 0 ||
    strpos($current_page, '/uma/admin/users/create.php') === 0;

// sites to make approval highlight
$atapprove = strpos($current_page, '/uma/admin/approval/approval.php') === 0 ||
    strpos($current_page, '/uma/admin/approval/approval.php') === 0;
?>
<!-- custom css -->

<!-- script for access js -->
<!-- script for access js -->
<script>
    var none_user = "not_a_user";
    var userRole = <?php echo (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN']) ? '"' . $_SESSION['rank'] . '"' : 'none_user'; ?>;
</script>
<script src="../../js/admin/access.js" defer></script>
<script src="../../js/admin/access-control.js"></script>


<!-- JQUERY link -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
    // Jquery code here!
    $(document).ready(function() {

        function load_unseen_notification(view = '') {
            $.ajax({
                url: "/incognito-capstone/admin/sidebar/fetch.php",
                method: "POST",
                data: {
                    view: view
                },
                dataType: "json",
                success: function(data) {
                    // Access data1 and update HTML accordingly
                    $('.count').html(data.data1.notification);
                    if (data.data1.unseen_notification > 0) {
                        $('.count').html(data.data1.unseen_notification);
                    }

                    // Access data2 and update HTML accordingly
                    // Adjust the selectors and HTML update based on your needs
                    $('.count2').html(data.data2.notification);
                    if (data.data2.unseen_notification > 0) {
                        $('.count2').html(data.data2.unseen_notification);
                    }
                }
            });
        }

        load_unseen_notification();

    });
</script>

<!-- main nav -->
<nav id="main-nav" class="d-none d-md-block col col-3 col-lg-3 col-xl-2 fixed-top h-100 m-0 p-0 z-3">
    <div class="d-flex flex-column flex-shrink-0 text-white h-100">
        <!-- title -->
        <a href="#" class="d-flex align-items-center m-3 mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <!-- logo -->
            <i class="fa-solid fa-hands-holding-circle me-2"></i>
            <span class="fs-4">Uma for Staffs</span>
        </a>
        <hr class="mx-3">
        <ul class="nav nav-pills flex-column mb-auto ps-3">
            <!-- crops sidebar nav -->
            <li class="nav-item">
                <a href="../crop/list.php" <?php echo ($atcrop)
                                                ? 'class="nav-link text-dark fw-semibold rounded-start-pill active-nav"'
                                                : 'class="nav-link text-white"'; ?>>
                    <i class="fa-solid fa-wheat-awn" style="width: 1.5rem;"></i>
                    Crops
                </a>

            </li>
            <!-- users sidebar nav -->
            <?php if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN']) : ?>
                <li class="curator-only admin-only">
                    <a href="../users/list.php" <?php echo ($atuser)
                                                    ? 'class="nav-link text-dark fw-semibold rounded-start-pill active-nav"'
                                                    : 'class="nav-link text-white"'; ?>>
                        <i class="fa-solid fa-user" style="width: 1.5rem;"></i>
                        Users
                    </a>
                </li>
            <?php endif; ?>

            <!-- approval crops sidebar nav -->
            <?php if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN']) : ?>
                <li class="admin-only curator-only">
                    <a href="../approval-crop/approval.php" <?php echo ($atapprove)
                                                                ? 'class="nav-link text-dark fw-semibold rounded-start-pill active-nav"'
                                                                : 'class="nav-link text-white"'; ?>>
                        <i class="fa-solid fa-check" style="width: 1.5rem;"></i>
                        Approval Crops
                        <span class="count" style="color:red;"></span>
                    </a>
                </li>
            <?php endif; ?>

            <!-- approval users sidebar nav -->
            <?php if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN']) : ?>
                <li class="admin-only curator-only">
                    <a href="../approval-users/approval.php" <?php echo ($atapprove)
                                                                    ? 'class="nav-link text-dark fw-semibold rounded-start-pill active-nav"'
                                                                    : 'class="nav-link text-white"'; ?>>
                        <i class="fa-solid fa-check" style="width: 1.5rem;"></i>
                        Approval Users
                        <span class="count2" style="color:red;"></span>
                    </a>
                </li>
            <?php endif; ?>

        </ul>
        <hr class="mx-3">
        <div class="dropdown mx-3 mt-0 mb-3">
            <div class="d-flex align-items-center">
                <a href="#" class="d-flex align-items-center justify-content-between text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://source.unsplash.com/32x32/?nature,water" alt="" width="32" height="32" class="rounded-circle me-2">
                    <?php if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN']) : ?>
                        <!-- User is logged in, display the first name -->
                        <strong><?= $_SESSION['USER']['first_name']; ?></strong>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="#">New project...</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="../profile/profile.php">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../../login/logout.php">Sign out</a></li>
                        </ul>
                    <?php else : ?>
                        <!-- User is not logged in, display a link to the login page -->
                        <?php
                        // Unset session
                        if (isset($_SESSION['USER'])) {
                            unset($_SESSION['USER']);
                        }
                        if (isset($_SESSION['LOGGED_IN'])) {
                            unset($_SESSION['LOGGED_IN']);
                        }
                        ?>
                        <a href="../../login/index.php" class="text-white text-decoration-none">Login</a>
                    <?php endif; ?>
                </a>
            </div>
        </div>

    </div>
    <!-- font awesome script -->
    <script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>
</nav>