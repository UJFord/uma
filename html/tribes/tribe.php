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
	<link rel="stylesheet" href="../../css/tribes/tribes.css" />
	<!-- favicon -->
	<link rel="shortcut icon" href="../../img/logo/favicon.svg" type="image/x-icon" />
	<title>Crops | <?php echo $tribe_name; ?></title>
</head>

<body>
	<!-- container -->
	<div id="main-container" class="row border vh-100">

		<!-- Showcase -->
		<section id="main-showcase" class="col-6 h-100" style="background-image: url('<?php echo (!empty($tribe_image)) ? $tribe_image : ''; ?>');">
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

		<!-- Information Section -->
		<div class="col-6"></div>
		<section id="info-section" class="col-6 h-100 d-flex justify-content-center p-5">
			<!-- container -->
			<div id="info-container" class="fs-6">

				<!-- desc -->
				<div class="description text-center d-flex flex-column align-items-center mb-4">
					<h1 id="tribe-name" class="text-center"><?php echo ucfirst($tribe_name); ?></h1>
					<p class="col-10">Sarangani, a province located in the southern part of the Philippines, is home to a variety of traditional indigenous communities. These groups have their own distinct cultural practices, beliefs, and ways of life that have been passed down through generations. These traditions often center around a strong connection to the land, nature, and spirituality. The people of Sarangani have worked hard to preserve their cultural heritage despite the challenges of modernization. Visitors to the province have the opportunity to experience and learn about the rich and diverse traditions of these indigenous communities through cultural exhibitions and interactions, contributing to the unique cultural tapestry of Sarangani.</p>
				</div>


				<!-- Practices -->
				<h2 class="section-title">Practices</h2>
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
								<!-- practice example -->
								<div class="">
									<h3 class="prax-name"><?php echo $practices_name ?></h3>
									<p class="mb-5">
										<!-- image -->
										<img src="<?php echo $practices_image;?>" class="rounded float-start m-2">
										<!-- description -->
										<?php echo $practices_description; ?>
									</p>
								</div>
					<?php
							}
						} else {
							echo "Crop ID not found in the URL.";
						}
					}
					?>
				</div>


				<!-- Rituals -->
				<h2 class="section-title">Rituals</h2>
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
								<!-- ritual example -->
								<div class="">
									<h2 class="prax-name"><?php echo $ritual_name ?></h2>
									<p class="mb-5">
										<!-- image -->
										<img src="<?php echo $ritual_image;?>" class="rounded float-end m-2">
										<!-- description -->
										<?php echo $ritual_description; ?>
									</p>
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