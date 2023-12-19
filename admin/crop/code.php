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

        // Escape user inputs for data in Traditional Crop Traits table
        $taste = handleEmpty($_POST['taste']);
        $aroma = handleEmpty($_POST['aroma']);
        $maturation = handleEmpty($_POST['maturation']);
        $pest_and_disease_resistance = handleEmpty($_POST['pest_and_disease_resistance']);

        // Inserting into Traditional Crop Traits table using parameterized query
        $query_traits = "INSERT INTO traditional_crop_traits (taste, aroma, maturation,
        pest_and_disease_resistance) 
        VALUES ($1, $2, $3, $4) RETURNING traditional_crop_traits_id";

        $query_run_traits = pg_query_params($con, $query_traits, array(
            $taste, $aroma, $maturation,
            $pest_and_disease_resistance
        ));

        if ($query_run_traits) {
            $row_traits = pg_fetch_row($query_run_traits);
            $traditional_crop_traits_id = $row_traits[0];
        } else {
            echo "Error: " . pg_last_error($con);
            exit(0);
        }

        // Inserting into Crop table using parameterized query
        $query_crop = "INSERT INTO crops (
        traditional_crop_traits_id,
        \"image\", crop_name, \"description\", upland_or_lowland,
        category, local_name, planting_techniques,
        cultural_and_spiritual_significance, threats,
        other_info, rice_biodiversity_uplift, cultural_importance_and_traditional_knowledge
    ) VALUES (
        $1, $2, $3, $4, $5, $6, $7, $8, $9, $10,
        $11, $12, $13
    ) RETURNING crop_id";

        $query_run_crop = pg_query_params($con, $query_crop, array(
            $traditional_crop_traits_id,
            handleEmpty($_POST['image']),
            handleEmpty($_POST['crop_name']),
            handleEmpty($_POST['description']),
            handleEmpty($_POST['upland_or_lowland']),
            handleEmpty($_POST['category']),
            handleEmpty($_POST['local_name']),
            handleEmpty($_POST['planting_techniques']),
            handleEmpty($_POST['cultural_and_spiritual_significance']),
            handleEmpty($_POST['threats']),
            handleEmpty($_POST['other_info']),
            handleEmpty($_POST['rice_biodiversity_uplift']),
            handleEmpty($_POST['cultural_importance_and_traditional_knowledge'])
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
    $traditional_crop_traits_id = pg_escape_string($con, $_POST['traditional_crop_traits_id']);
    $image = pg_escape_string($con, $_POST['image']);
    $crop_name = pg_escape_string($con, $_POST['crop_name']);
    $description = pg_escape_string($con, $_POST['description']);
    $upland_or_lowland = pg_escape_string($con, $_POST['upland_or_lowland']);
    $local_name = pg_escape_string($con, $_POST['local_name']);
    $cultural_and_spiritual_significance = pg_escape_string($con, $_POST['cultural_and_spiritual_significance']);
    $threats = pg_escape_string($con, $_POST['threats']);
    $other_info = pg_escape_string($con, $_POST['other_info']);
    $rice_biodiversity_uplift = pg_escape_string($con, $_POST['rice_biodiversity_uplift']);
    $cultural_importance_and_traditional_knowledge = pg_escape_string($con, $_POST['cultural_importance_and_traditional_knowledge']);
    $category = pg_escape_string($con, $_POST['category']);
    $planting_techniques = pg_escape_string($con, $_POST['planting_techniques']);

    //Traditional Traits Table
    $taste = pg_escape_string($con, $_POST['taste']);
    $aroma = pg_escape_string($con, $_POST['aroma']);
    $maturation = pg_escape_string($con, $_POST['maturation']);
    $pest_and_disease_resistance = pg_escape_string($con, $_POST['pest_and_disease_resistance']);

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
    $local_name = handleValue($_POST['local_name']);
    $cultural_and_spiritual_significance = handleValue($_POST['cultural_and_spiritual_significance']);
    $threats = handleValue($_POST['threats']);
    $other_info = handleValue($_POST['other_info']);
    $rice_biodiversity_uplift = handleValue($_POST['rice_biodiversity_uplift']);
    $cultural_importance_and_traditional_knowledge = handleValue($_POST['cultural_importance_and_traditional_knowledge']);
    $category = handleValue($_POST['category']);
    $planting_techniques = handleValue($_POST['planting_techniques']);

    // Traditional Traits Table
    $taste = handleValue($_POST['taste']);
    $aroma = handleValue($_POST['aroma']);
    $maturation = handleValue($_POST['maturation']);
    $pest_and_disease_resistance = handleValue($_POST['pest_and_disease_resistance']);

    // Update traditional_crop_traits table
    $query = "UPDATE traditional_crop_traits SET taste = $taste, aroma = $aroma, maturation = $maturation,
        pest_and_disease_resistance = $pest_and_disease_resistance WHERE traditional_crop_traits_id = $traditional_crop_traits_id";
    $query_run_traits = pg_query($con, $query);
    if (!$query_run_traits) {
        echo "Error updating traditional crop traits: " . pg_last_error($con);
        exit(0);
    }

    // Update Crop table
    $query = "UPDATE crops SET
    image = $image, crop_name = $crop_name, description = $description, upland_or_lowland = $upland_or_lowland,
    cultural_and_spiritual_significance = $cultural_and_spiritual_significance, threats = $threats,
    other_info = $other_info, rice_biodiversity_uplift = $rice_biodiversity_uplift, cultural_importance_and_traditional_knowledge = $cultural_importance_and_traditional_knowledge
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

        // Check if all deletions were successful
        if (
            $query_run_delete_traits
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
