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

        <!-- sidebar -->
        <?php
        require('../sidebar/side.php');
        ?>
        <!-- space holder of side panel -->
        <section class=" d-none d-md-block col col-3 col-xl-2 p-0 m-0"></section>
        <!-- main panel -->
        <section id="nav-cards" class="p-0 m-0 col col-md-9 col-xl-10 min-vh-100">
            <?php
            if (isset($_GET['farming_id'])) {
                $farming_id = pg_escape_string($connection, $_GET['farming_id']);
                $query = "SELECT * from farming WHERE farming_id='$farming_id'";
                $query_run = pg_query($connection, $query);

                if (pg_num_rows($query_run) > 0) {
                    $farming = pg_fetch_assoc($query_run);
            ?>
                    <!-- form for submitting -->
                    <form id="form-panel" name="Form" action="code.php" autocomplete="off" onsubmit="return validateForm()" method="POST" class="h-100 py-3 px-5">
                        <!-- back button -->
                        <a href="list.php" class="link-offset-2"><i class="bi bi-chevron-left"></i>Go Back</a>

                        <!-- title-->
                        <div class="row d-flex justify-content-between my-3">
                            <div class="col-6">
                                <h3 id="crops-title"><input type="text" name="farming_name" value="<?= $farming['farming_name']; ?>" class="fw-semibold w-100 border-0 py-1 px-2" disabled></h3>
                            </div>
                        </div>

                        <!-- Farming information -->
                        <div id="" class="row form-control p-3">

                        <!-- to get farming_id -->
                        <input type="hidden" name="farming_id" value="<?= $farming['farming_id']; ?>">

                            <!-- Farming information -->
                            <table id="info-table" class="table table-hover table-sm">
                                <tbody>
                                    <tr>
                                        <th class="table-secondary">Description</th>
                                        <td><textarea class="w-100 border-0 p-1" name="description" rows="5" disabled><?= $farming['description']; ?></textarea></td>
                                    </tr>
                                    <tr>
                                        <th class="table-secondary w-25">Image Link</th>
                                        <td><input type="text" name="image" value="<?= $farming['image']; ?>" class="w-100 border-0 p-1"' disabled></td>
							</tr>
                        </tbody>
                        </table>

                        <!-- characteristics of traditional rice -->
                        <table class="table table-hover table-sm">
                            <tbody>
                                <tr>
                                    <th class="table-secondary w-25">Importance</th>
                                    <td><textarea class="w-100 border-0 p-1" name="importance" rows="5" disabled><?= $farming['importance']; ?>
                                    </textarea></td>
                                </tr>
                                <tr>
                                    <th class="table-secondary w-25">Role in Maintaning Upland Ecosystems</th>
                                    <td><textarea class="w-100 border-0 p-1" name="role_in_maintaning_upland_ecosystem" rows="5" disabled><?= $farming['role_in_maintaning_upland_ecosystem']; ?></textarea></td>
                                </tr>
                                <tr>
                                    <th class="table-secondary w-25">Timing</th>
                                    <td><textarea class="w-100 border-0 p-1" name="timing" rows="5" disabled><?= $farming['timing']; ?></textarea></td>
                                </tr>
                                <tr>
                                    <th class="table-secondary w-25">Benefits</th>
                                    <td><textarea class="w-100 border-0 p-1" name="benefits" rows="5" disabled><?= $farming['benefits']; ?></textarea></td>
                                </tr>
                                <tr>
                                    <th class="table-secondary w-25">Environmetal Impacts</th>
                                    <td><textarea class="w-100 border-0 p-1" name="environmental_impacts" rows="5" disabled><?= $farming['environmental_impacts']; ?></textarea></td>
                                </tr>

                        </table>

                        <table class="table table-hover table-sm">
                            <tr>
                                <th class="table-secondary w-25">Considerations</th>
                                <td><textarea class="w-100 border-0 p-1" name="considerations" rows="5" disabled><?= $farming['considerations']; ?></textarea></td>
                            </tr>
                            <tr>
                                <th class="table-secondary w-25">Sustainable Practices</th>
                                <td><textarea class="w-100 border-0 p-1" name="sustainable_practices" rows="5" disabled><?= $farming['sustainable_practices']; ?></textarea></td>
                            </tr>
                            <tr>
                                <th class="table-secondary w-25">History Development</th>
                                <td><textarea class="w-100 border-0 p-1" name="history_development" rows="5" disabled><?= $farming['history_development']; ?></textarea></td>
                            </tr>
                            <tr>
                                <th class="table-secondary w-25">Construction and Maintenance</th>
                                <td><textarea class="w-100 border-0 p-1" name="construction_and_maintenance" rows="5" disabled><?= $farming['construction_and_maintenance']; ?></textarea></td>
                            </tr>
                            <tr>
                                <th class="table-secondary w-25">Challenges</th>
                                <td><textarea class="w-100 border-0 p-1" name="challenges" rows="5" disabled><?= $farming['challenges']; ?></textarea></td>
                            </tr>
                            <tr>
                                <th class="table-secondary w-25">Principles</th>
                                <td><textarea class="w-100 border-0 p-1" name="principles" rows="5" disabled><?= $farming['principles']; ?></textarea></td>
                            </tr>
                        </table>

                        <table class="table table-hover table-sm mb-0">
                            <tr>
                                <th class="table-secondary w-25">Other Info</th>
                                <td><textarea class="w-100 border-0 p-1" name="other_info" rows="5" disabled><?= $farming['other_info']; ?></textarea></td>
                            </tr>
                            </tbody>
                        </table>

                </div>

                <!-- editting buttons -->
                <?php
                    require('../edit-btn/edit-btn.php');
                ?>
            </form>
            <?php
                }
            }
            ?>
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