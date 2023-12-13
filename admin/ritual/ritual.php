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
    <title>Crop as Editor</title>
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
            if (isset($_GET['ritual_id'])) {
                $ritual_id = pg_escape_string($connection, $_GET['ritual_id']);
                $query = "SELECT * from ritual WHERE ritual_id='$ritual_id'";
                $query_run = pg_query($connection, $query);

                if (pg_num_rows($query_run) > 0) {
                    $ritual = pg_fetch_assoc($query_run);
                    $ritual_name = isset($ritual['ritual_name']) ? $ritual['ritual_name'] : null;
                    $description = isset($ritual['description']) ? $ritual['description'] : null;
                    $image = isset($ritual['image']) ? $ritual['image'] : null;
                    $purpose = isset($ritual['purpose']) ? $ritual['purpose'] : null;
                    $timing = isset($ritual['timing']) ? $ritual['timing'] : null;
                    $participants = isset($ritual['participants']) ? $ritual['participants'] : null;
                    $items_used = isset($ritual['items_used']) ? $ritual['items_used'] : null;
                    $other_info = isset($ritual['other_info']) ? $ritual['other_info'] : null;
            ?>

                    <!-- form for submitting -->
                    <form id="form-panel" name="Form" action="code.php" autocomplete="off" onsubmit="return validateForm()" method="POST" class="h-100 py-3 px-5">
                        <!-- back button -->
                        <a href="list.php" class="link-offset-2"><i class="bi bi-chevron-left"></i>Go Back</a>

                        <!-- title-->
                        <div class="row d-flex justify-content-between my-3">
                            <div class="col-6">
                                <?php
                                if ($ritual_name !== null) {
                                ?>
                                    <h3 id="crops-title"><input type="text" name="ritual_name" value="<?= $ritual_name; ?>" class="fw-semibold w-100 border-0 py-1 px-2" disabled></h3>
                                <?php
                                } else {
                                ?>
                                    <h3 id="crops-title"><input type="text" name="ritual_name" placeholder="No Name" class="fw-semibold w-100 border-0 py-1 px-2" disabled></h3>
                                <?php
                                }
                                ?>
                            </div>
                        </div>

                        <!-- crop information -->
                        <div id="" class="row form-control p-3">

                            <!-- to get the ritual id -->
                            <input type="hidden" name="ritual_id" value="<?= $ritual['ritual_id']; ?>">

                            <!-- Ritual Information -->
                            <table id="info-table" class="table table-hover table-sm">
                                <tbody>
                                    <?php
                                    if ($description !== null) {
                                    ?>
                                        <tr>
                                            <th class="table-secondary w-25">Description</th>
                                            <td><textarea class="w-100 border-0 p-1" name="description" rows="5" disabled><?= $description; ?></textarea></td>
                                        </tr>
                                    <?php
                                    } else {
                                    ?>
                                        <tr>
                                            <th class="table-secondary w-25">Description</th>
                                            <td><textarea class="w-100 border-0 p-1" name="description" rows="5" placeholder="Empty" disabled></textarea></td>
                                        </tr>
                                    <?php
                                    }

                                    if ($image !== null) {
                                    ?>
                                        <tr>
                                            <th class="table-secondary w-25">Image Link</th>
                                            <td><textarea class="w-100 border-0 p-1" name="image" rows="5" disabled><?= $image; ?></textarea></td>
                                        </tr>
                                    <?php
                                    } else {
                                    ?>
                                        <tr>
                                            <th class="table-secondary w-25">Image Link</th>
                                            <td><textarea class="w-100 border-0 p-1" name="image" rows="5" placeholder="Empty" disabled></textarea></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <table class="table table-hover table-sm">
                                <tbody>
                                    <?php
                                    if ($purpose !== null) {
                                    ?>
                                        <tr>
                                            <th class="table-secondary w-25">Purpose</th>
                                            <td><textarea class="w-100 border-0 p-1" name="purpose" rows="5" disabled><?= $purpose; ?></textarea></td>
                                        </tr>
                                    <?php
                                    } else {
                                    ?>
                                        <tr>
                                            <th class="table-secondary w-25">Purpose</th>
                                            <td><textarea class="w-100 border-0 p-1" name="purpose" rows="5" placeholder="Empty" disabled></textarea></td>
                                        </tr>
                                    <?php
                                    }

                                    if ($timing !== null) {
                                    ?>
                                        <tr>
                                            <th class="table-secondary w-25">Timing</th>
                                            <td><textarea class="w-100 border-0 p-1" name="timing" rows="5" disabled><?= $timing; ?></textarea></td>
                                        </tr>
                                    <?php
                                    } else {
                                    ?>
                                        <tr>
                                            <th class="table-secondary w-25">Timing</th>
                                            <td><textarea class="w-100 border-0 p-1" name="timing" rows="5" placeholder="Empty" disabled></textarea></td>
                                        </tr>
                                    <?php
                                    }

                                    if ($participants !== null) {
                                    ?>
                                        <tr>
                                            <th class="table-secondary w-25">Participants</th>
                                            <td><textarea class="w-100 border-0 p-1" name="participants" rows="5" disabled><?= $participants; ?></textarea></td>
                                        </tr>
                                    <?php
                                    } else {
                                    ?>
                                        <tr>
                                            <th class="table-secondary w-25">Participants</th>
                                            <td><textarea class="w-100 border-0 p-1" name="participants" rows="5" placeholder="Empty" disabled></textarea></td>
                                        </tr>
                                    <?php
                                    }
                                    if ($items_used !== null) {
                                    ?>
                                        <tr>
                                            <th class="table-secondary w-25">Items used</th>
                                            <td><textarea class="w-100 border-0 p-1" name="items_used" rows="5" disabled><?= $items_used; ?></textarea></td>
                                        </tr>
                                    <?php
                                    } else {
                                    ?>
                                        <tr>
                                            <th class="table-secondary w-25">Items used</th>
                                            <td><textarea class="w-100 border-0 p-1" name="items_used" rows="5" placeholder="Empty" disabled></textarea></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <!-- other info -->
                            <table class="table table-hover table-sm mb-0">
                                <tbody>
                                    <?php
                                    if ($other_info !== null) {
                                    ?>
                                        <tr>
                                            <th class="table-secondary w-25">Other Info</th>
                                            <td><textarea class="w-100 border-0 p-1" rows="5" name="other_info" disabled><?= $other_info; ?></textarea></td>
                                        </tr>
                                    <?php
                                    } else {
                                    ?>
                                        <tr>
                                            <th class="table-secondary w-25">Other Info</th>
                                            <td><textarea class="w-100 border-0 p-1" rows="5" name="other_info" placeholder="Empty" disabled></textarea></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
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