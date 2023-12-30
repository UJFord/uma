<?php

session_start();

$con = pg_connect("host=localhost dbname=farm_crops user=postgres password=123") or die("Could not connect to server\n");

if(isset($_SESSION['rank'])){
    $username = $_SESSION['rank'];
    echo "username: " . $username;
}

if (isset($_POST['save_crop'])) {
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
        unique_features, cultural_use, associated_vegetation, last_seen_location
    ) VALUES (
        $1, $2, $3, $4, $5, $6, $7, $8, $9, $10,
        $11, $12, $13, $14, $15, $16, $17, $18
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
        handleEmpty($_POST['last_seen_location'])
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

if (isset($_POST['update'])) {
    // Assuming you have a variable $_POST['crop_id'] containing the ID of the crop to update
    // crops table
    $crop_id = pg_escape_string($con, $_POST['crop_id']);
    $current_image = pg_escape_string($con, $_POST['current_image']);
    $traditional_crop_traits_id = pg_escape_string($con, $_POST['traditional_crop_traits_id']);
    // $farming_id = pg_escape_string($con, $_POST['farming_id']);
    $crop_name = pg_escape_string($con, $_POST['crop_name']);
    $description = pg_escape_string($con, $_POST['description']);
    $upland_or_lowland = pg_escape_string($con, $_POST['upland_or_lowland']);
    $local_name = pg_escape_string($con, $_POST['local_name']);
    $cultural_and_spiritual_significance = pg_escape_string($con, $_POST['cultural_and_spiritual_significance']);
    $threats = pg_escape_string($con, $_POST['threats']);
    $other_info = pg_escape_string($con, $_POST['other_info']);
    $role_in_maintaining_upland_ecosystem = pg_escape_string($con, $_POST['role_in_maintaining_upland_ecosystem']);
    $cultural_importance_and_traditional_knowledge = pg_escape_string($con, $_POST['cultural_importance_and_traditional_knowledge']);
    $category = pg_escape_string($con, $_POST['category']);
    $planting_techniques = pg_escape_string($con, $_POST['planting_techniques']);
    $unique_features = pg_escape_string($con, $_POST['unique_features']);
    $cultural_use = pg_escape_string($con, $_POST['cultural_use']);
    $associated_vegetation = pg_escape_string($con, $_POST['associated_vegetation']);
    $last_seen_location = pg_escape_string($con, $_POST['last_seen_location']);


    // Validate data before insertion
    if (empty($crop_name) || empty($local_name) || empty($category) || empty($description) || empty($current_image)) {
        // Handle the case where any required field is empty
        echo "naay empty";
        exit();
    }

    // Function to handle empty values and NULL values
    function handleValue($value)
    {
        return $value === '' ? 'Empty' : htmlspecialchars($value, ENT_QUOTES);
    }


    // Function to handle integer values, including NULL
    function handleInteger($value)
    {
        if ($value === '' || $value === null) {
            return 'Null';  // Return null for empty values
        } else {
            return $value;
        }
    }
    // Apply the function to each field
    // crops table
    $farming_id = handleInteger(isset($_POST['farming_id']) ? $_POST['farming_id'] : null);
    $cultural_and_spiritual_significance = handleValue($_POST['cultural_and_spiritual_significance']);
    $threats = handleValue($_POST['threats']);
    $other_info = handleValue($_POST['other_info']);
    $role_in_maintaining_upland_ecosystem = handleValue($_POST['role_in_maintaining_upland_ecosystem']);
    $cultural_importance_and_traditional_knowledge = handleValue($_POST['cultural_importance_and_traditional_knowledge']);
    $planting_techniques = handleValue($_POST['planting_techniques']);
    $unique_features = handleValue($_POST['unique_features']);
    $cultural_use = handleValue($_POST['cultural_use']);
    $associated_vegetation = handleValue($_POST['associated_vegetation']);
    $last_seen_location = handleValue($_POST['last_seen_location']);

    // Traditional Traits Table
    $taste = handleValue($_POST['taste']);
    $aroma = handleValue($_POST['aroma']);
    $maturation = handleValue($_POST['maturation']);
    $pest_and_disease_resistance = handleValue($_POST['pest_and_disease_resistance']);

    // Update traditional_crop_traits table
    $query_traits = "UPDATE traditional_crop_traits SET taste = $1, aroma = $2, maturation = $3,
        pest_and_disease_resistance = $4 WHERE traditional_crop_traits_id = $5";
    $params_traits = array($taste, $aroma, $maturation, $pest_and_disease_resistance, $traditional_crop_traits_id);
    $query_run_traits = pg_query_params($con, $query_traits, $params_traits);

    if (!$query_run_traits) {
        echo "Error updating traditional crop traits: " . pg_last_error($con);
        exit(0);
    }

    // Function to generate a unique image name
    function generate_unique_image_name($ext)
    {
        return "Crop_Image_" . rand(000, 999) . '.' . $ext;
    }

    // Check if the image is selected or not
    if (isset($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];

        // Check if a new image is available
        if ($image != "") {
            $ext = pathinfo($image, PATHINFO_EXTENSION);
            $image = generate_unique_image_name($ext);

            // Check if the new image name already exists in the database
            $query = "SELECT image FROM crops WHERE image = $1";
            $result = pg_query_params($con, $query, array($image));

            // Check for errors
            if ($result === false) {
                echo "Error: " . pg_last_error($con);
                die();
            }

            $count = pg_num_rows($result);

            if ($count > 0) {
                // If the image name exists, generate a new one
                $image = generate_unique_image_name($ext);
            } else {
                // Upload the new image
                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../img/crop/" . $image;

                // Upload the image
                $upload = move_uploaded_file($source_path, $destination_path);

                // Check whether the image is uploaded or not
                if (!$upload) {
                    echo "wala na upload";
                    die();
                }

                // Remove the current image if available
                if ($current_image != "") {
                    $remove_path = "../img/crop/" . $current_image;

                    // Check if the file exists before attempting to remove
                    if (file_exists($remove_path)) {
                        $remove = unlink($remove_path);

                        // Check whether the current image is removed or not
                        if (!$remove) {
                            echo "wala na remove";
                            die();
                        }
                    }
                }
            }
        } else {
            $image = $current_image;
        }
    } else {
        $image = $current_image;
    }

    // Update Crop table using parameterized query
    $query_crop = "UPDATE crops SET
    last_seen_location = $1, image = $2, crop_name = $3, description = $4, upland_or_lowland = $5,
    cultural_and_spiritual_significance = $6, threats = $7,
    other_info = $8, role_in_maintaining_upland_ecosystem = $9, cultural_importance_and_traditional_knowledge = $10,
    unique_features = $11, cultural_use = $12, associated_vegetation = $13, planting_techniques = $14, category = $15,
    local_name = $16
    WHERE crop_id = $17";

    // Parameters for the query
    $params_crop = array(
        $last_seen_location, $image, $crop_name, $description, $upland_or_lowland,
        $cultural_and_spiritual_significance, $threats,
        $other_info, $role_in_maintaining_upland_ecosystem, $cultural_importance_and_traditional_knowledge,
        $unique_features, $cultural_use, $associated_vegetation, $planting_techniques, $category,
        $local_name, $crop_id
    );

    // Prepare the statement
    $query_prepare_crop = pg_prepare($con, "update_crop", $query_crop);

    // Execute the statement with parameters
    $query_run_crop = pg_execute($con, "update_crop", $params_crop);

    if ($query_run_crop) {
        $_SESSION['message'] = "Crop Updated Successfully";
        header("Location: crop.php?crop_id=" . $_POST['crop_id']);
        exit(0);
    } else {
        echo "Error: " . pg_last_error($con);
        exit(0);
    }
}

if (isset($_POST['delete'])) {
    $crop_id = $_POST['crop_id'];
    $current_image = $_POST['current_image'];
    $traditional_crop_traits_id = $_POST['traditional_crop_traits_id'];

    // Validation Checks
    if (empty($crop_id) || empty($current_image) || empty($traditional_crop_traits_id)) {
        // Handle the case where parameters are missing
        echo "Invalid parameters";
        exit(0);
    }

    // Start a database transaction
    pg_query($con, "BEGIN");

    try {
        // Check if the current image is available
        if ($current_image != "") {
            // IT has an image and needs to remove from the folder
            $path = "../img/crop/" . $current_image;
            $remove = unlink($path);

            if ($remove == false) {
                throw new Exception("Failed to remove image");
            }
        }

        // Delete from Crop table
        $query_delete_crop = "DELETE FROM crops WHERE crop_id = $1";
        $query_run_delete_crop = pg_query_params($con, $query_delete_crop, [$crop_id]);

        if (!$query_run_delete_crop) {
            throw new Exception("Failed to delete from Crop table");
        }

        // Delete from Traditional Crop Traits table
        $query_delete_traits = "DELETE FROM traditional_crop_traits WHERE traditional_crop_traits_id = $1";
        $query_run_delete_traits = pg_query_params($con, $query_delete_traits, [$traditional_crop_traits_id]);

        if (!$query_run_delete_traits) {
            throw new Exception("Failed to delete from Traditional Crop Traits table");
        }

        // If everything is successful, commit the transaction
        pg_query($con, "COMMIT");

        $_SESSION['message'] = "Crop and associated records deleted successfully";
        header("Location: list.php");
        exit(0);
    } catch (Exception $e) {
        // If any step fails, roll back the transaction
        pg_query($con, "ROLLBACK");

        echo "Error: " . $e->getMessage();
        exit(0);
    }
}
