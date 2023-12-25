<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
	<!-- cutom css -->
	<link rel="stylesheet" href="../../css/admin/entry.css" />
	<!-- favicon -->
	<link rel="shortcut icon" href="img/logo/Uma logo.svg" type="image/x-icon" />
	<title>Crop sa Editor</title>
</head>

<body class="overflow-x-hidden">

	<!-- container of everything -->
	<div class="row">

		<!-- sidebar -->
		<?php
		require('../sidebar/side.php');
		?>
		<!-- space holder of side panel -->
		<section class=" d-none d-md-block col col-3 col-xl-2 p-0 m-0"></section>
		<!-- main panel -->
		<section id="nav-cards" class="p-0 m-0 col col-md-9 col-xl-10">

			<!-- form for submitting -->
			<form id="form-panel" name="Form" action="code.php" autocomplete="off" onsubmit="return validateForm()" method="POST" enctype="multipart/form-data" class=" py-3 px-5">
				<!-- back button -->
				<a href="list.php" class="link-offset-2"><i class="bi bi-chevron-left"></i>Go Back</a>



				<!-- main form -->
				<div class="form-control p-3 mt-3">

					<!-- general information -->
					<h3>General Information</h3>
					<div class="row">
						<div class="col-4">
							<!-- crop name -->
							<label for="crop-name">Crop <span class="text-danger">*</span></label>
							<input id="crop-name" type="text" class="form-control form-control-lg mb-2" required>

						</div>
						<!-- image -->
						<div class="col-4">
							<label for="image-input" class="">Images <span class="text-danger">*</span></label>
							<input type="file" class="form-control" id="image-input" multiple required accept="image/*">
						</div>
					</div>

					<div class="row">
						<div class="col-4">
							<!-- category -->
							<label for="category">Category <span class="text-danger">*</span></label>
							<select id="category" class="form-select mb-2" required>
								<option value="rice" selected>Rice</option>
								<option value="root">Rootcrop</option>
								<option value="fly">Flying</option>
								<option value="">Rock</option>
								<option value="">Fire</option>
								<option value="">Grass</option>
								<option value="">Steel</option>
							</select>

							<!-- local name -->
							<label for="local">Local Name <span class="text-danger">*</span></label>
							<input id="local" type="text" class="form-control mb-2" required>
							<!-- upland or lowland -->

							<label for="">Type <span class="text-danger">*</span></label>
							<div class="m-2">
								<div class="form-check form-check-inline">
									<label class="form-check-label" for="inlineRadio1">Upland</label>
									<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Upland" required>
								</div>
								<div class="form-check form-check-inline">
									<label class="form-check-label" for="inlineRadio2">Lowland</label>
									<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="Lowland" required>
								</div>
							</div>


						</div>

						<div class="col">
							<!-- images chosen not yet uploaded i think i dont know -->
							<div id="image-previews" class="overflow-x-scroll h-100 border d-flex flex-row"></div>
						</div>
					</div>

					<div class="col">
						<!-- Descrition -->
						<label for="gen-desc">Description <span class="text-danger">*</span></label>
						<textarea name="" id="gen-desc" class="form-control" rows="3" required></textarea>
					</div>

					<!-- Characteristics -->
					<h3 class="mt-4">Characteristics</h5>
						<div class="row">
							<div class="col-2">
								<!-- taste -->
								<label for="taste">Taste</label>
								<input id="taste" type="text" class="form-control mb-2">
							</div>
							<div class="col-2">
								<!-- aroma -->
								<label for="aroma">Aroma</label>
								<input id="aroma" type="text" class="form-control mb-2">
							</div>
							<div class="col-2">
								<!-- maturation -->
								<label for="matur">Maturation</label>
								<input id="matur" type="text" class="form-control mb-2">
							</div>
							<div class="col">
								<!-- disease resistance -->
								<label for="resist">Disease Resistance</label>
								<input id="resist" type="text" class="form-control">
							</div>
						</div>

						<!-- More -->
						<h3 class="mt-4">More</h5>

							<!-- Planting Techniques -->
							<label class="mt-2">Planting Techniques</label>
							<div class="row">
								<div class="col">
									<!-- Descrition -->
									<textarea name="" id="tech-desc" class="form-control" rows="2"></textarea>
								</div>
							</div>

							<!-- Cultural and Spiritual Significance -->
							<label class="mt-2">Cultural and Spiritual Significance</label>
							<div class="row">
								<div class="col">
									<!-- Descrition -->
									<textarea name="" id="signif-desc" class="form-control" rows="2"></textarea>
								</div>
							</div>

							<!-- Role in Maintaining Upland Ecosystems -->
							<label class="mt-2">Role in Maintaining Upland Ecosystems</label>
							<div class="row">
								<div class="col">
									<!-- Descrition -->
									<textarea name="" id="role-desc" class="form-control" rows="2"></textarea>
								</div>
							</div>

							<!-- Cultural Importance and Traditional Knowledge -->
							<label class="mt-2">Cultural Importance and Traditional Knowledge</label>
							<div class="row">
								<div class="col">
									<!-- Descrition -->
									<textarea name="" id="impotance-desc" class="form-control" rows="2"></textarea>
								</div>
							</div>

							<!-- Unique Features -->
							<label class="mt-2">Unique Features</label>
							<div class="row">
								<div class="col">
									<!-- Descrition -->
									<textarea name="" id="feat-desc" class="form-control" rows="2"></textarea>
								</div>
							</div>

							<!-- Cultural Use -->
							<label class="mt-2">Cultural Use</label>
							<div class="row">
								<div class="col">
									<!-- Descrition -->
									<textarea name="" id="use-desc" class="form-control" rows="2"></textarea>
								</div>
							</div>

							<!-- Associated Farming Practice -->
							<label class="mt-2">Associated Farming Practice</label>
							<div class="row">
								<div class="col">
									<!-- Descrition -->
									<textarea name="" id="prac-desc" class="form-control" rows="2"></textarea>
								</div>
							</div>

							<!-- Associated Vegetation -->
							<label class="mt-2">Associated Vegetation</label>
							<div class="row">
								<div class="col">
									<!-- Descrition -->
									<textarea name="" id="veg-desc" class="form-control" rows="2"></textarea>
								</div>
							</div>

							<!-- Last Seen Location -->
							<label class="mt-2">Last Seen Location</label>
							<div class="row">
								<div class="col">
									<!-- Descrition -->
									<textarea name="" id="loc-desc" class="form-control" rows="2"></textarea>
								</div>
							</div>

							<!-- Threats to Upland Farms -->
							<label class="mt-2">Threats to Upland Farms</label>
							<div class="row">
								<div class="col">
									<!-- Descrition -->
									<textarea name="" id="threat-desc" class="form-control" rows="2"></textarea>
								</div>
							</div>

							<!-- Other Information -->
							<label class="mt-2">Other Information</label>
							<div class="row">
								<div class="col">
									<!-- Descrition -->
									<textarea name="" id="more-desc" class="form-control" rows="2"></textarea>
								</div>
							</div>
				</div>
				<!-- editting buttons -->
				<?php
				require('../edit-btn/add-btn.php');
				?>
			</form>
		</section>

	</div>

	<!-- scipts -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
	<!-- font awesome -->
	<script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>
</body>

</html>