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
    // include '../access.php';
    // access('CURATOR');
    // access('ADMIN');
    ?>

    <!-- summernote -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
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
                include('../message.php');
                ?>

                <!-- main form -->
                <div class="form-control p-3 mt-3">

                    <!-- general information -->
                    <h3 class="fw-bolder">General Info <span class="fs-5 fw-normal">(Required)</span></h3>
                    <!-- image -->
                    <div class="col-4">
                        <label for="image-input">Images <span class="text-danger fw-bold">*</span></label>
                        <input type="file" name="crop_image[]" class="form-control" id="imageInput" multiple accept="image/*" required>
                    </div>

                    <div class="row mb-4">

                        <div class="col">
                            <!-- images chosen not yet uploaded i think i dont know -->
                            <div id="previewContainer" class="overflow-x-scroll h-100 border d-flex flex-row">
                                <!-- mao dapat ni ang mag loop everytime naay kani nga crop sa image -->
                                <img src="https://images.unsplash.com/photo-1682695797221-8164ff1fafc9?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="m-2 img-thumbnail" style="height: 200px;">
                                <img src="https://plus.unsplash.com/premium_photo-1664382466520-afe23272be60?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="m-2 img-thumbnail" style="height: 200px;">
                                <img src="https://plus.unsplash.com/premium_photo-1674675647693-777780779499?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="m-2 img-thumbnail" style="height: 200px;">
                            </div>
                        </div>
                    </div>

                </div>
                <!-- editting buttons -->
                <?php
                require('../edit-btn/add-btn.php');
                ?>
            </form>
        </section>
    </div>

    <!-- scipts -->

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

    <script>
        // JavaScript to handle file input change event and update image previews 
        document.addEventListener("DOMContentLoaded", function() {
            var imageInput = document.getElementById("imageInput");
            var previewContainer = document.getElementById("previewContainer");

            imageInput.addEventListener("change", function() {
                previewContainer.innerHTML = "";

                for (var i = 0; i < imageInput.files.length; i++) {
                    var file = imageInput.files[i];
                    var reader = new FileReader();

                    reader.onload = (function(index) {
                        return function(e) {
                            var imagePreview = document.createElement('div');
                            imagePreview.className = 'image-preview';
                            var image = document.createElement('img');
                            image.src = e.target.result;
                            var deleteButton = document.createElement('button');
                            deleteButton.className = 'delete-button';
                            deleteButton.textContent = 'X';
                            deleteButton.addEventListener('click', function() {
                                previewContainer.removeChild(imagePreview);
                                // Remove the file from the input's files array
                                var newFiles = Array.from(imageInput.files);
                                newFiles.splice(index, 1);
                                imageInput.files = newFiles;
                            });
                            imagePreview.appendChild(image);
                            imagePreview.appendChild(deleteButton);
                            previewContainer.appendChild(imagePreview);
                        }
                    })(i);
                    reader.readAsDataURL(file);
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