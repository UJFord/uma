<?php
// connection to db
$connection = pg_connect("host=localhost dbname=farm_crops user=postgres password=123");

// Check if the crop_id parameter is set in the URL
if (isset($_GET['practices_id'])) {
	// Retrieve the crop_id from the URL parameter
	$practices_id = $_GET['practices_id'];

	// query to get the selected data from the db
	$query = pg_query($connection, "select * from practices where practices_id='$practices_id'");
	$count = pg_num_rows($query);

	if ($count > 0) {
		while ($row = pg_fetch_assoc($query)) {
			$practices_id = $row['practices_id'];
			$practices_name = $row['practices_name'];
			$practices_description = $row['practices_description'];
			$practices_image = $row['practices_image'];
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
	<link rel="stylesheet" href="../../css/crops/crops.css" />
	<!-- favicon -->
	<link rel="shortcut icon" href="../../img/logo/favicon.svg" type="image/x-icon" />
	<title>Crops | Saging</title>
</head>

<body>
	<!-- container -->
	<div id="main-container" class="row border vh-100">
		<section id="main-showcase" class="col-sm-6 position-relative h-100" style="background-image: url('<?php echo (!empty($practices_image)) ? $practices_image : ''; ?>');">
			<div id="showcase-div" class="container p-5 d-flex flex-column justify-content-between align-items-start h-100">


				<!-- Return -->
				<a href="../practices.php">
					<i class="bi bi-caret-left-square fs-1"></i>
				</a>

				<!-- Crop Name -->
				<h1 class="mb-4"><?php echo $practices_name; ?></h1>
				<!-- Display other data here -->
			</div>
		</section>

		<!-- Navigation Cards -->
		<section id="info-section" class="col-sm-6 h-100 d-flex justify-content-center align-items-center p-5">
			<!-- container -->
			<div id="info-container" class="fs-6">

				<!-- desc -->
				<div class="fs-6 mb-3">
					<strong class="fs-4"><?php echo ucfirst($practices_name); ?> </strong><?php echo $practices_description; ?>
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