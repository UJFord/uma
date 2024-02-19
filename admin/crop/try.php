<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

    <!-- add entry custom css -->
    <link rel="stylesheet" href="../../css/admin/entry.css" />
    <!-- sidebar custom css -->
    <link rel="stylesheet" href="../../css/admin/side.css">

    <!-- favicon -->
    <link rel="shortcut icon" href="img/logo/Uma logo.svg" type="image/x-icon" />
    <title>Crop sa Editor</title>

    <?php
    session_start();
    // sidebar
    require('../sidebar/side.php');
    ?>

    <!-- Check access when the page loads -->
    <script>
        // Assume you have the userRole variable defined somewhere in your PHP code
        var userRole = "<?php echo isset($_SESSION['rank']) ? $_SESSION['rank'] : ''; ?>";
        checkAccess(userRole);
    </script>

    <!-- summernote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
</head>

<body class="overflow-x-hidden">

    <!-- container of everything -->
    <div class="row">

        <!-- space holder of side panel -->
        <section class=" d-none d-md-block col col-3 col-xl-2 p-0 m-0"></section>
        <!-- main panel -->
        <section id="" class="p-0 m-0 col col-md-9 col-xl-10">

            <!-- form for submitting -->
            <form id="form-panel" name="Form" action="code.php" autocomplete="off" method="POST" enctype="multipart/form-data" class=" py-3 px-5">
                <!-- back button -->
                <a href="list.php" class="link-offset-2"><i class="bi bi-chevron-left"></i>Go Back</a>

                <?php
                include('../functions/message.php');
                ?>
                <div id="error-message"></div>
                <input type="hidden" name="user_id" value="<?php if (isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN']) {
                                                                echo $_SESSION['USER']['user_id'];
                                                            } ?>">

                <!-- main form -->
                <div class="form-control p-3 mt-3">

                    <div class="tab_box">
                        <button class="tab_btn active">General Info</button>
                        <button class="tab_btn">Associated Vegetation</button>
                        <button class="tab_btn">Contributor and other Resources</button>
                        <div class="line"></div>
                    </div>

                    <!-- general information -->
                    <div class="general_info">
                        <div class="gen_info active">
                            <h3 class="fw-bolder">General Info <span class="fs-5 fw-normal">(Required)</span></h3>
                            <div class="row">
                                <div class="col-4">
                                    <!-- crop name -->
                                    <label for="crop-name">Crop / Variety <span class="text-danger fw-bold">*</span></label>
                                    <input id="crop-name" type="text" name="crop_name" class="form-control form-control-lg mb-4" required>
                                </div>
                                <!-- image -->
                                <div class="col-4">
                                    <label for="image-input">Images <span class="text-danger fw-bold">*</span></label>
                                    <input type="file" name="crop_image[]" class="form-control" id="image-input" multiple accept="image/*" required>
                                </div>
                            </div>
                        </div>

                        <div class="gen_info">
                            <div class="row mb-4">
                                <div class="col-4">
                                    <!-- local name -->
                                    <label for="crop_local_name">Local Name <span class="text-danger fw-bold">*</span></label>
                                    <input id="crop_local_name" type="text" name="crop_local_name" class="form-control mb-4" required>

                                    <!-- category -->
                                    <label for="category">Category <span class="text-danger">*</span></label>
                                    <div class="mb-4">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" for="ccateg-rice">Rice</label>
                                            <input class="form-check-input" type="radio" name="category" id="ccateg-rice" value="Rice" required>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" for="ccateg-root">Root Crops</label>
                                            <input class="form-check-input" type="radio" name="category" id="ccateg-root" value="Root Crop" required>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" for="ccateg-other">Other</label>
                                            <input class="form-check-input" type="radio" name="category" id="ccateg-other" value="Other" required>
                                        </div>
                                    </div>

                                    <!-- upland or lowland -->
                                    <label>Type <span class="text-danger">*</span></label>
                                    <div class="">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" for="ctype-up">Upland</label>
                                            <input class="form-check-input" type="radio" name="upland_or_lowland" id="ctype-up" value="Upland" required>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" for="ctype-low">Lowland</label>
                                            <input class="form-check-input" type="radio" name="upland_or_lowland" id="ctype-low" value="Lowland" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <!-- images chosen not yet uploaded i think i dont know -->
                                    <div id="image-previews" class="overflow-x-scroll h-100 border d-flex flex-row">
                                        <!-- mao dapat ni ang mag loop everytime naay kani nga crop sa image -->
                                        <img src="https://images.unsplash.com/photo-1682695797221-8164ff1fafc9?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="m-2 img-thumbnail" style="height: 200px;">
                                        <img src="https://plus.unsplash.com/premium_photo-1664382466520-afe23272be60?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="m-2 img-thumbnail" style="height: 200px;">
                                        <img src="https://plus.unsplash.com/premium_photo-1674675647693-777780779499?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="m-2 img-thumbnail" style="height: 200px;">
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="col">
                                <label for="gen-desc">Description <span class="fw-light">(Optional)</span></label>
                                <div class="border rounded p-2">
                                    <textarea name="crop_description" id="gen-desc" class="txtarea form-control w-100 h-100"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- editting buttons -->
                    <?php
                    require('../edit-btn/add-btn.php');
                    ?>
                </div>
            </form>
        </section>
    </div>

    <!-- scipts -->

    <script>
        const tabs = document.querySelectorAll('.tab_btn');
        const all_content = document.querySelectorAll('.gen_info');

        tabs.forEach((tab, index) => {
            tab.addEventListener('click', (e) => {
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');

                var line = document.querySelector('.line');
                line.style.width = e.target.offsetWidth + "px";
                line.style.left = e.target.offsetLeft + "px";

                all_content.forEach(content=>{content.classList.remove('active')});
                all_content[index].classList.add('active');
            })
        })
    </script>

    <!-- script to handle visibility for the other info -->
    <script>
        var toggleOtherInfo = document.getElementById('toggleOtherInfo');
        var toggleOtherInfoMinus = document.getElementById('toggleOtherInfoMinus');
        var otherInfoContent = document.querySelector('.other-info-content');

        toggleOtherInfo.addEventListener('click', function() {
            otherInfoContent.hidden = !otherInfoContent.hidden;
            toggleOtherInfo.style.display = otherInfoContent.hidden ? 'inline-block' : 'none';
            toggleOtherInfoMinus.style.display = otherInfoContent.hidden ? 'none' : 'inline-block';
        });

        toggleOtherInfoMinus.addEventListener('click', function() {
            otherInfoContent.hidden = true;
            toggleOtherInfo.style.display = 'inline-block';
            toggleOtherInfoMinus.style.display = 'none';
        });
    </script>

    <!-- JavaScript to handle file input change event and update image previews -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var imageInput = document.getElementById("image-input");
            var imagePreviews = document.getElementById("image-previews");

            imageInput.addEventListener("change", function() {
                // Clear existing image previews
                imagePreviews.innerHTML = "";

                // Display selected images
                for (var i = 0; i < imageInput.files.length; i++) {
                    var img = document.createElement("img");
                    img.src = URL.createObjectURL(imageInput.files[i]);
                    img.className = "m-2 img-thumbnail";
                    img.style.height = "200px";
                    imagePreviews.appendChild(img);
                }
            });
        });


        // SUMMERNOT HANDLING //

        // text area handling
        $('.txtarea').summernote({
            codeviewFilter: false,
            codeviewIframeFilter: true,
            airMode: true,
            tabsize: 2,
            height: 100,
            toolbar: [
                ['font', ['bold', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']]
            ],
            popover: {
                image: [
                    ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                    ['float', ['floatLeft', 'floatRight', 'floatNone']],
                    ['remove', ['removeMedia']]
                ],
                link: [
                    ['link', ['linkDialogShow', 'unlink']]
                ],
                table: [
                    ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                    ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
                ],
                air: [
                    ['color', ['color']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['para', ['ul', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']]
                ]
            }

        });
        // 
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>
</body>

</html>