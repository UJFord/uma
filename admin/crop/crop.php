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

				if (pg_num_rows($query_run) > 0) {
					$crops = pg_fetch_assoc($query_run);
					$current_agronomic_information_id = $crops['agronomic_information_id'];
					$current_botanical_information_id = $crops['botanical_information_id'];
					$current_morphological_characteristic_id = $crops['morphological_characteristic_id'];
					$current_traditional_crop_traits_id = $crops['traditional_crop_traits_id'];
					$current_relationship_among_cultivars_id = $crops['relationship_among_cultivars_id'];
			?>
					<!-- form for submitting -->
					<form id="form-panel" name="Form" action="code.php" autocomplete="off" onsubmit="return validateForm()" method="POST" class="h-100 py-3 px-5">
						<!-- back button -->
						<a href="list.php" class="link-offset-2"><i class="bi bi-chevron-left"></i>Go Back</a>

						<!-- title-->
						<div class="row d-flex justify-content-between my-3">
							<div class="col-6">
								<h3>
									<input id="title" type="text" name="crop_name" value="<?= $crops['crop_name']; ?>" class="fw-semibold w-100 border-0 py-1 px-2" disabled>
								</h3>
							</div>
						</div>

						<!-- crop information -->
						<div id="" class="row form-control p-3">

							<input type="hidden" name="crop_id" value="<?= $crops['crop_id']; ?>">
							<input type="hidden" name="botanical_information_id" value="<?= $crops['botanical_information_id']; ?>">
							<input type="hidden" name="agronomic_information_id" value="<?= $crops['agronomic_information_id']; ?>">
							<input type="hidden" name="morphological_characteristic_id" value="<?= $crops['morphological_characteristic_id']; ?>">
							<input type="hidden" name="traditional_crop_traits_id" value="<?= $crops['traditional_crop_traits_id']; ?>">
							<input type="hidden" name="relationship_among_cultivars_id" value="<?= $crops['relationship_among_cultivars_id']; ?>">

							<!-- Crop Info -->
							<table id="info-table" class="table table-hover table-sm">
								<thead>
									<tr>
										<th colspan="2" class="table-dark">Crop Info</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th class="table-secondary">Upland or Lowand</th>
										<td><input type="text" name="upland_or_lowland" value="<?= $crops['upland_or_lowland']; ?>" class="w-100 border-0 p-1" disabled></td>
									</tr>
									<tr>
										<th class="table-secondary w-25" scope="row">Season</th>
										<td><input type="text" name="season" value="<?= $crops['season']; ?>" class="w-100 border-0 p-1" disabled></td>
									</tr>
									<tr>
										<th class="table-secondary w-25" scope="row">Category</th>
										<td><input type="text" name="category" value="<?= $crops['category']; ?>" class="w-100 border-0 p-1" disabled></td>
									</tr>
									<tr>
										<th class="table-secondary w-25" scope="row">Links</th>
										<td><input type="text" name="links" value="<?= $crops['links']; ?>" class="w-100 border-0 p-1" disabled></td>
									</tr>
									<tr>
										<th class="table-secondary w-25" scope="row">Description</th>
										<td><input type="text" name="description" value="<?= $crops['description']; ?>" class="w-100 border-0 p-1" disabled></td>
									</tr>
									<tr>
										<th class="table-secondary w-25" scope="row">Image Link</th>
										<td><input type="text" name="image" value="<?= $crops['image']; ?>" class="w-100 border-0 p-1" disabled></td>
									</tr>
									<tr>
										<th class="table-secondary w-25" scope="row">Local Name</th>
										<td><input type="text" name="local_name" value="<?= $crops['local_name']; ?>" class="w-100 border-0 p-1" disabled></td>
									</tr>
								</tbody>
							</table>

							<!-- botanical information -->
							<table id="info-table" class="table table-hover table-sm">
								<thead>
									<tr>
										<th colspan="2" class="table-dark">Botanical Information</th>
									</tr>
								</thead>
								<tbody>
									<?php
									// PHP code to display available Botanical Information from the database

									// Check if $current_botanical_information_id is not null
									if ($current_botanical_information_id !== null) {
										// Query to select all available Botanical Information in the database
										$query2 = "SELECT * FROM botanical_information WHERE botanical_information_id='$current_botanical_information_id'";

										// Executing query
										$query_run2 = pg_query($connection, $query2);

										// If count is greater than 0, we have Botanical Information; else, we do not have Botanical Information
										if (pg_num_rows($query_run2) > 0) {
											// We have Botanical Information
											$row2 = pg_fetch_assoc($query_run2);

											// Get the details of the Botanical Information
											$scientific_name = isset($row2['scientific_name']) ? $row2['scientific_name'] : "No Scientific Name Available";
											$common_names = isset($row2['common_names']) ? $row2['common_names'] : "No Common Name Available";
									?>
											<tr>
												<th class="table-secondary w-25" scope="row">Scientific Name</th>
												<td><input type="text" name="scientific_name" value="<?= $scientific_name; ?>" class="w-100 border-0 p-1" disabled></td>
											</tr>
											<tr>
												<th class="table-secondary">Common Names</th>
												<td><input type="text" name="common_names" value="<?= $common_names; ?>" class="w-100 border-0 p-1" disabled></td>
											</tr>
										<?php
										}
									} else {
										// Handle the case when $current_botanical_information_id is null
										?>
										<tr>
											<th class="table-secondary w-25" scope="row">Scientific Name</th>
											<td><input type="text" name="scientific_name" placeholder="No Scientific Name Available" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Common Names</th>
											<td><input type="text" name="common_names" placeholder="No Common Name Available" class="w-100 border-0 p-1" disabled></td>
										</tr>
									<?php
									}
									?>

								</tbody>
							</table>

							<!-- characteristics of traditional rice -->
							<table class="table table-hover table-sm">
								<thead>
									<tr>
										<th colspan="2" class="table-dark">Characteristics of Traditional Rice</th>
									</tr>
								</thead>
								<tbody>
									<?php
									// PHP code to display available Traditional Crop Traits from the database

									// Check if $current_traditional_crop_traits_id is not null
									if ($current_traditional_crop_traits_id !== null) {
										// Query to select all available Traditional Crop Traits in the database
										$query3 = "SELECT * FROM traditional_crop_traits WHERE traditional_crop_traits_id='$current_traditional_crop_traits_id'";

										// Executing query
										$query_run3 = pg_query($connection, $query3);

										// If count is greater than 0, we have Traditional Crop Traits; else, we do not have Traditional Crop Traits
										if (pg_num_rows($query_run3) > 0) {
											$traditional_crop_traits = pg_fetch_assoc($query_run3);

											// Define default values for each field if they are null
											$taste = isset($traditional_crop_traits['taste']) ? $traditional_crop_traits['taste'] : "No Taste Available";
											$aroma = isset($traditional_crop_traits['aroma']) ? $traditional_crop_traits['aroma'] : "No Aroma Available";
											$maturation = isset($traditional_crop_traits['maturation']) ? $traditional_crop_traits['maturation'] : "No Maturation Period Available";
											$drought_tolerance = isset($traditional_crop_traits['drought_tolerance']) ? $traditional_crop_traits['drought_tolerance'] : "No Drought Tolerance Available";
											$environment_adaptability = isset($traditional_crop_traits['environment_adaptability']) ? $traditional_crop_traits['environment_adaptability'] : "No Adaptability to Different Environments Available";
											$culinary_quality = isset($traditional_crop_traits['culinary_quality']) ? $traditional_crop_traits['culinary_quality'] : "No Cooking and Eating Quality Available";
											$nutritional_value = isset($traditional_crop_traits['nutritional_value']) ? $traditional_crop_traits['nutritional_value'] : "No Nutritional Value Available";
											$disease_resistance = isset($traditional_crop_traits['disease_resistance']) ? $traditional_crop_traits['disease_resistance'] : "No Disease Resistance Available";
											$pest_resistance = isset($traditional_crop_traits['pest_resistance']) ? $traditional_crop_traits['pest_resistance'] : "No Pest Resistance Available";
									?>
											<tr>
												<th class="table-secondary w-25" scope="row">Taste</th>
												<td><input type="text" name="taste" value="<?= $taste; ?>" class="w-100 border-0 p-1" disabled></td>
											</tr>
											<tr>
												<th class="table-secondary">Aroma</th>
												<td><input type="text" name="aroma" value="<?= $aroma; ?>" class="w-100 border-0 p-1" disabled></td>
											</tr>
											<tr>
												<th class="table-secondary">Maturation Period</th>
												<td><input type="text" name="maturation" value="<?= $maturation; ?>" class="w-100 border-0 p-1" disabled></td>
											</tr>
											<tr>
												<th class="table-secondary">Drought Tolerance</th>
												<td><input type="text" name="drought_tolerance" value="<?= $drought_tolerance; ?>" class="w-100 border-0 p-1" disabled></td>
											</tr>
											<tr>
												<th class="table-secondary">Adaptability to Different Environments</th>
												<td><input type="text" name="environment_adaptability" value="<?= $environment_adaptability; ?>" class="w-100 border-0 p-1" disabled></td>
											</tr>
											<tr>
												<th class="table-secondary">Cooking and Eating Quality</th>
												<td><input type="text" name="culinary_quality" value="<?= $culinary_quality; ?>" class="w-100 border-0 p-1" disabled></td>
											</tr>
											<tr>
												<th class="table-secondary">Nutritional Value</th>
												<td><input type="text" name="nutritional_value" value="<?= $nutritional_value; ?>" class="w-100 border-0 p-1" disabled></td>
											</tr>
											<tr>
												<th class="table-secondary">Disease Resistance</th>
												<td><input type="text" name="disease_resistance" value="<?= $disease_resistance; ?>" class="w-100 border-0 p-1" disabled></td>
											</tr>
											<tr>
												<th class="table-secondary">Pest Resistance</th>
												<td><input type="text" name="pest_resistance" value="<?= $pest_resistance; ?>" class="w-100 border-0 p-1" disabled></td>
											</tr>
										<?php
										}
									} else {
										// Handle the case when $current_traditional_crop_traits_id is null
										?>
										<tr>
											<th class="table-secondary w-25">Taste</th>
											<td><input type="text" name="taste" placeholder="No Taste Available" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Aroma</th>
											<td><input type="text" name="aroma" placeholder="No Aroma Available" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Maturation Period</th>
											<td><input type="text" name="maturation" placeholder="No Maturation Period Available" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Drought Tolerance</th>
											<td><input type="text" name="drought_tolerance" placeholder="No Drought Tolerance Available" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Adaptability to Different Environments</th>
											<td><input type="text" name="environment_adaptability" placeholder="No Adaptability to Different Environments Available" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Cooking and Eating Quality</th>
											<td><input type="text" name="culinary_quality" placeholder="No Cooking and Eating Quality Available" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Nutritional Value</th>
											<td><input type="text" name="nutritional_value" placeholder="No Nutritional Value Available" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Disease Resistance</th>
											<td><input type="text" name="disease_resistance" placeholder="No Disease Resistance Available" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Pest Resistance</th>
											<td><input type="text" name="pest_resistance" placeholder="No Pest Resistance Available" class="w-100 border-0 p-1" disabled></td>
										</tr>
									<?php
									}
									?>
								</tbody>
							</table>

							<!-- planting techniques -->
							<table class="table table-hover table-sm">
								<thead>
									<tr>
										<th colspan="2" class="table-dark">Planting Techniques</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th class="table-secondary w-25">Description</th>
										<td><textarea name="planting_techniques" value="<?= $crops['planting_techniques']; ?>" class="w-100 border-0 p-1" rows="10" disabled><?= $crops['planting_techniques']; ?></textarea></td>
									</tr>
								</tbody>
							</table>

							<!-- Cultural and Spiritual Significance-->
							<table class="table table-hover table-sm">
								<thead>
									<tr>
										<th colspan="2" class="table-dark">Cultural and Spiritual Significance</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th class="table-secondary w-25">Description</th>
										<td><textarea name="cultural_and_spiritual_significance" value="<?= $crops['cultural_and_spiritual_significance']; ?>" class="w-100 border-0 p-1" rows="5" disabled><?= $crops['cultural_and_spiritual_significance']; ?></textarea></td>
									</tr>
								</tbody>
							</table>

							<!-- Agronomic Characteristic -->
							<table class="table table-hover table-sm">
								<thead>
									<tr>
										<th colspan="2" class="table-dark">Agronomic Characteristic</th>
									</tr>
								</thead>
								<tbody>
									<?php
									// PHP code to display available Agronomic Information from the database
									// Check if $current_agronomic_information_id is not null
									if ($current_agronomic_information_id !== null) {
										// Query to select all available Agronomic Information in the database
										$query5 = "SELECT * FROM agronomic_information WHERE agronomic_information_id='$current_agronomic_information_id'";
										// Executing query
										$query_run5 = pg_query($connection, $query5);

										// If count is greater than 0, we have Agronomic Information; else, we do not have Agronomic Information
										if (pg_num_rows($query_run5) > 0) {
											$agronomic_information = pg_fetch_assoc($query_run5);
											// Define default values for each field if they are null
											$days_to_mature = isset($agronomic_information['days_to_mature']) ? $agronomic_information['days_to_mature'] : "No Days to Mature Available";
											$yield_potential = isset($agronomic_information['yield_potential']) ? $agronomic_information['yield_potential'] : "No Yield Potential Available";
									?>
											<tr>
												<th class="table-secondary w-25" scope="row">Days to Mature</th>
												<td><input type="text" name="days_to_mature" value="<?= $days_to_mature; ?>" class="w-100 border-0 p-1" disabled></td>
											</tr>
											<tr>
												<th class="table-secondary">Yield Potential</th>
												<td><input type="text" name="yield_potential" value="<?= $yield_potential ?>" class="w-100 border-0 p-1" disabled></td>
											</tr>
										<?php
										}
									} else {
										// Handle the case when $current_agronomic_information_id is null
										?>
										<tr>
											<th class="table-secondary w-25" scope="row">Days to Mature</th>
											<td><input type="text" name="days_to_mature" placeholder="No Days to Mature Available" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Yield Potential</th>
											<td><input type="text" name="yield_potential" placeholder="No Yield Potential Available" class="w-100 border-0 p-1" disabled></td>
										</tr>
									<?php
									}
									?>

								</tbody>
							</table>

							<!-- Role in maintaining upland ecosystems And biodiversity-->
							<table class="table table-hover table-sm">
								<thead>
									<tr>
										<th colspan="2" class="table-dark">Role in Maintaining Upland Ecosystems</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th class="table-secondary w-25">Description</th>
										<td><textarea name="rice_biodiversity_uplift" value="<?php echo $crops['rice_biodiversity_uplift']; ?>" class="w-100 border-0 p-1" rows="5" disabled><?php echo $crops['rice_biodiversity_uplift']; ?></textarea></td>
									</tr>
								</tbody>
							</table>

							<!-- Economic Importance-->
							<table class="table table-hover table-sm">
								<thead>
									<tr>
										<th colspan="2" class="table-dark">Economic Importance</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th class="table-secondary w-25">Description</th>
										<td><textarea name="economic_importance" class="w-100 border-0 p-1" rows="5" value="<?php echo $crops['economic_importance']; ?>" disabled><?php echo $crops['economic_importance']; ?></textarea></td>
									</tr>
								</tbody>
							</table>

							<!-- Traditional Knowledge and Practices-->
							<table class="table table-hover table-sm">
								<thead>
									<tr>
										<th colspan="2" class="table-dark">Traditional Knowledge and Practices</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th class="table-secondary w-25">Description</th>
										<td><textarea name="traditional_knowledge_and_practices" class="w-100 border-0 p-1" rows="5" value="<?php echo $crops['traditional_knowledge_and_practices']; ?>" disabled><?php echo $crops['traditional_knowledge_and_practices']; ?></textarea></td>
									</tr>
								</tbody>
							</table>

							<!-- Location  -->
							<table class="table table-hover table-sm">
								<thead>
									<tr>
										<th colspan="2" class="table-dark">Location</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th class="table-secondary w-25">Map</th>
										<td></td>
									</tr>
									<tr>
										<th></th>
										<td></td>
									</tr>
								</tbody>
							</table>

							<!-- morphological characteristics  -->
							<table class="table table-hover table-sm">
								<thead>
									<tr>
										<th colspan="2" class="table-dark">Morphological Characteristics</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if ($current_morphological_characteristic_id !== null) {
										// PHP code to display available Morphological Characteristics from the database
										// Query to select all available Morphological Characteristics in the database
										$query6 = "SELECT * FROM morphological_characteristic WHERE morphological_characteristic_id='$current_morphological_characteristic_id'";

										// Executing query
										$query_run6 = pg_query($connection, $query6);

										// If count is greater than 0, we have Morphological Characteristics; else, we do not have Morphological Characteristics
										if (pg_num_rows($query_run6) > 0) {
											$morphological_characteristic = pg_fetch_assoc($query_run6);

											// Define default values for each field if they are null
											$plant_height = isset($morphological_characteristic['plant_height']) ? $morphological_characteristic['plant_height'] : "Not Available";
											$panicle_length = isset($morphological_characteristic['panicle_length']) ? $morphological_characteristic['panicle_length'] : "Not Available";
											$grain_quality = isset($morphological_characteristic['grain_quality']) ? $morphological_characteristic['grain_quality'] : "Not Available";
											$grain_color = isset($morphological_characteristic['grain_color']) ? $morphological_characteristic['grain_color'] : "Not Available";
											$grain_length = isset($morphological_characteristic['grain_length']) ? $morphological_characteristic['grain_length'] : "Not Available";
											$grain_width = isset($morphological_characteristic['grain_width']) ? $morphological_characteristic['grain_width'] : "Not Available";
											$grain_shape = isset($morphological_characteristic['grain_shape']) ? $morphological_characteristic['grain_shape'] : "Not Available";
											$awn_length = isset($morphological_characteristic['awn_length']) ? $morphological_characteristic['awn_length'] : "Not Available";
											$leaf_length = isset($morphological_characteristic['leaf_length']) ? $morphological_characteristic['leaf_length'] : "Not Available";
											$leaf_width = isset($morphological_characteristic['leaf_width']) ? $morphological_characteristic['leaf_width'] : "Not Available";
											$leaf_shape = isset($morphological_characteristic['leaf_shape']) ? $morphological_characteristic['leaf_shape'] : "Not Available";
											$stem_color = isset($morphological_characteristic['stem_color']) ? $morphological_characteristic['stem_color'] : "Not Available";
											$another_color = isset($morphological_characteristic['another_color']) ? $morphological_characteristic['another_color'] : "Not Available";
									?>
											<tr>
												<th class="table-secondary w-25" scope="row">Plant Height</th>
												<td><input type="text" name="plant_height" value="<?= $plant_height; ?>" class="w-100 border-0 p-1" disabled></td>
											</tr>
											<tr>
												<th class="table-secondary">Panicle Length</th>
												<td><input type="text" name="panicle_length" value="<?= $panicle_length; ?>" class="w-100 border-0 p-1" disabled></td>
											</tr>
											<tr>
												<th class="table-secondary">Grain Quality</th>
												<td><input type="text" name="grain_quality" value="<?= $grain_quality; ?>" class="w-100 border-0 p-1" disabled></td>
											</tr>
											<tr>
												<th class="table-secondary">Grain Color</th>
												<td><input type="text" name="grain_color" value="<?= $grain_color; ?>" class="w-100 border-0 p-1" disabled></td>
											</tr>
											<tr>
												<th class="table-secondary">Grain Length</th>
												<td><input type="text" name="grain_length" value="<?= $grain_length; ?>" class="w-100 border-0 p-1" disabled></td>
											</tr>
											<tr>
												<th class="table-secondary">Grain Width</th>
												<td><input type="text" name="grain_width" value="<?= $grain_width; ?>" class="w-100 border-0 p-1" disabled></td>
											</tr>
											<tr>
												<th class="table-secondary">Grain Shape</th>
												<td><input type="text" name="grain_shape" value="<?= $grain_shape; ?>" class="w-100 border-0 p-1" disabled></td>
											</tr>
											<tr>
												<th class="table-secondary">Awn Length</th>
												<td><input type="text" name="awn_length" value="<?= $awn_length; ?>" class="w-100 border-0 p-1" disabled></td>
											</tr>
											<tr>
												<th class="table-secondary">Leaf Length</th>
												<td><input type="text" name="leaf_length" value="<?= $leaf_length; ?>" class="w-100 border-0 p-1" disabled></td>
											</tr>
											<tr>
												<th class="table-secondary">Leaf Width</th>
												<td><input type="text" name="leaf_width" value="<?= $leaf_width; ?>" class="w-100 border-0 p-1" disabled></td>
											</tr>
											<tr>
												<th class="table-secondary">Leaf Shape</th>
												<td><input type="text" name="leaf_shape" value="<?= $leaf_shape; ?>" class="w-100 border-0 p-1" disabled></td>
											</tr>
											<tr>
												<th class="table-secondary">Stem Color</th>
												<td><input type="text" name="stem_color" value="<?= $stem_color; ?>" class="w-100 border-0 p-1" disabled></td>
											</tr>
											<tr>
												<th class="table-secondary">Another Color</th>
												<td><input type="text" name="another_color" value="<?= $another_color; ?>" class="w-100 border-0 p-1" disabled></td>
											</tr>
										<?php
										}
									} else {
										// Handle the case when $current_morphological_characteristic_id is null
										?>
										<tr>
											<th class="table-secondary w-25" scope="row">Plant Height</th>
											<td><input type="text" name="plant_height" placeholder="No Plant Height Available" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Panicle Length</th>
											<td><input type="text" name="panicle_length" placeholder="No Panicle Length Available" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Grain Quality</th>
											<td><input type="text" name="grain_quality" placeholder="No Grain Quality Available" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Grain Color</th>
											<td><input type="text" name="grain_color" placeholder="No Grain Color Available" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Grain Length</th>
											<td><input type="text" name="grain_length" placeholder="No Grain Length Available" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Grain Width</th>
											<td><input type="text" name="grain_width" placeholder="No Grain Width Available" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Grain Shape</th>
											<td><input type="text" name="grain_shape" placeholder="No Grain Shape Available" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Awn Length</th>
											<td><input type="text" name="awn_length" placeholder="No Awn Length Available" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Leaf Length</th>
											<td><input type="text" name="leaf_length" placeholder="No Leaf Length Available" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Leaf Width</th>
											<td><input type="text" name="leaf_width" placeholder="No Leaf Width Available" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Leaf Shape</th>
											<td><input type="text" name="leaf_shape" placeholder="No Leaf Shape Available" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Stem Color</th>
											<td><input type="text" name="stem_color" placeholder="No Stem Color Available" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Another Color</th>
											<td><input type="text" name="another_color" placeholder="No Another Color Available" class="w-100 border-0 p-1" disabled></td>
										</tr>
									<?php
									}
									?>
								</tbody>
							</table>

							<!-- relationship among cultivars  -->
							<table class="table table-hover table-sm">
								<thead>
									<tr>
										<th colspan="2" class="table-dark">Relationship Among Cultivars</th>
									</tr>
								</thead>
								<tbody>
									<?php
									// PHP code to display available Relationship Among Cultivars from the database

									// Check if $current_relationship_among_cultivars_id is not null
									if ($current_relationship_among_cultivars_id !== null) {
										// Query to select all available Relationship Among Cultivars in the database
										$query7 = "SELECT * FROM relationship_among_cultivars WHERE relationship_among_cultivars_id='$current_relationship_among_cultivars_id'";

										// Executing query
										$query_run7 = pg_query($connection, $query7);

										// If count is greater than 0, we have Relationship Among Cultivars; else, we do not have Relationship Among Cultivars
										if (pg_num_rows($query_run7) > 0) {
											$relationship_among_cultivars = pg_fetch_assoc($query_run7);

											// Distinct Groups of Cultivars based on Morphological and Genetic Characteristics
											$distinct_groups = isset($relationship_among_cultivars['distinct_cultivar_groups_morph_gen']) ? $relationship_among_cultivars['distinct_cultivar_groups_morph_gen'] : "No Distinct Groups Available";

											// Relationships Among Cultivars based on Cluster Analysis and Principal Component Analysis
											$relations_cluster_pca = isset($relationship_among_cultivars['cultivar_relations_cluster_and_pca']) ? $relationship_among_cultivars['cultivar_relations_cluster_and_pca'] : "No Relationships Available";

											// Potential for Hybridization and Breeding Among Cultivars
											$hybridization_potential = isset($relationship_among_cultivars['hybridization_potential']) ? $relationship_among_cultivars['hybridization_potential'] : "No Hybridization Potential Available";

											// Implications for Conservation and Breeding Efforts
											$conservation_breeding_implications = isset($relationship_among_cultivars['conservation_and_breeding_implications']) ? $relationship_among_cultivars['conservation_and_breeding_implications'] : "No Implications Available";
									?>
											<tr>
												<th class="table-secondary w-25" scope="row">Distinct Groups of Cultivars based on Morphological and Genetic Characteristics</th>
												<td><textarea name="distinct_cultivar_groups_morph_gen" class="w-100 border-0 p-1" rows="5" disabled><?= $distinct_groups; ?></textarea></td>
											</tr>
											<tr>
												<th class="table-secondary">Relationships Among Cultivars based on Cluster Analysis and Principal Component Analysis</th>
												<td><textarea name="cultivar_relations_cluster_and_pca" class="w-100 border-0 p-1" rows="5" disabled><?= $relations_cluster_pca; ?></textarea></td>
											</tr>
											<tr>
												<th class="table-secondary">Potential for Hybridization and Breeding Among Cultivars</th>
												<td><textarea name="hybridization_potential" class="w-100 border-0 p-1" rows="5" disabled><?= $hybridization_potential; ?></textarea></td>
											</tr>
											<tr>
												<th class="table-secondary">Implications for Conservation and Breeding Efforts</th>
												<td><textarea name="conservation_and_breeding_implications" class="w-100 border-0 p-1" rows="5" disabled><?= $conservation_breeding_implications; ?></textarea></td>
											</tr>
										<?php
										}
									} else {
										// Handle the case when $current_relationship_among_cultivars_id is null
										?>
										<tr>
											<th class="table-secondary w-25" scope="row">Distinct Groups of Cultivars based on Morphological and Genetic Characteristics</th>
											<td><textarea name="distinct_cultivar_groups_morph_gen" class="w-100 border-0 p-1" rows="5" disabled>No Distinct Groups of Cultivars based on Morphological and Genetic Characteristics Available</textarea></td>
										</tr>
										<tr>
											<th class="table-secondary">Relationships Among Cultivars based on Cluster Analysis and Principal Component Analysis</th>
											<td><textarea name="cultivar_relations_cluster_and_pca" class="w-100 border-0 p-1" rows="5" disabled>No Relationships Among Cultivars based on Cluster Analysis and Principal Component Analysis Available</textarea></td>
										</tr>
										<tr>
											<th class="table-secondary">Potential for Hybridization and Breeding Among Cultivars</th>
											<td><textarea name="hybridization_potential" class="w-100 border-0 p-1" rows="5" disabled>No Potential for Hybridization and Breeding Among Cultivars Available</textarea></td>
										</tr>
										<tr>
											<th class="table-secondary">Implications for Conservation and Breeding Efforts</th>
											<td><textarea name="conservation_and_breeding_implications" class="w-100 border-0 p-1" rows="5" disabled>No Implications for Conservation and Breeding Efforts Available</textarea></td>
										</tr>
									<?php
									}
									?>
								</tbody>
							</table>

							<!-- potential for breeding -->
							<table class="table table-hover table-sm">
								<thead>
									<tr>
										<th colspan="2" class="table-dark">Potential for Breeding</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th class="table-secondary w-25">Description</th>
										<td><textarea name="breeding_potential" class="w-100 border-0 p-1" rows="5" value="<?php echo $crops['breeding_potential']; ?>" disabled><?php echo $crops['breeding_potential']; ?></textarea></td>
									</tr>
								</tbody>
							</table>

							<!-- threats from lowland-associated influences-->
							<table class="table table-hover table-sm">
								<thead>
									<tr>
										<th colspan="2" class="table-dark">Threats from Lowland-Associated Influences</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th class="table-secondary w-25">Description</th>
										<td><textarea name="threats" class="w-100 border-0 p-1" rows="5" value="<?php echo $crops['threats']; ?>" disabled><?php echo $crops['threats']; ?></textarea></td>
									</tr>
								</tbody>
							</table>

							<!-- other info-->
							<table class="table table-hover table-sm  mb-0">
								<thead>
									<tr>
										<th colspan="2" class="table-dark">Other Info</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th class="table-secondary w-25">Description</th>
										<td><textarea name="other_info" class="w-100 border-0 p-1" rows="5" value="<?php echo $crops['other_info']; ?>" disabled><?php echo $crops['other_info']; ?></textarea></td>
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