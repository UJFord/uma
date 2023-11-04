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
	<title>Uma | Crops </title>
</head>

<body>
	<!-- Navbar -->
	<?php
		require('navfoot/navbar.php');
	?>

	<!-- Showcase -->
	<section id="main-showcase" class="position-relative">
		<div id="showcase-div" class="container d-flex flex-column justify-content-center align-items-center h-100">
			<h1 class="mb-4">Traditional Crops</h1>
			<p class="w-75 text-center">
				Sarangani is known for its rich agricultural heritage and
				traditional crops. Traditional crops in Sarangani include
				staples such as rice, corn, and coconut, which have been
				cultivated for generations by local farmers. These crops not
				only sustain the local population but also contribute to the
				province's economy and cultural identity.
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
					<h2 id="crops-title" class="fw-semibold">Crops</h2>
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
				$connection = pg_connect("host=localhost dbname=farm_crops user=postgres password=123");
				if (!$connection) {
					echo "An error occured";
					exit;
				}

				$result = pg_query($connection, "select traditional_crop.crop_id, basic_info.image, basic_info.name from traditional_crop left join basic_info on traditional_crop.basic_info_id = basic_info.basic_info_id");
				$count = pg_num_rows($result);

				if ($count > 0) {
					while ($row = pg_fetch_assoc($result)) {
						$crop_id = $row['crop_id'];
						$image = $row['image'];
						$name = $row['name'];

				?>
						<!-- Saging with data from db -->
						<div class="card-container col-6 col-md-4 col-lg-2 p-2">

							<a href="crops/saging.php?crop_id=<?php echo $crop_id; ?>">
								<!-- image -->
								<div class="crop-card py-3 px-1 d-flex justify-content-center align-items-end">
									<?php
									if ($image == "") {
										// Image not Available
										echo "Image not found.";
									} else {
										// Image Available
									?>
										<!-- <img src="<?php echo $image; ?>"> -->
									<?php
									}
									?>
									<div class="crop-card-text row w-100 d-flex flex-row justify-content-between align-items-center">
										<h4 class="crop-name col-6"><?php echo ucfirst($name); ?></h4>
										<div class="col-2 arrow-container">
											<i class="position-absolute bi bi-arrow-right-short fs-3"></i>
										</div>
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

				<!-- Saging -->
				<div class="card-container col-6 col-md-4 col-lg-2 p-2">
					<a href="#" class="crop-card py-3 px-1 d-flex justify-content-center align-items-end" style="
								background-image: url('https://images.unsplash.com/photo-1603833665858-e61d17a86224?auto=format&fit=crop&q=80&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&w=1854');
							">
						<div class="crop-card-text row w-100 d-flex flex-row justify-content-between align-items-center">
							<h4 class="crop-name col-6">Saging</h4>
							<div class="col-2 arrow-container">
								<i class="position-absolute bi bi-arrow-right-short fs-3"></i>
							</div>
						</div>
					</a>
				</div>

				<!-- Mais -->
				<div class="card-container col-6 col-md-4 col-lg-2 p-2">
					<a href="#" class="crop-card py-3 px-1 d-flex justify-content-center align-items-end" style="
								background-image: url('https://plus.unsplash.com/premium_photo-1664299124175-e2c793325bfa?auto=format&fit=crop&q=80&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&w=2001');
							">
						<div class="crop-card-text row w-100 d-flex flex-row justify-content-between align-items-center">
							<h4 class="crop-name col-6">Mais</h4>
							<div class="col-2 arrow-container">
								<i class="position-absolute bi bi-arrow-right-short fs-3"></i>
							</div>
						</div>
					</a>
				</div>

				<!-- Palay -->
				<div class="card-container col-6 col-md-4 col-lg-2 p-2">
					<a href="#" class="crop-card py-3 px-1 d-flex justify-content-center align-items-end" style="
								background-image: url('https://images.unsplash.com/photo-1635562985686-4f8bb9c0d3bf?auto=format&fit=crop&q=80&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&w=1887');
							">
						<div class="crop-card-text row w-100 d-flex flex-row justify-content-between align-items-center">
							<h4 class="crop-name col-6">Palay</h4>
							<div class="col-2 arrow-container">
								<i class="position-absolute bi bi-arrow-right-short fs-3"></i>
							</div>
						</div>
					</a>
				</div>

				<!-- Mani -->
				<div class="card-container col-6 col-md-4 col-lg-2 p-2">
					<a href="#" class="crop-card py-3 px-1 d-flex justify-content-center align-items-end" style="
								background-image: url('https://plus.unsplash.com/premium_photo-1668420870736-168a5a5c79a0?auto=format&fit=crop&q=80&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&w=1974');
							">
						<div class="crop-card-text row w-100 d-flex flex-row justify-content-between align-items-center">
							<h4 class="crop-name col-6">Mani</h4>
							<div class="col-2 arrow-container">
								<i class="position-absolute bi bi-arrow-right-short fs-3"></i>
							</div>
						</div>
					</a>
				</div>

				<!-- Kalabasa -->
				<div class="card-container col-6 col-md-4 col-lg-2 p-2">
					<a href="#" class="crop-card py-3 px-1 d-flex justify-content-center align-items-end" style="
								background-image: url('https://img.freepik.com/free-photo/top-view-pumpkins-arrangement_23-2150691975.jpg?t=st=1697648319~exp=1697651919~hmac=b0691e9aecfeb57a556a0fab47411822596e856ea324cbe9e3d3fb45b65d09de&w=360');
							">
						<div class="crop-card-text row w-100 d-flex flex-row justify-content-between align-items-center">
							<h4 class="crop-name col-6">Kalabasa</h4>
							<div class="col-2 arrow-container">
								<i class="position-absolute bi bi-arrow-right-short fs-3"></i>
							</div>
						</div>
					</a>
				</div>

				<!-- Kamote -->
				<div class="card-container col-6 col-md-4 col-lg-2 p-2">
					<a href="#" class="crop-card py-3 px-1 d-flex justify-content-center align-items-end" style="
								background-image: url('https://plus.unsplash.com/premium_photo-1675365780148-a00379c54123?auto=format&fit=crop&q=80&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&w=1887');
							">
						<div class="crop-card-text row w-100 d-flex flex-row justify-content-between align-items-center">
							<h4 class="crop-name col-6">Kamote</h4>
							<div class="col-2 arrow-container">
								<i class="position-absolute bi bi-arrow-right-short fs-3"></i>
							</div>
						</div>
					</a>
				</div>

				<!-- Abukado -->
				<div class="card-container col-6 col-md-4 col-lg-2 p-2">
					<a href="#" class="crop-card py-3 px-1 d-flex justify-content-center align-items-end" style="
								background-image: url('https://images.unsplash.com/photo-1583029901628-8039767c7ad0?auto=format&fit=crop&q=80&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&w=2070');
							">
						<div class="crop-card-text row w-100 d-flex flex-row justify-content-between align-items-center">
							<h4 class="crop-name col-6">Abukado</h4>
							<div class="col-2 arrow-container">
								<i class="position-absolute bi bi-arrow-right-short fs-3"></i>
							</div>
						</div>
					</a>
				</div>

				<!-- Sitaw -->
				<div class="card-container col-6 col-md-4 col-lg-2 p-2">
					<a href="#" class="crop-card py-3 px-1 d-flex justify-content-center align-items-end" style="
								background-image: url('https://images.unsplash.com/uploads/141143339879512fe9b0d/f72e2c85?auto=format&fit=crop&q=80&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&w=2070');
							">
						<div class="crop-card-text row w-100 d-flex flex-row justify-content-between align-items-center">
							<h4 class="crop-name col-6">Sitaw</h4>
							<div class="col-2 arrow-container">
								<i class="position-absolute bi bi-arrow-right-short fs-3"></i>
							</div>
						</div>
					</a>
				</div>

				<!-- Talong -->
				<div class="card-container col-6 col-md-4 col-lg-2 p-2">
					<a href="#" class="crop-card py-3 px-1 d-flex justify-content-center align-items-end" style="
								background-image: url('https://images.unsplash.com/photo-1605197378540-10ebaf6999e5?auto=format&fit=crop&q=80&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&w=1887');
							">
						<div class="crop-card-text row w-100 d-flex flex-row justify-content-between align-items-center">
							<h4 class="crop-name col-6">Talong</h4>
							<div class="col-2 arrow-container">
								<i class="position-absolute bi bi-arrow-right-short fs-3"></i>
							</div>
						</div>
					</a>
				</div>

				<!-- Labanos -->
				<div class="card-container col-6 col-md-4 col-lg-2 p-2">
					<a href="#" class="crop-card py-3 px-1 d-flex justify-content-center align-items-end" style="
								background-image: url('https://images.unsplash.com/photo-1585369496178-144fd937f249?auto=format&fit=crop&q=80&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&w=2070');
							">
						<div class="crop-card-text row w-100 d-flex flex-row justify-content-between align-items-center">
							<h4 class="crop-name col-6">Labanos</h4>
							<div class="col-2 arrow-container">
								<i class="position-absolute bi bi-arrow-right-short fs-3"></i>
							</div>
						</div>
					</a>
				</div>

				<!-- Kangkong -->
				<div class="card-container col-6 col-md-4 col-lg-2 p-2">
					<a href="#" class="crop-card py-3 px-1 d-flex justify-content-center align-items-end" style="
								background-image: url('https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQbZ_i5KWsdroWbR7Hp4PtWrNTE5vO_2MtMZbGYsEQTBa7MqLaA');
							">
						<div class="crop-card-text row w-100 d-flex flex-row justify-content-between align-items-center">
							<h4 class="crop-name col-6">Kangkong</h4>
							<div class="col-2 arrow-container">
								<i class="position-absolute bi bi-arrow-right-short fs-3"></i>
							</div>
						</div>
					</a>
				</div>

				<!-- Ampalaya -->
				<div class="card-container col-6 col-md-4 col-lg-2 p-2">
					<a href="#" class="crop-card py-3 px-1 d-flex justify-content-center align-items-end" style="
								background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ2Tto4dFtUIFf3rFYJ7jUEWp0wsI0qv_rYC0x8uV1XqRU6Dwu4');
							">
						<div class="crop-card-text row w-100 d-flex flex-row justify-content-between align-items-center">
							<h4 class="crop-name col-6">Ampalaya</h4>
							<div class="col-2 arrow-container">
								<i class="position-absolute bi bi-arrow-right-short fs-3"></i>
							</div>
						</div>
					</a>
				</div>

				<!-- Sili -->
				<div class="card-container col-6 col-md-4 col-lg-2 p-2">
					<a href="#" class="crop-card py-3 px-1 d-flex justify-content-center align-items-end" style="
								background-image: url('https://plus.unsplash.com/premium_photo-1675864033264-cb9db758422d?auto=format&fit=crop&q=80&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&w=1887');
							">
						<div class="crop-card-text row w-100 d-flex flex-row justify-content-between align-items-center">
							<h4 class="crop-name col-6">Sili</h4>
							<div class="col-2 arrow-container">
								<i class="position-absolute bi bi-arrow-right-short fs-3"></i>
							</div>
						</div>
					</a>
				</div>

				<!-- Tangkong -->
				<div class="card-container col-6 col-md-4 col-lg-2 p-2">
					<a href="#" class="crop-card py-3 px-1 d-flex justify-content-center align-items-end" style="
								background-image: url('https://bacolodpages.com/sites/default/files/styles/480x480/public/products/Tangkong.JPG.webp?itok=L4APZYgc');
							">
						<div class="crop-card-text row w-100 d-flex flex-row justify-content-between align-items-center">
							<h4 class="crop-name col-6">Tangkong</h4>
							<div class="col-2 arrow-container">
								<i class="position-absolute bi bi-arrow-right-short fs-3"></i>
							</div>
						</div>
					</a>
				</div>

				<!-- Kamias -->
				<div class="card-container col-6 col-md-4 col-lg-2 p-2">
					<a href="#" class="crop-card py-3 px-1 d-flex justify-content-center align-items-end" style="
								background-image: url('https://encrypted-tbn0.gstatic.com/licensed-image?q=tbn:ANd9GcT2GNDFPefuCPv6q9IyeO_9nBFaTvWOn3tGVpN3iMuicRFuSqHVRJJUYgM0PQ0KfSXMkMyYi3mmKZs_qGw');
							">
						<div class="crop-card-text row w-100 d-flex flex-row justify-content-between align-items-center">
							<h4 class="crop-name col-6">Kamias</h4>
							<div class="col-2 arrow-container">
								<i class="position-absolute bi bi-arrow-right-short fs-3"></i>
							</div>
						</div>
					</a>
				</div>

				<!-- Luya -->
				<div class="card-container col-6 col-md-4 col-lg-2 p-2">
					<a href="#" class="crop-card py-3 px-1 d-flex justify-content-center align-items-end" style="
								background-image: url('https://images.unsplash.com/photo-1603431777782-912e3b76f60d?auto=format&fit=crop&q=80&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&w=1887');
							">
						<div class="crop-card-text row w-100 d-flex flex-row justify-content-between align-items-center">
							<h4 class="crop-name col-6">Luya</h4>
							<div class="col-2 arrow-container">
								<i class="position-absolute bi bi-arrow-right-short fs-3"></i>
							</div>
						</div>
					</a>
				</div>

				<!-- Kasuy -->
				<div class="card-container col-6 col-md-4 col-lg-2 p-2">
					<a href="#" class="crop-card py-3 px-1 d-flex justify-content-center align-items-end" style="
								background-image: url('https://images.unsplash.com/photo-1573555657105-47a0bb37c3ea?auto=format&fit=crop&q=80&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&w=1886');
							">
						<div class="crop-card-text row w-100 d-flex flex-row justify-content-between align-items-center">
							<h4 class="crop-name col-6">Kasuy</h4>
							<div class="col-2 arrow-container">
								<i class="position-absolute bi bi-arrow-right-short fs-3"></i>
							</div>
						</div>
					</a>
				</div>

				<!-- Ube -->
				<div class="card-container col-6 col-md-4 col-lg-2 p-2">
					<a href="#" class="crop-card py-3 px-1 d-flex justify-content-center align-items-end" style="
								background-image: url('https://encrypted-tbn0.gstatic.com/licensed-image?q=tbn:ANd9GcSVVq8_u_lIG5ivQFYG98esKEMZfF1ExwLZEa5w7wlDixSRkFflpIPmSJWVZX710LwThnv7y_WPFoi4V2s');
							">
						<div class="crop-card-text row w-100 d-flex flex-row justify-content-between align-items-center">
							<h4 class="crop-name col-6">Ube</h4>
							<div class="col-2 arrow-container">
								<i class="position-absolute bi bi-arrow-right-short fs-3"></i>
							</div>
						</div>
					</a>
				</div>

				<!-- Saba -->
				<div class="card-container col-6 col-md-4 col-lg-2 p-2">
					<a href="#" class="crop-card py-3 px-1 d-flex justify-content-center align-items-end" style="
								background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS5DSKxdcBTH57Xqlo8tIMv5dVcr_brlp0Mx484072nsrV_Kou1');
							">
						<div class="crop-card-text row w-100 d-flex flex-row justify-content-between align-items-center">
							<h4 class="crop-name col-6">Saba</h4>
							<div class="col-2 arrow-container">
								<i class="position-absolute bi bi-arrow-right-short fs-3"></i>
							</div>
						</div>
					</a>
				</div>

				<!-- Lanzones -->
				<div class="card-container col-6 col-md-4 col-lg-2 p-2">
					<a href="#" class="crop-card py-3 px-1 d-flex justify-content-center align-items-end" style="
								background-image: url('https://media.istockphoto.com/id/1713340644/photo/lansium-parasiticum-in-thai-market.jpg?s=612x612&w=0&k=20&c=fC9uqgcftgRTqo11lbHc1iXN_mG95ZgNrFbdfCUfYYg=');
							">
						<div class="crop-card-text row w-100 d-flex flex-row justify-content-between align-items-center">
							<h4 class="crop-name col-6">Lanzones</h4>
							<div class="col-2 arrow-container">
								<i class="position-absolute bi bi-arrow-right-short fs-3"></i>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</section>

	<!-- Footer -->
	<?php
		require('navfoot/footer.php');
	?>>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
	<!-- font awesome -->
	<script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>
</body>

</html>