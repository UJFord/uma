<?php

session_start();

$con = pg_connect("host=localhost dbname=farm_crops user=postgres password=123") or die("Could not connect to server\n");

if (isset($_POST['save'])) {
    // Escape user inputs for data in agronomic_information table
    $days_to_mature = empty($_POST['days_to_mature']) ? 'NULL' : "'" . $_POST['days_to_mature'] . "'";
    $yield_potential = empty($_POST['yield_potential']) ? 'NULL' : "'" . $_POST['yield_potential'] . "'";

    // Inserting into agronomic_information table
    $query = "INSERT INTO agronomic_information (days_to_mature, yield_potential) 
    VALUES ($days_to_mature, $yield_potential) RETURNING agronomic_information_id";

    $query_run = pg_query($con, $query);

    if ($query_run) {
        $row = pg_fetch_row($query_run);
        $agronomic_information_id = $row[0];
    } else {
        echo pg_last_error($con);
        header("Location: crop-create.php");
        exit(0);
    }

    // Escape user inputs for data in Botanical Information table
    $scientific_name = empty($_POST['scientific_name']) ? 'NULL' : "'" . $_POST['scientific_name'] . "'";
    $common_names = empty($_POST['common_names']) ? 'NULL' : "'" . $_POST['common_names'] . "'";

    // Inserting into Botanical Information table
    $query = "INSERT INTO botanical_information (scientific_name, common_names) 
    VALUES ($scientific_name, $common_names) RETURNING botanical_information_id";

    $query_run_botanical = pg_query($con, $query);

    if ($query_run_botanical) {
        $row = pg_fetch_row($query_run_botanical);
        $botanical_information_id = $row[0];
    } else {
        $_SESSION['message'] = "Botanical Information Not Created";
        $_SESSION['message_type'] = 'error';
        $_SESSION['error_details'] = pg_last_error($con);
        header("Location: crop-create.php");
        exit(0);
    }

    // Escape user inputs for data in Farming table
    $plant_height = empty($_POST['plant_height']) ? 'NULL' : "'" . $_POST['plant_height'] . "'";
    $panicle_length = empty($_POST['panicle_length']) ? 'NULL' : "'" . $_POST['panicle_length'] . "'";
    $grain_quality = empty($_POST['grain_quality']) ? 'NULL' : "'" . $_POST['grain_quality'] . "'";
    $grain_color = empty($_POST['grain_color']) ? 'NULL' : "'" . $_POST['grain_color'] . "'";
    $grain_length = empty($_POST['grain_length']) ? 'NULL' : "'" . $_POST['grain_length'] . "'";
    $grain_width = empty($_POST['grain_width']) ? 'NULL' : "'" . $_POST['grain_width'] . "'";
    $grain_shape = empty($_POST['grain_shape']) ? 'NULL' : "'" . $_POST['grain_shape'] . "'";
    $awn_length = empty($_POST['awn_length']) ? 'NULL' : "'" . $_POST['awn_length'] . "'";
    $leaf_length = empty($_POST['leaf_length']) ? 'NULL' : "'" . $_POST['leaf_length'] . "'";
    $leaf_width = empty($_POST['leaf_width']) ? 'NULL' : "'" . $_POST['leaf_width'] . "'";
    $leaf_shape = empty($_POST['leaf_shape']) ? 'NULL' : "'" . $_POST['leaf_shape'] . "'";
    $stem_color = empty($_POST['stem_color']) ? 'NULL' : "'" . $_POST['stem_color'] . "'";
    $another_color = empty($_POST['another_color']) ? 'NULL' : "'" . $_POST['another_color'] . "'";


    // Inserting into Morphological Characteristic table
    $query = "INSERT INTO morphological_characteristic (plant_height, panicle_length, grain_quality, grain_color, grain_length,
    grain_width, grain_shape, awn_length, leaf_length, leaf_width, leaf_shape, stem_color, another_color) 
    VALUES ($plant_height, $panicle_length, $grain_quality, $grain_color, $grain_length, $grain_width, $grain_shape, $awn_length,
    $leaf_length, $leaf_width, $leaf_shape, $stem_color, $another_color) RETURNING morphological_characteristic_id";

    $query_run_morphological = pg_query($con, $query);

    if ($query_run_morphological) {
        $row = pg_fetch_row($query_run_morphological);
        $morphological_characteristic_id = $row[0];
    } else {
        $_SESSION['message'] = "Morphological Characteristic Not Created";
        $_SESSION['message_type'] = 'error';
        $_SESSION['error_details'] = pg_last_error($con);
        header("Location: crop-create.php");
        exit(0);
    }

    // Escape user inputs for data in Traditional Crop Traits table
    $taste = empty($_POST['taste']) ? 'NULL' : "'" . $_POST['taste'] . "'";
    $aroma = empty($_POST['aroma']) ? 'NULL' : "'" . $_POST['aroma'] . "'";
    $maturation = empty($_POST['maturation']) ? 'NULL' : "'" . $_POST['maturation'] . "'";
    $drought_tolerance = empty($_POST['drought_tolerance']) ? 'NULL' : "'" . $_POST['drought_tolerance'] . "'";
    $environment_adaptability = empty($_POST['environment_adaptability']) ? 'NULL' : "'" . $_POST['environment_adaptability'] . "'";
    $culinary_quality = empty($_POST['culinary_quality']) ? 'NULL' : "'" . $_POST['culinary_quality'] . "'";
    $nutritional_value = empty($_POST['nutritional_value']) ? 'NULL' : "'" . $_POST['nutritional_value'] . "'";
    $disease_resistance = empty($_POST['disease_resistance']) ? 'NULL' : "'" . $_POST['disease_resistance'] . "'";
    $pest_resistance = empty($_POST['pest_resistance']) ? 'NULL' : "'" . $_POST['pest_resistance'] . "'";

    // Inserting into Traditional Crop Traits table
    $query = "INSERT INTO traditional_crop_traits (taste, aroma, maturation, drought_tolerance, environment_adaptability,
    culinary_quality, nutritional_value, disease_resistance, pest_resistance) 
    VALUES ($taste, $aroma, $maturation, $drought_tolerance, $environment_adaptability, $culinary_quality, $nutritional_value,
    $disease_resistance, $pest_resistance) RETURNING traditional_crop_traits_id";

    $query_run_traits = pg_query($con, $query);

    if ($query_run_traits) {
        $row = pg_fetch_row($query_run_traits);
        $traditional_crop_traits_id = $row[0];
    } else {
        $_SESSION['message'] = "Traditional Crop Traits Not Created";
        $_SESSION['message_type'] = 'error';
        $_SESSION['error_details'] = pg_last_error($con);
        header("Location: crop-create.php");
        exit(0);
    }

    // Escape user inputs for data in Relaationship aamong Cultivars table
    $distinct_cultivar_groups_morph_gen = empty($_POST['distinct_cultivar_groups_morph_gen']) ? 'NULL' : "'" . $_POST['distinct_cultivar_groups_morph_gen'] . "'";
    $cultivar_relations_cluster_and_pca = empty($_POST['cultivar_relations_cluster_and_pca']) ? 'NULL' : "'" . $_POST['cultivar_relations_cluster_and_pca'] . "'";
    $hybridization_potential = empty($_POST['hybridization_potential']) ? 'NULL' : "'" . $_POST['hybridization_potential'] . "'";
    $conservation_and_breeding_implications = empty($_POST['conservation_and_breeding_implications']) ? 'NULL' : "'" . $_POST['conservation_and_breeding_implications'] . "'";

    // Inserting into Relationship among Cultivars table
    $query = "INSERT INTO relationship_among_cultivars (distinct_cultivar_groups_morph_gen, cultivar_relations_cluster_and_pca,
    hybridization_potential, conservation_and_breeding_implications) 
    VALUES ($distinct_cultivar_groups_morph_gen, $cultivar_relations_cluster_and_pca, $hybridization_potential,
    $conservation_and_breeding_implications) RETURNING relationship_among_cultivars_id";

    $query_run_cultivars = pg_query($con, $query);

    if ($query_run_cultivars) {
        $row = pg_fetch_row($query_run_cultivars);
        $relationship_among_cultivars_id = $row[0];
    } else {
        $_SESSION['message'] = "Relationship among Cultivars Not Created";
        $_SESSION['message_type'] = 'error';
        $_SESSION['error_details'] = pg_last_error($con);
        header("Location: crop-create.php");
        exit(0);
    }

    // Escape user inputs for data in crops table
    $image = empty($_POST['image']) ? 'NULL' : "'" . $_POST['image'] . "'";
    $crop_name = empty($_POST['crop_name']) ? 'NULL' : "'" . $_POST['crop_name'] . "'";
    $description = empty($_POST['description']) ? 'NULL' : "'" . $_POST['description'] . "'";
    $upland_or_lowland = empty($_POST['upland_or_lowland']) ? 'NULL' : "'" . $_POST['upland_or_lowland'] . "'";
    $season = empty($_POST['season']) ? 'NULL' : "'" . $_POST['season'] . "'";
    $economic_importance = empty($_POST['economic_importance']) ? 'NULL' : "'" . $_POST['economic_importance'] . "'";
    $category = empty($_POST['category']) ? 'NULL' : "'" . $_POST['category'] . "'";
    $links = empty($_POST['links']) ? 'NULL' : "'" . $_POST['links'] . "'";
    $local_name = empty($_POST['local_name']) ? 'NULL' : "'" . $_POST['local_name'] . "'";
    $planting_techniques = empty($_POST['planting_techniques']) ? 'NULL' : "'" . $_POST['planting_techniques'] . "'";
    $cultural_and_spiritual_significance = empty($_POST['cultural_and_spiritual_significance']) ? 'NULL' : "'" . $_POST['cultural_and_spiritual_significance'] . "'";
    $breeding_potential = empty($_POST['breeding_potential']) ? 'NULL' : "'" . $_POST['breeding_potential'] . "'";
    $threats = empty($_POST['threats']) ? 'NULL' : "'" . $_POST['threats'] . "'";
    $other_info = empty($_POST['other_info']) ? 'NULL' : "'" . $_POST['other_info'] . "'";
    $rice_biodiversity_uplift = empty($_POST['rice_biodiversity_uplift']) ? 'NULL' : "'" . $_POST['rice_biodiversity_uplift'] . "'";
    $traditional_knowledge_and_practices = empty($_POST['traditional_knowledge_and_practices']) ? 'NULL' : "'" . $_POST['traditional_knowledge_and_practices'] . "'";

    // Inserting into Crop table
    $query = "INSERT INTO crops (
    agronomic_information_id, botanical_information_id,
    morphological_characteristic_id, traditional_crop_traits_id, relationship_among_cultivars_id,
    \"image\", crop_name, \"description\", upland_or_lowland, season,
    economic_importance, category, links, local_name, planting_techniques,
    cultural_and_spiritual_significance, breeding_potential, threats,
    other_info, rice_biodiversity_uplift, traditional_knowledge_and_practices
    ) VALUES (
        $agronomic_information_id, $botanical_information_id, $morphological_characteristic_id, $traditional_crop_traits_id,
        $relationship_among_cultivars_id, $image, $crop_name, $description, $upland_or_lowland,
        $season, $economic_importance, $local_name, $cultural_and_spiritual_significance, $breeding_potential,
        $threats, $other_info, $rice_biodiversity_uplift, $traditional_knowledge_and_practices,
        $category, $links, $planting_techniques
    ) RETURNING crop_id";

    $query_run_crop = pg_query($con, $query);

    if ($query_run_crop) {
        // echo "Query: $query";
        $row = pg_fetch_row($query_run_crop);
        $crop_id = $row[0];
        $_SESSION['message'] = "Crop Created Successfully";
        header("Location: list.php");
        exit(0);
    } else {
        echo "Error: " . pg_last_error($con);
        exit(0);
    }
}

