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
		<section class=" d-none d-md-block col col-4 col-lg-3 col-xl-2 p-0 m-0"></section>
		<!-- main panel -->
		<section id="nav-cards" class="p-0 m-0 col col-md-8 col-lg-9 col-xl-10">

			<!-- form for submitting -->
			<form id="form-panel" name="Form" action="code.php" autocomplete="off" onsubmit="return validateForm()" method="POST" class=" py-3 px-5">
                <!-- back button -->
                <a href="list.php" class="link-offset-2"><i class="bi bi-chevron-left"></i>Go Back</a>

				<!-- title-->
				<div class="row d-flex justify-content-between my-3">
					<div class="col-6">
						<h3 id="crops-title"><input type="text" name="crop_name" placeholder="Crop Name" class="fw-semibold w-100 border py-1 px-2"></h3>
					</div>
				</div>

				<!-- crop information -->
				<div id="" class="row form-control p-3">

					<?php include('../message.php'); ?>

					<!-- Crop Info -->
					<table id="info-table" class="table table-hover table-sm">
						<thead>
							<tr>
								<th colspan="2" class="table-dark">Crop Info</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th class="table-secondary">Upland or Lowand</th>
								<td><input type="text" name="upland_or_lowland" placeholder="Upland or Lowland" class="w-100 border"></td>
							</tr>
							<tr>
								<th class="table-secondary w-25" scope="row">Season</th>
								<td><input type="text" name="season" placeholder="Enter Season" class="w-100 border"></td>
							</tr>
							<tr>
								<th class="table-secondary w-25" scope="row">Category</th>
								<td><input type="text" name="category" placeholder="Enter Category" class="w-100 border"></td>
							</tr>
							<tr>
								<th class="table-secondary w-25" scope="row">Links</th>
								<td><input type="text" name="links" placeholder="Enter Links" class="w-100 border"></td>
							</tr>
							<tr>
								<th class="table-secondary w-25" scope="row">Description</th>
								<td><input type="text" name="description" placeholder="Enter Description" class="w-100 border"></td>
							</tr>
							<tr>
								<th class="table-secondary w-25" scope="row">Image</th>
								<td><input type="text" name="image" placeholder="Enter Image" class="w-100 border"></td>
							</tr>
							<tr>
								<th class="table-secondary w-25" scope="row">Local Name</th>
								<td><input type="text" name="local_name" placeholder="Enter Local Name" class="w-100 border"></td>
							</tr>
						</tbody>
					</table>

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
								<td><input type="text" name="scientific_name" placeholder="Enter Scientific Name" class="w-100 border"></td>
							</tr>
							<tr>
								<th class="table-secondary">Common Names</th>
								<td><input type="text" name="common_names" placeholder="Enter Common Names" class="w-100 border"></td>
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
								<th class="table-secondary w-25">Taste</th>
								<td><input type="text" name="taste" placeholder="Enter Taste" class="w-100 border"></td>
							</tr>
							<tr>
								<th class="table-secondary">Aroma</th>
								<td><input type="text" name="aroma" placeholder="Enter Aroma" class="w-100 border"></td>
							</tr>
							<tr>
								<th class="table-secondary">Maturity Period</th>
								<td><input type="text" name="maturation" placeholder="Enter Maturation days" class="w-100 border"></td>
							</tr>
							<tr>
								<th class="table-secondary">Disease Resistance</th>
								<td><input type="text" name="disease_resistance" placeholder="Disease Resistance" class="w-100 border"></td>
							</tr>
							<tr>
								<th class="table-secondary">Pest Resistance</th>
								<td><input type="text" name="pest_resistance" placeholder="Pest Resistance" class="w-100 border"></td>
							</tr>
							<tr>
								<th class="table-secondary">Drought Tolerance</th>
								<td><input type="text" name="drought_tolerance" placeholder="Drought Tolerance" class="w-100 border"></td>
							</tr>
							<tr>
								<th class="table-secondary">Adaptability to Different Environments</th>
								<td><input type="text" name="environment_adaptability" placeholder="Environmental Adaptability" class="w-100 border"></td>
							</tr>
							<tr>
								<th class="table-secondary">Cooking and Eating Quality</th>
								<td><input type="text" name="culinary_quality" placeholder="Culinary Quality" class="w-100 border"></td>
							</tr>
							<tr>
								<th class="table-secondary">Nutritional Value</th>
								<td><input type="text" name="nutritional_value" placeholder="Enter Nutritional Value" class="w-100 border"></td>
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
								<td><textarea name="planting_techniques" class="w-100 border" rows="10" placeholder="Slash-and-burn agriculture: This method involves clearing a piece of land by slashing and burning the vegetation. The ashes from the fire are then used to fertilize the soil"></textarea></td>
							</tr>
						</tbody>
					</table>

					<!-- Cultural and Spiritual Significance-->
					<table class="table table-hover table-sm">
						<thead>
							<tr>
								<th colspan="2" class="table-dark">Cultural and Spiritual Significance</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th class="table-secondary w-25">Description</th>
								<td><textarea name="cultural_and_spiritual_significance" class="w-100 border" rows="5" placeholder="Enter Cultural and Spiritual Significance"></textarea></td>
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
								<td><input type="text" name="days_to_mature" placeholder="Enter Days to Mature" class="w-100 border"></td>
							</tr>
							<tr>
								<th class="table-secondary w-25">Yield per Plant</th>
								<td><input type="text" name="yield_potential" placeholder="Enter Yield Per Plant" class="w-100 border"></td>
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
								<td><textarea name="rice_biodiversity_uplift" class="w-100 border" rows="5" placeholder="Enter Role in Maintaning Upland Ecosystem"></textarea></td>
							</tr>
						</tbody>
					</table>

					<!-- Economic Importance-->
					<table class="table table-hover table-sm">
						<thead>
							<tr>
								<th colspan="2" class="table-dark">Economic Importance</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th class="table-secondary w-25">Description</th>
								<td><textarea name="economic_importance" class="w-100 border" rows="5" placeholder="Enter Economic Importance"></textarea></td>
							</tr>
						</tbody>
					</table>

					<!-- Traditional Knowledge and Practices-->
					<table class="table table-hover table-sm">
						<thead>
							<tr>
								<th colspan="2" class="table-dark">Traditional Knowledge and Practices</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th class="table-secondary w-25">Description</th>
								<td><textarea name="traditional_knowledge_and_practices" class="w-100 border" rows="5" placeholder="Enter Traditional Knowledge and Practices"></textarea></td>
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
							<tr>
								<th></th>
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
								<td><input type="text" name="plant_height" placeholder="12g" class="w-100 border"></td>
							</tr>
							<tr>
								<th class="table-secondary">Panicle Length</th>
								<td><input type="text" name="panicle_length" placeholder="23cm" class="w-100 border"></td>
							</tr>
							<tr>
								<th class="table-secondary">Grain Quality</th>
								<td><input type="text" name="grain_quality" placeholder="Good" class="w-100 border"></td>
							</tr>
							<tr>
								<th class="table-secondary">Grain Color</th>
								<td><input type="text" name="grain_color" placeholder="White" class="w-100 border"></td>
							</tr>
							<tr>
								<th class="table-secondary">Grain Length</th>
								<td><input type="text" name="grain_length" placeholder="6.62mm" class="w-100 border"></td>
							</tr>
							<tr>
								<th class="table-secondary">Grain Width</th>
								<td><input type="text" name="grain_width" placeholder="1.10mm" class="w-100 border"></td>
							</tr>
							<tr>
								<th class="table-secondary">Grain Shape</th>
								<td><input type="text" name="grain_shape" placeholder="Cylindrical" class="w-100 border"></td>
							</tr>
							<tr>
								<th class="table-secondary">Awn Length</th>
								<td><input type="text" name="awn_length" placeholder="37.6 mm" class="w-100 border"></td>
							</tr>
							<tr>
								<th class="table-secondary">Leaf Length</th>
								<td><input type="text" name="leaf_length" placeholder="9.9 to 48 cm" class="w-100 border"></td>
							</tr>
							<tr>
								<th class="table-secondary">Leaf Width</th>
								<td><input type="text" name="leaf_width" placeholder="1.201 ± 0.03 cm" class="w-100 border"></td>
							</tr>
							<tr>
								<th class="table-secondary">Leaf Shape</th>
								<td><input type="text" name="leaf_shape" placeholder="Long, Flat, Slender" class="w-100 border"></td>
							</tr>
							<tr>
								<th class="table-secondary">Stem Color</th>
								<td><input type="text" name="stem_color" placeholder="Green" class="w-100 border"></td>
							</tr>
							<tr>
								<th class="table-secondary">Another Color</th>
								<td><input type="text" name="another_color" placeholder="Purple, Red, Black, Brown, Yellow" class="w-100 border"></td>
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
								<td><textarea name="distinct_cultivar_groups_morph_gen" class="w-100 border" rows="5" placeholder="Enter Distinct Groups of Cultivars based on Morphological and Genetic Characteristics"></textarea></td>
							</tr>
							<tr>
								<th class="table-secondary">Relationships Among Cultivars based on Cluster Analysis and Principal Component Analysis</th>
								<td><textarea name="cultivar_relations_cluster_and_pca" class="w-100 border" rows="5" placeholder="Enter Relationships Among Cultivars based on Cluster Analysis and Principal Component Analysis"></textarea></td>
							</tr>
							<tr>
								<th class="table-secondary">Potential for Hybridization and Breeding Among Cultivars</th>
								<td><textarea name="hybridization_potential" class="w-100 border" rows="5" placeholder="Enter Potential for Hybridization and Breeding Among Cultivars"></textarea></td>
							</tr>
							<tr>
								<th class="table-secondary">Implications for Conservation and Breeding Efforts</th>
								<td><textarea name="conservation_and_breeding_implications" class="w-100 border" rows="5" placeholder="Enter Implications for Conservation and Breeding Efforts"></textarea></td>
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
								<td><textarea name="breeding_potential" class="w-100 border" rows="5" placeholder="Enter Potential BReeding"></textarea></td>
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
								<td><textarea name="threats" class="w-100 border" rows="5" placeholder="Enter Threats"></textarea></td>
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
								<td><textarea name="other_info" class="w-100 border" rows="5" placeholder="Additional Information"></textarea></td>
							</tr>
						</tbody>
					</table>
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