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

                <?php
                if (isset($_GET['farming_id'])) {
                    $farming_id = pg_escape_string($connection, $_GET['farming_id']);
                    $query = "SELECT * from farming WHERE farming_id='$farming_id'";
                    $query_run = pg_query($connection, $query);

                    $emptyValue = 'Empty';

                    if (pg_num_rows($query_run) > 0) {
                        $farming = pg_fetch_assoc($query_run);
                        $current_farming_image = $farming['image'];

                        $farming_name = isset($farming['farming_name']) ? htmlspecialchars($farming['farming_name'], ENT_QUOTES) : $emptyValue;
                        $description = isset($farming['description']) ? htmlspecialchars($farming['description'], ENT_QUOTES) : $emptyValue;
                        $image = isset($farming['image']) ? htmlspecialchars($farming['image'], ENT_QUOTES) : $emptyValue;
                        $importance = isset($farming['importance']) ? htmlspecialchars($farming['importance'], ENT_QUOTES) : $emptyValue;
                        $role_in_maintaining_upland_ecosystem = isset($farming['role_in_maintaining_upland_ecosystem']) ? htmlspecialchars($farming['role_in_maintaining_upland_ecosystem'], ENT_QUOTES) : $emptyValue;
                        $timing = isset($farming['timing']) ? htmlspecialchars($farming['timing'], ENT_QUOTES) : $emptyValue;
                        $benefits = isset($farming['benefits']) ? htmlspecialchars($farming['benefits'], ENT_QUOTES) : $emptyValue;
                        $environmental_impacts = isset($farming['environmental_impacts']) ? htmlspecialchars($farming['environmental_impacts'], ENT_QUOTES) : $emptyValue;
                        $considerations = isset($farming['considerations']) ? htmlspecialchars($farming['considerations'], ENT_QUOTES) : $emptyValue;
                        $sustainable_practices = isset($farming['sustainable_practices']) ? htmlspecialchars($farming['sustainable_practices'], ENT_QUOTES) : $emptyValue;
                        $history_development = isset($farming['history_development']) ? htmlspecialchars($farming['history_development'], ENT_QUOTES) : $emptyValue;
                        $construction_and_maintenance = isset($farming['construction_and_maintenance']) ? htmlspecialchars($farming['construction_and_maintenance'], ENT_QUOTES) : $emptyValue;
                        $challenges = isset($farming['challenges']) ? htmlspecialchars($farming['challenges'], ENT_QUOTES) : $emptyValue;
                        $principles = isset($farming['principles']) ? htmlspecialchars($farming['principles'], ENT_QUOTES) : $emptyValue;
                        $other_info = isset($farming['other_info']) ? htmlspecialchars($farming['other_info'], ENT_QUOTES) : $emptyValue;

                ?>
                        <!-- title-->
                        <div class="row d-flex justify-content-between my-3">
                            <div class="col-6">
                                <h3 id="crops-title"><input type="text" name="farming_name" <?php echo ($farming_name != $emptyValue) ? 'value="' . $farming_name . '"' : 'placeholder="Empty"'; ?> class="fw-semibold w-100 border-0 py-1 px-2" disabled></h3>
                            </div>
                        </div>

                        <!-- Farming information -->
                        <div id="" class="row form-control p-3">

                            <!-- to get farming_id -->
                            <input type="hidden" name="farming_id" value="<?= $farming['farming_id']; ?>">
                            <input type="hidden" name="current_farming_image" value="<?= $current_farming_image; ?>">

                            <!-- Farming information -->
                            <table id="info-table" class="table table-hover table-sm">
                                <tbody>
                                    <tr>
                                        <th class="table-secondary w-25">Description</th>
                                        <td><textarea class="w-100 border-0 p-1" name="description" rows="5" disabled <?php echo ($description !== $emptyValue) ? '>' . $description : 'placeholder="Empty">'; ?></textarea></td>
                                        </tr>
                                        <tr>
                                            <th class="table-secondary w-25">Image Link</th>
                                            <td>
                                                <?php
                                                if ($current_farming_image != "") {
                                                    // Display the image
                                                ?>
                                                    <img src="<?php echo 'http://localhost/incognito-capstone/admin/'; ?>img/farming/<?php echo $current_farming_image; ?>" width="150px">
                                                    <input id="image" type="file" name="image" Hidden>
                                                <?php
                                                } else {
                                                    // display message
                                                    echo "Image not added";
                                                ?>
                                                    <input id="image" type="file" name="image" Hidden>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="table table-hover table-sm">
                                <tbody>
                                    <tr>
                                        <th class="table-secondary w-25">Importance</th>
                                        <td><textarea class="w-100 border-0 p-1" name="importance" rows="5" disabled <?php echo ($importance !== $emptyValue) ? '>' . $importance : 'placeholder="Empty">'; ?></textarea></td>
                                    </tr>
                                    <tr>
                                        <th class="table-secondary w-25">Role in Maintaning pland Ecosystem</th>
                                        <td><textarea class="w-100 border-0 p-1" name="role_in_maintaining_upland_ecosystem" rows="5" disabled <?php echo ($role_in_maintaining_upland_ecosystem !== $emptyValue) ? '>' . $role_in_maintaining_upland_ecosystem : 'placeholder="Empty">'; ?></textarea></td>
                                    </tr>
                                    <tr>
                                        <th class="table-secondary w-25">Timing</th>
                                        <td><textarea class="w-100 border-0 p-1" name="timing" rows="5" disabled <?php echo ($timing !== $emptyValue) ? '>' . $timing : 'placeholder="Empty">'; ?></textarea></td>
                                    </tr>
                                    <tr>
                                        <th class="table-secondary w-25">Benefits</th>
                                        <td><textarea class="w-100 border-0 p-1" name="benefits" rows="5" disabled <?php echo ($benefits !== $emptyValue) ? '>' . $benefits : 'placeholder="Empty">'; ?></textarea></td>
                                    </tr>
                                    <tr>
                                        <th class="table-secondary w-25">Environmetal Impacts</th>
                                        <td><textarea class="w-100 border-0 p-1" name="environmental_impacts" rows="5" disabled <?php echo ($environmental_impacts !== $emptyValue) ? '>' . $environmental_impacts : 'placeholder="Empty">'; ?></textarea></td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="table table-hover table-sm">

                                <body>
                                    <tr>
                                        <th class="table-secondary w-25">Considerations</th>
                                        <td><textarea class="w-100 border-0 p-1" name="considerations" rows="5" disabled <?php echo ($considerations !== $emptyValue) ? '>' . $considerations : 'placeholder="Empty">'; ?></textarea></td>
                                    </tr>
                                    <tr>
                                        <th class="table-secondary w-25">Sustainable Practices</th>
                                        <td><textarea class="w-100 border-0 p-1" name="sustainable_practices" rows="5" disabled <?php echo ($sustainable_practices !== $emptyValue) ? '>' . $sustainable_practices : 'placeholder="Empty">'; ?></textarea></td>
                                    </tr>
                                    <tr>
                                        <th class="table-secondary w-25">History Development</th>
                                        <td><textarea class="w-100 border-0 p-1" name="history_development" rows="5" disabled <?php echo ($history_development !== $emptyValue) ? '>' . $history_development : 'placeholder="Empty">'; ?></textarea></td>
                                    </tr>
                                    <tr>
                                        <th class="table-secondary w-25">Construction and Maintenance</th>
                                        <td><textarea class="w-100 border-0 p-1" name="construction_and_maintenance" rows="5" disabled <?php echo ($construction_and_maintenance !== $emptyValue) ? '>' . $construction_and_maintenance : 'placeholder="Empty">'; ?></textarea></td>
                                    </tr>
                                    <tr>
                                        <th class="table-secondary w-25">Challenges</th>
                                        <td><textarea class="w-100 border-0 p-1" name="challenges" rows="5" disabled <?php echo ($challenges !== $emptyValue) ? '>' . $challenges : 'placeholder="Empty">'; ?></textarea></td>
                                    </tr>
                                    <tr>
                                        <th class="table-secondary w-25">Principles</th>
                                        <td><textarea class="w-100 border-0 p-1" name="principles" rows="5" disabled <?php echo ($principles !== $emptyValue) ? '>' . $principles : 'placeholder="Empty">'; ?></textarea></td>
                                    </tr>
                                </body>
                            </table>

                            <table class="table table-hover table-sm mb-0">
                                <tbody>
                                    <tr>
                                        <th class="table-secondary w-25">Other Info</th>
                                        <td><textarea class="w-100 border-0 p-1" name="other_info" rows="5" disabled <?php echo ($other_info !== $emptyValue) ? '>' . $other_info : 'placeholder="Empty">'; ?></textarea></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                <?php
                    }
                }
                ?>
                <!-- editting buttons -->
                <?php
                require('../edit-btn/edit-btn.php');
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