<!DOCTYPE html>
<?php
session_start();
require('../sidebar/side.php');
require('../search-box.php');
// include('../login/login-check.php');
// include '../access.php';
// access('ADMIN');
// require('../functions.php');
// check_login();
?>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

	<!-- list custom css -->
	<link rel="stylesheet" href="../../css/admin/list.css" />
	<!-- sidebar custom css -->
	<link rel="stylesheet" href="../../css/admin/side.css">

	<!-- favicon -->
	<link rel="shortcut icon" href="img/logo/Uma logo.svg" type="image/x-icon" />
	<title>Uma | AdminPage</title>
</head>

<body class="overflow-hidden">

	<!-- container of everything -->
	<div class="row ">

		<!-- space holder of side panel -->
		<section class=" d-none d-md-block col col-4 col-lg-3 col-xl-2 p-0 m-0"></section>
		<!-- main panel -->
		<section id="nav-cards" class="p-0 m-0 col col-md-4 col-lg-9 col-xl-10">
			<div class=" py-3 px-4">
				<!-- title and filter -->
				<div class="row d-flex justify-content-between mb-3">
					<!-- title -->
					<div class="col-6">
						<h2 id="crops-title" class="fw-semibold">Crops</h2>
					</div>

					<!-- search -->
					<div id="filter-search" class="col-6 col-md-5 col-lg-3">
						<div class="input-group">
							<div>
								<a href="list.php"><i class="fa-regular fa-rectangle-list list-box" aria-hidden="true"></i></a>
								<a href="list-box.php"><i class="fa-solid fa-table-cells list-box" aria-hidden="true"></i></a>
							</div>
							<input type="search" id="searchInput" name="search" class="form-control" placeholder="Start typing to filter..." oninput="filterTable()" />
						</div>
					</div>

					<!-- crop cards -->
					<div id="crop-cards" class="row">
						<?php
						include '../message.php';
						?>

						<?php
						if (isset($_GET['category'])) {
							$categoryChecked = array_map('strtolower', $_GET['category']);

							// Convert category names to lowercase in the SQL query
							$result = pg_query($connection, "SELECT DISTINCT * FROM crop WHERE LOWER(category) IN ('" . implode("','", $categoryChecked) . "') ORDER BY crop_id");
						} else {
							$result = pg_query($connection, "SELECT * FROM crop ORDER BY crop_id");
						}

						$count = pg_num_rows($result);

						if ($count > 0) {
							while ($row = pg_fetch_assoc($result)) {
								$crop_id = $row['crop_id'];
								$crop_image = $row['crop_image'];
								$crop_name = $row['crop_name'];

						?>
								<!-- crop -->
								<div class="filterable-row card-container col-6 col-md-4 col-lg-2 p-2">
									<?php
									if ($crop_image !== null) {
									?>
										<a href="crop.php?crop_id=<?php echo $crop_id; ?>" class="crop-card py-3 px-1 d-flex justify-content-center align-items-end" style="
                                    background-image: url(../img/crop/<?php echo $crop_image; ?>);
                                ">
											<div class="crop-card-text row w-100 d-flex flex-row justify-content-between align-items-center">
												<!-- crop name -->
												<h4 class="crop-name col-6"><?php echo ucfirst($crop_name); ?></h4>
												<!-- arrow -->
												<div class="col-2 arrow-container">
													<i class="position-absolute bi bi-arrow-right-short fs-3"></i>
												</div>
											</div>
										</a>
									<?php
									} else {
									?>
										<a href="crop.php?crop_id=<?php echo $crop_id; ?>" class="crop-card py-3 px-1 d-flex justify-content-center align-items-end" style="
                                    background-image: url('https://storage.googleapis.com/proudcity/mebanenc/uploads/2021/03/placeholder-image.png');
                                ">
											<div class="crop-card-text row w-100 d-flex flex-row justify-content-between align-items-center">
												<!-- crop name -->
												<h4 class="crop-name col-6"><?php echo ucfirst($crop_name); ?></h4>
												<!-- arrow -->
												<div class="col-2 arrow-container">
													<i class="position-absolute bi bi-arrow-right-short fs-3"></i>
												</div>
											</div>
										</a>
									<?php
									}
									?>
								</div>
						<?php
							}
						}
						?>
					</div>

				</div>
		</section>

	</div>

	<!-- scipts -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
	<!-- font awesome -->
	<script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>

</body>

</html>