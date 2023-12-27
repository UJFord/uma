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
	<title>Crops as Editor</title>
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
		<section class="p-0 m-0 col col-md-9 col-xl-10 min-vh-100">

			<?php
			if (isset($_GET['crop_id'])) {
				$crop_id = pg_escape_string($connection, $_GET['crop_id']);
				$query = "SELECT * from crops WHERE crop_id='$crop_id'";
				$query_run = pg_query($connection, $query);

				$emptyValue = 'Empty';

				if (pg_num_rows($query_run) > 0) {
					$crops = pg_fetch_assoc($query_run);

					// get the id for the roreign tables
					$current_traditional_crop_traits_id = $crops['traditional_crop_traits_id'];
					$current_farming_id = $crops['farming_id'];
					$current_image = $crops['image'];

					// Get the data from crops table
					// Define default values for each field if they are $emptyValue
					$crop_name = isset($crops['crop_name']) ? htmlspecialchars($crops['crop_name'], ENT_QUOTES) : $emptyValue;
					$upland_or_lowland = isset($crops['upland_or_lowland']) ? htmlspecialchars($crops['upland_or_lowland'], ENT_QUOTES) : $emptyValue;
					$category = isset($crops['category']) ? htmlspecialchars($crops['category'], ENT_QUOTES) : $emptyValue;
					$description = isset($crops['description']) ? htmlspecialchars($crops['description'], ENT_QUOTES) : $emptyValue;
					$image = isset($crops['image']) ? htmlspecialchars($crops['image'], ENT_QUOTES) : $emptyValue;
					$local_name = isset($crops['local_name']) ? htmlspecialchars($crops['local_name'], ENT_QUOTES) : $emptyValue;
					$planting_techniques = isset($crops['planting_techniques']) ? htmlspecialchars($crops['planting_techniques'], ENT_QUOTES) : $emptyValue;
					$cultural_and_spiritual_significance = isset($crops['cultural_and_spiritual_significance']) ? htmlspecialchars($crops['cultural_and_spiritual_significance'], ENT_QUOTES) : $emptyValue;
					$role_in_maintaining_upland_ecosystem = isset($crops['role_in_maintaining_upland_ecosystem']) ? htmlspecialchars($crops['role_in_maintaining_upland_ecosystem'], ENT_QUOTES) : $emptyValue;
					$cultural_importance_and_traditional_knowledge = isset($crops['cultural_importance_and_traditional_knowledge']) ? htmlspecialchars($crops['cultural_importance_and_traditional_knowledge'], ENT_QUOTES) : $emptyValue;
					$threats = isset($crops['threats']) ? htmlspecialchars($crops['threats'], ENT_QUOTES) : $emptyValue;
					$other_info = isset($crops['other_info']) ? htmlspecialchars($crops['other_info'], ENT_QUOTES) : $emptyValue;
					$unique_features = isset($crops['unique_features']) ? htmlspecialchars($crops['unique_features'], ENT_QUOTES) : $emptyValue;
					$cultural_use = isset($crops['cultural_use']) ? htmlspecialchars($crops['cultural_use'], ENT_QUOTES) : $emptyValue;
					$associated_vegetation = isset($crops['associated_vegetation']) ? htmlspecialchars($crops['associated_vegetation'], ENT_QUOTES) : $emptyValue;
					$last_seen_location = isset($crops['last_seen_location']) ? htmlspecialchars($crops['last_seen_location'], ENT_QUOTES) : $emptyValue;

			?>
					<!-- form for submitting -->
					<form id="form-panel" name="Form" action="code.php" autocomplete="off" method="POST" enctype="multipart/form-data" class="h-100 py-3 px-5">
						<!-- back button -->
						<a href="list.php" class="link-offset-2"><i class="bi bi-chevron-left"></i>Go Back</a>

						<!-- main form -->
						<div class="form-control p-3 mt-3">
							<input id="crop-id" type="hidden" name="crop_id" value="<?= $crops['crop_id']; ?>">
							<input type="hidden" name="traditional_crop_traits_id" value="<?= $crops['traditional_crop_traits_id']; ?>">
							<input type="hidden" name="current_image" value="<?= $current_image; ?>">

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
									<input type="file" class="form-control" name="image" id="image-input" multiple accept="image/*" hidden>
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
									<input id="local" type="text" name="local_name" value="<?= $local_name ?>" class="form-control mb-2" disabled>
									<!-- upland or lowland -->

									<label for="">Type <span class="text-danger">*</span></label>
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
									<!-- images chosen not yet uploaded i think i dont know -->
									<div id="image-previews" class="overflow-x-scroll h-100 border d-flex flex-row">
										<?php
										if ($current_image != "") {
											// Display the image
										?>
											<img src="<?php echo 'http://localhost/incognito-capstone/admin/'; ?>img/crop/<?php echo $current_image; ?>" width="100%">
										<?php
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
								<textarea name="description" id="gen-desc" class="form-control" rows="3" disabled <?php echo ($description !== $emptyValue) ? '>' . $description : 'placeholder="Empty">'; ?></textarea>
							</div>

							<!-- Characteristics -->
							<h3 class="mt-4">Characteristics</h5>
								<?php
								// PHP code to display available Traditional Crop Traits from the database

								// Query to select all available Traditional Crop Traits in the database
								$query3 = "SELECT * FROM traditional_crop_traits WHERE traditional_crop_traits_id='$current_traditional_crop_traits_id'";

								// Executing query
								$query_run3 = pg_query($connection, $query3);

								// If count is greater than 0, we have Traditional Crop Traits; else, we do not have Traditional Crop Traits
								if (pg_num_rows($query_run3) > 0) {
									$traditional_crop_traits = pg_fetch_assoc($query_run3);

									// Define default values for each field if they are $emptyValue
									$taste = isset($traditional_crop_traits['taste']) ? $traditional_crop_traits['taste'] : $emptyValue;
									$aroma = isset($traditional_crop_traits['aroma']) ? $traditional_crop_traits['aroma'] : $emptyValue;
									$maturation = isset($traditional_crop_traits['maturation']) ? $traditional_crop_traits['maturation'] : $emptyValue;
									$pest_and_disease_resistance = isset($traditional_crop_traits['pest_and_disease_resistance']) ? $traditional_crop_traits['pest_and_disease_resistance'] : $emptyValue;
								?>
									<div class="row">
										<div class="col-2">
											<!-- taste -->
											<label for="taste">Taste</label>
											<input id="taste" name="taste" type="text" value="<?= $taste; ?>" class="form-control mb-2" disabled>
										</div>
										<div class="col-2">
											<!-- aroma -->
											<label for="aroma">Aroma</label>
											<input id="aroma" name="aroma" type="text" value="<?= $aroma; ?>" class="form-control mb-2" disabled>
										</div>
										<div class="col-2">
											<!-- maturation -->
											<label for="matur">Maturation</label>
											<input id="matur" name="maturation" type="text" value="<?= $maturation; ?>" class="form-control mb-2" disabled>
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

							<!-- More -->
							<h3 class="mt-4">More</h5>

							<!-- Planting Techniques -->
							<label class="mt-2">Planting Techniques</label>
							<div class="row">
								<div class="col">
									<!-- Descrition -->
									<textarea name="planting_techniques" id="tech-desc" class="form-control" rows="2" disabled <?php echo ($planting_techniques !== $emptyValue) ? '>' . $planting_techniques : 'placeholder="Empty">'; ?></textarea>
							</div>
						</div>

						<!-- Cultural and Spiritual Significance -->
						<label class="mt-2">Cultural and Spiritual Significance</label>
						<div class="row">
							<div class="col">
								<!-- Descrition -->
								<textarea name="cultural_and_spiritual_significance" id="signif-desc" class="form-control" rows="2" disabled <?php echo ($cultural_and_spiritual_significance !== $emptyValue) ? '>' . $cultural_and_spiritual_significance : 'placeholder="Empty">'; ?></textarea>
								</div>
							</div>

							<!-- Role in Maintaining Upland Ecosystems -->
							<label class="mt-2">Role in Maintaining Upland Ecosystems</label>
							<div class="row">
								<div class="col">
									<!-- Descrition -->
									<textarea name="role_in_maintaining_upland_ecosystem" id="role-desc" class="form-control" rows="2" disabled <?php echo ($role_in_maintaining_upland_ecosystem !== $emptyValue) ? '>' . $role_in_maintaining_upland_ecosystem : 'placeholder="Empty">'; ?></textarea>
							</div>
						</div>

						<!-- Cultural Importance and Traditional Knowledge -->
						<label class="mt-2">Cultural Importance and Traditional Knowledge</label>
						<div class="row">
							<div class="col">
								<!-- Descrition -->
								<textarea name="cultural_importance_and_traditional_knowledge" id="impotance-desc" class="form-control" rows="2" disabled <?php echo ($cultural_importance_and_traditional_knowledge !== $emptyValue) ? '>' . $cultural_importance_and_traditional_knowledge : 'placeholder="Empty">'; ?></textarea>
								</div>
							</div>

							<!-- Unique Features -->
							<label class="mt-2">Unique Features</label>
							<div class="row">
								<div class="col">
									<!-- Descrition -->
									<textarea name="unique_features" id="feat-desc" class="form-control" rows="2" disabled <?php echo ($unique_features !== $emptyValue) ? '>' . $unique_features : 'placeholder="Empty">'; ?></textarea>
							</div>
						</div>

						<!-- Cultural Use -->
						<label class="mt-2">Cultural Use</label>
						<div class="row">
							<div class="col">
								<!-- Descrition -->
								<textarea name="cultural_use" id="use-desc" class="form-control" rows="2" disabled <?php echo ($cultural_use !== $emptyValue) ? '>' . $cultural_use : 'placeholder="Empty">'; ?></textarea>
								</div>
							</div>

							<!-- Associated Farming Practice -->
							<label class="mt-2">Associated Farming Practice</label>
							<div class="row">
								<div class="col">
									<!-- Descrition -->
									<textarea name="" id="prac-desc" class="form-control" rows="2" disabled ></textarea>
							</div>
						</div>

						<!-- Associated Vegetation -->
						<label class="mt-2">Associated Vegetation</label>
						<div class="row">
							<div class="col">
								<!-- Descrition -->
								<textarea name="associated_vegetation" id="veg-desc" class="form-control" rows="2" disabled <?php echo ($associated_vegetation !== $emptyValue) ? '>' . $associated_vegetation : 'placeholder="Empty">'; ?></textarea>
								</div>
							</div>

							<!-- Last Seen Location -->
							<label class="mt-2">Last Seen Location (Municipality)</label>
							<div class="row">
								<div class="col">
								<select id="last_seen_location" name="last_seen_location" class="form-select mb-2" disabled>
									<option value="alabel" <?php echo ($last_seen_location === 'alabel') ? 'selected' : ''; ?>>Alabel</option>
									<option value="glan" <?php echo ($last_seen_location === 'glan') ? 'selected' : ''; ?>>Glan</option>
									<option value="kiamba" <?php echo ($last_seen_location === 'kiamba') ? 'selected' : ''; ?>>Kiamba</option>
									<option value="maasim" <?php echo ($last_seen_location === 'maasim') ? 'selected' : ''; ?>>Maasim</option>
									<option value="maitum" <?php echo ($last_seen_location === 'maitum') ? 'selected' : ''; ?>>Maitum</option>
									<option value="malapatan" <?php echo ($last_seen_location === 'malapatan') ? 'selected' : ''; ?>>Malapatan</option>
									<option value="malungon" <?php echo ($last_seen_location === 'malungon') ? 'selected' : ''; ?>>Malungon</option>
								</select>							
								</div>
							</div>

							<!-- Province -->
								<!-- <label class="mt-2">Province</label>
								<div class="row">
									<div class="col">
										<select id="province" name="province" class="form-select mb-2">
											<option value="sarangani" selected>Alabel</option>
											<option value="davao">Davao</option>
											<option value="south_cotabato">South Cotabato</option>
											<option value="cotabato">Cotabato</option>
										</select>
									</div>
								</div> -->

							<!-- Threats to Upland Farms -->
							<label class="mt-2">Threats to Upland Farms</label>
							<div class="row">
								<div class="col">
									<!-- Descrition -->
									<textarea name="threats" id="threat-desc" class="form-control" rows="2" disabled <?php echo ($threats !== $emptyValue) ? '>' . $threats : 'placeholder="Empty">'; ?></textarea>
							</div>
						</div>

						<!-- Other Information -->
						<label class="mt-2">Other Information</label>
						<div class="row">
							<div class="col">
								<!-- Descrition -->
								<textarea name="other_info" id="more-desc" class="form-control" rows="2" disabled <?php echo ($other_info !== $emptyValue) ? '>' . $other_info : 'placeholder="Empty">'; ?></textarea>
								</div>
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