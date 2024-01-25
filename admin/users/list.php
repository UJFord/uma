<!DOCTYPE html>
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

	<!-- sidebar -->
	<?php
	session_start();
	require('../sidebar/side.php');
	?>
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
			<div class="py-3 px-4">
				<!-- title and filter -->
				<div class="row d-flex justify-content-between mb-3">
					<!-- title -->
					<div class="col-6">
						<h2 id="crops-title" class="fw-semibold">Users</h2>
					</div>
					<!-- search -->
					<div id="filter-search" class="col-6 col-md-5 col-lg-3">
						<div class="input-group">
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
								<h4><strong>Users Details</strong>
									<a href="create.php" class="btn btn-primary float-end">Add User</a>
								</h4>
							</div>
							<div class="card-body">
								<table id="dataTable" class="table table-bordered table-striped col-md-12">
									<thead>
										<tr>
											<th scope="col">User Id</th>
											<th scope="col">First Name</th>
											<th scope="col">Last Name</th>
											<th scope="col">Affiliation</th>
											<th scope="col">Email</th>
											<th scope="col">Account Type</th>
											<th scope="col" class="curator-only admin-only">Status</th>
										</tr>
									</thead>

									<?php
									$query = "SELECT users.*, account_type.* FROM users 
										JOIN account_type ON users.account_type_id = account_type.account_type_id ORDER BY users.user_id ASC";
									$query_run = pg_query($connection, $query);

									if ($query_run) {
										while ($row = pg_fetch_array($query_run)) {
									?>
											<tbody>
												<tr>
													<th scope="row"><?= $row['user_id']; ?></th>
													<td><?= $row['first_name']; ?></td>
													<td><?= $row['last_name']; ?></td>
													<td><?= $row['affiliation']; ?></td>
													<td><?= $row['email']; ?></td>
													<td><?= $row['type_name']; ?></td>
													<form id="form-panel" action="code.php" method="POST" class="curator-only">
														<td class="" style="text-align: center;">
															<input type="hidden" name="user_id" value="<?= $row['user_id']; ?>">
															<a href="user.php?user_id=<?= $row['user_id']; ?>" class="btn btn-info btn-sm">View</a>
															<button id="delete-btn" type="submit" name="delete" class="curator-only admin-only btn btn-danger btn-sm">Delete</a>
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
		</section>

	</div>

	<!-- scipts -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
	<!-- font awesome -->
	<script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>
	<!-- For button js -->
	<!-- <script src="../../js/admin/user-edit.js"></script> -->
</body>

</html>