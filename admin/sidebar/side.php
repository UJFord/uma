<!-- get current page -->
<?php
$current_page = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
require('../../html/navfoot/connection.php');
?>
<!-- custom css -->
<link rel="stylesheet" href="../../css/admin/side.css">
<!--========== BOX ICONS ==========-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
<!-- script for access js -->
<script>
    var userRole = "<?php echo $_SESSION['rank']; ?>";
</script>
<script src="../../js/admin/access.js"></script>
<!-- main nav -->
<nav id="main-nav" class="d-none d-md-block col col-3 col-lg-3 col-xl-2 fixed-top h-100 m-0 p-0">
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
                <a href="../crop/list.php" <?php echo (strpos($current_page, '/uma/admin/crop/list.php') === 0 || strpos($current_page, '/uma/admin/crop/crop.php') === 0 || strpos($current_page, '/uma/admin/crop/create.php') === 0)
                                                ? 'class="nav-link text-dark fw-semibold rounded-start-pill active-nav"'
                                                : 'class="nav-link text-white"'; ?>>
                    <i class="fa-solid fa-wheat-awn" style="width: 1.5rem;"></i>
                    Crops
                </a>
            </li>
            </li>
            <!-- users sidebar nav -->
            <li class="curator-only">
                <a href="../users/list.php" <?php echo (strpos($current_page, '/uma/admin/users/list.php') === 0 || strpos($current_page, '/uma/admin/users/users.php') === 0)
                                                ? 'class="nav-link text-dark fw-semibold rounded-start-pill active-nav"'
                                                : 'class="nav-link text-white"'; ?>>
                    <i class='bx bx-user' style="width: 1.5rem; font-size: 1.5rem;"></i>
                    Users
                </a>
            </li>
            </li>
            <!-- approval sidebar nav -->
            <li>
                <a href="../approval/approval.php" <?php echo (strpos($current_page, '/uma/admin/approval/approval.php') === 0 || strpos($current_page, '/uma/admin/approval/approval.php') === 0)
                                                        ? 'class="nav-link text-dark fw-semibold rounded-start-pill active-nav"'
                                                        : 'class="nav-link text-white"'; ?>>
                    <i class='bx bx-list-check' style="width: 1.5rem; font-size: 1.5rem;"></i>
                    Approval
                </a>
            </li>
        </ul>
        <hr class="mx-3">
        <div class="dropdown mx-3 mt-0 mb-3">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://source.unsplash.com/32x32/?nature,water" alt="" width="32" height="32" class="rounded-circle me-2">

                <!-- setting the variables for the user's user_id and first_name -->
                <?php
                if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN']) {
                    $user_id = $_SESSION['USER']['user_id'];
                    $first_name = $_SESSION['USER']['first_name'];
                } else {
                    $_SESSION['message'] = "<div class='error text-center'>Failed to login User.</div>";
                    // Destroy session
                    session_destroy(); //  unsets $_SESSION['USER']
                    header("location: list.php");
                    die();
                }
                // Set $first_name and $user_id to session variables
                $_SESSION['USER']['first_name'] = $first_name;
                $_SESSION['USER']['user_id'] = $user_id;
                ?>

                <?php if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN']) : ?>
                    <!-- User is logged in, display the first name -->
                    <strong><?= $first_name; ?></strong>
                <?php else : ?>
                    <!-- User is not logged in, display a link to the login page -->
                    <a href="../login/login.php" class="text-white text-decoration-none">Login</a>
                <?php endif; ?>

            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                <li><a class="dropdown-item" href="#">New project...</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="../login/logout.php">Sign out</a></li>
            </ul>
        </div>
    </div>
    <!-- font awesome script -->
    <script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>
</nav>