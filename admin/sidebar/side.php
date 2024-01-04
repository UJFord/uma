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
            <!-- farming sidebar nav -->
            <li>
                <a href="../farming/list.php" <?php echo (strpos($current_page, '/uma/admin/farming/list.php') === 0 || strpos($current_page, '/uma/admin/farming/farming.php') === 0)
                                                    ? 'class="nav-link text-dark fw-semibold rounded-start-pill active-nav"'
                                                    : 'class="nav-link text-white"'; ?>>
                    <i class="fa-solid fa-mountain-sun" style="width: 1.5rem;"></i>
                    Practices
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
                <strong <?php if (isset($_SESSION['user'])) {
                            $user = $_SESSION['user'];
                            $query = "select * from users where user_id = $user";
                            $res = pg_query($connection, $query);
                            if (pg_num_rows($res) > 0) {
                                $user = pg_fetch_assoc($res);
                                $first_name = $user['first_name'];
                                $user_id = $user['user_id'];
                            }
                        }
                        ?>><?= $first_name; ?>
                </strong>
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