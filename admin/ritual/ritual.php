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

                $emptyValue = 'Empty';

                if (pg_num_rows($query_run) > 0) {
                    $ritual = pg_fetch_assoc($query_run);
                    $ritual_name = isset($ritual['ritual_name']) ? htmlspecialchars($ritual['ritual_name'], ENT_QUOTES) : $emptyValue;
                    $description = isset($ritual['description']) ? htmlspecialchars($ritual['description'], ENT_QUOTES) : $emptyValue;
                    $image = isset($ritual['image']) ? htmlspecialchars($ritual['image'], ENT_QUOTES) : $emptyValue;
                    $purpose = isset($ritual['purpose']) ? htmlspecialchars($ritual['purpose'], ENT_QUOTES) : $emptyValue;
                    $timing = isset($ritual['timing']) ? htmlspecialchars($ritual['timing'], ENT_QUOTES) : $emptyValue;
                    $participants = isset($ritual['participants']) ? htmlspecialchars($ritual['participants'], ENT_QUOTES) : $emptyValue;
                    $items_used = isset($ritual['items_used']) ? htmlspecialchars($ritual['items_used'], ENT_QUOTES) : $emptyValue;
                    $other_info = isset($ritual['other_info']) ? htmlspecialchars($ritual['other_info'], ENT_QUOTES) : $emptyValue;
            ?>

                    <!-- form for submitting -->
                    <form id="form-panel" name="Form" action="code.php" autocomplete="off" onsubmit="return validateForm()" method="POST" class="h-100 py-3 px-5">
                        <!-- back button -->
                        <a href="list.php" class="link-offset-2"><i class="bi bi-chevron-left"></i>Go Back</a>

                        <!-- title-->
                        <div class="row d-flex justify-content-between my-3">
                            <div class="col-6">
                                <h3 id="crops-title">
                                    <input type="text" name="ritual_name" <?php echo ($ritual_name != $emptyValue) ? 'value="' . $ritual_name . '"' : 'placeholder="Empty"'; ?> class="fw-semibold w-100 border-0 py-1 px-2" disabled>
                                </h3>
                            </div>
                        </div>

                        <!-- crop information -->
                        <div id="" class="row form-control p-3">

                            <!-- to get the ritual id -->
                            <input type="hidden" name="ritual_id" value="<?= $ritual['ritual_id']; ?>">

                            <!-- Ritual Information -->
                            <table id="info-table" class="table table-hover table-sm">
                                <tbody>
                                    <tr>
                                        <th class="table-secondary w-25">Description</th>
                                        <td>
                                            <textarea class="w-100 border-0 p-1" name="description" rows="5" disabled <?php echo ($description !== $emptyValue) ? '>' . $description : 'placeholder="Empty">'; ?></textarea>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th class="table-secondary w-25">Image Link</th>
                                        <td>
                                            <textarea class="w-100 border-0 p-1" name="image" rows="5" disabled <?php echo ($image !== $emptyValue) ? '>' . $image : 'placeholder="Empty">'; ?></textarea>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="table table-hover table-sm">
                                <tbody>
                                    <tr>
                                        <th class="table-secondary w-25">Purpose</th>
                                        <td><textarea class="w-100 border-0 p-1" name="purpose" rows="5" disabled <?php echo ($purpose !== $emptyValue) ? '>' . $purpose : 'placeholder="Empty">'; ?></textarea></td>
                                    </tr>
                                    <tr>
                                        <th class="table-secondary w-25">Timing</th>
                                        <td><textarea class="w-100 border-0 p-1" name="timing" rows="5" disabled <?php echo ($timing !== $emptyValue) ? '>' . $timing : 'placeholder="Empty">'; ?></textarea></td>
                                    </tr>
                                    <tr>
                                        <th class="table-secondary w-25">Participants</th>
                                        <td><textarea class="w-100 border-0 p-1" name="participants" rows="5" disabled <?php echo ($participants !== $emptyValue) ? '>' . $participants : 'placeholder="Empty">'; ?></textarea></td>
                                    </tr>
                                    <tr>
                                        <th class="table-secondary w-25">Items used</th>
                                        <td><textarea class="w-100 border-0 p-1" name="items_used" rows="5" disabled <?php echo ($items_used !== $emptyValue) ? '>' . $items_used : 'placeholder="Empty">'; ?></textarea></td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- other info -->
                            <table class="table table-hover table-sm mb-0">
                                <tbody>

                                    <tr>
                                        <th class="table-secondary w-25">Other Info</th>
                                        <td><textarea class="w-100 border-0 p-1" rows="5" name="other_info" disabled <?php echo ($other_info !== $emptyValue) ? '>' . $other_info : 'placeholder="Empty">'; ?></textarea></td>
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