<!DOCTYPE html>
<?php
session_start();
require('../sidebar/side.php');
?>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
	<!-- cutom css -->
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
						<h2 id="crops-title" class="fw-semibold">Profile</h2>
					</div>
				</div>

				<!-- Profile start -->
				<div id="" class="row">
					<?php include '../message.php'; ?>

					<div class="container">
						<div class="main-body">

							<!-- /Breadcrumb -->
							<div class="row gutters-sm">
								<?php
								$user_id = $_SESSION['USER']['user_id'];

								$query = "Select * from users WHERE user_id = $1";
								$query_run = pg_query_params($connection, $query, array($user_id));

								if(pg_num_rows($query_run) > 0){
									$users = pg_fetch_assoc($query_run);

									$first_name = $users['first_name'];
									$last_name = $users['last_name'];
									$email = $users['email'];
									$gender = $users['gender'];
									$affiliation = $users['affiliation'];
									$username = $users['username'];
									$registration_date = $users['registration_date'];
								}
								?>

								<div class="col-md-4 mb-3">
									<div class="card">
										<div class="card-body">
											<div class="d-flex flex-column align-items-center text-center">
												<img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
												<div class="mt-3">
													<h4><?= $_SESSION['USER']['first_name']; ?></h4>
													<p class="text-muted font-size-sm"><?= $gender; ?></p>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-8">
									<div class="card mb-3">
										<div class="card-body">
											<div class="row">
												<div class="col-sm-3">
													<h6 class="mb-0">Full Name</h6>
												</div>
												<div class="col-sm-9 text-secondary">
												<?= $first_name; ?> <?= $last_name; ?>
												</div>
											</div>
											<hr>
											<div class="row">
												<div class="col-sm-3">
													<h6 class="mb-0">Email</h6>
												</div>
												<div class="col-sm-9 text-secondary">
												<?= $email; ?>
												</div>
											</div>
											<hr>
											<div class="row">
												<div class="col-sm-3">
													<h6 class="mb-0">Affiliation</h6>
												</div>
												<div class="col-sm-9 text-secondary">
												<?= $affiliation; ?>
												</div>
											</div>
											<hr>
											<div class="row">
												<div class="col-sm-3">
													<h6 class="mb-0">Mobile</h6>
												</div>
												<div class="col-sm-9 text-secondary">
													(320) 380-4539
												</div>
											</div>
											<hr>
											<div class="row">
												<div class="col-sm-3">
													<h6 class="mb-0">Address</h6>
												</div>
												<div class="col-sm-9 text-secondary">
													Bay Area, San Francisco, CA
												</div>
											</div>
											<hr>

										</div>
									</div>
								</div>
							</div>

						</div>
					</div>

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