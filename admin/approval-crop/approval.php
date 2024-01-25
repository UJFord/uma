<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

    <!-- list custom css -->
    <link rel="stylesheet" href="../../css/admin/list.css" />
    <!-- sidebar custom css -->
    <link rel="stylesheet" href="../../css/admin/side.css">

    <!-- favicon -->
    <link rel="shortcut icon" href="img/logo/Uma logo.svg" type="image/x-icon" />
    <title>Uma | AdminPage</title>
    <?php
    session_start();
    require('../sidebar/side.php');
    ?>
    <!-- Check access when the page loads -->
    <script>
        // Assume you have the userRole variable defined somewhere in your PHP code
        var userRole = "<?php echo isset($_SESSION['rank']) ? $_SESSION['rank'] : ''; ?>";
        checkAccess(userRole);
    </script>
</head>

<body class="overflow-hidden">

    <!-- container of everything -->
    <div class="row ">
        <!-- space holder of side panel -->
        <section class=" d-none d-md-block col col-4 col-lg-3 col-xl-2 p-0 m-0"></section>
        <!-- main panel -->
        <section id="nav-cards" class="p-0 m-0 col col-md-4 col-lg-9 col-xl-10">
            <div class=" py-3 px-4">
                <!-- title and filter -->
                <div class="row d-flex justify-content-between mb-3">
                    <!-- title -->
                    <div class="col-6">
                        <h2 id="crops-title" class="fw-semibold">Approval Crops</h2>
                    </div>

                    <h1 class="text-center  text-white bg-dark col-md-12">PENDING LIST</h1>

                    <table class="table table-bordered col-md-12">
                        <thead>
                            <tr>
                                <th scope="col">Sent By</th>
                                <th scope="col">Crop Name</th>
                                <th scope="col">local Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">STATUS</th>
                                <th scope="col" class="curator-only">ACTION</th>
                            </tr>
                        </thead>

                        <?php
                        $query = "SELECT crop.*, users.first_name, users.email, account_type.type_name, crop_location.*, crop_farming_practice.*, crop_other_info.*
                        FROM crop
                        JOIN users ON crop.user_id = users.user_id
                        JOIN crop_location ON crop.crop_id = crop_location.crop_id
                        JOIN crop_farming_practice ON crop.crop_id = crop_farming_practice.crop_id
                        JOIN crop_other_info ON crop.crop_id = crop_other_info.crop_id
                        JOIN account_type ON users.account_type_id = account_type.account_type_id
                        WHERE crop.status = 'pending'
                        ORDER BY crop.crop_id ASC";
                        $result = pg_query($connection, $query);

                        if ($result) {
                            while ($row = pg_fetch_array($result)) {
                        ?>
                                <tbody>
                                    <tr>
                                        <th scope="row"><?php echo $row['first_name']; ?></th>
                                        <td><?php echo $row['crop_name']; ?></td>
                                        <td><?php echo $row['crop_local_name']; ?></td>
                                        <td><?php echo $row['crop_description']; ?></td>
                                        <td><?php echo $row['status']; ?></td>
                                        <td class="curator-only">
                                            <form action="code.php" method="POST">
                                                <input type="hidden" name="crop_id" value="<?php echo $row['crop_id']; ?>" />
                                                <input type="hidden" name="other_info_id" value="<?php echo $row['other_info_id']; ?>" />
                                                <input type="hidden" name="location_id" value="<?php echo $row['location_id']; ?>" />
                                                <input type="hidden" name="farming_practice_id" value="<?php echo $row['farming_practice_id']; ?>" />
                                                <input type="hidden" name="email" value="<?php echo $row['email']; ?>" />
                                                <input type="submit" name="approve" value="approve"> &nbsp &nbsp <br>
                                                <input type="submit" name="delete" value="delete">
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                        <?php
                            }
                        } else {
                            echo "Query failed: " . pg_last_error($connection);
                        }
                        ?>
                    </table>
                    <!-- ================================================================== -->
                    &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                    <h1 class="text-center  text-white bg-success col-md-12
                    ">APPROVED LIST </h1>
                    <table class="table table-bordered col-md-12">
                        <thead>
                            <tr>
                                <th scope="col">Sent By</th>
                                <th scope="col">Crop Name</th>
                                <th scope="col">local Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">STATUS</th>
                            </tr>
                        </thead>
                        <?php

                        $query = "SELECT crop.*, users.first_name, account_type.*
                        FROM crop
                        JOIN users ON crop.user_id = users.user_id
                        JOIN account_type ON users.account_type_id = account_type.account_type_id
                        WHERE crop.status = 'approved' AND account_type.type_name != 'curator'";
                        $result2 = pg_query($connection, $query);

                        if ($result2) {
                            while ($row = pg_fetch_array($result2)) {
                        ?>
                                <tbody>
                                    <tr>
                                        <th scope="row"><?php echo $row['first_name']; ?></th>
                                        <td><?php echo $row['crop_name']; ?></td>
                                        <td><?php echo $row['crop_local_name']; ?></td>
                                        <td><?php echo $row['crop_description']; ?></td>
                                        <td><?php echo $row['status']; ?></td>
                                    </tr>
                                </tbody>
                        <?php
                            }
                        } else {
                            echo "Query failed: " . pg_last_error($connection);
                        }

                        ?>

                    </table>
                </div>
            </div>
        </section>

    </div>

    <!-- scipts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>
</body>

</html>