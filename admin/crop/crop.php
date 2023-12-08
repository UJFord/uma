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
								<td><input type="text" value="High" class="w-100 border-0" disabled></td>
							</tr>
							<tr>
								<th class="table-secondary">Pest Resistance</th>
								<td><input type="text" value="High" class="w-100 border-0" disabled></td>
							</tr>
							<tr>
								<th class="table-secondary">Drought Resistance</th>
								<td><input type="text" value="High" class="w-100 border-0" disabled></td>
							</tr>
							<tr>
								<th class="table-secondary">Adaptability to Different Environments</th>
								<td><input type="text" value="High" class="w-100 border-0" disabled></td>
							</tr>
							<tr>
								<th class="table-secondary">Cooking and Eating Quality</th>
								<td><input type="text" value="Good" class="w-100 border-0" disabled></td>
							</tr>
							<tr>
								<th class="table-secondary">Nutritional Value</th>
								<td><input type="text" value="High in Protein and Fiber" class="w-100 border-0" disabled></td>
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
								<td><textarea class="w-100 border-0" rows="10" disabled>Slash-and-burn agriculture: This method involves clearing a piece of land by slashing and burning the vegetation. The ashes from the fire are then used to fertilize the soil</textarea></td>
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
								<td><textarea class="w-100 border-0" disabled>Uplands rice farmers in the region traditionally plant rice only once a year, specifically at the onset of the rainy season (June). This practice is not based solely on agricultural considerations but also on their cultural beliefs and reverence for the natural world. Farmers rely on the phases of the moon and the position of specific stars to determine the optimal planting time. For instance, the B'laans believe that a bird chirping three times signals the start of the planting season, while the Tibolis rely on the appearance of three stars in the north.</textarea></td>
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
								<td><input type="text" value="120" class="w-100 border-0" disabled></td>
							</tr>
							<tr>
								<th class="table-secondary">Yield per Plant</th>
								<td><input type="text" value="20g" class="w-100 border-0" disabled></td>
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
								<td><textarea class="w-100 border-0" rows="10" disabled>Uplands rice farmers in the region traditionally plant rice only once a year, specifically at the onset of the rainy season (June). This practice is not based solely on agricultural considerations but also on their cultural beliefs and reverence for the natural world. Farmers rely on the phases of the moon and the position of specific stars to determine the optimal planting time. For instance, the B'laans believe that a bird chirping three times signals the start of the planting season, while the Tibolis rely on the appearance of three stars in the north.</textarea></td>
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
								<td><input type="text" value="12g" class="w-100 border-0" disabled></td>
							</tr>
							<tr>
								<th class="table-secondary">Panicle Length</th>
								<td><input type="text" value="23cm" class="w-100 border-0" disabled></td>
							</tr>
							<tr>
								<th class="table-secondary">Grain Quality</th>
								<td><input type="text" value="Good" class="w-100 border-0" disabled></td>
							</tr>
							<tr>
								<th class="table-secondary">Grain Color</th>
								<td><input type="text" value="White" class="w-100 border-0" disabled></td>
							</tr>
							<tr>
								<th class="table-secondary">Grain Length</th>
								<td><input type="text" value="6.62mm" class="w-100 border-0" disabled></td>
							</tr>
							<tr>
								<th class="table-secondary">Grain Width</th>
								<td><input type="text" value="1.10mm" class="w-100 border-0" disabled></td>
							</tr>
							<tr>
								<th class="table-secondary">Grain Shape</th>
								<td><input type="text" value="Cylindrical" class="w-100 border-0" disabled></td>
							</tr>
							<tr>
								<th class="table-secondary">Awn Length</th>
								<td><input type="text" value="37.6 mm" class="w-100 border-0" disabled></td>
							</tr>
							<tr>
								<th class="table-secondary">Leaf Length</th>
								<td><input type="text" value="9.9 to 48 cm" class="w-100 border-0" disabled></td>
							</tr>
							<tr>
								<th class="table-secondary">Leaf Width</th>
								<td><input type="text" value="1.201 ± 0.03 cm" class="w-100 border-0" disabled></td>
							</tr>
							<tr>
								<th class="table-secondary">Leaf Shape</th>
								<td><input type="text" value="Long, Flat, Slender" class="w-100 border-0" disabled></td>
							</tr>
							<tr>
								<th class="table-secondary">Stem Color</th>
								<td><input type="text" value="Green" class="w-100 border-0" disabled></td>
							</tr>
							<tr>
								<th class="table-secondary">Another Color</th>
								<td><input type="text" value="Purple, Red, Black, Brown, Yellow" class="w-100 border-0" disabled></td>
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

						<!-- potential for breeding -->
						<thead>
							<tr>
								<th colspan="2" class="table-dark">Potential for Breeding</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th class="table-secondary">Description</th>
								<td><textarea class="w-100 border-0" rows="10" disabled>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repudiandae, culpa ipsa quia autem similique, fugiat accusamus eaque odio totam officia dolorum facilis beatae molestias tempora. Sequi id aspernatur, odit nulla consequatur esse tempore fuga reiciendis veniam autem sunt eos neque atque itaque nobis dolore pariatur dolorem velit placeat consequuntur aliquam?</textarea></td>
							</tr>
						</tbody>

						<!-- threats from lowland-associated influences-->
						<thead>
							<tr>
								<th colspan="2" class="table-dark">Threats from Lowland-Associated Influences</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th class="table-secondary">Description</th>
								<td><textarea class="w-100 border-0" rows="10" disabled>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repudiandae, culpa ipsa quia autem similique, fugiat accusamus eaque odio totam officia dolorum facilis beatae molestias tempora. Sequi id aspernatur, odit nulla consequatur esse tempore fuga reiciendis veniam autem sunt eos neque atque itaque nobis dolore pariatur dolorem velit placeat consequuntur aliquam?</textarea></td>
							</tr>
						</tbody>

						<!-- other info-->
						<thead>
							<tr>
								<th colspan="2" class="table-dark">Other Info</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th class="table-secondary">Description</th>
								<td><textarea class="w-100 border-0" rows="10" disabled>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repudiandae, culpa ipsa quia autem similique, fugiat accusamus eaque odio totam officia dolorum facilis beatae molestias tempora. Sequi id aspernatur, odit nulla consequatur esse tempore fuga reiciendis veniam autem sunt eos neque atque itaque nobis dolore pariatur dolorem velit placeat consequuntur aliquam?</textarea></td>
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