if (isset($_POST['update'])) {
    // Assuming you have a variable $_POST['crop_id'] containing the ID of the crop to update
    // crops table
    $crop_id = pg_escape_string($con, $_POST['crop_id']);
    $agronomic_information_id = pg_escape_string($con, $_POST['agronomic_information_id']);
    $botanical_information_id = pg_escape_string($con, $_POST['botanical_information_id']);
    $morphological_characteristic_id = pg_escape_string($con, $_POST['morphological_characteristic_id']);
    $traditional_crop_traits_id = pg_escape_string($con, $_POST['traditional_crop_traits_id']);
    $relationship_among_cultivars_id = pg_escape_string($con, $_POST['relationship_among_cultivars_id']);
    $image = pg_escape_string($con, $_POST['image']);
    $crop_name = pg_escape_string($con, $_POST['crop_name']);
    $description = pg_escape_string($con, $_POST['description']);
    $upland_or_lowland = pg_escape_string($con, $_POST['upland_or_lowland']);
    $season = pg_escape_string($con, $_POST['season']);
    $economic_importance = pg_escape_string($con, $_POST['economic_importance']);
    $local_name = pg_escape_string($con, $_POST['local_name']);
    $cultural_and_spiritual_significance = pg_escape_string($con, $_POST['cultural_and_spiritual_significance']);
    $breeding_potential = pg_escape_string($con, $_POST['breeding_potential']);
    $threats = pg_escape_string($con, $_POST['threats']);
    $other_info = pg_escape_string($con, $_POST['other_info']);
    $rice_biodiversity_uplift = pg_escape_string($con, $_POST['rice_biodiversity_uplift']);
    $traditional_knowledge_and_practices = pg_escape_string($con, $_POST['traditional_knowledge_and_practices']);
    $category = pg_escape_string($con, $_POST['category']);
    $links = pg_escape_string($con, $_POST['links']);
    $planting_techniques = pg_escape_string($con, $_POST['planting_techniques']);

    // Agronomic Info Table
    $days_to_mature = pg_escape_string($con, $_POST['days_to_mature']);
    $yield_potential = pg_escape_string($con, $_POST['yield_potential']);

    // Botanical Info Table
    $scientific_name = pg_escape_string($con, $_POST['scientific_name']);
    $common_names = pg_escape_string($con, $_POST['common_names']);

    // Morphological Table
    $plant_height = pg_escape_string($con, $_POST['plant_height']);
    $panicle_length = pg_escape_string($con, $_POST['panicle_length']);
    $grain_quality = pg_escape_string($con, $_POST['grain_quality']);
    $grain_color = pg_escape_string($con, $_POST['grain_color']);
    $grain_length = pg_escape_string($con, $_POST['grain_length']);
    $grain_width = pg_escape_string($con, $_POST['grain_width']);
    $grain_shape = pg_escape_string($con, $_POST['grain_shape']);
    $awn_length = pg_escape_string($con, $_POST['awn_length']);
    $leaf_length = pg_escape_string($con, $_POST['leaf_length']);
    $leaf_width = pg_escape_string($con, $_POST['leaf_width']);
    $leaf_shape = pg_escape_string($con, $_POST['leaf_shape']);
    $stem_color = pg_escape_string($con, $_POST['stem_color']);
    $another_color = pg_escape_string($con, $_POST['another_color']);

    //Traditional Traits Table
    $taste = pg_escape_string($con, $_POST['taste']);
    $aroma = pg_escape_string($con, $_POST['aroma']);
    $maturation = pg_escape_string($con, $_POST['maturation']);
    $drought_tolerance = pg_escape_string($con, $_POST['drought_tolerance']);
    $environment_adaptability = pg_escape_string($con, $_POST['environment_adaptability']);
    $culinary_quality = pg_escape_string($con, $_POST['culinary_quality']);
    $nutritional_value = pg_escape_string($con, $_POST['nutritional_value']);
    $disease_resistance = pg_escape_string($con, $_POST['disease_resistance']);
    $pest_resistance = pg_escape_string($con, $_POST['pest_resistance']);

    // Relationship Among Cultivars Table
    $distinct_cultivar_groups_morph_gen = pg_escape_string($con, $_POST['distinct_cultivar_groups_morph_gen']);
    $cultivar_relations_cluster_and_pca = pg_escape_string($con, $_POST['cultivar_relations_cluster_and_pca']);
    $hybridization_potential = pg_escape_string($con, $_POST['hybridization_potential']);
    $conservation_and_breeding_implications = pg_escape_string($con, $_POST['conservation_and_breeding_implications']);

    // Function to handle values, including NULL
    function handleValue($value)
    {
        global $con;

        if ($value === '' || $value === null) {
            return 'NULL';
        } else {
            // Wrap in single quotes for non-empty values
            return "'" . pg_escape_string($con, $value) . "'";
        }
    }

    // Apply the function to each field
    // crops table
    $image = handleValue($_POST['image']);
    $crop_name = handleValue($_POST['crop_name']);
    $description = handleValue($_POST['description']);
    $upland_or_lowland = handleValue($_POST['upland_or_lowland']);
    $season = handleValue($_POST['season']);
    $economic_importance = handleValue($_POST['economic_importance']);
    $local_name = handleValue($_POST['local_name']);
    $cultural_and_spiritual_significance = handleValue($_POST['cultural_and_spiritual_significance']);
    $breeding_potential = handleValue($_POST['breeding_potential']);
    $threats = handleValue($_POST['threats']);
    $other_info = handleValue($_POST['other_info']);
    $rice_biodiversity_uplift = handleValue($_POST['rice_biodiversity_uplift']);
    $traditional_knowledge_and_practices = handleValue($_POST['traditional_knowledge_and_practices']);
    $category = handleValue($_POST['category']);
    $links = handleValue($_POST['links']);
    $planting_techniques = handleValue($_POST['planting_techniques']);

    // Agronomic Info Table
    $days_to_mature = handleValue($_POST['days_to_mature']);
    $yield_potential = handleValue($_POST['yield_potential']);

    // Botanical Info Table
    $scientific_name = handleValue($_POST['scientific_name']);
    $common_names = handleValue($_POST['common_names']);

    // Morphological Table
    $plant_height = handleValue($_POST['plant_height']);
    $panicle_length = handleValue($_POST['panicle_length']);
    $grain_quality = handleValue($_POST['grain_quality']);
    $grain_color = handleValue($_POST['grain_color']);
    $grain_length = handleValue($_POST['grain_length']);
    $grain_width = handleValue($_POST['grain_width']);
    $grain_shape = handleValue($_POST['grain_shape']);
    $awn_length = handleValue($_POST['awn_length']);
    $leaf_length = handleValue($_POST['leaf_length']);
    $leaf_width = handleValue($_POST['leaf_width']);
    $leaf_shape = handleValue($_POST['leaf_shape']);
    $stem_color = handleValue($_POST['stem_color']);
    $another_color = handleValue($_POST['another_color']);

    // Traditional Traits Table
    $taste = handleValue($_POST['taste']);
    $aroma = handleValue($_POST['aroma']);
    $maturation = handleValue($_POST['maturation']);
    $drought_tolerance = handleValue($_POST['drought_tolerance']);
    $environment_adaptability = handleValue($_POST['environment_adaptability']);
    $culinary_quality = handleValue($_POST['culinary_quality']);
    $nutritional_value = handleValue($_POST['nutritional_value']);
    $disease_resistance = handleValue($_POST['disease_resistance']);
    $pest_resistance = handleValue($_POST['pest_resistance']);

    // Relationship Among Cultivars Table
    $distinct_cultivar_groups_morph_gen = handleValue($_POST['distinct_cultivar_groups_morph_gen']);
    $cultivar_relations_cluster_and_pca = handleValue($_POST['cultivar_relations_cluster_and_pca']);
    $hybridization_potential = handleValue($_POST['hybridization_potential']);
    $conservation_and_breeding_implications = handleValue($_POST['conservation_and_breeding_implications']);

    // Update agronomic_information table
    $query = "UPDATE agronomic_information 
    SET days_to_mature = $days_to_mature, yield_potential = $yield_potential WHERE agronomic_information_id = $agronomic_information_id";
    $query_run_agro = pg_query($con, $query);
    if (!$query_run_agro) {
        echo "Error updating agronomic information: " . pg_last_error($con);
        exit(0);
    }

    // Update botanical_information table
    $query = "UPDATE botanical_information SET scientific_name = $scientific_name, common_names = $common_names WHERE botanical_information_id = $botanical_information_id";
    $query_run_botanical = pg_query($con, $query);
    if (!$query_run_botanical) {
        echo "Error updating botanical information: " . pg_last_error($con);
        exit(0);
    }

    // Update morphological_characteristic table
    $query = "UPDATE morphological_characteristic SET plant_height = $plant_height, panicle_length = $panicle_length, grain_quality = $grain_quality, grain_color = $grain_color,
    grain_length = $grain_length, grain_width = $grain_width, grain_shape = $grain_shape, awn_length = $awn_length, leaf_length = $leaf_length, leaf_width = $leaf_width, leaf_shape = $leaf_shape,
    stem_color = $stem_color, another_color = $another_color WHERE morphological_characteristic_id = $morphological_characteristic_id";
    $query_run_morphological = pg_query($con, $query);
    if (!$query_run_morphological) {
        echo "Error updating morphological characteristic: " . pg_last_error($con);
        exit(0);
    }

    // Update traditional_crop_traits table
    $query = "UPDATE traditional_crop_traits SET taste = $taste, aroma = $aroma, maturation = $maturation, drought_tolerance = $drought_tolerance,
        environment_adaptability = $environment_adaptability, culinary_quality = $culinary_quality, nutritional_value = $nutritional_value,
        disease_resistance = $disease_resistance, pest_resistance = $pest_resistance WHERE traditional_crop_traits_id = $traditional_crop_traits_id";
    $query_run_traits = pg_query($con, $query);
    if (!$query_run_traits) {
        echo "Error updating traditional crop traits: " . pg_last_error($con);
        exit(0);
    }


    // Update relationship_among_cultivars table
    $query = "UPDATE relationship_among_cultivars SET distinct_cultivar_groups_morph_gen = $distinct_cultivar_groups_morph_gen, cultivar_relations_cluster_and_pca = $cultivar_relations_cluster_and_pca,
    hybridization_potential = $hybridization_potential, conservation_and_breeding_implications = $conservation_and_breeding_implications WHERE relationship_among_cultivars_id = $relationship_among_cultivars_id";
    $query_run_cultivars = pg_query($con, $query);
    if (!$query_run_cultivars) {
        echo "Error updating relationship among cultivars: " . pg_last_error($con);
        exit(0);
    }


    // Update Crop table
    $query = "UPDATE crops SET
    image = $image, crop_name = $crop_name, description = $description, upland_or_lowland = $upland_or_lowland, season = $season,
    economic_importance = $economic_importance, category = $category, links = $links, local_name = $local_name, planting_techniques = $planting_techniques,
    cultural_and_spiritual_significance = $cultural_and_spiritual_significance, breeding_potential = $breeding_potential, threats = $threats,
    other_info = $other_info, rice_biodiversity_uplift = $rice_biodiversity_uplift, traditional_knowledge_and_practices = $traditional_knowledge_and_practices
    WHERE crop_id = $crop_id";

    $query_run_crop = pg_query($con, $query);

    if ($query_run_crop) {
        // echo "Query: $query";
        $_SESSION['message'] = "Crop Updated Successfully";
        header("Location: crop.php?crop_id=" . $_POST['crop_id']); // Assuming your update page is named 'update.php'
        exit(0);
    } else {
        echo "Error: " . pg_last_error($con);
        exit(0);
    }
}

