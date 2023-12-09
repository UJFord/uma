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
									// Query to select all available Botanical Information in the database
									$query2 = "SELECT * FROM botanical_information where botanical_information_id='$current_botanical_information_id'";

									// Executing query
									$query_run2 = pg_query($connection, $query2);

									// Count rows to check whether we have a Botanical Information or not
									$count2 = pg_num_rows($query_run2);

									// If count is greater than 0, we have a Botanical Information; else, we do not have a Botanical Information
									if ($count2 > 0) {
										// We have a Botanical Information
										while ($row2 = pg_fetch_assoc($query_run2)) {
											// Get the details of the Botanical Information
											$scientific_name = $row2['scientific_name'];
											$common_names = $row2['common_names'];

									?>
											<tr>
												<th class="table-secondary w-25" scope="row">Scientific Name</th>
												<td><input type="text" name="scientific_name" value="<?php echo $scientific_name; ?>" class="w-100 border-0 p-1" disabled></td>
											</tr>
											<tr>
												<th class="table-secondary"></th>
												<td><input type="text" name="common_names" value="<?php echo $common_names; ?>" class="w-100 border-0 p-1" disabled></td>
											</tr>
										<?php
										}
									} else {
										// We do not have a Botanical Information
										?>
										<tr>
											<th class="table-secondary w-25" scope="row">Scientific Name</th>
											<td><input type="text" name="scientific_name" value="0" class="w-100 border-0 p-1" disabled>No Scientific Name Available</td>
										</tr>
										<tr>
											<th class="table-secondary">Common Names</th>
											<td><input type="text" name="common_names" value="0" class="w-100 border-0 p-1" disabled>No Common Name Available</td>
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
									// Query to select all available Traditional Crop Traits in the database
									$query3 = "SELECT * FROM traditional_crop_traits where traditional_crop_traits_id='$current_traditional_crop_traits_id'";

									// Executing query
									$query_run3 = pg_query($connection, $query3);

									// If count is greater than 0, we have a Traditional Crop Traits; else, we do not have a Traditional Crop Traits
									if (pg_num_rows($query_run) > 0) {
										$traditional_crop_traits = pg_fetch_assoc($query_run3);
									?>
										<tr>
											<th class="table-secondary w-25" scope="row">Taste</th>
											<td><input type="text" name="taste" value="<?= $traditional_crop_traits['taste']; ?>" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Aroma</th>
											<td><input type="text" name="aroma" value="<?= $traditional_crop_traits['aroma']; ?>" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Maturation</th>
											<td><input type="text" name="maturation" value="<?= $traditional_crop_traits['maturation']; ?>" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Drought Tolerance</th>
											<td><input type="text" name="drought_tolerance" value="<?= $traditional_crop_traits['drought_tolerance']; ?>" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Environmental Adaptability</th>
											<td><input type="text" name="environment_adaptability" value="<?= $traditional_crop_traits['environment_adaptability']; ?>" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Culinary Quality</th>
											<td><input type="text" name="culinary_quality" value="<?= $traditional_crop_traits['culinary_quality']; ?>" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Nutritional Value</th>
											<td><input type="text" name="nutritional_value" value="<?= $traditional_crop_traits['nutritional_value']; ?>" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Disease Resistance</th>
											<td><input type="text" name="disease_resistance" value="<?= $traditional_crop_traits['disease_resistance']; ?>" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Pest Resistance</th>
											<td><input type="text" name="pest_resistance" value="<?= $traditional_crop_traits['pest_resistance']; ?>" class="w-100 border-0 p-1" disabled></td>
										</tr>

									<?php

									} else {
										// We do not have a Traditional Crop Traits
									?>
										<tr>
											<th class="table-secondary w-25">Taste</th>
											<td><input type="text" name="taste" value="0" class="w-100 border-0 p-1">No Taste Available</td>
										</tr>
										<tr>
											<th class="table-secondary">Aroma</th>
											<td><input type="text" name="aroma" value="0" class="w-100 border-0 p-1">No Aroma Available</td>
										</tr>
										<tr>
											<th class="table-secondary">Maturity Period</th>
											<td><input type="text" name="maturation" value="0" class="w-100 border-0 p-1">No Maturation Period Available</td>
										</tr>
										<tr>
											<th class="table-secondary">Drought Tolerance</th>
											<td><input type="text" name="drought_tolerance" value="0" class="w-100 border-0 p-1">No Drought Tolerance Available</td>
										</tr>
										<tr>
											<th class="table-secondary">Adaptability to Different Environments</th>
											<td><input type="text" name="environment_adaptability" value="0" class="w-100 border-0 p-1">No Adaptability to Different Environments Available</td>
										</tr>
										<tr>
											<th class="table-secondary">Cooking and Eating Quality</th>
											<td><input type="text" name="culinary_quality" value="0" class="w-100 border-0 p-1">No Cooking and Eating Quality Available</td>
										</tr>
										<tr>
											<th class="table-secondary">Nutritional Value</th>
											<td><input type="text" name="nutritional_value" value="0" class="w-100 border-0 p-1">No Nutritional Value Available</td>
										</tr>
										<tr>
											<th class="table-secondary">Disease Resistance</th>
											<td><input type="text" name="disease_resistance" value="0" class="w-100 border-0 p-1">No Disease Resistance Available</td>
										</tr>
										<tr>
											<th class="table-secondary">Pest Resistance</th>
											<td><input type="text" name="pest_resistance" value="0" class="w-100 border-0 p-1">No Pest Resistance Available</td>
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
									// Query to select all available Agronomic Information in the database
									$query5 = "SELECT * FROM agronomic_information where agronomic_information_id='$current_agronomic_information_id'";

									// Executing query
									$query_run5 = pg_query($connection, $query5);

									// If count is greater than 0, we have a Agronomic Information; else, we do not have a Agronomic Information
									if (pg_num_rows($query_run5) > 0) {
										$agronomic_information = pg_fetch_assoc($query_run5);

									?>
										<tr>
											<th class="table-secondary w-25" scope="row">Days to Mature</th>
											<td><input type="text" name="days_to_mature" value="<?php echo $agronomic_information['days_to_mature']; ?>" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Yield Potential</th>
											<td><input type="text" name="yield_potential" value="<?php echo $agronomic_information['yield_potential']; ?>" class="w-100 border-0 p-1" disabled></td>
										</tr>
									<?php

									} else {
										// We do not have a Agronomic Information
									?>
										<tr>
											<th class="table-secondary w-25" scope="row">Days to Mature</th>
											<td><input type="text" name="days_to_mature" value="0" class="w-100 border-0 p-1" disabled>No Days to Mature Available</td>
										</tr>
										<tr>
											<th class="table-secondary">Yield Potential</th>
											<td><input type="text" name="yield_potential" value="0" class="w-100 border-0 p-1" disabled>No Yield Potential Available</td>
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
									// PHP code to display available Morphological Characteristics from the database
									// Query to select all available Morphological Characteristics in the database
									$query6 = "SELECT * FROM morphological_characteristic where morphological_characteristic_id='$current_morphological_characteristic_id'";

									// Executing query
									$query_run6 = pg_query($connection, $query6);

									// If count is greater than 0, we have a Morphological Characteristics; else, we do not have a Morphological Characteristics
									if (pg_num_rows($query_run6) > 0) {
										$morphological_characteristic = pg_fetch_assoc($query_run6);

									?>
										<tr>
											<th class="table-secondary w-25" scope="row">Plant Height</th>
											<td><input type="text" name="plant_height" value="<?php echo $morphological_characteristic['plant_height']; ?>" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Panicle Length</th>
											<td><input type="text" name="panicle_length" value="<?php echo $morphological_characteristic['panicle_length']; ?>" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Grain Quality</th>
											<td><input type="text" name="grain_quality" value="<?php echo $morphological_characteristic['grain_quality']; ?>" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Grain Color</th>
											<td><input type="text" name="grain_color" value="<?php echo $morphological_characteristic['grain_color']; ?>" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Grain Length</th>
											<td><input type="text" name="grain_length" value="<?php echo $morphological_characteristic['grain_length']; ?>" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Grain Width</th>
											<td><input type="text" name="grain_width" value="<?php echo $morphological_characteristic['grain_width']; ?>" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Grain Shape</th>
											<td><input type="text" name="grain_shape" value="<?php echo $morphological_characteristic['grain_shape']; ?>" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Awn Length</th>
											<td><input type="text" name="awn_length" value="<?php echo $morphological_characteristic['awn_length']; ?>" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Leaf Length</th>
											<td><input type="text" name="leaf_length" value="<?php echo $morphological_characteristic['leaf_length']; ?>" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Leaf Width</th>
											<td><input type="text" name="leaf_width" value="<?php echo $morphological_characteristic['leaf_width']; ?>" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Leaf Shape</th>
											<td><input type="text" name="leaf_shape" value="<?php echo $morphological_characteristic['leaf_shape']; ?>" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Stem Color</th>
											<td><input type="text" name="stem_color" value="<?php echo $morphological_characteristic['stem_color']; ?>" class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary">Another Color</th>
											<td><input type="text" name="another_color" value="<?php echo $morphological_characteristic['another_color']; ?>" class="w-100 border-0 p-1" disabled></td>
										</tr>
									<?php

									} else {
										// We do not have a Morphological Characteristics
									?>
										<tr>
											<th class="table-secondary w-25" scope="row">Plant Height</th>
											<td><input type="text" name="plant_height" value="0" class="w-100 border-0 p-1" disabled>No Plant Height Available</td>
										</tr>
										<tr>
											<th class="table-secondary">Panicle length</th>
											<td><input type="text" name="panicle_length" value="0" class="w-100 border-0 p-1" disabled>No Panicle length Available</td>
										</tr>
										<tr>
											<th class="table-secondary">Grain Quality</th>
											<td><input type="text" name="grain_quality" value="0" class="w-100 border-0 p-1" disabled>No Grain Quality Available</td>
										</tr>
										<tr>
											<th class="table-secondary">Grain Color</th>
											<td><input type="text" name="grain_color" value="0" class="w-100 border-0 p-1" disabled>No Grain Color Available</td>
										</tr>
										<tr>
											<th class="table-secondary">Grain Length</th>
											<td><input type="text" name="grain_length" value="0" class="w-100 border-0 p-1" disabled>No Grain Length Available</td>
										</tr>
										<tr>
											<th class="table-secondary">Grain Width</th>
											<td><input type="text" name="grain_width" value="0" class="w-100 border-0 p-1" disabled>No Grain Width Available</td>
										</tr>
										<tr>
											<th class="table-secondary">Grain Shape</th>
											<td><input type="text" name="grain_shape" value="0" class="w-100 border-0 p-1" disabled>No Grain Shape Available</td>
										</tr>
										<tr>
											<th class="table-secondary">Awn Length</th>
											<td><input type="text" name="awn_length" value="0" class="w-100 border-0 p-1" disabled>No Awn Length Available</td>
										</tr>
										<tr>
											<th class="table-secondary">Leaf Length</th>
											<td><input type="text" name="leaf_length" value="0" class="w-100 border-0 p-1" disabled>No Leaf Length Available</td>
										</tr>
										<tr>
											<th class="table-secondary">Leaf Width</th>
											<td><input type="text" name="leaf_width" value="0" class="w-100 border-0 p-1" disabled>No Leaf Width Available</td>
										</tr>
										<tr>
											<th class="table-secondary">Leaf Shape</th>
											<td><input type="text" name="leaf_shape" value="0" class="w-100 border-0 p-1" disabled>No Leaf Shape Available</td>
										</tr>
										<tr>
											<th class="table-secondary">Stem Color</th>
											<td><input type="text" name="stem_color" value="0" class="w-100 border-0 p-1" disabled>No Stem Color Available</td>
										</tr>
										<tr>
											<th class="table-secondary">Another Color</th>
											<td><input type="text" name="another_color" value="0" class="w-100 border-0 p-1" disabled>No Another Color Available</td>
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
									// PHP code to display available Agronomic Information from the database
									// Query to select all available Agronomic Information in the database
									$query7 = "SELECT * FROM relationship_among_cultivars where relationship_among_cultivars_id='$current_relationship_among_cultivars_id'";

									// Executing query
									$query_run7 = pg_query($connection, $query7);

									// If count is greater than 0, we have a Agronomic Information; else, we do not have a Agronomic Information
									if (pg_num_rows($query_run7) > 0) {
										$relationship_among_cultivars = pg_fetch_assoc($query_run7);

									?>
										<tr>
											<th class="table-secondary w-25" scope="row">Distinct Groups of Cultivars based on Morphological and Genetic Characteristics</th>
											<td><textarea name="distinct_cultivar_groups_morph_gen" class="w-100 border-0 p-1" rows="5" value="<?php echo $relationship_among_cultivars['distinct_cultivar_groups_morph_gen']; ?>" disabled><?php echo $relationship_among_cultivars['distinct_cultivar_groups_morph_gen']; ?></textarea></td>
										</tr>
										<tr>
											<th class="table-secondary">Relationships Among Cultivars based on Cluster Analysis and Principal Component Analysis</th>
											<td><textarea name="cultivar_relations_cluster_and_pca" class="w-100 border-0 p-1" rows="5" value="<?php echo $relationship_among_cultivars['cultivar_relations_cluster_and_pca']; ?>" disabled><?php echo $relationship_among_cultivars['cultivar_relations_cluster_and_pca']; ?></textarea></td>
										</tr>
										<tr>
											<th class="table-secondary">Potential for Hybridization and Breeding Among Cultivars</th>
											<td><textarea name="hybridization_potential" class="w-100 border-0 p-1" rows="5" value="<?php echo $relationship_among_cultivars['hybridization_potential']; ?>" disabled><?php echo $relationship_among_cultivars['hybridization_potential']; ?></textarea></td>
										</tr>
										<tr>
											<th class="table-secondary">Implications for Conservation and Breeding Efforts</th>
											<td><textarea name="conservation_and_breeding_implications" class="w-100 border-0 p-1" rows="5" value="<?php echo $relationship_among_cultivars['conservation_and_breeding_implications']; ?>" disabled><?php echo $relationship_among_cultivars['conservation_and_breeding_implications']; ?></textarea></td>
										</tr>
									<?php

									} else {
										// We do not have a Agronomic Information
									?>
										<tr>
											<th class="table-secondary w-25" scope="row">Distinct Groups of Cultivars based on Morphological and Genetic Characteristics</th>
											<td><textarea name="conservation_and_breeding_implications" class="w-100 border-0" rows="5" value="0" disabled>No Distinct Groups of Cultivars based on Morphological and Genetic Characteristics Available</textarea></td>
										</tr>
										<tr>
											<th class="table-secondary">Relationships Among Cultivars based on Cluster Analysis and Principal Component Analysis</th>
											<td><textarea name="cultivar_relations_cluster_and_pca" class="w-100 border-0" rows="5" value="0" disabled>No Relationships Among Cultivars based on Cluster Analysis and Principal Component Analysis Available</textarea></td>
										</tr>
										<tr>
											<th class="table-secondary">Potential for Hybridization and Breeding Among Cultivars</th>
											<td><textarea name="hybridization_potential" class="w-100 border-0" rows="5" value="0" disabled>No Potential for Hybridization and Breeding Among Cultivars Available</textarea></td>
										</tr>
										<tr>
											<th class="table-secondary">Implications for Conservation and Breeding Efforts</th>
											<td><textarea name="conservation_and_breeding_implications" class="w-100 border-0" rows="5" value="0" disabled>No Implications for Conservation and Breeding Efforts Available</textarea></td>
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
						<?php
						require('../edit-btn/edit-btn.php');
						?>
					</form>
			<?php

				}
			}
			?>
		</section>
		<!-- editting buttons -->
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