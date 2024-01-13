<!-- get current page -->
<?php
$current_page = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
require('../../html/navfoot/connection.php');

$atcrop = strpos($current_page, '/uma/admin/crop/list.php') === 0 ||
    strpos($current_page, '/uma/admin/crop/crop.php') === 0 ||
    strpos($current_page, '/uma/admin/crop/create.php') === 0;

$atuser = strpos($current_page, '/uma/admin/users/list.php') === 0 ||
    strpos($current_page, '/uma/admin/users/user.php') === 0 ||
    strpos($current_page, '/uma/admin/users/create.php') === 0 ;

$atapprove = strpos($current_page, '/uma/admin/approval/approval.php') === 0 ||
    strpos($current_page, '/uma/admin/approval/approval.php') === 0;
?>
<!-- custom css -->
<!-- script for access js -->
<script>
    var userRole = "<?php echo $_SESSION['rank']; ?>";
</script>
<script src="../../js/admin/access.js" defer></script>
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
                <li class="curator-only">
                    <a href="../users/list.php" <?php echo ($atuser)
                                                    ? 'class="nav-link text-dark fw-semibold rounded-start-pill active-nav"'
                                                    : 'class="nav-link text-white"'; ?>>
                        <i class="fa-regular fa-user" style="width: 1.5rem;"></i>
                        Users
                    </a>
                </li>
            <?php endif; ?>
            <!-- approval sidebar nav -->
            <li>
                <a href="../approval/approval.php" <?php echo ($atapprove)
                                                        ? 'class="nav-link text-dark fw-semibold rounded-start-pill active-nav"'
                                                        : 'class="nav-link text-white"'; ?>>
                    <i class="fa-solid fa-check" style="width: 1.5rem;"></i>
                    Approval
                </a>
            </li>
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
                            <li><a class="dropdown-item" href="../login/logout.php">Sign out</a></li>
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
                        <a href="../login/login.php" class="text-white text-decoration-none">Login</a>
                    <?php endif; ?>
                </a>
            </div>
        </div>
    </div>
    <!-- font awesome script -->
    <script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>
</nav>