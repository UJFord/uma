<?php
// connection to db
$connection = pg_connect("host=localhost dbname=farm_crops user=postgres password=123");

// Check if the crop_id parameter is set in the URL
if (isset($_GET['crop_id'])) {
	// Retrieve the crop_id from the URL parameter
	$crop_id = $_GET['crop_id'];

	// query to get the selected data from the db
	$query = pg_query($connection, "SELECT basic_info.image, basic_info.name, basic_info.basic_description, basic_info.scientific_name, basic_info.origin, basic_info.genus, plant_type.plant_type_name, farming.farming_name, farming.farming_image, farming.farming_description, usage_info.usage_name, usage_info.usage_description, usage_info.usage_example, usage_info.usage_image FROM traditional_crop left join basic_info on traditional_crop.basic_info_id = basic_info.basic_info_id left join farming on basic_info.farming_id = farming.farming_id left join usage_info on basic_info.usage_id = usage_info.usage_id left join plant_type on basic_info.plant_type_id = plant_type.plant_type_id WHERE crop_id='$crop_id'");
	$count = pg_num_rows($query);

	if ($count > 0) {
		while ($row = pg_fetch_assoc($query)) {
			$name = $row['name'];
			$image = $row['image'];
			$scientific_name = $row['scientific_name'];
			$basic_description = $row['basic_description'];
			$origin = $row['origin'];
			$genus = $row['genus'];
			$plant_type_name = $row['plant_type_name'];
			$farming_name = $row['farming_name'];
			$farming_description = $row['farming_description'];
			$farming_image = $row['farming_image'];
			$usage_name = $row['usage_name'];
			$usage_description = $row['usage_description'];
			$usage_example = $row['usage_example'];
			$usage_image = $row['usage_image'];
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
	<title>Crops | <?php echo ucfirst($name); ?></title>
</head>

<body>
	<!-- container -->
	<div id="main-container" class="row border vh-100">


		<!-- container -->
		<section id="main-showcase" class="col-sm-6 position-relative h-100" style="background-image: url('<?php echo (!empty($image)) ? $image : ''; ?>');">
			<div id="showcase-div" class="container p-5 d-flex flex-column justify-content-between align-items-start h-100">

				<!-- Return -->
				<a href="../crops.php">
					<i class="bi bi-caret-left-square fs-1"></i>
				</a>

				<!-- Crop Name -->
				<h1 class="mb-4"><?php echo $name; ?></h1>
			</div>
		</section>

		<!-- Navigation Cards -->
		<section id="info-section" class="col-sm-6 h-100 d-flex justify-content-center align-items-center p-5">
			<!-- container -->
			<div id="info-container" class="fs-6">

				<!-- desc -->
				<strong class="fs-4"><?php echo ucfirst($name); ?></strong>
				<hr>

				<div class="fs-6 mb-3">
					</strong><?php echo $basic_description; ?>
				</div>
				<!-- scientific name -->
				<div class="info-item"><strong>Scientific Name:</strong>
					<p><em><?php echo $scientific_name; ?></em></p>
				</div>
				<!-- plant type -->
				<div class="info-item"><strong>Plant Type:</strong>
					<p><?php echo $plant_type_name; ?></p>
				</div>
				<!-- genus -->
				<div class="info-item"><strong>Genus:</strong>
					<p><?php echo $genus; ?></p>
				</div>
				<!-- origin -->
				<div class="info-item"><strong>Origin:</strong>
					<p><?php echo $origin; ?></p>
				</div>

				<hr>
				<strong class="fs-4">Usage</strong>
				<hr>

				<!-- usage name -->
				<div class="info-item"><strong>Usage Name:</strong>
					<p><?php echo $usage_name; ?></p>
				</div>
				<!-- usage description -->
				<div class="info-item"><strong>Usage Description:</strong>
					<p><?php echo $usage_description; ?></p>
				</div>

				<!-- Div to contain Usage Image and Usage Example -->
				<div class="usage-details">
					<!-- usage image -->
					<div class="image-container">
						<?php
						if (!empty($usage_image)) {
							echo '<img src="' . $usage_image . '" style="max-width: 100%; height: auto;">';
						} else {
							echo "Image not found.";
						}
						?>
					</div>
					<!-- usage example -->
					<div class="example-container">
						<strong>Usage Example:</strong>
						<p><?php echo $usage_example; ?></p>
					</div>
				</div>

				<hr>
				<strong class="fs-4">Farming</strong>
				<hr>
				<!-- Farming -->
				<div class="info-item"><strong>Farming Name:</strong>
					<p><?php echo $farming_name; ?></p>
				</div>
				<!-- Farming image -->
				<div class="usage-details">
					<div class="image-container">
						<?php
						if (!empty($farming_image)) {
							echo '<img src="' . $farming_image . '" style="max-width: 100%; height: auto;">';
						} else {
							echo "Image not found.";
						}
						?>
					</div>
					<!-- Farming -->
					<div class="example-container"><strong>Farming Description:</strong>
						<p><?php echo $farming_description; ?></p>
					</div>
				</div>
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