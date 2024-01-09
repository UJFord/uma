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

	<!-- sidebar -->
	<?php
	session_start();
	require('../sidebar/side.php');
	// include('../login/login-check.php');
	include '../access.php';
	access('CURATOR');
	?>
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

					<h1 class="text-center  text-white bg-dark col-md-12">Users</h1>
					<form id="form-panel" action="code.php" method="POST" class="curator-only">
						<table class="table table-bordered col-md-12">
							<thead>
								<tr>
									<th scope="col">First Name</th>
									<th scope="col">Last Name</th>
									<th scope="col">Affiliation</th>
									<th scope="col">Email</th>
									<th scope="col">Account Type</th>
									<th scope="col" id="user-edit-btn-box" class="curator-only">
										<!-- for edit button -->
										<button id="user-edit-btn" type="button" class="btn btn-primary py-3 px-4 curator-only"><i class="fa-solid fa-pen-to-square me-1"></i>Edit</button>
									</th>
								</tr>
							</thead>

							<?php
							$query = "SELECT users.*, account_type.* FROM users 
							JOIN account_type ON users.account_type_id = account_type.account_type_id ORDER BY users.user_id ASC";
							$result = pg_query($connection, $query);

							if ($result) {
								while ($row = pg_fetch_array($result)) {
									$current_account_type_id = $row['account_type_id'];

							?>
									<tbody>
										<tr>
											<th scope="row"><?php echo $row['first_name']; ?></th>
											<td><?php echo $row['last_name']; ?></td>
											<td><?php echo $row['affiliation']; ?></td>
											<td><?php echo $row['email']; ?></td>
											<td>
												<select name="account_type_id" class="w-100 border" rows="2" disabled>
													<?php
													// php code to display available schedules from the database
													// query to select all available schedules in the database
													$query2 = "SELECT * FROM account_type";

													// Executing query
													$query_run2 = pg_query($connection, $query2);

													// count rows to check whether we have a schedule or not
													$count2 = pg_num_rows($query_run2);

													// if count is greater than 0 we have a schedule else we do not have a schedule
													if ($count2 > 0) {
														// we have a schedule
														while ($row = pg_fetch_assoc($query_run2)) {
															// get the detail of the schedule
															$account_type_id = $row['account_type_id'];
															$type_name = $row['type_name'];
													?>
															<option <?php
																	if ($current_account_type_id === null) {
																		echo "selected";
																	} elseif ($current_account_type_id == $account_type_id) {
																		echo "selected";
																	}
																	?> value="<?php echo $account_type_id; ?>"><?php echo $type_name; ?>
															</option>
														<?php
														}
													} else {
														// we do not have a schedule
														?>
														<option value="0">No Farming name Found</option>
													<?php
													}
													?>
											</td>
											<td id="apply-cancel-box" class="curator-only">
												<input id="confirm-btn" type="submit" name="confirm" value="confirm" class="d-none"> &nbsp &nbsp <br>
												<input id="delete-btn" type="submit" name="delete" value="delete" class="d-none">
											</td>
										</tr>
									</tbody>
							<?php
								}
							} else {
								echo "Query failed: " . pg_last_error($connection);
							}
							?>
						</table>
					</form>

				</div>
		</section>

	</div>

	<!-- scipts -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
	<!-- font awesome -->
	<script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>
	<!-- For button js -->
	<script src="../../js/admin/user-edit.js"></script>

</body>

</html>