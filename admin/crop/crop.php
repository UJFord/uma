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
					$rice_biodiversity_uplift = isset($crops['rice_biodiversity_uplift']) ? htmlspecialchars($crops['rice_biodiversity_uplift'], ENT_QUOTES) : $emptyValue;
					$cultural_importance_and_traditional_knowledge = isset($crops['cultural_importance_and_traditional_knowledge']) ? htmlspecialchars($crops['cultural_importance_and_traditional_knowledge'], ENT_QUOTES) : $emptyValue;
					$threats = isset($crops['threats']) ? htmlspecialchars($crops['threats'], ENT_QUOTES) : $emptyValue;
					$other_info = isset($crops['other_info']) ? htmlspecialchars($crops['other_info'], ENT_QUOTES) : $emptyValue;
					$unique_features = isset($crops['unique_features']) ? htmlspecialchars($crops['unique_features'], ENT_QUOTES) : $emptyValue;
					$cultural_use = isset($crops['cultural_use']) ? htmlspecialchars($crops['cultural_use'], ENT_QUOTES) : $emptyValue;
					$associated_vegetation = isset($crops['associated_vegetation']) ? htmlspecialchars($crops['associated_vegetation'], ENT_QUOTES) : $emptyValue;

			?>
					<!-- form for submitting -->
					<form id="form-panel" name="Form" action="try.php" autocomplete="off" onsubmit="return validateForm()" method="POST" enctype="multipart/form-data" class="h-100 py-3 px-5">
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
							<input type="hidden" name="traditional_crop_traits_id" value="<?= $crops['traditional_crop_traits_id']; ?>">
							<input type="hidden" name="current_image" value="<?= $current_image; ?>">

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
										<th class="table-secondary w-25">Category (rice, rootcrop, etc...)</th>
										<td><input type="text" name="category" <?php echo ($category != $emptyValue) ? 'value="' . $category . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
									</tr>
									<tr>
										<th class="table-secondary w-25">Description</th>
										<td><input type="text" name="description" <?php echo ($description != $emptyValue) ? 'value="' . $description . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
									</tr>
									<tr>
										<th class="table-secondary w-25">Image</th>
										<td>
											<?php
											if ($current_image != "") {
												// Display the image
											?>
												<img src="<?php echo 'http://localhost/incognito-capstone/admin/'; ?>img/crop/<?php echo $current_image; ?>" width="150px">
												<input id="image" type="file" name="image" Hidden>
											<?php
											} else {
												// display message
												echo "Image not added";
											}
											?>
										</td>
									</tr>
									<tr>
										<th class="table-secondary w-25">Local Name</th>
										<td><input type="text" name="local_name" <?php echo ($local_name != $emptyValue) ? 'value="' . $local_name . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
									</tr>
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
										$pest_and_disease_resistance = isset($traditional_crop_traits['pest_and_disease_resistance']) ? $traditional_crop_traits['pest_and_disease_resistance'] : $emptyValue;
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
											<th class="table-secondary w-25">Disease Resistance</th>
											<td><input type="text" name="pest_and_disease_resistance" <?php echo ($pest_and_disease_resistance != $emptyValue) ? 'value="' . $pest_and_disease_resistance . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
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

							<!-- Traditional Knowledge and Practices-->
							<table class="table table-hover table-sm">
								<thead>
									<tr>
										<th colspan="2" class="table-dark">Cultural Importance and Traditional Knowledge</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th class="table-secondary w-25">Description</th>
										<td><textarea name="cultural_importance_and_traditional_knowledge" class="w-100 border-0 p-1" rows="5" disabled <?php echo ($cultural_importance_and_traditional_knowledge !== $emptyValue) ? '>' . $cultural_importance_and_traditional_knowledge : 'placeholder="Empty">'; ?></textarea></td>
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
										<th class="table-secondary w-25">Location Where Last Seen</th>
										<td></td>
									</tr>
								</tbody>
							</table>

							<!-- threats from lowland-associated influences-->
							<table class="table table-hover table-sm">
								<thead>
									<tr>
										<th colspan="2" class="table-dark">Threats to the Upland Farms</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th class="table-secondary w-25">Description</th>
										<td><textarea name="threats" class="w-100 border-0 p-1" rows="5" disabled <?php echo ($threats !== $emptyValue) ? '>' . $threats : 'placeholder="Empty">'; ?></textarea></td>
										</tr>
								</tbody>
							</table>

							<!-- Unique Features -->
							<table class="table table-hover table-sm">
								<thead>
									<tr>
										<th colspan="2" class="table-dark">Unique Features</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th class="table-secondary w-25">Description</th>
										<td>
											<textarea name="unique_features" class="w-100 border" rows="5" disabled><?php echo ($unique_features !== $emptyValue) ? $unique_features : 'Empty'; ?></textarea>
										</td>
									</tr>
								</tbody>
							</table>

							<!-- Cultural Use -->
							<table class="table table-hover table-sm">
								<thead>
									<tr>
										<th colspan="2" class="table-dark">Cultural Use</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th class="table-secondary w-25">Description</th>
										<td>
											<textarea name="cultural_use" class="w-100 border" rows="5" disabled><?php echo ($cultural_use !== $emptyValue) ? $cultural_use : 'Empty'; ?></textarea>
										</td>
									</tr>
								</tbody>
							</table>

							<!-- Associated Vegetation -->
							<table class="table table-hover table-sm">
								<thead>
									<tr>
										<th colspan="2" class="table-dark">Associated Vegetation</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th class="table-secondary w-25">Description</th>
										<td>
											<textarea name="associated_vegetation" class="w-100 border" rows="5" disabled><?php echo ($associated_vegetation !== $emptyValue) ? $associated_vegetation : 'Empty'; ?></textarea>
										</td>
									</tr>
								</tbody>
							</table>

							<!-- Associated Farming Practices -->
							<table class="table table-hover table-sm  mb-0">
								<input type="hidden" name="farming_id" value="<?= $farming_id; ?>">
								<thead>
									<tr>
										<th colspan="2" class="table-dark">Associated Farming Practices</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th class="table-secondary w-25">Farming Practice Name</th>
										<td>
											<select name="farming_id" class="w-100 border" rows="2" disabled>
												<?php
												// php code to display available schedules from the database
												// query to select all available schedules in the database
												$query = "SELECT * FROM farming";

												// Executing query
												$query_run = pg_query($connection, $query);

												// count rows to check whether we have a schedule or not
												$count = pg_num_rows($query_run);

												// if count is greater than 0 we have a schedule else we do not have a schedule
												if ($count > 0) {
													// we have a schedule
													while ($row = pg_fetch_assoc($query_run)) {
														// get the detail of the schedule
														$farming_id = $row['farming_id'];
														$farming_name = $row['farming_name'];
												?>
														<option <?php
																if ($current_farming_id === null) {
																	echo "selected";
																} elseif ($current_farming_id == $farming_id) {
																	echo "selected";
																}
																?> value="<?php echo $farming_id; ?>"><?php echo $farming_name; ?>
														</option>
													<?php
													}
												} else {
													// we do not have a schedule
													?>
													<option value="0">No Farming name Found</option>
												<?php
												}
												?>
											</select>
										</td>
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