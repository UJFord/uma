<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
	<!-- cutom css -->
	<link rel="stylesheet" href="../../css/admin/crop.css" />
	<!-- favicon -->
	<link rel="shortcut icon" href="img/logo/Uma logo.svg" type="image/x-icon" />
	<title>Uma | AdminPage</title>
</head>

<body class="overflow-x-hidden">

	<!-- container of everything -->
	<div class="row">

		<!-- sidebar -->
		<?php
		require('../sidebar/side.php');
		?>
		<!-- space holder of side panel -->
		<section class=" d-none d-md-block col col-4 col-lg-3 col-xl-2 p-0 m-0"></section>
		<!-- main panel -->
		<section id="nav-cards" class="p-0 m-0 col col-md-8 col-lg-9 col-xl-10">

			<!-- form for submitting -->
			<form action="" class=" py-3 px-5">

				<!-- title-->
				<div class="row d-flex justify-content-between mb-3">
					<div class="col-6">
						<h3 id="crops-title" class="fw-semibold">Crop Name</h3>
					</div>
				</div>

				<!-- crop information -->
				<div id="" class="row form-control">

					<!-- table -->
					<table id="info-table" class="table table-hover table-sm">

						<!-- botanical information -->
						<thead>
							<tr>
								<th colspan="2" class="table-dark">Botanical Information</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th class="table-secondary w-25" scope="row">Scientific Name</th>
								<td><input type="text" value="Oryza sativa L" class="w-100 border-0" disabled></td>
							</tr>
							<tr>
								<th class="table-secondary">Common Names</th>
								<td><input type="text" value="Adlai" class="w-100 border-0" disabled></td>
							</tr>
						</tbody>

						<!-- characteristics of traditional rice -->
						<thead>
							<tr>
								<th colspan="2" class="table-dark">Characteristics of Traditional Rice</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th class="table-secondary">Taste</th>
								<td><input type="text" value="Nutty" class="w-100 border-0" disabled></td>
							</tr>
							<tr>
								<th class="table-secondary">Aroma</th>
								<td><input type="text" value="jasmine-scented" class="w-100 border-0" disabled></td>
							</tr>
							<tr>
								<th class="table-secondary">Maturity Period</th>
								<td><input type="text" value="130 Days" class="w-100 border-0" disabled></td>
							</tr>
							<tr>
								<th class="table-secondary">Disease Resistance</th>
								<td><input type="text" value="" class="w-100 border-0" disabled></td>
							</tr>
							<tr>
								<th class="table-secondary">Pest Resistance</th>
								<td><input type="text" value="Upland rice, rainfed rice, hill rice" class="w-100 border-0" disabled></td>
							</tr>
							<tr>
								<th class="table-secondary">Drought Resistance</th>
								<td><input type="text" value="Upland rice, rainfed rice, hill rice" class="w-100 border-0" disabled></td>
							</tr>
							<tr>
								<th class="table-secondary">Adaptability to Different Environments</th>
								<td><input type="text" value="Upland rice, rainfed rice, hill rice" class="w-100 border-0" disabled></td>
							</tr>
							<tr>
								<th class="table-secondary">Cooking and Eating Quality</th>
								<td><input type="text" value="Upland rice, rainfed rice, hill rice" class="w-100 border-0" disabled></td>
							</tr>
							<tr>
								<th class="table-secondary">Nutritional Value</th>
								<td><input type="text" value="Upland rice, rainfed rice, hill rice" class="w-100 border-0" disabled></td>
							</tr>
						</tbody>

						<!-- planting techniques -->
						<thead>
							<tr>
								<th colspan="2" class="table-dark">Planting Techniques</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th class="table-secondary">Description</th>
								<td></td>
							</tr>
							<tr>
								<th></th>
								<td></td>
							</tr>
						</tbody>

						<!-- Cultural and Spiritual -->
						<thead>
							<tr>
								<th colspan="2" class="table-dark">Cultural and Spiritual</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th class="table-secondary">Description</th>
								<td></td>
							</tr>
							<tr>
								<th></th>
								<td></td>
							</tr>
						</tbody>

						<!-- Agronomic Characteristic -->
						<thead>
							<tr>
								<th colspan="2" class="table-dark">Agronomic Characteristic</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th class="table-secondary">Days to Maturity</th>
								<td></td>
							</tr>
							<tr>
								<th class="table-secondary">Yield per Plant</th>
								<td></td>
							</tr>
						</tbody>

						<!-- Role in maintaining upland ecosystems And biodiversity  -->
						<thead>
							<tr>
								<th colspan="2" class="table-dark">Role in Maintaining Upland Ecosystems</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th class="table-secondary">Description</th>
								<td></td>
							</tr>
							<tr>
								<th></th>
								<td></td>
							</tr>
						</tbody>

						<!-- Genetic Diversity  -->
						<thead>
							<tr>
								<th colspan="2" class="table-dark">Genetic Diversity</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th class="table-secondary">Description</th>
								<td></td>
							</tr>
							<tr>
								<th></th>
								<td></td>
							</tr>
						</tbody>

						<!-- Location  -->
						<thead>
							<tr>
								<th colspan="2" class="table-dark">Location</th>
							</tr>
						</thead>
						<tbody>
						<tr>
								<th class="table-secondary">Map</th>
								<td></td>
							</tr>
							<tr>
								<th></th>
								<td></td>
							</tr>
						</tbody>

						<!-- morphological characteristics  -->
						<thead>
							<tr>
								<th colspan="2" class="table-dark">Morphological Characteristics</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th class="table-secondary">Plant Height</th>
								<td></td>
							</tr>
							<tr>
								<th class="table-secondary">Panicle Length</th>
								<td></td>
							</tr>
							<tr>
								<th class="table-secondary">Grain Quality</th>
								<td></td>
							</tr>
							<tr>
								<th class="table-secondary">Grain Color</th>
								<td></td>
							</tr>
							<tr>
								<th class="table-secondary">Grain Length</th>
								<td></td>
							</tr>
							<tr>
								<th class="table-secondary">Grain Width</th>
								<td></td>
							</tr>
							<tr>
								<th class="table-secondary">Grain Shape</th>
								<td></td>
							</tr>
							<tr>
								<th class="table-secondary">Awn Length</th>
								<td></td>
							</tr>
							<tr>
								<th class="table-secondary">Leaf Length</th>
								<td></td>
							</tr>
							<tr>
								<th class="table-secondary">Leaf Width</th>
								<td></td>
							</tr>
							<tr>
								<th class="table-secondary">Leaf Shape</th>
								<td></td>
							</tr>
							<tr>
								<th class="table-secondary">Stem Color</th>
								<td></td>
							</tr>
							<tr>
								<th class="table-secondary">Another Color</th>
								<td></td>
							</tr>
						</tbody>

						<!-- relationship among cultivars  -->
						<thead>
							<tr>
								<th colspan="2" class="table-dark">Relationship Among Cultivars</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th class="table-secondary">Distinct Groups of Cultivars based on Morphological and Genetic Characteristics</th>
								<td></td>
							</tr>
							<tr>
								<th class="table-secondary">Relationships Among Cultivars based on Cluster Analysis and Principal Component Analysis</th>
								<td></td>
							</tr>
							<tr>
								<th class="table-secondary">Potential for Hybridization and Breeding Among Cultivars</th>
								<td></td>
							</tr>
							<tr>
								<th class="table-secondary">Implications for Conservation and Breeding Efforts</th>
								<td></td>
							</tr>
						</tbody>

					</table>

				</div>
			</form>
		</section>

	</div>

	<!-- scipts -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
	<!-- font awesome -->
	<script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>
</body>

</html>