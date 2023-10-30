<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
			rel="stylesheet"
			integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
			crossorigin="anonymous"
		/>
		<link
			rel="stylesheet"
			href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"
		/>
		<!-- cutom css -->
		<link rel="stylesheet" href="../../css/crops/saging.css" />
		<!-- favicon -->
		<link
			rel="shortcut icon"
			href="../../img/logo/favicon.svg"
			type="image/x-icon"
		/>
		<title>Crops | Saging</title>
	</head>
	<body>
		<!-- container -->
		<div id="main-container" class="row border vh-100">

			<?php
			// connection to db
			$connection = pg_connect("host=localhost dbname=farm_crops user=postgres password=123");

			// Check if the crop_id parameter is set in the URL
			if (isset($_GET['crop_id'])) {
				// Retrieve the crop_id from the URL parameter
				$crop_id = $_GET['crop_id'];

				// query to get the selected data from the db
				$query = pg_query($connection,"SELECT basic_info.image, basic_info.name, basic_info.scientific_name, basic_info.origin, basic_info.genus, plant_type.plant_type_name, farming.farming_name, farming.farming_description, usage_info.usage_name, usage_info.usage_description, usage_info.usage_example FROM traditional_crop left join basic_info on traditional_crop.basic_info_id = basic_info.basic_info_id left join farming on basic_info.farming_id = farming.farming_id left join usage_info on basic_info.usage_id = usage_info.usage_id left join plant_type on basic_info.plant_type_id = plant_type.plant_type_id");
				$count = pg_num_rows($query);
					
				if ($count > 0) {
					while ($row = pg_fetch_assoc($query)) {
						$name = $row['name'];
						$image = $row['image'];
						$scientific_name = $row['scientific_name'];
						$origin = $row['origin'];
						$genus = $row['genus'];
						$plant_type_name = $row['plant_type_name'];
						$farming_name = $row['farming_name'];
						$farming_description = $row['farming_description'];
						$usage_name = $row['usage_name'];
						$usage_description = $row['usage_description'];
						$usage_example = $row['usage_example'];
				} 
				}
				else {
					echo "Crop ID not found in the URL.";
				}
			}
			?>
				<section id="main-showcase" class="col-sm-6 position-relative h-100">
					<div id="showcase-div" class="container p-5 d-flex flex-column justify-content-between align-items-start h-100">
						<!-- Image -->
						<div>
							<?php
							if (!empty($image)) {
								echo '<img src="' . $image . '" style="max-width: 100%; height: auto;">';
							} else {
								echo "Image not found.";
							}
							?>
						</div>

						<!-- Return -->
						<a href="../crops.html">
							<i class="bi bi-caret-left-square fs-1"></i>
						</a>

						<!-- Crop Name -->
						<h1 class="mb-4"><?php echo $name; ?></h1>
						<!-- Display other data here -->
					</div>
				</section>

				<!-- Navigation Cards -->
				<section
					id="info-section"
					class="col-sm-6 h-100 d-flex justify-content-center align-items-center p-5"
				>
					<!-- container -->
					<div id="info-container" class="fs-6">

						<!-- desc -->
						<div class="fs-6 mb-3">
							<strong class="fs-4"><?php echo ucfirst($name);?></strong><?php echo $farming_description;?>
						</div>

						<!-- scientific name -->
						<div class="info-item"><i class="fa-solid fa-microscope"></i><p><em><?php echo $scientific_name;?></em></p></div>

						<!-- plant type -->
						<div class="info-item"><i class="fa-solid fa-seedling"></i><p><?php echo $origin;?></p></div>

						<!-- use -->
						<div class="info-item"><i class="fa-solid fa-utensils"></i><p><?php echo $usage_example;?></p></div>

						<!-- origin -->
						<div class="info-item"><i class="fa-regular fa-newspaper"></i><p><?php echo $usage_description;?></p></div>
					</div>

					<!-- map -->
					<div></div>
				</section>
		</div>

		<script
			src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
			crossorigin="anonymous"
		></script>
		<!-- font awesome -->
		<script
			src="https://kit.fontawesome.com/57e83eb6e4.js"
			crossorigin="anonymous"
		></script>
	</body>
</html>
