<?php

session_start();

$con = pg_connect("host=localhost dbname=farm_crops user=postgres password=123") or die("Could not connect to server\n");

if (isset($_SESSION['rank'])) {
    $rank = $_SESSION['rank'];
}

if (isset($_POST['save_crop']) && $_SESSION['rank'] == 'curator') {
    // Function to handle empty values
    function handleEmpty($value)
    {
        return empty($value) ? 'Empty' : $value;
    }

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

    // Check if the image is selected
    if (isset($_FILES['image']['name'])) {
        // Upload image
        $image = $_FILES['image']['name'];

        // Upload the image only if selected
        if ($image != "") {
            // Auto rename image
            $ext = pathinfo($image, PATHINFO_EXTENSION);
            $image = "Crop_image_" . rand(000, 999) . '.' . $ext;

            // Check if the image name already exists in the database
            while (true) {
                $query = "SELECT image FROM crops WHERE image = $1";
                $result = pg_query_params($con, $query, array($image));

                if ($result === false) {
                    break;
                }

                $count = pg_num_rows($result);

                if ($count == 0) {
                    break;
                } else {
                    // If the image name exists, generate a new one
                    $image = "Crop_image_" . rand(000, 999) . '.' . $ext;
                }
            }

            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../img/crop/" . $image;

            // Upload the image
            $upload = move_uploaded_file($source_path, $destination_path);

            // Check whether the image is uploaded or not
            if (!$upload) {
                echo "Image uploaded";
                die();
            }
        }
    } else {
        // Don't upload image and set the image value as blank
        $image = "";
    }

    $user_id = $_POST['user_id'];
    $status = 'approved';
    $crop_name = $_POST['crop_name'];
    $local_name = $_POST['local_name'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    // Validate data before insertion
    if (empty($crop_name) || empty($local_name) || empty($category) || empty($description) || empty($image)) {
        // Handle the case where any required field is empty
        echo "naay empty";
        exit();
    }

    // Inserting into Crop table using parameterized query
    $query_crop = "INSERT INTO crops (
        traditional_crop_traits_id, farming_id,
        image, crop_name, \"description\", upland_or_lowland,
        category, local_name, planting_techniques,
        cultural_and_spiritual_significance, threats,
        other_info, role_in_maintaining_upland_ecosystem, cultural_importance_and_traditional_knowledge,
        unique_features, cultural_use, associated_vegetation, last_seen_location, user_id, status
    ) VALUES (
        $1, $2, $3, $4, $5, $6, $7, $8, $9, $10,
        $11, $12, $13, $14, $15, $16, $17, $18, $19, $20
    ) RETURNING crop_id";

    $farming_id_input = $_POST['farming_id'];
    $farming_id = empty($farming_id_input) ? null : $farming_id_input;

    $query_run_crop = pg_query_params($con, $query_crop, array(
        $traditional_crop_traits_id, $farming_id, $image,
        handleEmpty($_POST['crop_name']),
        handleEmpty($_POST['description']),
        handleEmpty($_POST['upland_or_lowland']),
        handleEmpty($_POST['category']),
        handleEmpty($_POST['local_name']),
        handleEmpty($_POST['planting_techniques']),
        handleEmpty($_POST['cultural_and_spiritual_significance']),
        handleEmpty($_POST['threats']),
        handleEmpty($_POST['other_info']),
        handleEmpty($_POST['role_in_maintaining_upland_ecosystem']),
        handleEmpty($_POST['cultural_importance_and_traditional_knowledge']),
        handleEmpty($_POST['unique_features']),
        handleEmpty($_POST['cultural_use']),
        handleEmpty($_POST['associated_vegetation']),
        handleEmpty($_POST['last_seen_location']),
        $user_id, $status
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
} else {
    if (isset($_POST['save_crop']) && $_SESSION['rank'] == 'admin') {
        // Function to handle empty values
        function handleEmpty($value)
        {
            return empty($value) ? 'Empty' : $value;
        }

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

        // Check if the image is selected
        if (isset($_FILES['image']['name'])) {
            // Upload image
            $image = $_FILES['image']['name'];

            // Upload the image only if selected
            if ($image != "") {
                // Auto rename image
                $ext = pathinfo($image, PATHINFO_EXTENSION);
                $image = "Crop_image_" . rand(000, 999) . '.' . $ext;

                // Check if the image name already exists in the database
                while (true) {
                    $query = "SELECT image FROM crops WHERE image = $1";
                    $result = pg_query_params($con, $query, array($image));

                    if ($result === false) {
                        break;
                    }

                    $count = pg_num_rows($result);

                    if ($count == 0) {
                        break;
                    } else {
                        // If the image name exists, generate a new one
                        $image = "Crop_image_" . rand(000, 999) . '.' . $ext;
                    }
                }

                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../img/crop/" . $image;

                // Upload the image
                $upload = move_uploaded_file($source_path, $destination_path);

                // Check whether the image is uploaded or not
                if (!$upload) {
                    echo "Image uploaded";
                    die();
                }
            }
        } else {
            // Don't upload image and set the image value as blank
            $image = "";
        }

        $user_id = $_POST['user_id'];
        $status = 'pending';
        $crop_name = $_POST['crop_name'];
        $local_name = $_POST['local_name'];
        $category = $_POST['category'];
        $description = $_POST['description'];

        // Validate data before insertion
        if (empty($crop_name) || empty($local_name) || empty($category) || empty($description) || empty($image)) {
            // Handle the case where any required field is empty
            echo "naay empty";
            exit();
        }

        // Inserting into Crop table using parameterized query
        $query_crop = "INSERT INTO crops (
        traditional_crop_traits_id, farming_id,
        image, crop_name, \"description\", upland_or_lowland,
        category, local_name, planting_techniques,
        cultural_and_spiritual_significance, threats,
        other_info, role_in_maintaining_upland_ecosystem, cultural_importance_and_traditional_knowledge,
        unique_features, cultural_use, associated_vegetation, last_seen_location, user_id, status
        ) VALUES (
            $1, $2, $3, $4, $5, $6, $7, $8, $9, $10,
            $11, $12, $13, $14, $15, $16, $17, $18, $19, $20
        ) RETURNING crop_id";

        $farming_id_input = $_POST['farming_id'];
        $farming_id = empty($farming_id_input) ? null : $farming_id_input;

        $query_run_crop = pg_query_params($con, $query_crop, array(
            $traditional_crop_traits_id, $farming_id, $image,
            handleEmpty($_POST['crop_name']),
            handleEmpty($_POST['description']),
            handleEmpty($_POST['upland_or_lowland']),
            handleEmpty($_POST['category']),
            handleEmpty($_POST['local_name']),
            handleEmpty($_POST['planting_techniques']),
            handleEmpty($_POST['cultural_and_spiritual_significance']),
            handleEmpty($_POST['threats']),
            handleEmpty($_POST['other_info']),
            handleEmpty($_POST['role_in_maintaining_upland_ecosystem']),
            handleEmpty($_POST['cultural_importance_and_traditional_knowledge']),
            handleEmpty($_POST['unique_features']),
            handleEmpty($_POST['cultural_use']),
            handleEmpty($_POST['associated_vegetation']),
            handleEmpty($_POST['last_seen_location']),
            $user_id, $status
        ));

        if ($query_run_crop) {
            $row_crop = pg_fetch_row($query_run_crop);
            $crop_id = $row_crop[0];
            $_SESSION['message'] = "Crop Created Successfully Waitinng for approval";
            header("Location: list.php");
            exit(0);
        } else {
            echo "Error: " . pg_last_error($con);
            exit(0);
        }
    } else {
        $_SESSION['message'] = "Status not high enough";
        header("Location: list.php");
        exit(0);
    }
}
