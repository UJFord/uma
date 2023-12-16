<?php

session_start();

$con = pg_connect("host=localhost dbname=farm_crops user=postgres password=123") or die("Could not connect to server\n");

if (isset($_POST['save'])) {
    // Function to handle empty values
    function handleEmpty($value)
    {
        return empty($value) ? 'Empty' : $value;
    }

    if (isset($_POST['save'])) {
        // Escape user inputs for data in agronomic_information table
        $days_to_mature = handleEmpty($_POST['days_to_mature']);
        $yield_potential = handleEmpty($_POST['yield_potential']);

        // Inserting into agronomic_information table using parameterized query
        $query_agronomic = "INSERT INTO agronomic_information (days_to_mature, yield_potential) 
                    VALUES ($1, $2) RETURNING agronomic_information_id";

        $query_run_agronomic = pg_query_params($con, $query_agronomic, array($days_to_mature, $yield_potential));

        if ($query_run_agronomic) {
            $row_agronomic = pg_fetch_row($query_run_agronomic);
            $agronomic_information_id = $row_agronomic[0];
        } else {
            echo "Error: " . pg_last_error($con);
            exit(0);
        }

        // Escape user inputs for data in Botanical Information table
        $scientific_name = handleEmpty($_POST['scientific_name']);
        $common_names = handleEmpty($_POST['common_names']);

        // Inserting into Botanical Information table using parameterized query
        $query_botanical = "INSERT INTO botanical_information (scientific_name, common_names) 
                    VALUES ($1, $2) RETURNING botanical_information_id";

        $query_run_botanical = pg_query_params($con, $query_botanical, array($scientific_name, $common_names));

        if ($query_run_botanical) {
            $row_botanical = pg_fetch_row($query_run_botanical);
            $botanical_information_id = $row_botanical[0];
        } else {
            echo "Error: " . pg_last_error($con);
            exit(0);
        }

        // Escape user inputs for data in Morphological Characteristic table
        $plant_height = handleEmpty($_POST['plant_height']);
        $panicle_length = handleEmpty($_POST['panicle_length']);
        $grain_quality = handleEmpty($_POST['grain_quality']);
        $grain_color = handleEmpty($_POST['grain_color']);
        $grain_length = handleEmpty($_POST['grain_length']);
        $grain_width = handleEmpty($_POST['grain_width']);
        $grain_shape = handleEmpty($_POST['grain_shape']);
        $awn_length = handleEmpty($_POST['awn_length']);
        $leaf_length = handleEmpty($_POST['leaf_length']);
        $leaf_width = handleEmpty($_POST['leaf_width']);
        $leaf_shape = handleEmpty($_POST['leaf_shape']);
        $stem_color = handleEmpty($_POST['stem_color']);
        $another_color = handleEmpty($_POST['another_color']);

        // Inserting into Morphological Characteristic table using parameterized query
        $query_morphological = "INSERT INTO morphological_characteristic (plant_height, panicle_length, grain_quality, grain_color, grain_length,
    grain_width, grain_shape, awn_length, leaf_length, leaf_width, leaf_shape, stem_color, another_color) 
    VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13) RETURNING morphological_characteristic_id";

        $query_run_morphological = pg_query_params($con, $query_morphological, array(
            $plant_height, $panicle_length, $grain_quality, $grain_color, $grain_length,
            $grain_width, $grain_shape, $awn_length, $leaf_length, $leaf_width,
            $leaf_shape, $stem_color, $another_color
        ));

        if ($query_run_morphological) {
            $row_morphological = pg_fetch_row($query_run_morphological);
            $morphological_characteristic_id = $row_morphological[0];
        } else {
            echo "Error: " . pg_last_error($con);
            exit(0);
        }

        // Escape user inputs for data in Traditional Crop Traits table
        $taste = handleEmpty($_POST['taste']);
        $aroma = handleEmpty($_POST['aroma']);
        $maturation = handleEmpty($_POST['maturation']);
        $drought_tolerance = handleEmpty($_POST['drought_tolerance']);
        $environment_adaptability = handleEmpty($_POST['environment_adaptability']);
        $culinary_quality = handleEmpty($_POST['culinary_quality']);
        $nutritional_value = handleEmpty($_POST['nutritional_value']);
        $disease_resistance = handleEmpty($_POST['disease_resistance']);
        $pest_resistance = handleEmpty($_POST['pest_resistance']);

        // Inserting into Traditional Crop Traits table using parameterized query
        $query_traits = "INSERT INTO traditional_crop_traits (taste, aroma, maturation, drought_tolerance, environment_adaptability,
        culinary_quality, nutritional_value, disease_resistance, pest_resistance) 
        VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9) RETURNING traditional_crop_traits_id";

        $query_run_traits = pg_query_params($con, $query_traits, array(
            $taste, $aroma, $maturation, $drought_tolerance, $environment_adaptability, $culinary_quality, $nutritional_value,
            $disease_resistance, $pest_resistance
        ));

        if ($query_run_traits) {
            $row_traits = pg_fetch_row($query_run_traits);
            $traditional_crop_traits_id = $row_traits[0];
        } else {
            echo "Error: " . pg_last_error($con);
            exit(0);
        }

        // Continue with the same approach for Relationship among Cultivars
        $query_cultivars = "INSERT INTO relationship_among_cultivars (distinct_cultivar_groups_morph_gen, cultivar_relations_cluster_and_pca,
    hybridization_potential, conservation_and_breeding_implications) 
    VALUES ($1, $2, $3, $4) RETURNING relationship_among_cultivars_id";

        $query_run_cultivars = pg_query_params($con, $query_cultivars, array(
            handleEmpty($_POST['distinct_cultivar_groups_morph_gen']),
            handleEmpty($_POST['cultivar_relations_cluster_and_pca']),
            handleEmpty($_POST['hybridization_potential']),
            handleEmpty($_POST['conservation_and_breeding_implications'])
        ));

        if ($query_run_cultivars) {
            $row_cultivars = pg_fetch_row($query_run_cultivars);
            $relationship_among_cultivars_id = $row_cultivars[0];
        } else {
            echo "Error: " . pg_last_error($con);
            exit(0);
        }

        // Inserting into Crop table using parameterized query
        $query_crop = "INSERT INTO crops (
        agronomic_information_id, botanical_information_id,
        morphological_characteristic_id, traditional_crop_traits_id, relationship_among_cultivars_id,
        \"image\", crop_name, \"description\", upland_or_lowland, season,
        economic_importance, category, links, local_name, planting_techniques,
        cultural_and_spiritual_significance, breeding_potential, threats,
        other_info, rice_biodiversity_uplift, traditional_knowledge_and_practices
    ) VALUES (
        $1, $2, $3, $4, $5, $6, $7, $8, $9, $10,
        $11, $12, $13, $14, $15, $16, $17, $18, $19,
        $20, $21
    ) RETURNING crop_id";

        $query_run_crop = pg_query_params($con, $query_crop, array(
            $agronomic_information_id,
            $botanical_information_id,
            $morphological_characteristic_id,
            $traditional_crop_traits_id,
            $relationship_among_cultivars_id,
            handleEmpty($_POST['image']),
            handleEmpty($_POST['crop_name']),
            handleEmpty($_POST['description']),
            handleEmpty($_POST['upland_or_lowland']),
            handleEmpty($_POST['season']),
            handleEmpty($_POST['economic_importance']),
            handleEmpty($_POST['category']),
            handleEmpty($_POST['links']),
            handleEmpty($_POST['local_name']),
            handleEmpty($_POST['planting_techniques']),
            handleEmpty($_POST['cultural_and_spiritual_significance']),
            handleEmpty($_POST['breeding_potential']),
            handleEmpty($_POST['threats']),
            handleEmpty($_POST['other_info']),
            handleEmpty($_POST['rice_biodiversity_uplift']),
            handleEmpty($_POST['traditional_knowledge_and_practices'])
        ));

        if ($query_run_crop) {
            $row_crop = pg_fetch_row($query_run_crop);
            $crop_id = $row_crop[0];
            $_SESSION['message'] = "Crop Created Successfully";
            header("Location: list.php");
            exit(0);
        } else {
            echo "Error: " . pg_last_error($con);
            exit(0);
        }
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
            return "'Empty'";
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
