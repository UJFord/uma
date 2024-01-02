<?php
session_start();
// sidebar
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
		<section id="nav-cards" class="p-0 m-0 col col-md-9 col-xl-10">

			<!-- form for submitting -->
			<form id="form-panel" name="Form" action="try.php" autocomplete="off" method="POST" enctype="multipart/form-data" class=" py-3 px-5">
				<!-- back button -->
				<a href="list.php" class="link-offset-2"><i class="bi bi-chevron-left"></i>Go Back</a>

				<?php
				include('../message.php');

				if (isset($_SESSION['user'])) {
					$user_id = $_SESSION["user"];
				}
				?>
				<input type="hidden" name="user_id" value="<?= $user_id ?>">

				<!-- main form -->
				<div class="form-control p-3 mt-3">

					<!-- general information -->
					<h3>General Information</h3>
					<div class="row">
						<div class="col-4">
							<!-- crop name -->
							<label for="crop-name">Crop <span class="text-danger">*</span></label>
							<input id="crop-name" type="text" name="crop_name" placeholder="Enter Crop Name" class="form-control form-control-lg mb-2" required>

						</div>
						<!-- image -->
						<div class="col-4">
							<label for="image-input" class="">Images <span class="text-danger">*</span></label>
							<input type="file" name="crop_image[]" class="form-control" id="image-input" multiple accept="image/*" required>
						</div>
					</div>

					<div class="row">
						<div class="col-4">
							<!-- category -->
							<label for="category">Category <span class="text-danger">*</span></label>
							<select id="category" name="category" class="form-select mb-2" required>
								<option value="rice" selected>Rice</option>
								<option value="root">Rootcrop</option>
								<option value="fly">Flying</option>
								<option value="rock">Rock</option>
								<option value="fire">Fire</option>
								<option value="grass">Grass</option>
								<option value="steel">Steel</option>
							</select>

							<!-- local name -->
							<label for="crop_local_name">Local Name <span class="text-danger">*</span></label>
							<input id="crop_local_name" type="text" name="crop_local_name" placeholder="Enter Crop Local Name" class="form-control mb-2" required>

							<!-- scientific name -->
							<label for="crop_scientific_name">Scientific Name <span class="text-danger"></span></label>
							<input id="crop_scientific_name" type="text" name="crop_scientific_name" placeholder="Enter Crop Scientific Name" class="form-control mb-2">

							<!-- Crop Variety -->
							<label for="crop_variety">Crop Variety <span class="text-danger"></span></label>
							<input id="crop_variety" type="text" name="crop_variety" placeholder="Enter Crop Variety" class="form-control mb-2">

							<!-- Crop Origin -->
							<label for="crop_origin">Crop Origin <span class="text-danger"></span></label>
							<input id="crop_origin" type="text" name="crop_origin" placeholder="Enter Crop Origin" class="form-control mb-2">

							<!-- upland or lowland -->
							<label>Type <span class="text-danger">*</span></label>
							<div class="m-2" required>
								<div class="form-check form-check-inline">
									<label class="form-check-label" for="inlineRadio1">Upland</label>
									<input class="form-check-input" type="radio" name="upland_or_lowland" id="inlineRadio1" value="Upland">
								</div>
								<div class="form-check form-check-inline">
									<label class="form-check-label" for="inlineRadio2">Lowland</label>
									<input class="form-check-input" type="radio" name="upland_or_lowland" id="inlineRadio2" value="Lowland">
								</div>
							</div>

						</div>

						<div class="col">
							<!-- images chosen not yet uploaded i think i dont know -->
							<div id="image-previews" class="overflow-x-scroll h-100 border d-flex flex-row">
							</div>
						</div>
					</div>

					<div class="col">
						<!-- Descrition -->
						<label for="gen-desc">Description <span class="text-danger">*</span></label>
						<textarea name="crop_description" id="gen-desc" class="txtarea form-control" rows="3" required></textarea>
					</div>

					<!-- More -->
					<h3 class="mt-4">More</h5>

						<!-- Location -->
						<h3 class="mt-4">Location</h5>
							<div class="row">
								<div class="col">
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
								<div class="col">
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
								<div class="col-2">
									<!-- Longtitude -->
									<label for="longtitude">Longtitude</label>
									<input id="longtitude" type="text" name="longtitude" class="form-control mb-2">
								</div>
								<div class="col-2">
									<!-- Latitude -->
									<label for="latitude">Latitude</label>
									<input id="latitude" type="text" name="latitude" class="form-control">
								</div>
							</div>

							<!-- Associated Farming Practice -->
							<label class="mt-2">Associated Farming Practice</label>
							<div class="row">
								<div class="col">
									<select id="farming_practice_id" name="farming_practice_id" class="form-select mb-2">
										<?php
										// php code to display available schedules from the database
										// query to select all available schedules in the database
										$query = "SELECT * FROM farming_practice";

										// Executing query
										$query_run = pg_query($connection, $query);

										// count rows to check whether we have a schedule or not
										$count = pg_num_rows($query_run);

										// if count is greater than 0 we have a schedule else we do not have a schedule
										if ($count > 0) {
											// we have a schedule
											while ($row = pg_fetch_assoc($query_run)) {
												// get the detail of the schedule
												$farming_practice_id = $row['farming_practice_id'];
												$farming_practice_name = $row['farming_practice_name'];
										?>
												<option value="<?php echo $farming_practice_id; ?>"><?php echo $farming_practice_name; ?></option>
											<?php
											}
										} else {
											// we do not have a schedule
											?>
											<option value="0">No Farming Practices Found</option>
										<?php
										}
										?>
									</select>
								</div>
							</div>

							<!-- Other Information -->
							<div class="other_info">
								<h3 class="mt-4 d-flex align-items-center" id="otherInfoTitle">Other Info <i class='bx bx-plus ml-2' id="toggleOtherInfo" style="color: blue;"></i> <i class='bx bx-minus ml-2' id="toggleOtherInfoMinus" style="display: none; color:red"></i></h3>
								<div class="other-info-content" hidden>
									<div class="col">
										<!-- Other Info Type -->
										<label for="other_info_type">Other Info Type</label>
										<input id="other_info_type" type="text" name="other_info_type" placeholder="Enter Other Info Type" class="form-control mb-2">
									</div>
									<div class="col">
										<!-- Other Info Name -->
										<label for="other_info_name">Other Info Name</label>
										<input id="other_info_name" type="text" name="other_info_name" placeholder="Enter Other Info Name" class="form-control mb-2">
									</div>
									<div class="col">
										<!-- Other Info Description -->
										<label for="gen-desc">Description <span class="text-danger">*</span></label>
										<textarea name="other_info_description" id="gen-desc" class="txtarea form-control" rows="3"></textarea>
									</div>
									<div class="col">
										<!-- Other Info Url -->
										<label for="other_info_url">Links</label>
										<input id="other_info_url" type="text" name="other_info_url" placeholder="Enter links if available" class="form-control">
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