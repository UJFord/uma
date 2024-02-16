<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

    <!-- add entry custom css -->
    <link rel="stylesheet" href="../../css/admin/entry.css" />
    <!-- sidebar custom css -->
    <link rel="stylesheet" href="../../css/admin/side.css">

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
            <form id="form-panel" name="Form" action="code.php" autocomplete="off" method="POST" enctype="multipart/form-data" class="h-100 py-3 px-5">
                <!-- back button -->
                <a href="list.php" class="link-offset-2"><i class="bi bi-chevron-left"></i>Go Back</a>

                <?php
                include('../functions/message.php');
                ?>

                <!-- main form -->
                <div class="form-control p-3 mt-3">

                    <!-- general information -->
                    <h3>Create User</h3>

                    <div class="row">
                        <div class="col-5">
                            <!-- First Name -->
                            <label for="first-name">First Name<span class="text-danger">*</span></label>
                            <input id="first-name" type="text" name="first_name" class="form-control form-control-lg mb-2" required>

                            <!-- Last Name -->
                            <label for="last-name">Last Name <span class="text-danger">*</span></label>
                            <input id="last-name" type="text" name="last_name" class="form-control form-control-lg mb-2" required>

                            <!-- Email -->
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input id="email" type="email" name="email" class="form-control form-control-lg mb-2" required>

                            <!-- Password -->
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input id="password" type="text" name="password" class="form-control form-control-lg mb-2" required>
                        </div>

                        <div class="col-5">
                            <!-- Account Type -->
                            <label for="type_name">Account Type <span class="text-danger">*</span></label>
                            <select id="type_name" name="account_type_id" class="w-100 border form-control-lg mb-2" rows="2" required>
                                <?php
                                // php code to display available Account Type from the database
                                // query to select all available Account Type in the database
                                $query2 = "SELECT * FROM account_type";

                                // Executing query
                                $query_run2 = pg_query($connection, $query2);

                                // count rows to check whether we have a account type or not
                                $count2 = pg_num_rows($query_run2);

                                // if count is greater than 0 we have a account type else we do not have a account type
                                if ($count2 > 0) {
                                    // we have a account type
                                    while ($row = pg_fetch_assoc($query_run2)) {
                                        // get the detail of the account type
                                        $account_type_id = $row['account_type_id'];
                                        $type_name = $row['type_name'];
                                ?>
                                        <option value="<?= $account_type_id ?>"><?= $type_name ?></option>
                                    <?php
                                    }
                                } else {
                                    // we do not have a account type
                                    ?>
                                    <option value="0">No Account Type Found</option>
                                <?php
                                }
                                ?>
                            </select>
                            <!-- Gender -->
                            <label for="gender">Gender <span class="text-danger"></span></label>
                            <input id="gender" type="text" name="gender" class="form-control form-control-lg mb-2">

                            <!-- Username -->
                            <label for="username">Username <span class="text-danger"></span></label>
                            <input id="username" type="text" name="username" class="form-control form-control-lg mb-2">

                            <!-- Affiliation -->
                            <label for="affiliation">Affiliation <span class="text-danger"></span></label>
                            <input id="affiliation" type="text" name="affiliation" class="form-control form-control-lg mb-2">
                        </div>
                    </div>

                </div>
                <!-- editting buttons -->
                <?php
                require('../edit-btn/add-btn.php');
                ?>
            </form>
        </section>
    </div>
    <!-- scipts -->
    <!-- custom -->
    <script src="../../js/admin/user-edit.js"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>
</body>

</html>