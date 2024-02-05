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
                        <h2 id="crops-title" class="fw-semibold">Approval Users</h2>
                    </div>
                    <?php
                    // Set the number of items to display per page
                    $items_per_page = 5;

                    // Get the current page number
                    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

                    // Calculate the offset based on the current page and items per page
                    $offset = ($current_page - 1) * $items_per_page;

                    // Count the total number of rows for pagination
                    $total_rows_query = "SELECT COUNT(*) FROM users WHERE email_verified is null";
                    $total_rows_result = pg_query($connection, $total_rows_query);
                    $total_rows = pg_fetch_row($total_rows_result)[0];

                    // Calculate the total number of pages
                    $total_pages = ceil($total_rows / $items_per_page);
                    ?>

                    <h1 class="text-center  text-white bg-dark col-md-12">PENDING LIST</h1>

                    <!-- Header -->
                    <table class="table table-bordered col-md-12">
                        <thead>
                            <tr>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Affiliation</th>
                                <th scope="col">Registration Date</th>
                                <th scope="col">STATUS</th>
                                <th scope="col" class="curator-only">ACTION</th>
                            </tr>
                        </thead>

                        <?php
                        $query = "SELECT users.user_id, users.first_name, users.last_name, users.affiliation, users.registration_date, account_type.type_name
                        FROM users
                        JOIN account_type ON users.account_type_id = account_type.account_type_id
                        WHERE users.email_verified IS NULL
                        ORDER BY users.user_id ASC LIMIT $items_per_page OFFSET $offset";
                        $result = pg_query($connection, $query);

                        if ($result) {
                            while ($row = pg_fetch_array($result)) {
                        ?>
                                <!-- Body -->
                                <tbody>
                                    <tr>
                                        <th scope="row"><?php echo $row['first_name']; ?></th>
                                        <td><?php echo $row['last_name']; ?></td>
                                        <td><?php echo $row['affiliation']; ?></td>
                                        <td><?php echo $row['registration_date']; ?></td>
                                        <td><?php echo $row['type_name']; ?></td>
                                        <td class="curator-only">
                                            <form action="code.php" method="POST">
                                                <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>" />
                                                <a href="view.php?user_id=<?= $row['user_id']; ?>" class="btn btn-info btn-sm">View</a>
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
                    <!-- Add pagination links -->
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="pagination justify-content-center">
                                <?php for ($page = 1; $page <= $total_pages; $page++) : ?>
                                    <li class="page-item <?php echo ($current_page == $page) ? 'active' : ''; ?>">
                                        <a class="page-link" href="?page=<?php echo $page; ?>"><?php echo $page; ?></a>
                                    </li>
                                <?php endfor; ?>
                            </ul>
                        </div>
                    </div>
                    <!-- ================================================================== -->
                    &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                    <h1 class="text-center  text-white bg-success col-md-12
                    ">APPROVED LIST </h1>

                    <?php
                    // Set the number of items to display per page
                    $items_per_page = 5;

                    // Get the current page number
                    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

                    // Calculate the offset based on the current page and items per page
                    $offset = ($current_page - 1) * $items_per_page;

                    // Count the total number of rows for pagination
                    $total_rows_query = "SELECT COUNT(*) FROM users left join account_type on users.account_type_id = account_type.account_type_id WHERE users.email_verified is not null and account_type.account_type_id <> 'curator'";
                    $total_rows_result = pg_query($connection, $total_rows_query);
                    $total_rows = pg_fetch_row($total_rows_result)[0];

                    // Calculate the total number of pages
                    $total_pages = ceil($total_rows / $items_per_page);
                    ?>

                    <table class="table table-bordered col-md-12">
                        <thead>
                            <tr>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Affiliation</th>
                                <th scope="col">Registration Date</th>
                                <th scope="col">STATUS</th>
                            </tr>
                        </thead>
                        <?php

                        $query = "SELECT u.first_name, u.last_name, u.affiliation, u.registration_date, u.email_verified, a.type_name
                        FROM users u
                        JOIN account_type a ON u.account_type_id = a.account_type_id
                        WHERE u.email_verified IS NOT NULL AND a.type_name <> 'curator'";

                        $result2 = pg_query($connection, $query);

                        if ($result2) {
                            while ($row = pg_fetch_array($result2)) {
                        ?>
                                <tbody>
                                    <tr>
                                        <th scope="row"><?php echo $row['first_name']; ?></th>
                                        <td><?php echo $row['last_name']; ?></td>
                                        <td><?php echo $row['affiliation']; ?></td>
                                        <td><?php echo $row['registration_date']; ?></td>
                                        <td>
                                            <?php
                                            if ($row['email_verified'] != '') {
                                                echo 'Verified';
                                            }
                                            ?>
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
                    <!-- Add pagination links -->
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="pagination justify-content-center">
                                <?php for ($page = 1; $page <= $total_pages; $page++) : ?>
                                    <li class="page-item <?php echo ($current_page == $page) ? 'active' : ''; ?>">
                                        <a class="page-link" href="?page=<?php echo $page; ?>"><?php echo $page; ?></a>
                                    </li>
                                <?php endfor; ?>
                            </ul>
                        </div>
                    </div>
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