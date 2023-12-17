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
    <title>Tribe as Editor</title>
</head>

<body class="overflow-x-hidden">

    <!-- container of everything -->
    <div class="row">

        <!-- sidebar -->
        <?php
        require('../sidebar/side.php');
        ?>
        <!-- space holder of side panel -->
        <section class=" d-none d-md-block col col-3 col-xl-2 p-0 m-0"></section>
        <!-- main panel -->
        <section id="nav-cards" class="p-0 m-0 col col-md-9 col-xl-10 min-vh-100">

            <!-- form for submitting -->
            <form id="form-panel" name="Form" action="code.php" autocomplete="off" onsubmit="return validateForm()" method="POST" class="h-100 py-3 px-5">
                <!-- back button -->
                <a href="list.php" class="link-offset-2"><i class="bi bi-chevron-left"></i>Go Back</a>

                <!-- title-->
                <div class="row d-flex justify-content-between my-3">
                    <div class="col-6">
                        <h3 id="crops-title"><input type="text" name="tribe_name" placeholder="Display Title" class="fw-semibold w-100 border py-1 px-2"></h3>
                    </div>
                </div>

                <!-- tribe information -->
                <div id="" class="row form-control p-3">

                    <table class="table table-hover table-sm">

                        <tbody>
                            <tr>
                                <th class="table-secondary w-25" scope="row">Image Link</th>
                                <td><input type="text" name="image" placeholder="Enter Image Link" class="w-100 border p-1"></td>
                            </tr>
                            <tr>
                                <th class="table-secondary w-25" scope="row">Location</th>
                                <td><input type="text" name="location" placeholder="Enter Location" class="w-100 border p-1"></td>
                            </tr>
                            <tr>
                                <th class="table-secondary">Language and Dialect</th>
                                <td><input type="text" name="language_and_dialect" placeholder="Enter Language and Dialect" class="w-100 border p-1"></td>
                            </tr>
                            <tr>
                                <th class="table-secondary">Population</th>
                                <td><input type="text" name="population" placeholder="Enter Population" class="w-100 border p-1"></td>
                            </tr>
                            <tr>
                                <th class="table-secondary">Livelihood and Practices</th>
                                <td><input type="text" name="livelihood_and_practices" placeholder="Enter Livelihood and Practices" class="w-100 border p-1"></td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-hover table-sm">
                        <tbody>
                            <tr>
                                <th class="table-secondary w-25" scope="row">Farming Practices</th>
                                <td><input type="text" name="farming_practices" placeholder="Enter Farming Practices" class="w-100 border p-1"></td>
                            </tr>
                            <tr>
                                <th class="table-secondary">Social Structure and Kinship System</th>
                                <td><input type="text" name="social_structure_and_kinship_system" placeholder="Enter Social Structure and Kinship System" class="w-100 border p-1"></td>
                            </tr>
                            <tr>
                                <th class="table-secondary">Beliefs and Customs</th>
                                <td><input type="text" name="beliefs_and_customs" placeholder="Enter Beliefs and Customs" class="w-100 border p-1"></td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-hover table-sm">
                        <tbody>
                            <tr>
                                <th class="table-secondary w-25" scope="row">Challenges and Threats</th>
                                <td><input type="text" name="challenges_and_threats" placeholder="Enter Challenges and Threats" class="w-100 border p-1"></td>
                            </tr>
                            <tr>
                                <th class="table-secondary">Efforts of Revitalization</th>
                                <td><input type="text" name="efforts_of_revitalization" placeholder="Enter Efforts of Revitalization" class="w-100 border p-1"></td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-hover table-sm mb-0">
                        <tbody>
                            <tr>
                                <th class="table-secondary w-25" scope="row">Other Info</th>
                                <td><input type="text" name="other_info" placeholder="Enter Other Info" class="w-100 border p-1"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Add button -->
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