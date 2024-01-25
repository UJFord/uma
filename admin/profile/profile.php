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

	<!-- Check access when the page loads -->
	<script>
		// Assume you have the userRole variable defined somewhere in your PHP code
		var userRole = "<?php echo isset($_SESSION['rank']) ? $_SESSION['rank'] : ''; ?>";
		checkAccess(userRole);
	</script>
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

								if (pg_num_rows($query_run) > 0) {
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
													<h4><?= $_SESSION['USER']['first_name']; ?>(first name)</h4>
													<p class="text-muted font-size-sm"><?= $gender; ?>(gender initial lang ni)</p>
												</div>
											</div>
										</div>
									</div>
									<div class="card mt-3">
										<ul class="list-group list-group-flush">
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe mr-2 icon-inline">
														<circle cx="12" cy="12" r="10"></circle>
														<line x1="2" y1="12" x2="22" y2="12"></line>
														<path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
													</svg>Website</h6>
												<span class="text-secondary">example@mail.com</span>
											</li>
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github mr-2 icon-inline">
														<path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path>
													</svg>Github</h6>
												<span class="text-secondary">example@mail.com</span>
											</li>
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter mr-2 icon-inline text-info">
														<path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
													</svg>Twitter</h6>
												<span class="text-secondary">@example@mail.com</span>
											</li>
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram mr-2 icon-inline text-danger">
														<rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
														<path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
														<line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
													</svg>Instagram</h6>
												<span class="text-secondary">example@mail.com</span>
											</li>
											<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
												<h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook mr-2 icon-inline text-primary">
														<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
													</svg>Facebook</h6>
												<span class="text-secondary">example@mail.com</span>
											</li>
										</ul>
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
									<div class="row gutters-sm">
										<div class="col-sm-12 mb-3">
											<div class="card h-100">
												<div class="card-body">
													<h6 class="d-flex align-items-center mb-3">Crops Submitted</h6>
													<div>
														<table class="table table-bordered col-md-12">
															<thead>
																<tr>
																	<th scope="col">Crop ID</th>
																	<th scope="col">Crop Name</th>
																	<th scope="col">local Name</th>
																	<th scope="col">Description</th>
																</tr>
															</thead>

															<?php
															$query = "SELECT *
															FROM crop
															WHERE user_id = $user_id
															ORDER BY crop.crop_id ASC";
															$result = pg_query($connection, $query);

															if ($result) {
																while ($row = pg_fetch_array($result)) {
															?>
																	<tbody>
																		<tr>
																			<th scope="row"><?php echo $row['crop_id']; ?></th>
																			<td><?php echo $row['crop_name']; ?></td>
																			<td><?php echo $row['crop_local_name']; ?></td>
																			<td><?php echo $row['crop_description']; ?></td>
																		</tr>
																	</tbody>
															<?php
																}
															} else {
																echo "Query failed: " . pg_last_error($connection);
															}
															?>
														</table>
													</div>
												</div>
											</div>
										</div>
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