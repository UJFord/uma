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
		<section class="p-0 m-0 col col-md-9 col-xl-10 min-vh-100">

			<!-- form for submitting -->
			<form  id="main-panel" action="" class="h-100 py-3 px-5">

				<!-- title-->
				<div class="row d-flex justify-content-between mb-3">
					<div class="col-6">
						<h3>
							<input id="title" type="text" value="Crop Name" class="fw-semibold w-100 border-0 py-1 px-2" disabled>
						</h3>
					</div>
				</div>

				<!-- crop information -->
				<div id="" class="row form-control p-3">

					<!-- botanical information -->
					<table id="info-table" class="table table-hover table-sm">
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
							<tr>
								<th class="table-secondary">Local Name</th>
								<td><input type="text" value="Adlai" class="w-100 border-0" disabled></td>
							</tr>
						</tbody>

					</table>

					<!-- characteristics of traditional rice -->
					<table class="table table-hover table-sm">
						<thead>
							<tr>
								<th colspan="2" class="table-dark">Characteristics of Traditional Rice</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th class="table-secondary w-25">Image</th>
								<td><input type="image" src="Submit" class="w-100 border-0"' disabled></td>
							</tr>
							<tr>
								<th class="table-secondary w-25">Taste</th>
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
					</table>

					<!-- planting techniques -->
					<table class="table table-hover table-sm">
						<thead>
							<tr>
								<th colspan="2" class="table-dark">Planting Techniques</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th class="table-secondary w-25">Description</th>
								<td><textarea class="w-100 border-0" rows="10" disabled>Slash-and-burn agriculture: This method involves clearing a piece of land by slashing and burning the vegetation. The ashes from the fire are then used to fertilize the soil</textarea></td>
							</tr>
						</tbody>
					</table>


					<!-- Cultural and Spiritual -->
					<table class="table table-hover table-sm">
						<thead>
							<tr>
								<th colspan="2" class="table-dark">Cultural and Spiritual</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th class="table-secondary w-25">Description</th>
								<td><textarea class="w-100 border-0" rows="5" disabled>Uplands rice farmers in the region traditionally plant rice only once a year, specifically at the onset of the rainy season (June). This practice is not based solely on agricultural considerations but also on their cultural beliefs and reverence for the natural world. Farmers rely on the phases of the moon and the position of specific stars to determine the optimal planting time. For instance, the B'laans believe that a bird chirping three times signals the start of the planting season, while the Tibolis rely on the appearance of three stars in the north.</textarea></td>
							</tr>
						</tbody>
					</table>

					<!-- Agronomic Characteristic -->

					<table class="table table-hover table-sm">
						<thead>
							<tr>
								<th colspan="2" class="table-dark">Agronomic Characteristic</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th class="table-secondary w-25">Days to Maturity</th>
								<td><input type="text" value="120" class="w-100 border-0" disabled></td>
							</tr>
							<tr>
								<th class="table-secondary w-25">Yield per Plant</th>
								<td><input type="text" value="20g" class="w-100 border-0" disabled></td>
							</tr>
						</tbody>
					</table>

					<!-- Role in maintaining upland ecosystems And biodiversity-->
					<table class="table table-hover table-sm">
						<thead>
							<tr>
								<th colspan="2" class="table-dark">Role in Maintaining Upland Ecosystems</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th class="table-secondary w-25">Description</th>
								<td><textarea class="w-100 border-0" rows="5" disabled>Uplands rice farmers in the region traditionally plant rice only once a year, specifically at the onset of the rainy season (June). This practice is not based solely on agricultural considerations but also on their cultural beliefs and reverence for the natural world. Farmers rely on the phases of the moon and the position of specific stars to determine the optimal planting time. For instance, the B'laans believe that a bird chirping three times signals the start of the planting season, while the Tibolis rely on the appearance of three stars in the north.</textarea></td>
							</tr>
						</tbody>
					</table>

					<!-- Genetic Diversity  -->
					<table class="table table-hover table-sm">
						<thead>
							<tr>
								<th colspan="2" class="table-dark">Genetic Diversity</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th class="table-secondary w-25">Description</th>
								<td></td>
							</tr>
						</tbody>
					</table>

					<!-- Location  -->
					<table class="table table-hover table-sm">
						<thead>
							<tr>
								<th colspan="2" class="table-dark">Location</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th class="table-secondary w-25">Map</th>
								<td></td>
							</tr>
						</tbody>
					</table>

					<!-- morphological characteristics  -->
					<table class="table table-hover table-sm">
						<thead>
							<tr>
								<th colspan="2" class="table-dark">Morphological Characteristics</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th class="table-secondary w-25">Plant Height</th>
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
					</table>

					<!-- relationship among cultivars  -->
					<table class="table table-hover table-sm">
						<thead>
							<tr>
								<th colspan="2" class="table-dark">Relationship Among Cultivars</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th class="table-secondary w-25">Distinct Groups of Cultivars based on Morphological and Genetic Characteristics</th>
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

					<!-- potential for breeding -->
					<table class="table table-hover table-sm">
						<thead>
							<tr>
								<th colspan="2" class="table-dark">Potential for Breeding</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th class="table-secondary w-25">Description</th>
								<td><textarea class="w-100 border-0" rows="5" disabled>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repudiandae, culpa ipsa quia autem similique, fugiat accusamus eaque odio totam officia dolorum facilis beatae molestias tempora. Sequi id aspernatur, odit nulla consequatur esse tempore fuga reiciendis veniam autem sunt eos neque atque itaque nobis dolore pariatur dolorem velit placeat consequuntur aliquam?</textarea></td>
							</tr>
						</tbody>
					</table>

					<!-- threats from lowland-associated influences-->
					<table class="table table-hover table-sm">
						<thead>
							<tr>
								<th colspan="2" class="table-dark">Threats from Lowland-Associated Influences</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th class="table-secondary w-25">Description</th>
								<td><textarea class="w-100 border-0" rows=5" disabled>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repudiandae, culpa ipsa quia autem similique, fugiat accusamus eaque odio totam officia dolorum facilis beatae molestias tempora. Sequi id aspernatur, odit nulla consequatur esse tempore fuga reiciendis veniam autem sunt eos neque atque itaque nobis dolore pariatur dolorem velit placeat consequuntur aliquam?</textarea></td>
							</tr>
						</tbody>
					</table>

					<!-- other info-->
					<table class="table table-hover table-sm  mb-0">
						<thead>
							<tr>
								<th colspan="2" class="table-dark">Other Info</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th class="table-secondary w-25">Description</th>
								<td><textarea class="w-100 border-0" rows="5" disabled>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repudiandae, culpa ipsa quia autem similique, fugiat accusamus eaque odio totam officia dolorum facilis beatae molestias tempora. Sequi id aspernatur, odit nulla consequatur esse tempore fuga reiciendis veniam autem sunt eos neque atque itaque nobis dolore pariatur dolorem velit placeat consequuntur aliquam?</textarea></td>
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