if (isset($_POST['delete'])) {
    $crop_id = $_POST['crop_id'];
    $result = pg_query($con, "select * from crops where crop_id='$crop_id'");
    $count = pg_num_rows($result);

    if ($count > 0) {
        while ($row = pg_fetch_assoc($result)) {
            $agronomic_information_id = $row['agronomic_information_id'];
            $botanical_information_id = $row['botanical_information_id'];
            $relationship_among_cultivars_id = $row['relationship_among_cultivars_id'];
            $morphological_characteristic_id = $row['morphological_characteristic_id'];
            $traditional_crop_traits_id = $row['traditional_crop_traits_id'];
        }
    }
    // Delete from Crop table
    $query_delete_crop = "DELETE FROM crops WHERE crop_id = $1";
    $query_run_delete_crop = pg_query_params($con, $query_delete_crop, [$crop_id]);

    if ($query_run_delete_crop) {
        // Delete from Traditional Crop Traits table
        $query_delete_traits = "DELETE FROM traditional_crop_traits WHERE traditional_crop_traits_id = $1";
        $query_run_delete_traits = pg_query_params($con, $query_delete_traits, [$traditional_crop_traits_id]);

        // Delete from Morphological Characteristic table
        $query_delete_morphological = "DELETE FROM morphological_characteristic WHERE morphological_characteristic_id = $1";
        $query_run_delete_morphological = pg_query_params($con, $query_delete_morphological, [$morphological_characteristic_id]);

        // Delete from Botanical Information table
        $query_delete_botanical = "DELETE FROM botanical_information WHERE botanical_information_id = $1";
        $query_run_delete_botanical = pg_query_params($con, $query_delete_botanical, [$botanical_information_id]);

        // Delete from Relationship Among Cultivars table
        $query_delete_cultivars = "DELETE FROM relationship_among_cultivars WHERE relationship_among_cultivars_id = $1";
        $query_run_delete_cultivars = pg_query_params($con, $query_delete_cultivars, [$relationship_among_cultivars_id]);

        // Delete from Agronomic Information table
        $query_delete_agronomic = "DELETE FROM agronomic_information WHERE agronomic_information_id = $1";
        $query_run_delete_agronomic = pg_query_params($con, $query_delete_agronomic, [$agronomic_information_id]);

        // Check if all deletions were successful
        if (
            $query_run_delete_traits && $query_run_delete_morphological && $query_run_delete_cultivars &&
            $query_run_delete_botanical && $query_run_delete_agronomic
        ) {
            $_SESSION['message'] = "Crop and associated records deleted successfully";
            header("Location: list.php");
            exit(0);
        } else {
            echo "Error: " . pg_last_error($con);
            exit(0);
        }
    } else {
        echo "Error: " . pg_last_error($con);
        exit(0);
    }
}
