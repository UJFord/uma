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

	<!-- Check access when the page loads -->
	<script>
		// Assume you have the userRole variable defined somewhere in your PHP code
		var userRole = "<?php echo isset($_SESSION['rank']) ? $_SESSION['rank'] : ''; ?>";
		checkAccess(userRole);
	</script>
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
				$query = "SELECT crop.*, crop_location.*, crop_other_info.*, crop_farming_practice.*, users.*, crop_characteristics.* FROM crop LEFT JOIN crop_location ON crop.crop_id = crop_location.crop_id left join crop_other_info on crop.crop_id = crop_other_info.crop_id left join crop_farming_practice on crop.crop_id = crop_farming_practice.crop_id left join users on crop.user_id = users.user_id left join crop_characteristics on crop.crop_id = crop_characteristics.crop_id WHERE crop.crop_id = $1";
				$query_run = pg_query_params($connection, $query, array($crop_id));

				$emptyValue = 'Empty';

				if (pg_num_rows($query_run) > 0) {
					$crops = pg_fetch_assoc($query_run);
					// get the id for the foreign tables
					$other_info_id = $crops['other_info_id'];
					$location_id = $crops['location_id'];
					$farming_practice_id = $crops['farming_practice_id'];
					$characteristics_id = $crops['characteristics_id'];

					$crop_location_id = $crops['crop_location_id'];
					$current_crop_farming_practice_id = $crops['crop_farming_practice_id'];
					$current_crop_other_info_id = $crops['crop_other_info_id'];
					$current_crop_image = $crops['crop_image'];
					$current_crop_characteristics_id = $crops['crop_characteristics_id'];

					// Get the data from crops table
					// Define default values for each field if they are $emptyValue
					$crop_name = isset($crops['crop_name']) ? htmlspecialchars($crops['crop_name'], ENT_QUOTES) : $emptyValue;
					$upland_or_lowland = isset($crops['upland_or_lowland']) ? htmlspecialchars($crops['upland_or_lowland'], ENT_QUOTES) : $emptyValue;
					$category = isset($crops['category']) ? htmlspecialchars($crops['category'], ENT_QUOTES) : $emptyValue;
					$crop_description = isset($crops['crop_description']) ? htmlspecialchars($crops['crop_description'], ENT_QUOTES) : $emptyValue;
					$crop_variety = isset($crops['crop_variety']) ? htmlspecialchars($crops['crop_variety'], ENT_QUOTES) : $emptyValue;
					$other_info = isset($crops['other_info']) ? htmlspecialchars($crops['other_info'], ENT_QUOTES) : $emptyValue;
					$status = isset($crops['status']) ? htmlspecialchars($crops['status'], ENT_QUOTES) : $emptyValue;
					$first_name = isset($crops['first_name']) ? htmlspecialchars($crops['first_name'], ENT_QUOTES) : $emptyValue;
					$input_date = isset($crops['input_date']) ? htmlspecialchars($crops['input_date'], ENT_QUOTES) : $emptyValue;
					$crop_local_name = isset($crops['crop_local_name']) ? htmlspecialchars($crops['crop_local_name'], ENT_QUOTES) : $emptyValue;
					$planting_techniques = isset($crops['planting_techniques']) ? htmlspecialchars($crops['planting_techniques'], ENT_QUOTES) : $emptyValue;
					$cultural_and_spiritual_significance = isset($crops['cultural_and_spiritual_significance']) ? htmlspecialchars($crops['cultural_and_spiritual_significance'], ENT_QUOTES) : $emptyValue;
					$role_in_maintaining_upland_ecosystem = isset($crops['role_in_maintaining_upland_ecosystem']) ? htmlspecialchars($crops['role_in_maintaining_upland_ecosystem'], ENT_QUOTES) : $emptyValue;
					$cultural_importance_and_traditional_knowledge = isset($crops['cultural_importance_and_traditional_knowledge']) ? htmlspecialchars($crops['cultural_importance_and_traditional_knowledge'], ENT_QUOTES) : $emptyValue;
					$unique_features = isset($crops['unique_features']) ? htmlspecialchars($crops['unique_features'], ENT_QUOTES) : $emptyValue;
					$cultural_use = isset($crops['cultural_use']) ? htmlspecialchars($crops['cultural_use'], ENT_QUOTES) : $emptyValue;
					$associated_vegetation = isset($crops['associated_vegetation']) ? htmlspecialchars($crops['associated_vegetation'], ENT_QUOTES) : $emptyValue;
					$threats = isset($crops['threats']) ? htmlspecialchars($crops['threats'], ENT_QUOTES) : $emptyValue;

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
							<input type="hidden" name="crop_characteristics_id" value="<?= $crops['crop_characteristics_id']; ?>">

							<input type="hidden" name="other_info_id" value="<?= $other_info_id; ?>">
							<input type="hidden" name="location_id" value="<?= $location_id; ?>">
							<input type="hidden" name="farming_practice_id" value="<?= $farming_practice_id; ?>">
							<input type="hidden" name="characteristics_id" value="<?= $characteristics_id; ?>">

							<?php
							// Convert the string to a DateTime object
							$date = new DateTime($input_date);
							// Format the date to display up to the minute
							$formatted_date = $date->format('Y-m-d H:i');
							?>

							<!-- general information -->
							<h3 class="fw-bolder">General Info <span class="fs-5 fw-normal"></span></h3>
							<div class="row">
								<div class="col-4">
									<!-- crop name -->
									<label for="crop-name">Crop / Variety <span class="text-danger fw-bold">*</span></label>
									<input id="crop-name" type="text" name="crop_name" value="<?= $crop_name; ?>" class="form-control form-control-lg mb-4" disabled>
								</div>
								<!-- image -->
								<div class="col-4">
									<label for="image-input">Images <span class="text-danger fw-bold">*</span></label>
									<input type="file" name="crop_image[]" class="form-control" id="image-input" multiple="multiple" accept="image/*" hidden>								</div>
								<div class="col-3">
									<!-- Input Date -->
									<label for="input_date">Input Date</label>
									<input id="input_date" name="input_date" type="text" value="<?= $formatted_date; ?>" class="form-control disabled-input">
								</div>
							</div>

							<div class="row mb-4">
								<div class="col-4">
									<!-- local name -->
									<label for="crop_local_name">Local Name <span class="text-danger fw-bold">*</span></label>
									<input id="crop_local_name" type="text" name="crop_local_name" value="<?= $crop_local_name ?>" class="form-control mb-4" disabled>

									<!-- category -->
									<label>Category <span class="text-danger">*</span></label>
									<div class="mb-4">
										<div class="form-check form-check-inline">
											<label class="form-check-label" for="ccateg-rice">Rice</label>
											<input class="form-check-input" <?php if ($category == "Rice") {
																				echo "checked";
																			} ?> type="radio" name="category" id="ccateg-rice" value="Rice" disabled>
										</div>
										<div class="form-check form-check-inline">
											<label class="form-check-label" for="ccateg-root">Root Crops</label>
											<input class="form-check-input" <?php if ($category == "Root Crop") {
																				echo "checked";
																			} ?> type="radio" name="category" id="ccateg-root" value="Root Crop" disabled>
										</div>
										<div class="form-check form-check-inline">
											<label class="form-check-label" for="ccateg-other">Other</label>
											<input class="form-check-input" <?php if ($category == "Other") {
																				echo "checked";
																			} ?> type="radio" name="category" id="ccateg-other" value="Other" disabled>
										</div>
									</div>

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
												<img id="current-crop-image" src="<?php echo 'http://localhost/incognito-capstone/admin/'; ?>img/crop/<?php echo trim($imageName); ?>" class="m-2 img-thumbnail" style="height: 200px;">
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
								<label for="gen-desc">Description <span class="fw-light">(Optional)</span></label>
								<textarea name="crop_description" value="<?= $crop_description ?>" id="gen-desc" class="txtarea form-control" rows="3" disabled <?php echo ($crop_description !== $emptyValue) ? '>' . $crop_description : 'placeholder="Empty">'; ?></textarea>
							</div>

							<!-- More -->
							<h3 class="mt-4">More</h5>
								<!-- Characteristics -->
								<div class="row">
									<h4 class="">Characteristics</h4>
									<?php
									// PHP code to display available characteristics from the database

									// Query to select all available characteristics in the database
									$query5 = "SELECT crop_characteristics.*, characteristics.* FROM crop_characteristics left join characteristics on crop_characteristics.characteristics_id = characteristics.characteristics_id WHERE characteristics.characteristics_id='$characteristics_id'";

									// Executing query
									$query_run5 = pg_query($connection, $query5);

									// If count is greater than 0, we have characteristics; else, we do not have characteristics
									if (pg_num_rows($query_run5) > 0) {
										$characteristics = pg_fetch_assoc($query_run5);

										// Define default values for each field if they are $emptyValue
										$taste = isset($characteristics['taste']) ? $characteristics['taste'] : $emptyValue;
										$aroma = isset($characteristics['aroma']) ? $characteristics['aroma'] : $emptyValue;
										$maturation = isset($characteristics['maturation']) ? $characteristics['maturation'] : $emptyValue;
										$pest_and_disease_resistance = isset($characteristics['pest_and_disease_resistance']) ? $characteristics['pest_and_disease_resistance'] : $emptyValue;
									?>
										<div class="col-2">
											<!-- taste -->
											<label for="taste">Taste</label>
											<input id="taste" name="taste" type="text" value="<?= $taste; ?>" class="form-control mb-4" disabled>
										</div>
										<div class="col-2">
											<!-- aroma -->
											<label for="aroma">Aroma</label>
											<input id="aroma" name="aroma" type="text" value="<?= $aroma; ?>" class="form-control mb-4" disabled>
										</div>
										<div class="col-2">
											<!-- maturation -->
											<label for="matur">Maturation</label>
											<input id="matur" name="maturation" type="text" value="<?= $maturation; ?>" class="form-control mb-4" disabled>
										</div>
										<div class="col">
											<!-- disease resistance -->
											<label for="resist">Pest and Disease Resistance</label>
											<input id="resist" name="pest_and_disease_resistance" type="text" value="<?= $pest_and_disease_resistance; ?>" class="form-control" disabled>
										</div>
										<?php
									}
										?>								
								</div>

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
										}
											?>
											</div>
								</div>

								<!-- Planting Techniques -->
								<label class="mt-2" for="tech-desc">Planting Techniques</label>
								<div class="row">
								<div class="col">
									<!-- Descrition -->
									<!-- <textarea name="" id="tech-desc" class="txtarea form-control" rows="2"></textarea> -->
								<div class="border rounded p-2">
									<textarea id="tech-desc" name="planting_techniques" class="txtarea form-control w-100 h-100" disabled <?php echo ($planting_techniques !== $emptyValue) ? '>' . $planting_techniques : 'placeholder="Empty">'; ?></textarea>
								</div>
							</div>
						</div>

						<!-- Cultural and Spiritual Significance -->
						<label class="mt-2" for="signif-desc">Cultural and Spiritual Significance</label>
						<div class="row">
							<div class="col">
								<!-- Descrition -->
								<!-- <textarea name="" id="signif-desc" class="txtarea form-control" rows="2"></textarea> -->
									<div class="border rounded p-2">
										<textarea id="signif-desc" name="cultural_and_spiritual_significance" class="txtarea form-control w-100 h-100" disabled <?php echo ($cultural_and_spiritual_significance !== $emptyValue) ? '>' . $cultural_and_spiritual_significance : 'placeholder="Empty">'; ?></textarea>
										</div>
									</div>
								</div>

								<!-- Role in Maintaining Upland Ecosystems -->
								<label class="mt-2" for="role-desc">Role in Maintaining Upland Ecosystems</label>
								<div class="row">
									<div class="col">
										<!-- Descrition -->
										<!-- <textarea name="" id="role-desc" class="txtarea form-control" rows="2"></textarea> -->
										<div class="border rounded p-2">
											<textarea id="role-desc" name="role_in_maintaining_upland_ecosystem" class="txtarea form-control w-100 h-100" disabled <?php echo ($role_in_maintaining_upland_ecosystem !== $emptyValue) ? '>' . $role_in_maintaining_upland_ecosystem : 'placeholder="Empty">'; ?></textarea>
										</div>
									</div>
								</div>

								<!-- Cultural Importance and Traditional Knowledge -->
								<label class="mt-2" for="importance-desc">Cultural Importance and Traditional Knowledge</label>
								<div class="row">
									<div class="col">
										<!-- Descrition -->
										<!-- <textarea name="" id="importance-desc" class="txtarea form-control" rows="2"></textarea> -->
											<div class="border rounded p-2">
												<textarea id="importance-desc" name="cultural_importance_and_traditional_knowledge" class="txtarea form-control w-100 h-100" disabled <?php echo ($cultural_importance_and_traditional_knowledge !== $emptyValue) ? '>' . $cultural_importance_and_traditional_knowledge : 'placeholder="Empty">'; ?></textarea>
										</div>
									</div>
								</div>

								<!-- Unique Features -->
								<label class="mt-2" for="feat-desc">Unique Features</label>
								<div class="row">
									<div class="col">
										<!-- Descrition -->
										<!-- <textarea name="" id="feat-desc" class="txtarea form-control" rows="2"></textarea> -->
												<div class="border rounded p-2">
													<textarea id="feat-desc" name="unique_features" class="txtarea form-control w-100 h-100" disabled <?php echo ($unique_features !== $emptyValue) ? '>' . $unique_features : 'placeholder="Empty">'; ?></textarea>
										</div>
									</div>
								</div>

								<!-- Cultural Use -->
								<label class="mt-2" for="use-desc">Cultural Use</label>
								<div class="row">
									<div class="col">
										<!-- Descrition -->
										<!-- <textarea name="" id="use-desc" class="txtarea form-control" rows="2"></textarea> -->
													<div class="border rounded p-2">
														<textarea id="use-desc" name="cultural_use" class="txtarea form-control w-100 h-100" disabled <?php echo ($cultural_use !== $emptyValue) ? '>' . $cultural_use : 'placeholder="Empty">'; ?></textarea>
										</div>
									</div>
								</div>

								<!-- Associated Vegetation -->
								<label class="mt-2" for="veg-desc">Associated Vegetation</label>
								<div class="row">
									<div class="col">
										<!-- Descrition -->
										<!-- <textarea name="" id="veg-desc" class="txtarea form-control" rows="2"></textarea> -->
														<div class="border rounded p-2">
															<textarea id="veg-desc" name="associated_vegetation" class="txtarea form-control w-100 h-100" disabled <?php echo ($associated_vegetation !== $emptyValue) ? '>' . $associated_vegetation : 'placeholder="Empty">'; ?></textarea>
										</div>
									</div>
								</div>

								<!-- Threats to Upland Farms -->
								<label class="mt-2" for="threat-desc">Threats to Upland Farms</label>
								<div class="row">
									<div class="col">
										<!-- Descrition -->
										<!-- <textarea name="" id="threat-desc" class="txtarea form-control" rows="2"></textarea> -->
															<div class="border rounded p-2">
																<textarea id="threat-desc" name="threats" class="txtarea form-control w-100 h-100" disabled <?php echo ($threats !== $emptyValue) ? '>' . $threats : 'placeholder="Empty">'; ?></textarea>
										</div>
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
																		<input id="first_name" name="first_name" type="text" value="<?= $first_name; ?>" class="form-control mb-2 disabled-input">
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
<?php
								}
?>
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