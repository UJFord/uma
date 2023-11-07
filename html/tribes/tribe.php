<?php
// connection to db
$connection = pg_connect("host=localhost dbname=farm_crops user=postgres password=123");

// Check if the crop_id parameter is set in the URL
if (isset($_GET['tribe_id'])) {
	// Retrieve the crop_id from the URL parameter
	$tribe_id = $_GET['tribe_id'];

	// query to get the selected data from the db
	$query = pg_query($connection, "select * from tribe where tribe_id = '$tribe_id'");
	$count = pg_num_rows($query);

	if ($count > 0) {
		while ($row = pg_fetch_assoc($query)) {
			$tribe_id = $row['tribe_id'];
			$tribe_name = $row['tribe_name'];
			$tribe_image = $row['tribe_image'];
		}
	} else {
		echo "Crop ID not found in the URL.";
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
	<!-- cutom css -->
	<link rel="stylesheet" href="../../css/crops/saging.css" />
	<!-- favicon -->
	<link rel="shortcut icon" href="../../img/logo/favicon.svg" type="image/x-icon" />
	<title>Crops | <?php echo $tribe_name; ?></title>
</head>

<body>
	<!-- container -->
	<div id="main-container" class="row border vh-100">

		<section id="main-showcase" class="col-sm-6 position-relative h-100" style="background-image: url('<?php echo (!empty($tribe_image)) ? $tribe_image : ''; ?>');">
			<div id="showcase-div" class="container p-5 d-flex flex-column justify-content-between align-items-start h-100">

				<!-- Return -->
				<a href="../tribes.php">
					<i class="bi bi-caret-left-square fs-1"></i>
				</a>

				<!-- Crop Name -->
				<h1 class="mb-4"><?php echo $tribe_name; ?></h1>
				<!-- Display other data here -->
			</div>
		</section>

		<!-- Navigation Cards -->
		<section id="info-section" class="col-sm-6 h-100 d-flex justify-content-center align-items-center p-5">
			<!-- container -->
			<div id="info-container" class="fs-6">

				<!-- desc -->
				<strong class="fs-4"><?php echo ucfirst($tribe_name); ?></strong>

				<hr>
				<strong class="fs-4">Practices</strong>
				<hr>

				<!-- Div to contain practice Image and practice Example -->
				<div class="usage-details">
					<?php
					if (isset($_GET['tribe_id'])) {
						// query to get the selected data from the db
						$query = pg_query($connection, "SELECT practices.practices_id, practices.practices_name, practices.practices_description, practices.practices_image FROM tribe_practices 
						LEFT JOIN tribe ON tribe.tribe_id = tribe_practices.tribe_id 
						LEFT JOIN practices ON tribe_practices.practices_id = practices.practices_id
						where tribe.tribe_id = '$tribe_id'");
						$count = pg_num_rows($query);

						if ($count > 0) {
							while ($row = pg_fetch_assoc($query)) {
								$practices_id = $row['practices_id'];
								$practices_name = $row['practices_name'];
								$practices_description = $row['practices_description'];
								$practices_image = $row['practices_image'];

					?>
								<div>
									<!-- practice image -->
									<div class="image-container">
										<?php
										if (!empty($practices_image)) {
											echo '<img src="' . $practices_image . '" style="max-width: 100%; height: auto;">';
										} else {
											echo "Image not found.";
										}
										?>
									</div>
									<!-- practice example -->
									<div class="example-container">
										<strong><?php echo $practices_name ?></strong>
										<br><br>
										<strong>Practice Description:</strong>
										<p><?php echo $practices_description; ?></p>
									</div>
								</div>
					<?php
							}
						} else {
							echo "Crop ID not found in the URL.";
						}
					}
					?>
				</div>

				<hr>
				<strong class="fs-4">Rituals</strong>
				<hr>
				<!-- Div to contain tribe ritual data -->
				<div class="usage-details">
					<?php
					if (isset($_GET['tribe_id'])) {
						// query to get the selected data from the db
						$query = pg_query($connection, "SELECT ritual.ritual_id, ritual.ritual_name, ritual.ritual_description, ritual.ritual_image FROM tribe_ritual 
						LEFT JOIN tribe ON tribe.tribe_id = tribe_ritual.tribe_id 
						LEFT JOIN ritual ON tribe_ritual.ritual_id = ritual.ritual_id
						where tribe.tribe_id = '$tribe_id'");
						$count = pg_num_rows($query);

						if ($count > 0) {
							while ($row = pg_fetch_assoc($query)) {
								$ritual_id = $row['ritual_id'];
								$ritual_name = $row['ritual_name'];
								$ritual_description = $row['ritual_description'];
								$ritual_image = $row['ritual_image'];

					?>
								<div>
									<!-- ritual image -->
									<div class="image-container">
										<?php
										if (!empty($ritual_image)) {
											echo '<img src="' . $ritual_image . '" style="max-width: 100%; height: auto;">';
										} else {
											echo "Image not found.";
										}
										?>
									</div>
									<!-- ritual example -->
									<div class="example-container">
										<strong><?php echo $ritual_name ?></strong>
										<br><br>
										<strong>Ritual Description:</strong>
										<p><?php echo $ritual_description; ?></p>
									</div>
								</div>
					<?php
							}
						} else {
							echo "Crop ID not found in the URL.";
						}
					}
					?>
				</div>
				<!-- map -->
				<div></div>
		</section>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
	<!-- font awesome -->
	<script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>
</body>

</html>