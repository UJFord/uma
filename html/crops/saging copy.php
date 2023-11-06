<?php
$connection = pg_connect("host=localhost dbname=farm_crops user=postgres password=123");
?>


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
				<!-- Showcase -->
				<section
					id="main-showcase"
					class="col-sm-6 position-relative h-100"
				>
					<div
						id="showcase-div"
						class="container p-5 d-flex flex-column justify-content-between align-items-start h-100"
					>
						<!-- return -->
						<a href="../crops.html"
							><i class="bi bi-caret-left-square fs-1"></i
						></a>

						<!-- crop name -->
						<h1 class="mb-4">Saging</h1>
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
							<strong class="fs-4">Banana</strong> in Sarangani is known for thriving the industry. It is a major banana-producing
							region, with vast plantations and farms cultivating
							various banana varieties. The province's tropical
							climate and fertile soil make it an ideal location for
							banana cultivation, contributing significantly to the
							local economy.
						</div>

						<!-- scientific name -->
						<div class="info-item"><i class="fa-solid fa-microscope"></i><p><em>Musa</em></p></div>

						<!-- plant type -->
						<div class="info-item"><i class="fa-solid fa-seedling"></i><p>Genus</p></div>

						<!-- use -->
						<div class="info-item"><i class="fa-solid fa-utensils"></i><p>fresh snacking, smoothies, cereals and oatmeal, baking, fruit salads, desserts, fruit shakes and ice cream, dried bananas, savory dishes (unripe plantains), banana chips, flavoring, nutritional value, natural sweetener</p></div>

						<!-- origin -->
						<div class="info-item"><i class="fa-regular fa-newspaper"></i><p>Believed to have originated in Southeast Asia, particularly in regions including Malaysia, Indonesia, the Philippines, and Papua New Guinea. They have been cultivated for thousands of years and spread to various parts of the world through trade and travel. The popular Cavendish banana variety we consume today replaced the earlier Gros Michel variety due to disease susceptibility.</p></div>
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
