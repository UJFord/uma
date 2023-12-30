<?php
ob_start(); // Start output buffering
session_start();
require('../sidebar/side.php');
ob_end_flush(); // Send output to the browser
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <!-- cutom css -->
    <link rel="stylesheet" href="../../css/admin/list.css" />
    <!-- favicon -->
    <link rel="shortcut icon" href="img/logo/Uma logo.svg" type="image/x-icon" />
    <title>Uma | AdminPage</title>
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
                        <h2 id="crops-title" class="fw-semibold">Approval</h2>
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
                        $query = "SELECT crops.*, users.username FROM crops
                                JOIN users ON crops.user_id = users.user_id
                                WHERE status = 'pending'
                                AND users.rank != 'curator'
                                ORDER BY crop_id ASC";
                        $result = pg_query($connection, $query);
                        while ($row = pg_fetch_array($result)) {
                        ?>
                            <tbody>
                                <tr>
                                    <th scope="row"><?php echo $row['username']; ?></th>
                                    <td><?php echo $row['crop_name']; ?></td>
                                    <td><?php echo $row['local_name']; ?></td>
                                    <td><?php echo $row['description']; ?></td>
                                    <td><?php echo $row['status']; ?></td>
                                    <td class="curator-only">
                                        <form action="code.php" method="POST">
                                            <input type="hidden" name="crop_id" value="<?php echo $row['crop_id']; ?>" />
                                            <input type="submit" name="approve" value="approve"> &nbsp &nbsp <br>
                                            <input type="submit" name="delete" value="delete">
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        <?php
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
                        $query = "SELECT crops.*, users.username
                                FROM crops
                                JOIN users ON crops.user_id = users.user_id
                                WHERE crops.status = 'approved'
                                AND users.rank != 'curator'";
                        $result = pg_query($connection, $query);
                        while ($row = pg_fetch_array($result)) {
                        ?>
                            <tbody>
                                <tr>
                                    <th scope="row"><?php echo $row['username']; ?></th>
                                    <td><?php echo $row['crop_name']; ?></td>
                                    <td><?php echo $row['local_name']; ?></td>
                                    <td><?php echo $row['description']; ?></td>
                                    <td><?php echo $row['status']; ?></td>
                                </tr>
                            </tbody>
                        <?php
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
    <!-- script fort access level -->
    <script>
        // script for access levels in admin
        // hide or show based on account type
        document.addEventListener("DOMContentLoaded", function() {
            // Use PHP to set the user role dynamically
            var userRole = "<?php echo $_SESSION['rank']; ?>";
            var addEntryCard = document.getElementById("add-entry-card");

            // Elements to show/hide based on user role
            var curatorElements = document.querySelectorAll(".curator-only");
            var adminElements = document.querySelectorAll(".admin-only");
            var viewerElements = document.querySelectorAll(".viewer-only");

            // Function to set visibility based on user role
            function setVisibility(elements, isVisible) {
                elements.forEach(function(element) {
                    element.style.display = isVisible ? "block" : "none";
                });
            }

            // Check user role and set visibility
            if (userRole === "curator") {
                setVisibility(curatorElements, true);
                setVisibility(adminElements, true);
                setVisibility(viewerElements, false);
            } else if (userRole === "admin") {
                setVisibility(curatorElements, false);
                setVisibility(adminElements, true);
                setVisibility(viewerElements, false);
            } else if (userRole === "user") {
                setVisibility(curatorElements, false);
                setVisibility(adminElements, false);
                setVisibility(viewerElements, true);
            } else {
                console.error("Unexpected user role:", userRole);
            }
        });
    </script>
</body>

</html>