<!-- sidebar -->
<?php
session_start();
require('../sidebar/side.php');
// include('../login/login-check.php');
// include '../access.php';
// access('ADMIN');
?>

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

		<!-- space holder of side panel -->
		<section class=" d-none d-md-block col col-4 col-lg-3 col-xl-2 p-0 m-0"></section>
		<!-- main panel -->
		<section id="nav-cards" class="p-0 m-0 col col-md-4 col-lg-9 col-xl-10">
			<div class="py-3 px-4">
				<!-- title and filter -->
				<div class="row d-flex justify-content-between mb-3">
					<!-- title -->
					<div class="col-6">
						<h2 id="crops-title" class="fw-semibold">Farming Practices</h2>
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
					include('../message.php');
					require('../add/add.php');
					?>
					<?php
					$result = pg_query($connection, "select * from farming");
					$count = pg_num_rows($result);

					if ($count > 0) {
						while ($row = pg_fetch_assoc($result)) {
							$farming_id = $row['farming_id'];
							$farming_name = $row['farming_name'];
							$image = $row['image'];
					?>
							<!-- data from db -->
							<div class="card-container col-6 col-md-4 col-lg-2 p-2">
								<?php
								if ($image !== 'Empty') {
								?>
									<a href="farming.php?farming_id=<?php echo $farming_id; ?>" class="crop-card py-3 px-1 d-flex justify-content-center align-items-end" style="
									background-image: url('<?php echo $image; ?>');
								">
										<div class="crop-card-text row w-100 d-flex flex-row justify-content-between align-items-center">
											<!-- Farming name -->
											<h4 class="crop-name col-6"><?php echo ucfirst($farming_name); ?></h4>
											<!-- arrow -->
											<div class="col-2 arrow-container">
												<i class="position-absolute bi bi-arrow-right-short fs-3"></i>
											</div>
										</div>
									</a>
								<?php
								} else {
								?>
								<a href="farming.php?farming_id=<?php echo $farming_id; ?>" class="crop-card py-3 px-1 d-flex justify-content-center align-items-end" style="
									background-image: url('https://t3.ftcdn.net/jpg/02/48/42/64/360_F_248426448_NVKLywWqArG2ADUxDq6QprtIzsF82dMF.jpg');
								">
									<div class="crop-card-text row w-100 d-flex flex-row justify-content-between align-items-center">
										<!-- Farming name -->
										<h4 class="crop-name col-6"><?php echo ucfirst($farming_name); ?></h4>
										<!-- arrow -->
										<div class="col-2 arrow-container">
											<i class="position-absolute bi bi-arrow-right-short fs-3"></i>
										</div>
									</div>
								</a>
								<?php
								}
								?>
							</div>
					<?php
						}
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

	<script>
        // script for access levels in admin
        // hide or show based on account type
        document.addEventListener("DOMContentLoaded", function() {
            // Use PHP to set the user role dynamically
            var userRole = "<?php echo $_SESSION['rank']; ?>";
            var addEntryCard = document.getElementById("add-entry-card");

            // Elements to show/hide based on user role
            var curatorElements = document.querySelectorAll(".curator-only");
            var adminElements = document.querySelectorAll(".admin-only");
            var viewerElements = document.querySelectorAll(".viewer-only");

            // Function to set visibility based on user role
            function setVisibility(elements, isVisible) {
                elements.forEach(function(element) {
                    element.style.display = isVisible ? "block" : "none";
                });
            }

            // Check user role and set visibility
            if (userRole === "curator") {
                setVisibility(curatorElements, true);
                setVisibility(adminElements, true);
                setVisibility(viewerElements, false);
                addEntryCard.hidden = false;
            } else if (userRole === "admin") {
                setVisibility(curatorElements, false);
                setVisibility(adminElements, true);
                setVisibility(viewerElements, false);
                addEntryCard.hidden = false;
            } else if (userRole === "user") {
                setVisibility(curatorElements, false);
                setVisibility(adminElements, false);
                setVisibility(viewerElements, true);
                addEntryCard.hidden = true;
            } else {
                console.error("Unexpected user role:", userRole);
            }
        });
    </script>
</body>

</html>