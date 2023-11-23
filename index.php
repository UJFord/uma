<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
	<!-- cutom css -->
	<link rel="stylesheet" href="css/landing/landing.css" />
	<!-- favicon -->
	<link rel="shortcut icon" href="img/logo/Uma logo.svg" type="image/x-icon" />
	<title>Uma | Homepage</title>
</head>

<body>
	<!-- Navbar -->
	

	<!-- Showcase -->
	<section id="main-showcase" class="position-relative">
		<div id="carouselExampleCaptions" class="carousel slide h-10" data-bs-ride="carousel">
			<div class="carousel-indicators">
				<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
				<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
				<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
			</div>
			<div class="carousel-inner">
				<div class="carousel-item active">
					<div class="carousel-image" style="
								background-image: url('https://images.unsplash.com/photo-1593480092626-cd38b2fc2e10?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1149&q=80');
							"></div>
					<div class="carousel-caption text-start">
						<h5>Harvesting Excellence, One Crop at a Time</h5>
						<p class="d-none d-md-block">
							We strive for agricultural excellence, nurturing
							each crop with care and dedication.
						</p>
					</div>
				</div>
				<div class="carousel-item">
					<div class="carousel-image" style="
								background-image: url('https://images.unsplash.com/photo-1609553868429-3d75802809d8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1176&q=80');
							"></div>
					<div class="carousel-caption text-start">
						<h5>Rooted in Tradition, Growing for the Future</h5>
						<p class="d-none d-md-block">
							Our farming heritage fuels our commitment to
							sustainable growth and innovation.
						</p>
					</div>
				</div>
				<div class="carousel-item">
					<div class="carousel-image" style="
								background-image: url('https://images.unsplash.com/photo-1660903014788-8339c3120915?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1330&q=80');
							"></div>
					<div class="carousel-caption text-start">
						<h5>
							Where Traditional Agriculture Meets Innovation
						</h5>
						<p class="d-none d-md-block">
							We blend the time-honored practices of
							agriculture with cutting-edge innovations to
							optimize crop production.
						</p>
					</div>
				</div>
			</div>
			<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
			</button>
			<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
			</button>
		</div>

		<!-- brush -->
		<div class="brush position-absolute bottom-0 end-0 w-100"></div>
	</section>

	<!-- Navigation Cards -->
	<section id="nav-cards" class="my-5">
		<div class="container">
			<div class="row">
				<!-- nav cards -->
				<div class="col col-lg-9 d-flex flex-column align-items-center grid gap-0 row-gap-4">
					<a href="html/crops.php" id="plink-crop" class="plink-container col-9 col-lg-7">
						<!-- text -->
						<div class="plink-text">
							<h6 class="plink-gentitle">Crops</h6>
							<h5 class="plink-subtitle d-none d-md-block">
								Traditional Crops
							</h5>
						</div>
						<!-- arrow -->
						<div class="arrow-container">
							<i class="bi bi-arrow-right-short fs-3"></i>
						</div>
					</a>

					<!-- map -->
					<a href="html/map.html" id="plink-map" class="plink-container col-9 col-lg-7">
						<!-- text -->
						<div class="plink-text">
							<h6 class="plink-gentitle">Map</h6>
							<h5 class="plink-subtitle d-none d-md-block">Sarangani Map</h5>
						</div>
						<!-- arrow -->
						<div class="arrow-container">
							<i class="bi bi-arrow-right-short fs-3"></i>
						</div>
					</a>

					<!-- two in a row -->
					<div id="double-card" class="row column-gap-4 col-9 col-lg-7">
						<!-- tribe -->
						<a href="#" id="plink-tribe" class="plink-container">
							<!-- text -->
							<div class="plink-text">
								<h6 class="plink-gentitle">Tribes</h6>
								<h5 class="plink-subtitle d-none d-md-block">
									Farming Tribes
								</h5>
							</div>
							<!-- arrow -->
							<div class="arrow-container">
								<i class="bi bi-arrow-right-short fs-3"></i>
							</div>
						</a>

						<!-- farms -->
						<a href="#" id="plink-farm" class="plink-container">
							<!-- text -->
							<div class="plink-text">
								<h6 class="plink-gentitle">Farms</h6>
								<h5 class="plink-subtitle d-none d-md-block">Crop Farms</h5>
							</div>
							<!-- arrow -->
							<div class="arrow-container">
								<i class="bi bi-arrow-right-short fs-3"></i>
							</div>
						</a>
					</div>
				</div>

				<div class="col col-lg-3 d-none d-lg-block">
					<div class="container my-2">
						<!-- Tags -->
						<div id="landing-tags" class="row py-4 px-3 mb-3">
							<div class="">
								<h4 class="w-25 py-2">Tags</h4>
								<div class="d-flex flex-row row grid gap-2 p-2">
									<a class="col col-auto rounded-pill link-underline-opacity-0 px-3 py-1">
										trv
									</a>
									<a class="col col-auto rounded-pill link-underline-opacity-0 px-3 py-1">
										alabel
									</a>
									<a class="col col-auto rounded-pill link-underline-opacity-0 px-3 py-1">
										malgas
									</a>
									<a class="col col-auto rounded-pill link-underline-opacity-0 px-3 py-1">
										moradu
									</a>
									<a class="col col-auto rounded-pill link-underline-opacity-0 px-3 py-1">
										sarangani
									</a>
									<a class="col col-auto rounded-pill link-underline-opacity-0 px-3 py-1">
										malapatan
									</a>
									<a class="col col-auto rounded-pill link-underline-opacity-0 px-3 py-1">
										upland rice
									</a>
								</div>
							</div>
						</div>

						<!-- Socials -->
						<div id="landing-socials" class="row py-4 px-3">
							<div class="">
								<h4 class="w-25 py-2">Socials</h4>
								<div class="d-flex flex-row row grid gap-2 p-2">
									<!-- facebook -->
									<a class="col col-auto border border-0 rounded-circle py-0 px-2 bg-transparent">
										<i class="fa-brands fa-facebook"></i>
									</a>
									<!-- github -->
									<a class="col col-auto border border-0 rounded-circle py-0 px-2 bg-transparent">
										<i class="fa-brands fa-github"></i>
									</a>
									<!-- instagram -->
									<a class="col col-auto border border-0 rounded-circle py-0 px-2 bg-transparent">
										<i class="fa-brands fa-instagram"></i>
									</a>
									<!-- linkedIn -->
									<a class="col col-auto border border-0 rounded-circle py-0 px-2 bg-transparent">
										<i class="fa-brands fa-linkedin"></i>
									</a>
									<!-- youtube -->
									<a class="col col-auto border border-0 rounded-circle py-0 px-2 bg-transparent">
										<i class="fa-brands fa-youtube"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Footer -->
	<?php
	require('html/navfoot/footer.php');
	?>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
	<!-- font awesome -->
	<script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>
</body>

</html>