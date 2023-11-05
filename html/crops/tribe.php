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
				$query = pg_query($connection,"select tribe.tribe_id, tribe.tribe_name, tribe.tribe_image, practices.practices_name, practices.practices_description, practices.practices_image, ritual.ritual_name, ritual.ritual_description, ritual.ritual_image from tribe left join practices on tribe.practices_id = practices.practices_id left join ritual on tribe.ritual_id = ritual.ritual_id");
				$count = pg_num_rows($query);
					
				if ($count > 0) {
					while ($row = pg_fetch_assoc($query)) {
						$tribe_id = $row['tribe_id'];
						$tribe_name = $row['tribe_name'];
						$tribe_image = $row['tribe_image'];
						$practices_name = $row['practices_name'];
						$practices_description = $row['practices_description'];
						$practices_image = $row['practices_image'];
						$ritual_name = $row['ritual_name'];
						$ritual_description = $row['ritual_description'];
						$ritual_image = $row['ritual_image'];
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
							if (!empty($tribe_image)) {
								echo '<img src="' . $tribe_image . '" style="max-width: 75%; height: auto;">';
							} else {
								echo "Image not found.";
							}
							?>
						</div>

						<!-- Return -->
						<a href="../tribe.php">
							<i class="bi bi-caret-left-square fs-1"></i>
						</a>

						<!-- Crop Name -->
						<h1 class="mb-4"><?php echo $tribe_name; ?></h1>
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
						<strong class="fs-4"><?php echo ucfirst($tribe_name);?></strong>

						<hr>
						<strong class="fs-4">Practices</strong>
						<hr>

						<!-- Div to contain practice Image and practice Example -->
						<div class="usage-details">
							<!-- practice image -->
							<div class="image-container">
								<?php
								if (!empty($practices_image)) {
									/* echo '<img src="' . $practices_image . '" style="max-width: 100%; height: auto;">'; */
								} else {
									echo "Image not found.";
								}
								?>
							</div>
							<!-- practice example -->
							<div class="example-container">
								<strong><?php echo $practices_name?></strong>
								<br><br>
								<strong>Practice Description:</strong>
								<p><?php echo $practices_description;?></p>
							</div>
						</div>

						<hr>
						<strong class="fs-4">Rituals</strong>
						<hr>

						<!-- Div to contain Usage Image and Usage Example -->
						<div class="usage-details">
							<!-- usage image -->
							<div class="image-container">
								<?php
								if (!empty($ritual_image)) {
									echo '<img src="' . $ritual_image . '" style="max-width: 100%; height: auto;">';
								} else {
									echo "Image not found.";
								}
								?>
							</div>
							<!-- usage example -->
							<div class="example-container">
								<strong><?php echo $ritual_name?></strong>
								<br><br>
								<strong>Usage Example:</strong>
								<p><?php echo $ritual_description;?></p>
							</div>
						</div>
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
