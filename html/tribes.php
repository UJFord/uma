<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
	<!-- cutom css -->
	<link rel="stylesheet" href="../css/crops/crops.css" />
	<!-- favicon -->
	<link rel="shortcut icon" href="../img/logo/umalogo.png" type="image/x-icon" />
	<title>Uma | Tribes </title>
</head>

<body>
	<!-- Navbar -->
	<?php
	require('navfoot/navbar.php');
	require('navfoot/connection.php');
	?>

	<!-- Showcase -->
	<section id="main-showcase" class="position-relative">
		<div id="showcase-div" class="container d-flex flex-column justify-content-center align-items-center h-100">
			<h1 class="mb-4">Tribes</h1>
			<p class="w-75 text-center">
				Sarangani is distinguished for its vibrant cultural diversity and ancient tribal legacies.
				The indigenous tribes in Sarangani uphold a wealth of heritage, embracing unique traditions and customary
				rituals that have endured through generations. These timeless practices, deeply embedded in the history of
				each tribe, encompass diverse ceremonies, spiritual customs, and ancestral traditions. Passed down through
				generations, these tribal legacies not only perpetuate the identity and beliefs of each tribe but also serve
				as a cornerstone in defining the social structure and safeguarding the diverse cultural heritage of the
				community.
			</p>
		</div>`

		<!-- brush -->
		<div class="brush position-absolute bottom-0 end-0 w-100"></div>
	</section>

	<!-- Navigation Cards -->
	<section id="nav-cards" class="my-5">
		<div class="container">
			<!-- title and filter -->
			<div class="row d-flex justify-content-between mb-3">
				<!-- title -->
				<div class="col-6">
					<h2 id="crops-title" class="fw-semibold">Tribes</h2>
				</div>

				<!-- search -->
				<div id="filter-search" class="col-6 col-md-5 col-lg-3">
					<div class="input-group">
						<button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
							<i class="bi bi-funnel"></i>
						</button>
						<ul class="dropdown-menu">
							<li>
								<a class="dropdown-item" href="#">Action</a>
							</li>
							<li>
								<a class="dropdown-item" href="#">Another action</a>
							</li>
							<li>
								<a class="dropdown-item" href="#">Something else here</a>
							</li>
							<li>
								<hr class="dropdown-divider" />
							</li>
							<li>
								<a class="dropdown-item" href="#">Separated link</a>
							</li>
						</ul>
						<input type="text" class="form-control" placeholder="Start typing to filter..." />
					</div>
				</div>

				<!-- crop cards -->
				<div class="row"></div>
			</div>

			<!-- crop cards -->
			<div id="crop-cards" class="row">

				<?php

				$result = pg_query($connection, "select tribe.tribe_id, tribe.tribe_name, tribe.tribe_image from tribe");
				$count = pg_num_rows($result);

				if ($count > 0) {
					while ($row = pg_fetch_assoc($result)) {
						$tribe_id = $row['tribe_id'];
						$tribe_name = $row['tribe_name'];
						$tribe_image = $row['tribe_image'];
				?>
						<!-- Saging with data from db -->
						<div class="card-container col-6 col-md-4 col-lg-2 p-2">

							<a href="tribes/tribe.php?tribe_id=<?php echo $tribe_id; ?>" class="crop-card py-3 px-1 d-flex justify-content-center align-items-end" style="
									background-image: url('<?php echo $tribe_image; ?>');
								">
								<div class="crop-card-text row w-100 d-flex flex-row justify-content-between align-items-center">
									<!-- crop name -->
									<h4 class="crop-name col-6"><?php echo ucfirst($tribe_name); ?></h4>
									<!-- arrow -->
									<div class="col-2 arrow-container">
										<i class="position-absolute bi bi-arrow-right-short fs-3"></i>
									</div>
								</div>
							</a>
						</div>
				<?php
					}
				} else {
					echo '<h5>No Record Found </h5>';
				}
				?>
			</div>
		</div>
	</section>

	<!-- Footer -->
	<?php
	require('navfoot/footer.php');
	?>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
	<!-- font awesome -->
	<script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>
</body>

</html>