<!-- sidebar -->
<?php
session_start();
require('../sidebar/side.php');
// include('../login/login-check.php');
// include '../access.php';
// access('ADMIN');
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

    <!-- script fort access level -->
    <!-- wala pani gagana nga js ambot nganuman gi inline ra sa nako -->
    <script src="../../js/admin/access.js"></script>
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

                        <h1 class="text-center  text-white bg-dark col-md-12">PENDING LIST</h1>

                        <table class="table table-bordered col-md-12">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">SUBJECT</th>
                                    <th scope="col">CONTENT</th>
                                    <th scope="col">STATUS</th>
                                    <th scope="col">ACTION</th>
                                </tr>
                            </thead>

                            <!-- <?php

                            $query = "SELECT * FROM  crops WHERE status = 'pending' ORDER BY id ASC";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_array($result)) { ?>


                                <tbody>
                                    <tr>
                                        <th scope="row"><?php echo $row['id']; ?></th>
                                        <td><?php echo $row['subject']; ?></td>
                                        <td><?php echo $row['content']; ?></td>
                                        <td><?php echo $row['status']; ?></td>


                                        <td>
                                            <form action="approved.php" method="POST">
                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                                                <input type="submit" name="approve" value="approve"> &nbsp &nbsp <br>
                                                <input type="submit" name="delete" value="delete">

                                            </form>
                                        </td>
                                    </tr>

                                </tbody>
                            <?php } ?> -->
                        </table>


                        <!-- <?php
                        if (isset($_POST['approve'])) {

                            $id = $_POST['id'];
                            $select = "UPDATE pending_list SET status = 'approved' WHERE id = '$id' ";
                            $resut = mysqli_query($conn, $select);
                            header("location:approved.php");
                        }


                        if (isset($_POST['delete'])) {

                            $id = $_POST['id'];
                            $select = "DELETE  FROM pending_list  WHERE id = '$id' ";
                            $resut = mysqli_query($conn, $select);
                            header("location:approved.php");
                        }
                        ?> -->

                    </div>

                </div>
            </div>
        </section>

    </div>

    <!-- scipts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>

    <script>
        // script for access levels in admin
        // hide or show based on account type
        document.addEventListener("DOMContentLoaded", function() {
            // Use PHP to set the user role dynamically
            var userRole = "<?php echo $_SESSION['rank']; ?>";
            var addEntryCard = document.getElementById("add-entry-card");

            // Elements to show/hide based on user role
            var adminElements = document.querySelectorAll(".admin-only");
            var viewerElements = document.querySelectorAll(".viewer-only");

            // Function to set visibility based on user role
            function setVisibility(elements, isVisible) {
                elements.forEach(function(element) {
                    element.style.display = isVisible ? "block" : "none";
                });
            }

            // Check user role and set visibility
            if (userRole === "admin") {
                setVisibility(adminElements, true);
                setVisibility(viewerElements, false);
                addEntryCard.hidden = false;
            } else if (userRole === "user") {
                setVisibility(adminElements, false);
                setVisibility(viewerElements, true);
                addEntryCard.hidden = true;
            } else {
                console.error("Unexpected user role:", userRole);
            }
        });
    </script>
</body>

</html>