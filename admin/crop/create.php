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
		<section id="nav-cards" class="p-0 m-0 col col-md-9 col-xl-10">

			<!-- form for submitting -->
			<form id="form-panel" name="Form" action="code.php" autocomplete="off" onsubmit="return validateForm()" method="POST" enctype="multipart/form-data" class=" py-3 px-5">
				<!-- back button -->
				<a href="list.php" class="link-offset-2"><i class="bi bi-chevron-left"></i>Go Back</a>

				<!-- display name-->
				<div class="row d-flex justify-content-between my-3">
					<div class="col-6">
						<h3 id="crops-title"><input type="text" name="crop_name" placeholder="Display Title" class="fw-semibold w-100 border py-1 px-2"></h3>
					</div>
				</div>

				<!-- crop information -->
				<div id="" class="row form-control p-3">

					<?php include('../message.php'); ?>

					<!-- Crop Info -->
					<table id="info-table" class="table table-hover table-sm">
						<thead>
							<tr>
								<th colspan="2" class="table-dark">General Information</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th class="table-secondary w-25" scope="row">Description</th>
								<td><textarea name="description" rows="2" class="border w-100 p-1"></textarea></td>
							</tr>
							<tr>
								<th class="table-secondary">Upland or Lowand</th>
								<td><input type="text" name="upland_or_lowland" class="w-100 border p-1"></td>
							</tr>
							<tr>
								<th class="table-secondary w-25" scope="row">Category (rice, rootcrop, etc...)</th>
								<td><input type="text" name="category" class="w-100 border"></td>
							</tr>
							<tr>
								<th class="table-secondary w-25" scope="row">Image</th>
								<td><input type="file" name="image" class="w-100 border"></td>
							</tr>
							<tr>
								<th class="table-secondary w-25" scope="row">Local Name</th>
								<td><input type="text" name="local_name" class="w-100 border"></td>
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
							<tr>
								<th class="table-secondary w-25">Taste</th>
								<td><input type="text" name="taste" class="w-100 border"></td>
							</tr>
							<tr>
								<th class="table-secondary">Aroma</th>
								<td><input type="text" name="aroma" class="w-100 border"></td>
							</tr>
							<tr>
								<th class="table-secondary">Maturity Period</th>
								<td><input type="text" name="maturation" class="w-100 border"></td>
							</tr>
							<tr>
								<th class="table-secondary">Disease Resistance</th>
								<td><input type="text" name="pest_and_disease_resistance" class="w-100 border"></td>
							</tr>
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
								<td><textarea name="planting_techniques" class="w-100 border" rows="2"></textarea></td>
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
								<td><textarea name="cultural_and_spiritual_significance" class="w-100 border" rows="2"></textarea></td>
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
								<td><textarea name="rice_biodiversity_uplift" class="w-100 border" rows="2"></textarea></td>
							</tr>
						</tbody>
					</table>

					<!-- Cultural Importance and Traditional Knowledge -->
					<table class="table table-hover table-sm">
						<thead>
							<tr>
								<th colspan="2" class="table-dark">Cultural Importance and Traditional Knowledge</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th class="table-secondary w-25">Description</th>
								<td><textarea name="cultural_importance_and_traditional_knowledge" class="w-100 border" rows="2"></textarea></td>
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
								<td><textarea name="threats" class="w-100 border" rows="2"></textarea></td>
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
								<td><textarea name="unique_features" class="w-100 border" rows="5"></textarea></td>
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
								<td><textarea name="cultural_use" class="w-100 border" rows="5"></textarea></td>
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
								<td><textarea name="associated_vegetation" class="w-100 border" rows="5"></textarea></td>
							</tr>
						</tbody>
					</table>

					<!-- Associated Farming Practices -->
					<table class="table table-hover table-sm  mb-0">
							<thead>
								<tr>
									<th colspan="2" class="table-dark">Associated Farming Practices</th>
								</tr>
							</thead>
							<tbody>
								<tr>
								<th class="table-secondary w-25">Farming Practice Name</th>
								<td>
									<select name="farming_id" class="w-100 border" rows="2">
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
												<option value="<?php echo $farming_id; ?>"><?php echo $farming_name; ?></option>
												<option value="">None</option>
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
								<td><textarea name="other_info" class="w-100 border" rows="2"></textarea></td>
							</tr>
						</tbody>
					</table>
				</div>
				<!-- editting buttons -->
				<?php
				require('../edit-btn/add-btn.php');
				?>
			</form>
		</section>

	</div>

	<!-- scipts -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
	<!-- font awesome -->
	<script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>
</body>

</html>