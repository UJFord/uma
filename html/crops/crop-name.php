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
	<link rel="stylesheet" href="../../css/crops/crop-name.css" />
	<!-- favicon -->
	<link rel="shortcut icon" href="../../img/logo/favicon.svg" type="image/x-icon" />
	<title>Crops | <?php echo ucfirst($name); ?></title>

	<!-- leaflet -->
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
	<!-- Make sure you put this AFTER Leaflet's CSS -->
	<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

</head>

<body>

	<!-- back button -->
	<a href="../crops.php" id="back-btn">
		<i class="bi bi-caret-left-square"></i>
	</a>

	<!-- container -->
	<div id="main-container" class="mt-5">

		<!-- showcase -->
		<div class="container">
			<div id="showcase" class="row d-flex justify-content-center">

				<!-- head -->
				<div id="head" class="col-8 d-flex justify-content-center align-items-center flex-column">
					<!-- crop name -->
					<h1 class="mb-3"><?php echo $name; ?></h1>
					<!-- decription -->
					<p class="text-center"><?php echo $basic_description; ?></p>
				</div>

				<!-- other names and image -->
				<div id="name-n-img" class="row mt-3 mb-5">
					<!-- scientific name -->
					<div id="sname" class="col-4  d-flex flex-column align-item-center  justify-content-center">
						<!-- name -->
						<h3 class="text-center"><em><?php echo $scientific_name; ?></em></h3>
						<!-- title -->
						<h5 class="text-center">Scientific Name</h5>
					</div>
					<!-- crop image -->
					<div id="crop-image" class="col-4 " style="background-image: url('<?php echo (!empty($image)) ? $image : ''; ?>');"></div>
					<!-- plant type -->
					<div id="sname" class="col-4  d-flex flex-column align-item-center justify-content-center">
						<!-- name -->
						<h3 class="text-center"><?php echo $plant_type_name; ?></h3>
						<!-- title -->
						<h5 class="text-center">Family</h5>
					</div>
				</div>

				<!-- origin -->
				<div id="origin" class="col-6 text-center">
					<p><?php echo $origin; ?></p>
				</div>
			</div>
		</div>

		<!-- usage and farming -->
		<div id="use-n-farm" class="mt-5 mb-5">
			<div class="container">
				<!-- usage -->
				<div id="usage" class="d-flex justify-content-evenly align-items-center">
					<!-- text -->
					<div class="text col-5">
						<h4 class=""><?php echo ucfirst($usage_name); ?></h4>
						<p class=""><?php echo $usage_description; ?></p>
					</div>
					<!-- image -->
					<div class="use-n-farm-img col-4 " style="background-image: url('<?php echo $usage_image; ?>');"></div>
				</div>

				<!-- farming -->
				<div id="farming" class=" d-flex justify-content-evenly align-items-center">
					<!-- image -->
					<div class="use-n-farm-img col-4 " style="background-image: url('<?php echo $farming_image; ?>');"></div>
					<!-- text -->
					<div class="text col-5">
						<h4 class=""><?php echo ucfirst($farming_name); ?></h4>
						<p class=""><?php echo $farming_description; ?></p>
					</div>
				</div>
			</div>
			<!-- bg -->
			<div class="bg-container d-flex align-items-center">
				<div class="bg"></div>
			</div>
		</div>

		<!-- map element -->
		<!-- <div id="map-box" class="container d-flex justify-content-center">

			<div id="map" class="col-6" style=""></div>
		</div> -->
	</div>




	<!-- map script -->
	<script>
		// * FUNCTIONS
		// navbar tag button onlclick show markers
		let activeMarkers = [];
		let showMarkers = (category, coordinates) => {

		}



		let map = L.map('map').setView([5.9267, 124.9948], 11);

		L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
			maxZoom: 19,
			minZoom: 0,
			attribution: '© OpenStreetMap',
		}).addTo(map);

		// * Map Zoom Control Positioning
		function addControlPlaceholders(map) {
			var corners = map._controlCorners,
				l = 'leaflet-',
				container = map._controlContainer;

			function createCorner(vSide, hSide) {
				var className = l + vSide + ' ' + l + hSide;

				corners[vSide + hSide] = L.DomUtil.create('div', className, container);
			}

			createCorner('verticalcenter', 'left');
			createCorner('verticalcenter', 'right');
		}
		addControlPlaceholders(map);

		// * Change the position of the Zoom Control to a newly created placeholder.
		map.zoomControl.setPosition('verticalcenterright');
	</script>

	<!-- bootstrap -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
	<!-- font awesome -->
	<script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>
</body>

</html>