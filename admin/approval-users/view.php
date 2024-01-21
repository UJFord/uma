<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
	
	<!-- add entry custom css -->
	<link rel="stylesheet" href="../../css/admin/entry.css" />
	<!-- sidebar custom css -->
	<link rel="stylesheet" href="../../css/admin/side.css"> 

	<!-- favicon -->
	<link rel="shortcut icon" href="img/logo/Uma logo.svg" type="image/x-icon" />
	<title>Users</title>

	<!-- sidebar -->
	<?php
	session_start();
	require('../sidebar/side.php');
	// include('../login/login-check.php');
	include '../access.php';
	access('CURATOR');
	?>

	<!-- script fort access level -->
	<script src="../../js/admin/access.js" defer></script>
</head>

<body class="overflow-x-hidden">

	<!-- container of everything -->
	<div class="row">

		<!-- space holder of side panel -->
		<section class=" d-none d-md-block col col-3 col-xl-2 p-0 m-0"></section>
		<!-- main panel -->
		<section class="p-0 m-0 col col-md-9 col-xl-10 min-vh-100">

			<?php
			if (isset($_GET['user_id'])) {
				$user_id = pg_escape_string($connection, $_GET['user_id']);
				$query = "SELECT users.*, account_type.* from users left join account_type on users.account_type_id = account_type.account_type_id where users.user_id = $1";
				$query_run = pg_query_params($connection, $query, array($user_id));

				$emptyValue = 'Empty';

				if (pg_num_rows($query_run) > 0) {
					$users = pg_fetch_assoc($query_run);
					// get the id for the foreign tables
					$first_name = $users['first_name'];
					$last_name = $users['last_name'];
					$gender = $users['gender'];
					$email = $users['email'];
					$password = $users['password'];
					$affiliation = $users['affiliation'];
					$registration_date = $users['registration_date'];
					$type_name = $users['type_name'];
					$username = $users['username'];
					$email_verified = $users['email_verified'];
					$current_account_type_id = $users['account_type_id'];

					// Get the data from users table
					// Define default values for each field if they are $emptyValue
					$first_name = isset($users['first_name']) ? htmlspecialchars($users['first_name'], ENT_QUOTES) : $emptyValue;
					$last_name = isset($users['last_name']) ? htmlspecialchars($users['last_name'], ENT_QUOTES) : $emptyValue;
					$gender = isset($users['gender']) ? htmlspecialchars($users['gender'], ENT_QUOTES) : $emptyValue;
					$email = isset($users['email']) ? htmlspecialchars($users['email'], ENT_QUOTES) : $emptyValue;
					$password = isset($users['password']) ? htmlspecialchars($users['password'], ENT_QUOTES) : $emptyValue;
					$affiliation = isset($users['affiliation']) ? htmlspecialchars($users['affiliation'], ENT_QUOTES) : $emptyValue;
					$registration_date = isset($users['registration_date']) ? htmlspecialchars($users['registration_date'], ENT_QUOTES) : $emptyValue;
					$type_name = isset($users['type_name']) ? htmlspecialchars($users['type_name'], ENT_QUOTES) : $emptyValue;
					$username = isset($users['username']) ? htmlspecialchars($users['username'], ENT_QUOTES) : $emptyValue;
					$email_verified = isset($users['email_verified']) ? htmlspecialchars($users['email_verified'], ENT_QUOTES) : $emptyValue;

					// Convert the string to a DateTime object
					$date = new DateTime($registration_date);
					// Format the date to display up to the minute
					$formatted_date = $date->format('Y-m-d H:i');
			?>
					<!-- form for submitting -->
					<form id="form-panel" name="Form" action="code.php" autocomplete="off" method="POST" enctype="multipart/form-data" class="h-100 py-3 px-5">
						<!-- back button -->
						<a href="list.php" class="link-offset-2"><i class="bi bi-chevron-left"></i>Go Back</a>

						<?php
						include('../message.php');
						?>

						<!-- main form -->
						<div class="form-control p-3 mt-3">
							<input type="hidden" name="user_id" value="<?= $user_id; ?>">
							<input type="hidden" name="current_account_type_id" value="<?= $current_account_type_id; ?>">

							<!-- general information -->
							<div class="row">
								<h3>General Information</h3>

								<div>
									<a href="reset.php?user_id=<?= $user_id; ?>">Reset Password</a>
								</div>

							</div>

							<div class="row">
								<div class="col-5">
									<!-- First Name -->
									<label for="first-name">First Name<span class="text-danger">*</span></label>
									<input id="first-name" type="text" name="first_name" value="<?= $first_name; ?>" class="form-control form-control-lg mb-2" disabled>

									<!-- Last Name -->
									<label for="last-name">Last Name <span class="text-danger">*</span></label>
									<input id="last-name" type="text" name="last_name" value="<?= $last_name; ?>" class="form-control form-control-lg mb-2" disabled>

                                    <!-- Gender -->
									<label for="gender">Gender <span class="text-danger">*</span></label>
									<input id="gender" type="text" name="gender" value="<?= $gender ?>" class="form-control form-control-lg mb-2" disabled>

									<!-- Email -->
									<label for="email">Email <span class="text-danger"></span></label>
									<input id="email" type="text" name="email" value="<?= $email ?>" class="form-control form-control-lg mb-2" disabled>
								</div>

								<div class="col-5">
									<!-- Registration Date -->
									<label for="registration_date">Registration Date <span class="text-danger"></span></label>
									<input id="registration_date" type="text" name="registration_date" value="<?= $formatted_date ?>" class="form-control form-control-lg mb-2 disabled-input">

									<!-- Account Type -->
									<label for="type_name">Account Type <span class="text-danger">*</span></label>
									<select id="type_name" name="account_type_id" class="w-100 border form-control-lg mb-2" rows="2" disabled>
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
									</select>

									<!-- Username -->
									<label for="username">Username <span class="text-danger"></span></label>
									<input id="username" type="text" name="username" value="<?= $username ?>" class="form-control form-control-lg mb-2" disabled>

									<!-- Affiliation -->
									<label for="affiliation">Affiliation <span class="text-danger"></span></label>
									<input id="affiliation" type="text" name="affiliation" value="<?= $affiliation ?>" class="form-control form-control-lg mb-2" disabled>

								</div>
							</div>

						</div>
						<!-- editting buttons -->
						<?php
						require('../edit-btn/edit-btn.php');
						?>
					</form>
			<?php
				}
			}
			?>
		</section>
	</div>
	<!-- scipts -->
	<!-- custom -->
	<script src="../../js/admin/user-edit.js"></script>
	<!-- bootstrap -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
	<!-- font awesome -->
	<script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>
</body>

</html>