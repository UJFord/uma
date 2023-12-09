<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <!-- cutom css -->
    <!-- <link rel="stylesheet" href="../../css/admin/crop.css" /> -->
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
        <section class=" d-none d-md-block col col-4 col-lg-3 col-xl-2 p-0 m-0"></section>
        <!-- main panel -->
        <section id="nav-cards" class="p-0 m-0 col col-md-8 col-lg-9 col-xl-10">

            <!-- form for submitting -->
            <form action="" class=" py-3 px-5">

                <!-- title-->
                <div class="row d-flex justify-content-between mb-3">
                    <div class="col-6">
                        <h3 id="crops-title" class="fw-semibold"><input type="text" value="Farming Practice Name" class="w-100 border-0" disabled></h3>
                    </div>
                </div>

                <!-- crop information -->
                <div id="" class="row form-control p-3">

                    <!-- botanical information -->
                    <table id="info-table" class="table table-hover table-sm">
                        <tbody>
                            <tr>
                                <th class="table-secondary w-25" scope="row">Name</th>
                                <td><input type="text" value="Oryza sativa L" class="w-100 border-0" disabled></td>
                            </tr>
                            <tr>
                                <th class="table-secondary">Description</th>
                                <td><textarea class="w-100 border-0" rows="5" disabled>Slash-and-burn agriculture: This method involves clearing a piece of land by slashing and burning the vegetation. The ashes from the fire are then used to fertilize the soil</textarea></td>
                            </tr>
                            <tr>
								<th class="table-secondary w-25">Image</th>
								<td><input type="image" src="Submit" class="w-100 border-0"' disabled></td>
							</tr>
                        </tbody>

                    </table>

                    <!-- characteristics of traditional rice -->
                    <table class="table table-hover table-sm">
                        <tbody>
                            <tr>
                                <th class="table-secondary w-25">Importance</th>
                                <td><textarea class="w-100 border-0" rows="5" disabled>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Mollitia magni suscipit reprehenderit! Dolore harum nemo beatae ducimus aspernatur saepe, repellendus nostrum cumque libero est, quod quia rerum. Excepturi modi id quod reiciendis minus numquam?nfjsffdasnfos
                                </textarea></td>
                            </tr>
                            <tr>
                                <th class="table-secondary w-25">Role in Maintaning Upland Ecosystems</th>
                                <td><textarea class="w-100 border-0" rows="5" disabled>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Mollitia magni suscipit reprehenderit! Dolore harum nemo beatae ducimus aspernatur saepe, repellendus nostrum cumque libero est, quod quia rerum. Excepturi modi id quod reiciendis minus numquam?</textarea></td>
                            </tr>
                            <tr>
                                <th class="table-secondary w-25">Timing</th>
                                <td><textarea class="w-100 border-0" rows="5" disabled>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Mollitia magni suscipit reprehenderit! Dolore harum nemo beatae ducimus aspernatur saepe, repellendus nostrum cumque libero est, quod quia rerum. Excepturi modi id quod reiciendis minus numquam?</textarea></td>
                            </tr>
                            <tr>
                                <th class="table-secondary w-25">Benefits</th>
                                <td><textarea class="w-100 border-0" rows="5" disabled>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Mollitia magni suscipit reprehenderit! Dolore harum nemo beatae ducimus aspernatur saepe, repellendus nostrum cumque libero est, quod quia rerum. Excepturi modi id quod reiciendis minus numquam?</textarea></td>
                            </tr>
                            <tr>
                                <th class="table-secondary w-25">Environmetal Impacts</th>
                                <td><textarea class="w-100 border-0" rows="5" disabled>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Mollitia magni suscipit reprehenderit! Dolore harum nemo beatae ducimus aspernatur saepe, repellendus nostrum cumque libero est, quod quia rerum. Excepturi modi id quod reiciendis minus numquam?</textarea></td>
                            </tr>

                    </table>

                    <table class="table table-hover table-sm">
                        <tr>
                            <th class="table-secondary w-25">Considerations</th>
                            <td><textarea class="w-100 border-0" rows="5" disabled>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Mollitia magni suscipit reprehenderit! Dolore harum nemo beatae ducimus aspernatur saepe, repellendus nostrum cumque libero est, quod quia rerum. Excepturi modi id quod reiciendis minus numquam?</textarea></td>
                        </tr>
                        <tr>
                            <th class="table-secondary w-25">Sustainable Practices</th>
                            <td><textarea class="w-100 border-0" rows="5" disabled>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Mollitia magni suscipit reprehenderit! Dolore harum nemo beatae ducimus aspernatur saepe, repellendus nostrum cumque libero est, quod quia rerum. Excepturi modi id quod reiciendis minus numquam?</textarea></td>
                        </tr>
                        <tr>
                            <th class="table-secondary w-25">History Development</th>
                            <td><textarea class="w-100 border-0" rows="5" disabled>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Mollitia magni suscipit reprehenderit! Dolore harum nemo beatae ducimus aspernatur saepe, repellendus nostrum cumque libero est, quod quia rerum. Excepturi modi id quod reiciendis minus numquam?</textarea></td>
                        </tr>
                        <tr>
                            <th class="table-secondary w-25">Construction and Maintenance</th>
                            <td><textarea class="w-100 border-0" rows="5" disabled>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Mollitia magni suscipit reprehenderit! Dolore harum nemo beatae ducimus aspernatur saepe, repellendus nostrum cumque libero est, quod quia rerum. Excepturi modi id quod reiciendis minus numquam?</textarea></td>
                        </tr>
                        <tr>
                            <th class="table-secondary w-25">Challenges</th>
                            <td><textarea class="w-100 border-0" rows="5" disabled>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Mollitia magni suscipit reprehenderit! Dolore harum nemo beatae ducimus aspernatur saepe, repellendus nostrum cumque libero est, quod quia rerum. Excepturi modi id quod reiciendis minus numquam?</textarea></td>
                        </tr>
                        <tr>
                            <th class="table-secondary w-25">Principles</th>
                            <td><textarea class="w-100 border-0" rows="5" disabled>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Mollitia magni suscipit reprehenderit! Dolore harum nemo beatae ducimus aspernatur saepe, repellendus nostrum cumque libero est, quod quia rerum. Excepturi modi id quod reiciendis minus numquam?</textarea></td>
                        </tr>
                    </table>

                    <table class="table table-hover table-sm mb-0">
                        <tr>
                            <th class="table-secondary w-25">Other Info</th>
                            <td><textarea class="w-100 border-0" rows="5" disabled>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Mollitia magni suscipit reprehenderit! Dolore harum nemo beatae ducimus aspernatur saepe, repellendus nostrum cumque libero est, quod quia rerum. Excepturi modi id quod reiciendis minus numquam?</textarea></td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </form>
        </section>

    </div>

    <!-- scipts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>
</body>

</html>