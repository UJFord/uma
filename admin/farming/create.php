<!-- sidebar -->
<?php
session_start();
require('../sidebar/side.php');
// include('../login/login-check.php');
?>

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
    <title>Crop sa Editor</title>
</head>

<body class="overflow-x-hidden">

    <!-- container of everything -->
    <div class="row">

        <!-- space holder of side panel -->
        <section class=" d-none d-md-block col col-3 col-xl-2 p-0 m-0"></section>
        <!-- main panel -->
        <section id="nav-cards" class="p-0 m-0 col col-md-9 col-xl-10 min-vh-100">

            <!-- form for submitting -->
            <form id="form-panel" name="Form" action="code.php" autocomplete="off" onsubmit="return validateForm()" method="POST" enctype="multipart/form-data" class="h-100 py-3 px-5">
                <!-- back button -->
                <a href="list.php" class="link-offset-2"><i class="bi bi-chevron-left"></i>Go Back</a>

                <?php
                include('../message.php');
                ?>
                <!-- title-->
                <div class="row d-flex justify-content-between my-3">
                    <div class="col-6">
                        <h3 id="crops-title"><input type="text" name="farming_practice_name" placeholder="Display Title" class="fw-semibold w-100 border py-1 px-2"></h3>
                    </div>
                </div>

                <!-- crop information -->

                <!-- Farming Details -->
                <div id="" class="row form-control p-3">
                    <table id="info-table" class="table table-hover table-sm">
                        <tbody>
                            <tr>
                                <th class="table-secondary w-25">Farming Practice Type</th>
                                <td><input type="text" name="farming_practice_type" class="w-100 border p-1"></td>
                            </tr>
                            <tr>
                                <th class="table-secondary">Description</th>
                                <td><textarea class="w-100 border p-1" name="farming_practice_description" placeholder="Enter Description" rows="5"></textarea></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <?php
                require('../edit-btn/add-btn.php');
                ?>
            </form>
        </section>

    </div>

    <!-- scipts -->
    <!-- custom -->
    <script src="../../js/admin/entry-edit.js"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>
</body>

</html>