<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
	<!-- cutom css -->
	<link rel="stylesheet" href="../../css/admin/list.css" />
	<!-- favicon -->
	<link rel="shortcut icon" href="img/logo/Uma logo.svg" type="image/x-icon" />
	<title>Uma | AdminPage</title>
</head>

<body class="overflow-hidden">

	<!-- container of everything -->
	<div class="row ">

		<!-- sidebar -->
		<?php
		require('../sidebar/side.php');
		?>
		<!-- space holder of side panel -->
		<section class=" d-none d-md-block col col-4 col-lg-3 col-xl-2 p-0 m-0"></section>
		<!-- main panel -->
		<section id="nav-cards" class="p-0 m-0 col col-md-4 col-lg-9 col-xl-10">
			<div class="py-3 px-4">
				<!-- title and filter -->
				<div class="row d-flex justify-content-between mb-3">
					<!-- title -->
					<div class="col-6">
						<h2 id="crops-title" class="fw-semibold">Rituals</h2>
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
							<form action="search.php" method="POST">
								<input type="search" name="search" class="form-control" placeholder="Start typing to filter..." />
							</form>
						</div>
					</div>
				</div>

				<!-- crop cards -->
				<div id="crop-cards" class="row">
					<?php
					// add entry button
					require('../add/add.php');
					?>
					<!-- crop cards -->
					<div id="crop-cards" class="row">
						<?php
						$result = pg_query($connection, "select * from ritual");
						$count = pg_num_rows($result);

						if ($count > 0) {
							while ($row = pg_fetch_assoc($result)) {
								$ritual_id = $row['ritual_id'];
								$ritual_name = $row['ritual_name'];
								$image = $row['image'];
						?>
								<!--  -->
								<div class="card-container col-6 col-md-4 col-lg-2 p-2">

									<a href="ritual.php?ritual_id=<?php echo $ritual_id; ?>" class="crop-card py-3 px-1 d-flex justify-content-center align-items-end" style="
									background-image: url('<?php echo $image; ?>');
								">
										<div class="crop-card-text row w-100 d-flex flex-row justify-content-between align-items-center">
											<!-- crop name -->
											<h4 class="crop-name col-6"><?php echo ucfirst($ritual_name); ?></h4>
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

	</div>

	<!-- scipts -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
	<!-- font awesome -->
	<script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>
</body>

</html>