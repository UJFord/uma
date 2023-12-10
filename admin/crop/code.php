<?php

session_start();

$con = pg_connect("host=localhost dbname=farm_crops user=postgres password=123") or die("Could not connect to server\n");

if (isset($_POST['save'])) {
    // Inserting into agronomic_information table
    $query = "INSERT INTO agronomic_information (days_to_mature, yield_potential) VALUES ($1, $2) RETURNING agronomic_information_id";
    $query_run = pg_query_params($con, $query, [$_POST['days_to_mature'], $_POST['yield_potential']]);

    if ($query_run) {
        $row = pg_fetch_row($query_run);
        $agronomic_information_id = $row[0];
    } else {
        echo pg_last_error($con);
        header("Location: crop-create.php");
        exit(0);
    }

    // Inserting into Botanical Information table
    $query = "INSERT INTO botanical_information (scientific_name, common_names) VALUES ($1, $2) RETURNING botanical_information_id";
    $query_run_botanical = pg_query_params($con, $query, [$_POST['scientific_name'], $_POST['common_names']]);

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

    // Inserting into Morphological Characteristic table
    $query = "INSERT INTO morphological_characteristic (plant_height, panicle_length, grain_quality, grain_color, grain_length,
    grain_width, grain_shape, awn_length, leaf_length, leaf_width, leaf_shape, stem_color, another_color) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13) RETURNING morphological_characteristic_id";

    $query_run_morphological = pg_query_params($con, $query, [
        $_POST['plant_height'], $_POST['panicle_length'], $_POST['grain_quality'], $_POST['grain_color'],
        $_POST['grain_length'], $_POST['grain_width'], $_POST['grain_shape'], $_POST['awn_length'], $_POST['leaf_length'],
        $_POST['leaf_width'], $_POST['leaf_shape'], $_POST['stem_color'], $_POST['another_color']
    ]);

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

    // Inserting into Traditional Crop Traits table
    $query = "INSERT INTO traditional_crop_traits (taste, aroma, maturation, drought_tolerance, environment_adaptability,
        culinary_quality, nutritional_value, disease_resistance, pest_resistance) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9) RETURNING traditional_crop_traits_id";

    $query_run_traits = pg_query_params($con, $query, [
        $_POST['taste'], $_POST['aroma'], $_POST['maturation'], $_POST['drought_tolerance'],
        $_POST['environment_adaptability'], $_POST['culinary_quality'], $_POST['nutritional_value'],
        $_POST['disease_resistance'], $_POST['pest_resistance']
    ]);

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

    // Inserting into Relationship among Cultivars table
    $query = "INSERT INTO relationship_among_cultivars (distinct_cultivar_groups_morph_gen, cultivar_relations_cluster_and_pca,
    hybridization_potential, conservation_and_breeding_implications) VALUES ($1, $2, $3, $4) RETURNING relationship_among_cultivars_id";
    $query_run_cultivars = pg_query_params($con, $query, [
        $_POST['distinct_cultivar_groups_morph_gen'], $_POST['cultivar_relations_cluster_and_pca'],
        $_POST['hybridization_potential'], $_POST['conservation_and_breeding_implications']
    ]);

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

    // Inserting into Crop table
    $query = "INSERT INTO crops (
    agronomic_information_id, botanical_information_id,
    morphological_characteristic_id, traditional_crop_traits_id, relationship_among_cultivars_id,
    \"image\", crop_name, \"description\", upland_or_lowland, season,
    economic_importance, category, links, local_name, planting_techniques,
    cultural_and_spiritual_significance, breeding_potential, threats,
    other_info, rice_biodiversity_uplift, traditional_knowledge_and_practices
    ) VALUES (
        $1, $2, $3, $4,
        $5, $6, $7, $8, $9,
        $10, $11, $12, $13, $14,
        $15, $16, $17, $18,
        $19, $20, $21
    ) RETURNING crop_id";

    $query_run_crop = pg_query_params($con, $query, [
        $agronomic_information_id, $botanical_information_id,
        $morphological_characteristic_id, $traditional_crop_traits_id, $relationship_among_cultivars_id,
        $_POST['image'], $_POST['crop_name'], $_POST['description'],
        $_POST['upland_or_lowland'], $_POST['season'],
        $_POST['economic_importance'], $_POST['category'], $_POST['links'],
        $_POST['local_name'], $_POST['planting_techniques'],
        $_POST['cultural_and_spiritual_significance'],
        $_POST['breeding_potential'], $_POST['threats'],
        $_POST['other_info'], $_POST['rice_biodiversity_uplift'], $_POST['traditional_knowledge_and_practices']
    ]);

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


    // Update agronomic_information table
    $query = "UPDATE agronomic_information SET days_to_mature = $1, yield_potential = $2 WHERE agronomic_information_id = $3";
    $query_run = pg_query_params($con, $query, [$_POST['days_to_mature'], $_POST['yield_potential'], $_POST['agronomic_information_id']]);

    // Update botanical_information table
    $query = "UPDATE botanical_information SET scientific_name = $1, common_names = $2 WHERE botanical_information_id = $3";
    $query_run_botanical = pg_query_params($con, $query, [$_POST['scientific_name'], $_POST['common_names'], $_POST['botanical_information_id']]);

    // Update morphological_characteristic table
    $query = "UPDATE morphological_characteristic SET plant_height = $1, panicle_length = $2, grain_quality = $3, grain_color = $4,
    grain_length = $5, grain_width = $6, grain_shape = $7, awn_length = $8, leaf_length = $9, leaf_width = $10, leaf_shape = $11,
    stem_color = $12, another_color = $13 WHERE morphological_characteristic_id = $14";

    $query_run_morphological = pg_query_params($con, $query, [
        $_POST['plant_height'], $_POST['panicle_length'], $_POST['grain_quality'], $_POST['grain_color'],
        $_POST['grain_length'], $_POST['grain_width'], $_POST['grain_shape'], $_POST['awn_length'], $_POST['leaf_length'],
        $_POST['leaf_width'], $_POST['leaf_shape'], $_POST['stem_color'], $_POST['another_color'],
        $_POST['morphological_characteristic_id']
    ]);

    // Update traditional_crop_traits table
    $query = "UPDATE traditional_crop_traits SET taste = $1, aroma = $2, maturation = $3, drought_tolerance = $4,
        environment_adaptability = $5, culinary_quality = $6, nutritional_value = $7,
        disease_resistance = $8, pest_resistance = $9 WHERE traditional_crop_traits_id = $10";

    $query_run_traits = pg_query_params($con, $query, [
        $_POST['taste'], $_POST['aroma'], $_POST['maturation'], $_POST['drought_tolerance'],
        $_POST['environment_adaptability'], $_POST['culinary_quality'], $_POST['nutritional_value'],
        $_POST['disease_resistance'], $_POST['pest_resistance'],
        $_POST['traditional_crop_traits_id']
    ]);

    // Update relationship_among_cultivars table
    $query = "UPDATE relationship_among_cultivars SET distinct_cultivar_groups_morph_gen = $1, cultivar_relations_cluster_and_pca = $2,
    hybridization_potential = $3, conservation_and_breeding_implications = $4 WHERE relationship_among_cultivars_id = $5";
    $query_run_cultivars = pg_query_params($con, $query, [
        $_POST['distinct_cultivar_groups_morph_gen'], $_POST['cultivar_relations_cluster_and_pca'],
        $_POST['hybridization_potential'], $_POST['conservation_and_breeding_implications'], $_POST['relationship_among_cultivars_id']
    ]);

    // Update Crop table
    $query = "UPDATE crops SET
    agronomic_information_id = $1, botanical_information_id = $2,
    morphological_characteristic_id = $3, traditional_crop_traits_id = $4, relationship_among_cultivars_id = $5,
    image = $6, crop_name = $7, description = $8, upland_or_lowland = $9, season = $10,
    economic_importance = $11, category = $12, links = $13, local_name = $14, planting_techniques = $15,
    cultural_and_spiritual_significance = $16, breeding_potential = $17, threats = $18,
    other_info = $19, rice_biodiversity_uplift = $20, traditional_knowledge_and_practices = $21
    WHERE crop_id = $22";

    $query_run_crop = pg_query_params($con, $query, [
        $_POST['agronomic_information_id'], $_POST['botanical_information_id'],
        $_POST['morphological_characteristic_id'], $_POST['traditional_crop_traits_id'], $_POST['relationship_among_cultivars_id'],
        $_POST['image'], $_POST['crop_name'], $_POST['description'],
        $_POST['upland_or_lowland'], $_POST['season'],
        $_POST['economic_importance'], $_POST['category'], $_POST['links'],
        $_POST['local_name'], $_POST['planting_techniques'],
        $_POST['cultural_and_spiritual_significance'],
        $_POST['breeding_potential'], $_POST['threats'],
        $_POST['other_info'], $_POST['rice_biodiversity_uplift'], $_POST['traditional_knowledge_and_practices'],
        $_POST['crop_id']
    ]);

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