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
	// include('../login/login-check.php');
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
				<input type="hidden" name="user_id" value="<?= $_SESSION['USER']['user_id']; ?>">

				<!-- main form -->
				<div class="form-control p-3 mt-3">

					<!-- general information -->
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
									<input class="form-check-input" type="radio" name="upland_or_lowland" id="ccateg-rice" value="Rice" required>
								</div>
								<div class="form-check form-check-inline">
									<label class="form-check-label" for="ccateg-root">Root Crops</label>
									<input class="form-check-input" type="radio" name="upland_or_lowland" id="ccateg-root" value="Root Crop" required>
								</div>
								<div class="form-check form-check-inline">
									<label class="form-check-label" for="ccateg-other">Other</label>
									<input class="form-check-input" type="radio" name="upland_or_lowland" id="ccateg-other" value="Other" required>
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

					<div class="col">
						<!-- Description -->
						<label for="gen-desc">Description <span class="fw-light">(Optional)</span></label>
						<textarea name="crop_description" id="gen-desc" class="txtarea form-control" rows="3" required></textarea>
					</div>




					<!-- More -->
					<h3 class="mt-5 fw-bolder">Additional Info <span class="fs-5 fw-normal">(Optional)</span></h3>

					<!-- Characteristics -->
					<h4 class="">Characteristics</h4>
					<div class="row">
						<div class="col-2">
							<!-- taste -->
							<label for="taste">Taste</label>
							<input id="taste" type="text" class="form-control mb-4">
						</div>
						<div class="col-2">
							<!-- aroma -->
							<label for="aroma">Aroma</label>
							<input id="aroma" type="text" class="form-control mb-4">
						</div>
						<div class="col-2">
							<!-- maturation -->
							<label for="matur">Maturation</label>
							<input id="matur" type="text" class="form-control mb-4">
						</div>
						<div class="col">
							<!-- disease resistance -->
							<label for="resist">Disease Resistance</label>
							<input id="resist" type="text" class="form-control">
						</div>
					</div>


					<!-- Planting Techniques -->
					<label class="mt-2">Planting Techniques</label>
					<div class="row">
						<div class="col">
							<!-- Descrition -->
							<textarea name="" id="tech-desc" class="txtarea form-control" rows="2"></textarea>
						</div>
					</div>

					<!-- Cultural and Spiritual Significance -->
					<label class="mt-2" for="signif-desc">Cultural and Spiritual Significance</label>
					<div class="row">
						<div class="col">
							<!-- Descrition -->
							<textarea name="" id="signif-desc" class="txtarea form-control" rows="2"></textarea>
						</div>
					</div>

					<!-- Role in Maintaining Upland Ecosystems -->
					<label class="mt-2">Role in Maintaining Upland Ecosystems</label>
					<div class="row">
						<div class="col">
							<!-- Descrition -->
							<textarea name="" id="role-desc" class="txtarea form-control" rows="2"></textarea>
						</div>
					</div>

					<!-- Cultural Importance and Traditional Knowledge -->
					<label class="mt-2">Cultural Importance and Traditional Knowledge</label>
					<div class="row">
						<div class="col">
							<!-- Descrition -->
							<textarea name="" id="impotance-desc" class="txtarea form-control" rows="2"></textarea>
						</div>
					</div>

					<!-- Unique Features -->
					<label class="mt-2">Unique Features</label>
					<div class="row">
						<div class="col">
							<!-- Descrition -->
							<textarea name="" id="feat-desc" class="txtarea form-control" rows="2"></textarea>
						</div>
					</div>

					<!-- Cultural Use -->
					<label class="mt-2">Cultural Use</label>
					<div class="row">
						<div class="col">
							<!-- Descrition -->
							<textarea name="" id="use-desc" class="txtarea form-control" rows="2"></textarea>
						</div>
					</div>

					<!-- Associated Farming Practice -->
					<label class="mt-2">Associated Farming Practice</label>
					<div class="row">
						<div class="col">
							<!-- Descrition -->
							<textarea name="" id="prac-desc" class="txtarea form-control" rows="2"></textarea>
						</div>
					</div>

					<!-- Associated Vegetation -->
					<label class="mt-2">Associated Vegetation</label>
					<div class="row">
						<div class="col">
							<!-- Descrition -->
							<textarea name="" id="veg-desc" class="txtarea form-control" rows="2"></textarea>
						</div>
					</div>

					<!-- Last Seen Location -->
					<label class="mt-2">Last Seen Location</label>
					<div class="row">
						<div class="col">
							<!-- Descrition -->
							<textarea name="" id="loc-desc" class="txtarea form-control" rows="2"></textarea>
						</div>
					</div>

					<!-- Threats to Upland Farms -->
					<label class="mt-2">Threats to Upland Farms</label>
					<div class="row">
						<div class="col">
							<!-- Descrition -->
							<textarea name="" id="threat-desc" class="txtarea form-control" rows="2"></textarea>
						</div>
					</div>

					<!-- Other Information -->
					<label class="mt-2">Other Information</label>
					<div class="row">
						<div class="col">
							<!-- Description -->
							<textarea name="" id="more-desc" class="txtarea form-control" rows="2"></textarea>
						</div>
					</div>

					<div class="row">
						<!-- Location -->
						<h5 class="mt-2">Location</h5>
						<div class="col-4">
							<!-- Municipality -->
							<label for="municipality">Municipality</label>
							<select id="municipality" name="municipality_name" class="form-select mb-2">
								<option value="alabel" selected>None</option>
								<option value="alabel">Alabel</option>
								<option value="glan">Glan</option>
								<option value="kiamba">Kiamba</option>
								<option value="maasim">Maasim</option>
								<option value="maitum">Maitum</option>
								<option value="malapatan">Malapatan</option>
								<option value="malungon">Malungon</option>
							</select>
						</div>
						<div class="col-3">
							<!-- Province -->
							<label for="province">Province</label>
							<select id="province" name="province_name" class="form-select mb-2">
								<option value="sarangani" selected>None</option>
								<option value="sarangani">Davao Del Norte</option>
								<option value="davao">Davao</option>
								<option value="south_cotabato">South Cotabato</option>
								<option value="cotabato">Cotabato</option>
							</select>
						</div>
						<div class="col-3">
							<!-- Longtitude -->
							<label for="longtitude">Longtitude</label>
							<input id="longtitude" type="text" name="longtitude" placeholder="Enter Longtitude" class="form-control mb-2">
						</div>
						<div class="col-2">
							<!-- Latitude -->
							<label for="latitude">Latitude</label>
							<input id="latitude" type="text" name="latitude" placeholder="Enter Latitude" class="form-control">
						</div>
					</div>

					<div class="">
						<!-- Associated Farming Practice -->
						<h5 class="mt-4">Associated Farming Practice</h5>
						<div class="col">
							<!-- Other Info Type -->
							<label for="farming_practice_type">Type</label>
							<input id="farming_practice_type" type="text" name="farming_practice_type" placeholder="Enter Farming Practice Type" class="form-control mb-2">
						</div>
						<div class="col">
							<!-- Other Info Name -->
							<label for="farming_practice_name">Name</label>
							<input id="farming_practice_name" type="text" name="farming_practice_name" placeholder="Enter Farming Practice Name" class="form-control mb-2">
						</div>
						<div class="col">
							<!-- Other Info Description -->
							<label for="farming_practice-desc">Description <span class="text-danger"></span></label>
							<textarea name="farming_practice_description" id="farming_practice-desc" class="txtarea form-control" rows="3"></textarea>
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
	</script>


	<script>
		$('.txtarea').summernote({
			tabsize: 2,
			height: 120,
			toolbar: [
				['style', ['style']],
				['font', ['bold', 'underline', 'clear']],
				['color', ['color']],
				['para', ['ul', 'ol', 'paragraph']],
				['table', ['table']],
				['insert', ['link', 'picture', 'video']],
				['view', ['fullscreen', 'codeview', 'help']]
			]
		});
	</script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
	<!-- font awesome -->
	<script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>
</body>

</html>