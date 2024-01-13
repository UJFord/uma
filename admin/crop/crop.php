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
	
	<!-- add entry custom css -->
	<link rel="stylesheet" href="../../css/admin/entry.css" />
	<!-- sidebar custom css -->
	<link rel="stylesheet" href="../../css/admin/side.css"> 

	<!-- favicon -->
	<link rel="shortcut icon" href="img/logo/Uma logo.svg" type="image/x-icon" />
	<title>Crops as Editor</title>

	<!-- script fort access level -->
	<script src="../../js/admin/access.js" defer></script>
</head>

<body class="overflow-x-hidden">

	<!-- container of everything -->
	<div class="row">

		<!-- space holder of side panel -->
		<section class=" d-none d-md-block col col-3 col-xl-2 p-0 m-0"></section>
		<!-- main panel -->
		<section class="p-0 m-0 col col-md-9 col-xl-10 min-vh-100">

			<?php
			if (isset($_GET['crop_id'])) {
				$crop_id = pg_escape_string($connection, $_GET['crop_id']);
				$query = "SELECT crop.*, crop_location.*, crop_other_info.*, crop_farming_practice.*, users.* FROM crop LEFT JOIN crop_location ON crop.crop_id = crop_location.crop_id left join crop_other_info on crop.crop_id = crop_other_info.crop_id left join crop_farming_practice on crop.crop_id = crop_farming_practice.crop_id left join users on crop.user_id = users.user_id WHERE crop.crop_id = $1";
				$query_run = pg_query_params($connection, $query, array($crop_id));

				$emptyValue = 'Empty';

				if (pg_num_rows($query_run) > 0) {
					$crops = pg_fetch_assoc($query_run);
					// get the id for the foreign tables
					$other_info_id = $crops['other_info_id'];
					$location_id = $crops['location_id'];
					$crop_location_id = $crops['crop_location_id'];
					$farming_practice_id = $crops['farming_practice_id'];
					$current_crop_farming_practice_id = $crops['crop_farming_practice_id'];
					$current_crop_other_info_id = $crops['crop_other_info_id'];
					$current_crop_image = $crops['crop_image'];

					// Get the data from crops table
					// Define default values for each field if they are $emptyValue
					$crop_name = isset($crops['crop_name']) ? htmlspecialchars($crops['crop_name'], ENT_QUOTES) : $emptyValue;
					$upland_or_lowland = isset($crops['upland_or_lowland']) ? htmlspecialchars($crops['upland_or_lowland'], ENT_QUOTES) : $emptyValue;
					$category = isset($crops['category']) ? htmlspecialchars($crops['category'], ENT_QUOTES) : $emptyValue;
					$crop_description = isset($crops['crop_description']) ? htmlspecialchars($crops['crop_description'], ENT_QUOTES) : $emptyValue;
					$crop_variety = isset($crops['crop_variety']) ? htmlspecialchars($crops['crop_variety'], ENT_QUOTES) : $emptyValue;
					$crop_origin = isset($crops['crop_origin']) ? htmlspecialchars($crops['crop_origin'], ENT_QUOTES) : $emptyValue;
					$crop_scientific_name = isset($crops['crop_scientific_name']) ? htmlspecialchars($crops['crop_scientific_name'], ENT_QUOTES) : $emptyValue;
					$crop_local_name = isset($crops['crop_local_name']) ? htmlspecialchars($crops['crop_local_name'], ENT_QUOTES) : $emptyValue;
					$other_info = isset($crops['other_info']) ? htmlspecialchars($crops['other_info'], ENT_QUOTES) : $emptyValue;
					$status = isset($crops['status']) ? htmlspecialchars($crops['status'], ENT_QUOTES) : $emptyValue;
					$first_name = isset($crops['first_name']) ? htmlspecialchars($crops['first_name'], ENT_QUOTES) : $emptyValue;

			?>
					<!-- form for submitting -->
					<form id="form-panel" name="Form" action="code.php" autocomplete="off" method="POST" enctype="multipart/form-data" class="h-100 py-3 px-5">
						<!-- back button -->
						<a href="list.php" class="link-offset-2"><i class="bi bi-chevron-left"></i>Go Back</a>

						<?php
						include('../message.php');
						?>

						<!-- main form -->
						<div class="form-control p-3 mt-3">
							<input id="crop-id" type="hidden" name="crop_id" value="<?= $crops['crop_id']; ?>">
							<input type="hidden" name="user_id" value="<?= $user_id; ?>">
							<input type="hidden" name="crop_location_id" value="<?= $crops['crop_location_id']; ?>">
							<input type="hidden" name="crop_farming_practice_id" value="<?= $crops['crop_farming_practice_id']; ?>">
							<input type="hidden" name="crop_other_info_id" value="<?= $crops['crop_other_info_id']; ?>">
							<input type="hidden" name="current_crop_image" value="<?= $current_crop_image; ?>">

							<input type="hidden" name="other_info_id" value="<?= $other_info_id; ?>">
							<input type="hidden" name="location_id" value="<?= $location_id; ?>">
							<input type="hidden" name="farming_practice_id" value="<?= $farming_practice_id; ?>">

							<!-- general information -->
							<h3>General Information</h3>
							<div class="row">
								<div class="col-4">
									<!-- crop name -->
									<label for="crop-name">Crop <span class="text-danger">*</span></label>
									<input id="crop-name" type="text" name="crop_name" value="<?= $crop_name; ?>" class="form-control form-control-lg mb-2" disabled>
								</div>
								<!-- image -->
								<div class="col-4">
									<label for="image-input" class="">Images <span class="text-danger">*</span></label>
									<input type="file" class="form-control" name="crop_image[]" id="image-input" multiple accept="image/*" hidden>
								</div>
							</div>

							<div class="row">
								<div class="col-4">
									<!-- category -->
									<label for="category">Category <span class="text-danger">*</span></label>
									<select id="category" name="category" class="form-select mb-2" disabled>
										<option value="rice" <?php echo ($category === 'rice') ? 'selected' : ''; ?>>Rice</option>
										<option value="root" <?php echo ($category === 'root') ? 'selected' : ''; ?>>Rootcrop</option>
										<option value="fly" <?php echo ($category === 'fly') ? 'selected' : ''; ?>>Flying</option>
										<option value="rock" <?php echo ($category === 'rock') ? 'selected' : ''; ?>>Rock</option>
										<option value="fire" <?php echo ($category === 'fire') ? 'selected' : ''; ?>>Fire</option>
										<option value="grass" <?php echo ($category === 'grass') ? 'selected' : ''; ?>>Grass</option>
										<option value="steel" <?php echo ($category === 'steel') ? 'selected' : ''; ?>>Steel</option>
									</select>

									<!-- local name -->
									<label for="local">Local Name <span class="text-danger">*</span></label>
									<input id="local" type="text" name="crop_local_name" value="<?= $crop_local_name ?>" class="form-control mb-2" disabled>

									<!-- scientific name -->
									<label for="crop_scientific_name">Scientific Name <span class="text-danger"></span></label>
									<input id="crop_scientific_name" type="text" name="crop_scientific_name" value="<?= $crop_scientific_name ?>" class="form-control mb-2" disabled>

									<!-- Crop Variety -->
									<label for="crop_variety">Crop Variety <span class="text-danger"></span></label>
									<input id="crop_variety" type="text" name="crop_variety" value="<?= $crop_variety ?>" class="form-control mb-2" disabled>

									<!-- Crop Origin -->
									<label for="crop_origin">Crop Origin <span class="text-danger"></span></label>
									<input id="crop_origin" type="text" name="crop_origin" value="<?= $crop_origin ?>" class="form-control mb-2" disabled>

									<!-- upland or lowland -->
									<label>Type <span class="text-danger">*</span></label>
									<div class="m-2">
										<div class="form-check form-check-inline">
											<label class="form-check-label" for="inlineRadio1">Upland</label>
											<input class="form-check-input" <?php if ($upland_or_lowland == "Upland") {
																				echo "checked";
																			} ?> type="radio" name="upland_or_lowland" id="inlineRadio1" value="Upland" disabled>
										</div>
										<div class="form-check form-check-inline">
											<label class="form-check-label" for="inlineRadio2">Lowland</label>
											<input class="form-check-input" <?php if ($upland_or_lowland == "Lowland") {
																				echo "checked";
																			} ?> type="radio" name="upland_or_lowland" id="inlineRadio2" value="Lowland" disabled>
										</div>
									</div>

								</div>

								<div class="col">
									<!-- current images -->
									<div id="image-previews" class="overflow-x-scroll h-100 border d-flex flex-row">
										<?php
										if ($current_crop_image != "") {
											// Split the image names by comma
											$imageNames = explode(',', $current_crop_image);
											// Display each image
											foreach ($imageNames as $imageName) {
										?>
												<img src="<?php echo 'http://localhost/incognito-capstone/admin/'; ?>img/crop/<?php echo trim($imageName); ?>" width="100%">
										<?php
											}
										} else {
											// display message
											echo "Image not added";
										}
										?>
									</div>
								</div>
							</div>

							<div class="col">
								<!-- Description -->
								<label for="gen-desc">Description <span class="text-danger">*</span></label>
								<textarea name="crop_description" id="gen-desc" class="form-control" rows="3" disabled <?php echo ($crop_description !== $emptyValue) ? '>' . $crop_description : 'placeholder="Empty">'; ?></textarea>
							</div>

							<!-- More -->
							<h3 class="mt-4">More</h5>

							<!-- Location -->
							<div>
								<h3 class="mt-4">Location</h5>
									<?php
									// PHP code to display available Location from the database

									// Query to select all available Location in the database
									$query3 = "SELECT crop_location.*, location.* FROM crop_location left join location on crop_location.location_id = location.location_id WHERE location.location_id='$location_id'";

									// Executing query
									$query_run3 = pg_query($connection, $query3);

									// If count is greater than 0, we have Location; else, we do not have Location
									if (pg_num_rows($query_run3) > 0) {
										$location = pg_fetch_assoc($query_run3);

										// Define default values for each field if they are $emptyValue
										$province_name = isset($location['province_name']) ? $location['province_name'] : $emptyValue;
										$municipality_name = isset($location['municipality_name']) ? $location['municipality_name'] : $emptyValue;
										$latitude = isset($location['latitude']) ? $location['latitude'] : $emptyValue;
										$longtitude = isset($location['longtitude']) ? $location['longtitude'] : $emptyValue;
										$input_date = isset($location['input_date']) ? $location['input_date'] : $emptyValue;

									?>
									<div class="row">
										<div class="col-3">
											<!-- Province -->
											<label for="province">Province</label>
											<select id="province" name="province_name" class="form-select mb-2" disabled>
												<option value="<?= $province_name; ?>" <?php echo ($province_name === 'province_name') ? 'selected' : ''; ?>><?= $province_name; ?></option>
												<option value="sarangani">None</option>
												<option value="sarangani">Davao Del Norte</option>
												<option value="davao">Davao</option>
												<option value="south_cotabato">South Cotabato</option>
												<option value="cotabato">Cotabato</option>
											</select>
										</div>
										<div class="col-3">
											<!-- MUnicipality Name -->
											<label for="municipality">Municipality Name</label>
											<select id="municipality" name="municipality_name" class="form-select mb-2" disabled>
												<option value="<?= $municipality_name; ?>" <?php echo ($municipality_name === 'municipality_name') ? 'selected' : ''; ?>><?= $municipality_name; ?></option>
												<option value="none">None</option>
												<option value="alabel">Alabel</option>
												<option value="glan">Glan</option>
												<option value="kiamba">Kiamba</option>
												<option value="maasim">Maasim</option>
												<option value="maitum">Maitum</option>
												<option value="malapatan">Malapatan</option>
												<option value="malungon">Malungon</option>
											</select>										
										</div>
										<div class="col-2">
											<!-- Latitude -->
											<label for="latitude">Latitude</label>
											<input id="latitude" name="latitude" type="text" value="<?= $latitude; ?>" class="form-control mb-2" disabled>
										</div>
										<div class="col-2">
											<!-- Longtitude -->
											<label for="longtitude">Longtitude</label>
											<input id="longtitude" name="longtitude" type="text" value="<?= $longtitude; ?>" class="form-control" disabled>
										</div>

										<?php
										// Convert the string to a DateTime object
										$date = new DateTime($input_date);
										// Format the date to display up to the minute
										$formatted_date = $date->format('Y-m-d H:i');
										?>
										<div class="col-3">
											<!-- Input Date -->
											<label for="input_date">Input Date</label>
											<input id="input_date" name="input_date" type="text" value="<?= $formatted_date; ?>" class="form-control disabled-input">
										</div>
										<?php
									}
										?>
									</div>
							</div>

							<!-- Associated Farming Practice -->
							<div class="">
								<h3 class="mt-4">Associated Farming Practice</h5>
								<?php
								// PHP code to display available crop farming practice from the database
								// Query to select all available crop farming practice in the database
								$query4 = "SELECT crop_farming_practice.*, farming_practice.* FROM crop_farming_practice left join farming_practice on crop_farming_practice.farming_practice_id = farming_practice.farming_practice_id WHERE farming_practice.farming_practice_id='$farming_practice_id'";

								// Executing query
								$query_run4 = pg_query($connection, $query4);

								// If count is greater than 0, we have farming_practice; else, we do not have farming_practice
								if (pg_num_rows($query_run4) > 0) {
									$farming_practice = pg_fetch_assoc($query_run4);

									// Define default values for each field if they are $emptyValue
									$farming_practice_type = isset($farming_practice['farming_practice_type']) ? $farming_practice['farming_practice_type'] : $emptyValue;
									$farming_practice_name = isset($farming_practice['farming_practice_name']) ? $farming_practice['farming_practice_name'] : $emptyValue;
									$farming_practice_description = isset($farming_practice['farming_practice_description']) ? $farming_practice['farming_practice_description'] : $emptyValue;
								?>
										<div class="col">
											<!-- Other Info Type -->
											<label for="farming_practice_type">Type</label>
											<input id="farming_practice_type" type="text" name="farming_practice_type" value="<?= $farming_practice_type; ?>" class="form-control mb-2" disabled>
										</div>
										<div class="col">
											<!-- Other Info Name -->
											<label for="farming_practice_name">Name</label>
											<input id="farming_practice_name" type="text" name="farming_practice_name" value="<?= $farming_practice_name; ?>" class="form-control mb-2" disabled>
										</div>
										<div class="col">
											<!-- Other Info Description -->
											<label for="farming_practice-desc">Description <span class="text-danger"></span></label>
											<textarea name="farming_practice_description" id="farming_practice-desc" class="txtarea form-control" rows="3" disabled <?php echo ($farming_practice_description !== $emptyValue) ? '>' . $farming_practice_description : 'placeholder="Empty">'; ?></textarea>
							</div>
						<?php
								}
						?>
						</div>

						<!-- Other Information -->
						<div class="other_info">
							<h3 class="mt-4 d-flex align-items-center" id="otherInfoTitle">Other Info</h3>
							<?php
							// PHP code to display available crop other info from the database
							// Query to select all available crop other info in the database
							$query4 = "SELECT crop_other_info.*, other_info.* FROM crop_other_info left join other_info on crop_other_info.other_info_id = other_info.other_info_id WHERE other_info.other_info_id='$other_info_id'";

							// Executing query
							$query_run4 = pg_query($connection, $query4);

							// If count is greater than 0, we have other_info; else, we do not have other_info
							if (pg_num_rows($query_run4) > 0) {
								$other_info = pg_fetch_assoc($query_run4);

								// Define default values for each field if they are $emptyValue
								$other_info_type = isset($other_info['other_info_type']) ? $other_info['other_info_type'] : $emptyValue;
								$other_info_name = isset($other_info['other_info_name']) ? $other_info['other_info_name'] : $emptyValue;
								$other_info_description = isset($other_info['other_info_description']) ? $other_info['other_info_description'] : $emptyValue;
								$other_info_url = isset($other_info['other_info_url']) ? $other_info['other_info_url'] : $emptyValue;

							?>
								<div class="col">
									<!-- Submitted By -->
									<label for="first_name">Submitted BY:</label>
									<input id="first_name" name="first_name" type="text" value="<?= $first_name; ?>" class="form-control mb-2" disabled>
								</div>
								<div class="col">
									<!-- Other Info Type -->
									<label for="other_info_type">Type</label>
									<input id="other_info_type" name="other_info_type" type="text" value="<?= $other_info_type; ?>" class="form-control mb-2" disabled>
								</div>
								<div class="col">
									<!-- Other Info Name -->
									<label for="other_info_name">Name</label>
									<input id="other_info_name" name="other_info_name" type="text" value="<?= $other_info_name; ?>" class="form-control mb-2" disabled>
								</div>
								<div class="col">
									<!-- Other Info Urls -->
									<label for="other_info_url">Links</label>

									<?php if ($other_info_url != $emptyValue && $other_info_url != "") : ?>
										<?php
										// Check if the URL is absolute
										if (filter_var($other_info_url, FILTER_VALIDATE_URL) === false) {
											// If not, prepend "http://"
											$other_info_url = "http://" . $other_info_url;
										}
										?>
										<a id="other_info_link" href="<?= $other_info_url; ?>" target="_blank">
											<input id="other_info_url" name="other_info_url" type="text" value="<?= $other_info_url; ?>" class="form-control clickable" readonly>
										</a>
									<?php else : ?>
										<input id="other_info_url" name="other_info_url" type="text" placeholder="No Links" class="form-control clickable" readonly>
									<?php endif; ?>
								</div>

								<div class="col">
									<!-- Other Info Description -->
									<label for="other_info-desc">Description <span class="text-danger">*</span></label>
									<textarea name="other_info_description" id="other_info-desc" class="form-control" rows="3" disabled <?php echo ($other_info_description !== $emptyValue) ? '>' . $other_info_description : 'placeholder="Empty">'; ?></textarea>
							</div>

						<?php
							}
						?>
						</div>
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
<script src="../../js/admin/crop-image.js"></script>
<!-- bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<!-- font awesome -->
<script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>
</body>

</html>