<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <!-- cutom css -->
    <link rel="stylesheet" href="../../css/admin/entry.css" />
    <!-- favicon -->
    <link rel="shortcut icon" href="img/logo/Uma logo.svg" type="image/x-icon" />
    <title>Users</title>

    <!-- sidebar -->
    <?php
    session_start();
    require('../sidebar/side.php');
    // include('../login/login-check.php');
    ?>
    <!-- Check access when the page loads -->
    <script>
        // Assume you have the userRole variable defined somewhere in your PHP code
        var userRole = "<?php echo isset($_SESSION['rank']) ? $_SESSION['rank'] : ''; ?>";
        checkAccess(userRole);
    </script>
    <!-- script fort access level -->
    <script src="../../js/admin/access.js" defer></script>
</head>

<body class="overflow-x-hidden">

    <!-- container of everything -->
    <div class="row">

        <!-- space holder of side panel -->
        <section class=" d-none d-md-block col col-3 col-xl-2 p-0 m-0"></section>
        <!-- main panel -->
        <section class="p-0 m-0 col col-md-9 col-xl-10 min-vh-100">
            <!-- form for submitting -->
            <?php
            if (isset($_GET['user_id'])) {
                $user_id = pg_escape_string($connection, $_GET['user_id']);
                $query = "SELECT * from users where user_id = $1";
                $query_run = pg_query_params($connection, $query, array($user_id));

                if (pg_num_rows($query_run) > 0) {
                    $users = pg_fetch_assoc($query_run);
                    $password = $users['password'];
                }
            }
            ?>
            <form id="form-panel" name="Form" action="code.php" autocomplete="off" method="POST" enctype="multipart/form-data" class="h-100 py-3 px-5">
                <!-- back button -->
                <a href="list.php" class="link-offset-2"><i class="bi bi-chevron-left"></i>Go Back</a>

                <?php
                include('../message.php');
                ?>

                <!-- main form -->
                <div class="form-control p-3 mt-3">

                    <input type="hidden" name="user_id" value="<?= $user_id; ?>">
                    <input type="hidden" name="password" value="<?= $password; ?>">

                    <!-- general information -->
                    <h3>Create User</h3>

                    <div class="row">
                        <div class="col-5">
                            <!-- Current Password -->
                            <label for="current-password">Current Password<span class="text-danger">*</span></label>
                            <input id="current-password" type="text" name="current_password" class="form-control form-control-lg mb-2" required>

                            <!-- New Password -->
                            <label for="password1">New Password <span class="text-danger">*</span></label>
                            <input id="password1" type="text" name="password1" class="form-control form-control-lg mb-2" required>

                            <!-- Confirm Password -->
                            <label for="password2">Confirm Password <span class="text-danger">*</span></label>
                            <input id="password2" type="text" name="password2" class="form-control form-control-lg mb-2" required>
                        </div>
                    </div>
                    <button id="reset-btn" type="submit" name="reset" class="btn btn-info btn-sm col-2">Reset</button>
                </div>
                <?php
                ?>
            </form>
        </section>
    </div>
    <!-- scipts -->
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>
</body>

</html>