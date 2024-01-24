<!DOCTYPE html>
<?php
session_start();
require('../sidebar/side.php');
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
							<!-- <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="bi bi-funnel"></i>
							</button> -->
							<!-- <form action="" method="GET">
								<ul class="dropdown-menu">
									<div class="filter-header">
										<h5>Filter
											<button type="submit" class="btn btn-primary py-1 px-1 ">Search</button>
										</h5>
									</div>

									<li>
										<h5 class="filter-title">Category</h5>
										<?php
										$category_query = pg_query($connection, "SELECT DISTINCT category FROM crop");
										if (pg_num_rows($category_query) > 0) {
											$checked = isset($_GET['category']) ? $_GET['category'] : [];

											while ($category_name = pg_fetch_assoc($category_query)) {
										?>
												<div>
													<input type="checkbox" name="category[]" value="<?= $category_name['category'] ?>" <?php if (in_array($category_name['category'], $checked)) {
																																			echo "checked";
																																		} ?>>
													<?= $category_name['category'] ?>
												</div>
										<?php
											}
										}
										?>
									</li>

									<li>
										<hr class="dropdown-divider" />
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
							</form> -->
							<input type="search" id="searchInput" name="search" class="form-control" placeholder="Start typing to filter..." oninput="filterTable()" />
						</div>
					</div>
					<?php
					include('../message.php');
					?>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header admin-only curator-only">
								<h4>Crop Details
									<a href="create.php" class="btn btn-primary float-end">Add Crops</a>
								</h4>
							</div>
							<div class="card-body">
								<table id="dataTable" class="table table-bordered table-striped col-md-12">
									<thead>
										<tr>
											<th scope="col">Crop Id</th>
											<th scope="col">Crop Name</th>
											<th scope="col">Scientific Name</th>
											<th scope="col">Lowland or Upland</th>
											<th scope="col">Category</th>
											<th scope="col">Description</th>
											<th scope="col" class="curator-only admin-only">Status</th>
										</tr>
									</thead>

									<?php
									$query = "select * from crop where status = 'approved' ORDER BY crop_id ASC";
									$query_run = pg_query($connection, $query);

									if ($query_run) {
										while ($row = pg_fetch_array($query_run)) {
									?>
											<tbody>
												<tr>
													<th scope="row"><?= $row['crop_id']; ?></th>
													<td><?= $row['crop_name']; ?></td>
													<td><?= $row['crop_scientific_name']; ?></td>
													<td><?= $row['upland_or_lowland']; ?></td>
													<td><?= $row['category']; ?></td>
													<td><?= $row['crop_description']; ?></td>
													<form id="form-panel" action="code.php" method="POST" class="curator-only">
													<td class="curator-only admin-only" style="text-align: center;">
															<input type="hidden" name="crop_id" value="<?= $row['crop_id']; ?>">
															<a href="crop.php?crop_id=<?= $row['crop_id']; ?>" class="btn btn-info btn-sm">View</a>
															<button id="delete-btn" type="submit" name="delete" class="btn btn-danger btn-sm">Delete</a>
														</td>
													</form>
												</tr>
											</tbody>
									<?php
										}
									}
									?>
								</table>
							</div>
						</div>
					</div>
				</div>

			</div>
		</section>

	</div>

	<!-- scipts -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
	<script src="../../js/admin/access.js"></script>

	<!-- font awesome -->
	<script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>

</body>

</html>