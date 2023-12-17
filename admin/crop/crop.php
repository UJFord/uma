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
					$current_agronomic_information_id = $crops['agronomic_information_id'];
					$current_botanical_information_id = $crops['botanical_information_id'];
					$current_morphological_characteristic_id = $crops['morphological_characteristic_id'];
					$current_traditional_crop_traits_id = $crops['traditional_crop_traits_id'];
					$current_relationship_among_cultivars_id = $crops['relationship_among_cultivars_id'];

					// Get the data from crops table
					// Define default values for each field if they are $emptyValue
					$crop_name = isset($crops['crop_name']) ? $crops['crop_name'] : $emptyValue;
					$upland_or_lowland = isset($crops['upland_or_lowland']) ? $crops['upland_or_lowland'] : $emptyValue;
					$season = isset($crops['season']) ? $crops['season'] : $emptyValue;
					$category = isset($crops['category']) ? $crops['category'] : $emptyValue;
					$links = isset($crops['links']) ? $crops['links'] : $emptyValue;
					$description = isset($crops['description']) ? $crops['description'] : $emptyValue;
					$image = isset($crops['image']) ? $crops['image'] : $emptyValue;
					$local_name = isset($crops['local_name']) ? $crops['local_name'] : $emptyValue;
					$planting_techniques = isset($crops['planting_techniques']) ? $crops['planting_techniques'] : $emptyValue;
					$cultural_and_spiritual_significance = isset($crops['cultural_and_spiritual_significance']) ? $crops['cultural_and_spiritual_significance'] : $emptyValue;
					$rice_biodiversity_uplift = isset($crops['rice_biodiversity_uplift']) ? $crops['rice_biodiversity_uplift'] : $emptyValue;
					$economic_importance = isset($crops['economic_importance']) ? $crops['economic_importance'] : $emptyValue;
					$traditional_knowledge_and_practices = isset($crops['traditional_knowledge_and_practices']) ? $crops['traditional_knowledge_and_practices'] : $emptyValue;
					$breeding_potential = isset($crops['breeding_potential']) ? $crops['breeding_potential'] : $emptyValue;
					$threats = isset($crops['threats']) ? $crops['threats'] : $emptyValue;
					$other_info = isset($crops['other_info']) ? $crops['other_info'] : $emptyValue;

			?>
					<!-- form for submitting -->
					<form id="form-panel" name="Form" action="code.php" autocomplete="off" onsubmit="return validateForm()" method="POST" class="h-100 py-3 px-5">
						<!-- back button -->
						<a href="list.php" class="link-offset-2"><i class="bi bi-chevron-left"></i>Go Back</a>

						<!-- title-->
						<div class="row d-flex justify-content-between my-3">
							<div class="col-6">
								<h3>
									<input id="title" type="text" name="crop_name" <?php echo ($crop_name != $emptyValue) ? 'value="' . $crop_name . '"' : 'placeholder="Empty"'; ?> class="fw-semibold w-100 border-0 py-1 px-2" disabled>
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

							<!-- General Information -->
							<table id="info-table" class="table table-hover table-sm">
								<thead>
									<tr>
										<th colspan="2" class="table-dark">General Information</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th class="table-secondary w-25">Upland or Lowand</th>
										<td><input type="text" name="upland_or_lowland" <?php echo ($upland_or_lowland != $emptyValue) ? 'value="' . $upland_or_lowland . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
									</tr>
									<tr>
										<th class="table-secondary w-25">Season</th>
										<td><input type="text" name="season" <?php echo ($season != $emptyValue) ? 'value="' . $season . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
									</tr>
									<tr>
										<th class="table-secondary w-25">Category</th>
										<td><input type="text" name="category" <?php echo ($category != $emptyValue) ? 'value="' . $category . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
									</tr>
									<tr>
										<th class="table-secondary w-25">Links</th>
										<td><input type="text" name="links" <?php echo ($links != $emptyValue) ? 'value="' . $links . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
									</tr>
									<tr>
										<th class="table-secondary w-25">Description</th>
										<td><input type="text" name="description" <?php echo ($description != $emptyValue) ? 'value="' . $description . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
									</tr>
									<tr>
										<th class="table-secondary w-25">Link to Image</th>
										<td><input type="text" name="image" <?php echo ($image != $emptyValue) ? 'value="' . $image . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
									</tr>
									<tr>
										<th class="table-secondary w-25">Local Name</th>
										<td><input type="text" name="local_name" <?php echo ($local_name != $emptyValue) ? 'value="' . $local_name . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
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
									$query2 = "SELECT * FROM botanical_information WHERE botanical_information_id='$current_botanical_information_id'";

									// Executing query
									$query_run2 = pg_query($connection, $query2);

									// If count is greater than 0, we have Botanical Information; else, we do not have Botanical Information
									if (pg_num_rows($query_run2) > 0) {
										// We have Botanical Information
										$row2 = pg_fetch_assoc($query_run2);

										// Get the details of the Botanical Information
										$scientific_name = isset($row2['scientific_name']) ? $row2['scientific_name'] : $emptyValue;
										$common_names = isset($row2['common_names']) ? $row2['common_names'] : $emptyValue;
									?>
										<tr>
											<th class="table-secondary w-25">Scientific Name</th>
											<td><input type="text" name="scientific_name" <?php echo ($scientific_name != $emptyValue) ? 'value="' . $scientific_name . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary w-25">Common Name</th>
											<td><input type="text" name="common_names" <?php echo ($common_names != $emptyValue) ? 'value="' . $common_names . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
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
										$drought_tolerance = isset($traditional_crop_traits['drought_tolerance']) ? $traditional_crop_traits['drought_tolerance'] : $emptyValue;
										$environment_adaptability = isset($traditional_crop_traits['environment_adaptability']) ? $traditional_crop_traits['environment_adaptability'] : $emptyValue;
										$culinary_quality = isset($traditional_crop_traits['culinary_quality']) ? $traditional_crop_traits['culinary_quality'] : $emptyValue;
										$nutritional_value = isset($traditional_crop_traits['nutritional_value']) ? $traditional_crop_traits['nutritional_value'] : $emptyValue;
										$disease_resistance = isset($traditional_crop_traits['disease_resistance']) ? $traditional_crop_traits['disease_resistance'] : $emptyValue;
										$pest_resistance = isset($traditional_crop_traits['pest_resistance']) ? $traditional_crop_traits['pest_resistance'] : $emptyValue;
									?>
										<tr>
											<th class="table-secondary w-25">Taste</th>
											<td><input type="text" name="taste" <?php echo ($taste != $emptyValue) ? 'value="' . $taste . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary w-25">Aroma</th>
											<td><input type="text" name="aroma" <?php echo ($aroma != $emptyValue) ? 'value="' . $aroma . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary w-25">Maturation</th>
											<td><input type="text" name="maturation" <?php echo ($maturation != $emptyValue) ? 'value="' . $maturation . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary w-25">Drought Tolerance</th>
											<td><input type="text" name="drought_tolerance" <?php echo ($drought_tolerance != $emptyValue) ? 'value="' . $drought_tolerance . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary w-25">Environment Adaptability</th>
											<td><input type="text" name="environment_adaptability" <?php echo ($environment_adaptability != $emptyValue) ? 'value="' . $environment_adaptability . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary w-25">Culinary Quality</th>
											<td><input type="text" name="culinary_quality" <?php echo ($culinary_quality != $emptyValue) ? 'value="' . $culinary_quality . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary w-25">Nutritional Value</th>
											<td><input type="text" name="nutritional_value" <?php echo ($nutritional_value != $emptyValue) ? 'value="' . $nutritional_value . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary w-25">Disease Resistance</th>
											<td><input type="text" name="disease_resistance" <?php echo ($disease_resistance != $emptyValue) ? 'value="' . $disease_resistance . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary w-25">Pest Resistance</th>
											<td><input type="text" name="pest_resistance" <?php echo ($pest_resistance != $emptyValue) ? 'value="' . $pest_resistance . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
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
										<td><textarea name="planting_techniques" class="w-100 border-0 p-1" rows="5" disabled <?php echo ($planting_techniques !== $emptyValue) ? '>' . $planting_techniques : 'placeholder="Empty">'; ?></textarea></td>
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
											<td><textarea name="cultural_and_spiritual_significance" class="w-100 border-0 p-1" rows="5" disabled <?php echo ($cultural_and_spiritual_significance !== $emptyValue) ? '>' . $cultural_and_spiritual_significance : 'placeholder="Empty">'; ?></textarea></td>
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
									$query5 = "SELECT * FROM agronomic_information WHERE agronomic_information_id='$current_agronomic_information_id'";
									// Executing query
									$query_run5 = pg_query($connection, $query5);

									// If count is greater than 0, we have Agronomic Information; else, we do not have Agronomic Information
									if (pg_num_rows($query_run5) > 0) {
										$agronomic_information = pg_fetch_assoc($query_run5);
										// Define default values for each field if they are $emptyValue
										$days_to_mature = isset($agronomic_information['days_to_mature']) ? $agronomic_information['days_to_mature'] : $emptyValue;
										$yield_potential = isset($agronomic_information['yield_potential']) ? $agronomic_information['yield_potential'] : $emptyValue;
									?>
										<tr>
											<th class="table-secondary w-25">Days to Mature</th>
											<td><input type="text" name="days_to_mature" <?php echo ($days_to_mature != $emptyValue) ? 'value="' . $days_to_mature . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
										</tr>
										<tr>
											<th class="table-secondary w-25">Yield Potential</th>
											<td><input type="text" name="yield_potential" <?php echo ($yield_potential != $emptyValue) ? 'value="' . $yield_potential . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
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
										<td><textarea name="rice_biodiversity_uplift" class="w-100 border-0 p-1" rows="5" disabled <?php echo ($rice_biodiversity_uplift !== $emptyValue) ? '>' . $rice_biodiversity_uplift : 'placeholder="Empty">'; ?></textarea></td>
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
											<td><textarea name="economic_importance" class="w-100 border-0 p-1" rows="5" disabled <?php echo ($economic_importance !== $emptyValue) ? '>' . $economic_importance : 'placeholder="Empty">'; ?></textarea></td>
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
										<td><textarea name="traditional_knowledge_and_practices" class="w-100 border-0 p-1" rows="5" disabled <?php echo ($traditional_knowledge_and_practices !== $emptyValue) ? '>' . $traditional_knowledge_and_practices : 'placeholder="Empty">'; ?></textarea></td>
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
									$query6 = "SELECT * FROM morphological_characteristic WHERE morphological_characteristic_id='$current_morphological_characteristic_id'";

									// Executing query
									$query_run6 = pg_query($connection, $query6);

									// If count is greater than 0, we have Morphological Characteristics; else, we do not have Morphological Characteristics
									if (pg_num_rows($query_run6) > 0) {
										$morphological_characteristic = pg_fetch_assoc($query_run6);

										// Define default values for each field if they are $emptyValue
										$plant_height = isset($morphological_characteristic['plant_height']) ? $morphological_characteristic['plant_height'] : $emptyValue;
										$panicle_length = isset($morphological_characteristic['panicle_length']) ? $morphological_characteristic['panicle_length'] : $emptyValue;
										$grain_quality = isset($morphological_characteristic['grain_quality']) ? $morphological_characteristic['grain_quality'] : $emptyValue;
										$grain_color = isset($morphological_characteristic['grain_color']) ? $morphological_characteristic['grain_color'] : $emptyValue;
										$grain_length = isset($morphological_characteristic['grain_length']) ? $morphological_characteristic['grain_length'] : $emptyValue;
										$grain_width = isset($morphological_characteristic['grain_width']) ? $morphological_characteristic['grain_width'] : $emptyValue;
										$grain_shape = isset($morphological_characteristic['grain_shape']) ? $morphological_characteristic['grain_shape'] : $emptyValue;
										$awn_length = isset($morphological_characteristic['awn_length']) ? $morphological_characteristic['awn_length'] : $emptyValue;
										$leaf_length = isset($morphological_characteristic['leaf_length']) ? $morphological_characteristic['leaf_length'] : $emptyValue;
										$leaf_width = isset($morphological_characteristic['leaf_width']) ? $morphological_characteristic['leaf_width'] : $emptyValue;
										$leaf_shape = isset($morphological_characteristic['leaf_shape']) ? $morphological_characteristic['leaf_shape'] : $emptyValue;
										$stem_color = isset($morphological_characteristic['stem_color']) ? $morphological_characteristic['stem_color'] : $emptyValue;
										$another_color = isset($morphological_characteristic['another_color']) ? $morphological_characteristic['another_color'] : $emptyValue;
									?>
												<tr>
													<th class="table-secondary w-25">Plant Height</th>
													<td><input type="text" name="plant_height" <?php echo ($plant_height != $emptyValue) ? 'value="' . $plant_height . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
												</tr>
												<tr>
													<th class="table-secondary w-25">Panicle Length</th>
													<td><input type="text" name="panicle_length" <?php echo ($panicle_length != $emptyValue) ? 'value="' . $panicle_length . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
												</tr>
												<tr>
													<th class="table-secondary w-25">Grain Quality</th>
													<td><input type="text" name="grain_quality" <?php echo ($grain_quality != $emptyValue) ? 'value="' . $grain_quality . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
												</tr>
												<tr>
													<th class="table-secondary w-25">Grain Color</th>
													<td><input type="text" name="grain_color" <?php echo ($grain_color != $emptyValue) ? 'value="' . $grain_color . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
												</tr>
												<tr>
													<th class="table-secondary w-25">Grain Length</th>
													<td><input type="text" name="grain_length" <?php echo ($grain_length != $emptyValue) ? 'value="' . $grain_length . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
												</tr>
												<tr>
													<th class="table-secondary w-25">Grain Width</th>
													<td><input type="text" name="grain_width" <?php echo ($grain_width != $emptyValue) ? 'value="' . $grain_width . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
												</tr>
												<tr>
													<th class="table-secondary w-25">Grain Shape</th>
													<td><input type="text" name="grain_shape" <?php echo ($grain_shape != $emptyValue) ? 'value="' . $grain_shape . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
												</tr>
												<tr>
													<th class="table-secondary w-25">Awn Length</th>
													<td><input type="text" name="awn_length" <?php echo ($awn_length != $emptyValue) ? 'value="' . $awn_length . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
												</tr>
												<tr>
													<th class="table-secondary w-25">Leaf Length</th>
													<td><input type="text" name="leaf_length" <?php echo ($leaf_length != $emptyValue) ? 'value="' . $leaf_length . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
												</tr>
												<tr>
													<th class="table-secondary w-25">Leaf Width</th>
													<td><input type="text" name="leaf_width" <?php echo ($leaf_width != $emptyValue) ? 'value="' . $leaf_width . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
												</tr>
												<tr>
													<th class="table-secondary w-25">Leaf Shape</th>
													<td><input type="text" name="leaf_shape" <?php echo ($leaf_shape != $emptyValue) ? 'value="' . $leaf_shape . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
												</tr>
												<tr>
													<th class="table-secondary w-25">Stem Color</th>
													<td><input type="text" name="stem_color" <?php echo ($stem_color != $emptyValue) ? 'value="' . $stem_color . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
												</tr>
												<tr>
													<th class="table-secondary w-25">Another Color</th>
													<td><input type="text" name="another_color" <?php echo ($another_color != $emptyValue) ? 'value="' . $another_color . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
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

									// Query to select all available Relationship Among Cultivars in the database
									$query7 = "SELECT * FROM relationship_among_cultivars WHERE relationship_among_cultivars_id='$current_relationship_among_cultivars_id'";

									// Executing query
									$query_run7 = pg_query($connection, $query7);

									// If count is greater than 0, we have Relationship Among Cultivars; else, we do not have Relationship Among Cultivars
									if (pg_num_rows($query_run7) > 0) {
										$relationship_among_cultivars = pg_fetch_assoc($query_run7);

										// Define default values for each field if they are $emptyValue
										$distinct_cultivar_groups_morph_gen = isset($relationship_among_cultivars['distinct_cultivar_groups_morph_gen']) ? $relationship_among_cultivars['distinct_cultivar_groups_morph_gen'] : $emptyValue;
										$cultivar_relations_cluster_and_pca = isset($relationship_among_cultivars['cultivar_relations_cluster_and_pca']) ? $relationship_among_cultivars['cultivar_relations_cluster_and_pca'] : $emptyValue;
										$hybridization_potential = isset($relationship_among_cultivars['hybridization_potential']) ? $relationship_among_cultivars['hybridization_potential'] : $emptyValue;
										$conservation_and_breeding_implications = isset($relationship_among_cultivars['conservation_and_breeding_implications']) ? $relationship_among_cultivars['conservation_and_breeding_implications'] : $emptyValue;

									?>

												<tr>
													<th class="table-secondary w-25">Distinct Groups of Cultivars based on Morphological and Genetic Characteristics</th>
													<td><input type="text" name="distinct_cultivar_groups_morph_gen" <?php echo ($distinct_cultivar_groups_morph_gen != $emptyValue) ? 'value="' . $distinct_cultivar_groups_morph_gen . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
												</tr>
												<tr>
													<th class="table-secondary w-25">Relationships Among Cultivars based on Cluster Analysis and Principal Component Analysis</th>
													<td><input type="text" name="cultivar_relations_cluster_and_pca" <?php echo ($cultivar_relations_cluster_and_pca != $emptyValue) ? 'value="' . $cultivar_relations_cluster_and_pca . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
												</tr>												<tr>
													<th class="table-secondary w-25">Potential for Hybridization and Breeding Among Cultivars</th>
													<td><input type="text" name="hybridization_potential" <?php echo ($hybridization_potential != $emptyValue) ? 'value="' . $hybridization_potential . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
												</tr>
												<tr>
													<th class="table-secondary w-25">Implications for Conservation and Breeding Efforts</th>
													<td><input type="text" name="conservation_and_breeding_implications" <?php echo ($conservation_and_breeding_implications != $emptyValue) ? 'value="' . $conservation_and_breeding_implications . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
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
											<td><textarea name="breeding_potential" class="w-100 border-0 p-1" rows="5" disabled <?php echo ($breeding_potential !== $emptyValue) ? '>' . $breeding_potential : 'placeholder="Empty">'; ?></textarea></td>
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
											<td><textarea name="threats" class="w-100 border-0 p-1" rows="5" disabled <?php echo ($threats !== $emptyValue) ? '>' . $threats : 'placeholder="Empty">'; ?></textarea></td>
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
											<td><textarea name="other_info" class="w-100 border-0 p-1" rows="5" disabled <?php echo ($other_info !== $emptyValue) ? '>' . $other_info : 'placeholder="Empty">'; ?></textarea></td>
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