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
	<title>Tribe as Editor</title>
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
		<section id="nav-cards" class="p-0 m-0 col col-md-9 col-xl-10 min-vh-100">
			<?php
			if (isset($_GET['tribe_id'])) {
				$tribe_id = pg_escape_string($connection, $_GET['tribe_id']);
				$query = "SELECT * from tribe WHERE tribe_id='$tribe_id'";
				$query_run = pg_query($connection, $query);

				$emptyValue = 'Empty';

				if (pg_num_rows($query_run) > 0) {
					$tribe = pg_fetch_assoc($query_run);

					// get the data from the tribe table
					// Define default values for each field if they are Empty
					$tribe_name = isset($tribe['tribe_name']) ? htmlspecialchars($tribe['tribe_name'], ENT_QUOTES) : $emptyValue;
					$image = isset($tribe['image']) ? htmlspecialchars($tribe['image'], ENT_QUOTES) : $emptyValue;
					$location = isset($tribe['location']) ? htmlspecialchars($tribe['location'], ENT_QUOTES) : $emptyValue;
					$language_and_dialect = isset($tribe['language_and_dialect']) ? htmlspecialchars($tribe['language_and_dialect'], ENT_QUOTES) : $emptyValue;
					$population = isset($tribe['population']) ? htmlspecialchars($tribe['population'], ENT_QUOTES) : $emptyValue;
					$livelihood_and_practices = isset($tribe['livelihood_and_practices']) ? htmlspecialchars($tribe['livelihood_and_practices'], ENT_QUOTES) : $emptyValue;
					$farming_practices = isset($tribe['farming_practices']) ? htmlspecialchars($tribe['farming_practices'], ENT_QUOTES) : $emptyValue;
					$social_structure_and_kinship_system = isset($tribe['social_structure_and_kinship_system']) ? htmlspecialchars($tribe['social_structure_and_kinship_system'], ENT_QUOTES) : $emptyValue;
					$beliefs_and_customs = isset($tribe['beliefs_and_customs']) ? htmlspecialchars($tribe['beliefs_and_customs'], ENT_QUOTES) : $emptyValue;
					$challenges_and_threats = isset($tribe['challenges_and_threats']) ? htmlspecialchars($tribe['challenges_and_threats'], ENT_QUOTES) : $emptyValue;
					$efforts_of_revitalization = isset($tribe['efforts_of_revitalization']) ? htmlspecialchars($tribe['efforts_of_revitalization'], ENT_QUOTES) : $emptyValue;
					$other_info = isset($tribe['other_info']) ? htmlspecialchars($tribe['other_info'], ENT_QUOTES) : $emptyValue;

			?>
					<!-- form for submitting -->
					<form id="form-panel" name="Form" action="code.php" autocomplete="off" onsubmit="return validateForm()" method="POST" class="h-100 py-3 px-5">
						<!-- back button -->
						<a href="list.php" class="link-offset-2"><i class="bi bi-chevron-left"></i>Go Back</a>

						<!-- title-->
						<div class="row d-flex justify-content-between my-3">
							<div class="col-6">
								<h3 id="crops-title"><input type="text" name="tribe_name" <?php echo ($tribe_name != $emptyValue) ? 'value="' . $tribe_name . '"' : 'placeholder="Empty"'; ?> class="fw-semibold w-100 border-0 py-1 px-2" disabled></h3>
							</div>
						</div>

						<!-- tribe information -->
						<div id="" class="row form-control p-3">

							<table class="table table-hover table-sm">
								<input type="hidden" name="tribe_id" value="<?= $tribe['tribe_id']; ?>">
								<tbody>
									<tr>
										<th class="table-secondary w-25">Image Link</th>
										<td>
											<input type="text" name="image" <?php echo ($image !== $emptyValue) ? 'value="' . $image . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled>
										</td>
									</tr>

									<tr>
										<th class="table-secondary w-25">Location</th>
										<td><input type="text" name="location" <?php echo ($location !== $emptyValue) ? 'value="' . $location . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
									</tr>
									<tr>
										<th class="table-secondary w-25">Language and Dialect</th>
										<td><input type="text" name="language_and_dialect" <?php echo ($language_and_dialect !== $emptyValue) ? 'value="' . $language_and_dialect . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
									</tr>
									<tr>
										<th class="table-secondary w-25">Population</th>
										<td><input type="text" name="population" <?php echo ($population !== $emptyValue) ? 'value="' . $population . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
									</tr>
									<tr>
										<th class="table-secondary w-25">Livelihood and Practices</th>
										<td><input type="text" name="livelihood_and_practices" <?php echo ($livelihood_and_practices !== $emptyValue) ? 'value="' . $livelihood_and_practices . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
									</tr>
								</tbody>
							</table>

							<table class="table table-hover table-sm">
								<tbody>
									<tr>
										<th class="table-secondary w-25">Farming Practices</th>
										<td><input type="text" name="farming_practices" <?php echo ($farming_practices !== $emptyValue) ? 'value="' . $farming_practices . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
									</tr>
									<tr>
										<th class="table-secondary w-25">Social Structure and Kinship</th>
										<td><input type="text" name="social_structure_and_kinship_system" <?php echo ($social_structure_and_kinship_system !== $emptyValue) ? 'value="' . $social_structure_and_kinship_system . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
									</tr>
									<tr>
										<th class="table-secondary w-25">Beliefs and Customs</th>
										<td><input type="text" name="beliefs_and_customs" <?php echo ($beliefs_and_customs !== $emptyValue) ? 'value="' . $beliefs_and_customs . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
									</tr>
								</tbody>
							</table>

							<table class="table table-hover table-sm">
								<tbody>
									<tr>
										<th class="table-secondary w-25">Challenges and Threats</th>
										<td><input type="text" name="challenges_and_threats" <?php echo ($challenges_and_threats !== $emptyValue) ? 'value="' . $challenges_and_threats . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
									</tr>
									<tr>
										<th class="table-secondary w-25">Efforts of Revitalization</th>
										<td><input type="text" name="efforts_of_revitalization" <?php echo ($efforts_of_revitalization !== $emptyValue) ? 'value="' . $efforts_of_revitalization . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
									</tr>
								</tbody>
							</table>

							<table class="table table-hover table-sm mb-0">
								<tbody>
									<tr>
										<th class="table-secondary w-25">Other Info</th>
										<td><input type="text" name="other_info" <?php echo ($other_info !== $emptyValue) ? 'value="' . $other_info . '"' : 'placeholder="Empty"'; ?> class="w-100 border-0 p-1" disabled></td>
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