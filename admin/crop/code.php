<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$con = pg_connect("host=localhost dbname=farm_crops user=postgres password=123") or die("Could not connect to server\n");

// if (isset($_POST['save']) && $_SESSION['rank'] == 'curator') {
if (isset($_POST['save']) && $_SESSION['rank'] == 'curator') {
    // Begin the database transaction
    pg_query($con, "BEGIN");
    try {
        // Function to handle empty values
        function handleEmpty($value)
        {
            return empty($value) ? 'Empty' : $value;
        }

        // Get user inputs for data in crop Location table
        $province_name = handleEmpty($_POST['province_name']);
        $municipality_name = handleEmpty($_POST['municipality_name']);
        $longtitude = handleEmpty($_POST['longtitude']);
        $latitude = handleEmpty($_POST['latitude']);

        // Inserting into location table using parameterized query
        $query_location = "INSERT INTO location (province_name, municipality_name, longtitude,
        latitude) 
        VALUES ($1, $2, $3, $4) RETURNING location_id";

        $query_run_location = pg_query_params($con, $query_location, array(
            $province_name, $municipality_name, $longtitude,
            $latitude
        ));

        if ($query_run_location) {
            $row_location = pg_fetch_row($query_run_location);
            $location_id = $row_location[0];
        } else {
            echo "Error: " . pg_last_error($con);
            exit(0);
        }

        // Get user inputs for data in crop Location table
        $other_info_type = handleEmpty($_POST['other_info_type']);
        $other_info_name = handleEmpty($_POST['other_info_name']);
        $other_info_description = handleEmpty($_POST['other_info_description']);
        $other_info_url = handleEmpty($_POST['other_info_url']);

        // Inserting into location table using parameterized query
        $query_other_info = "INSERT INTO other_info (other_info_type, other_info_name, other_info_description,
        other_info_url) 
        VALUES ($1, $2, $3, $4) RETURNING other_info_id";

        $query_run_other_info = pg_query_params($con, $query_other_info, array(
            $other_info_type, $other_info_name, $other_info_description,
            $other_info_url
        ));

        if ($query_run_other_info) {
            $row_other_info = pg_fetch_row($query_run_other_info);
            $other_info_id = $row_other_info[0];
        } else {
            echo "Error: " . pg_last_error($con);
            exit(0);
        }

        // Array to store uploaded image names
        $imageNamesArray = [];

        // Check if the image is selected
        if (isset($_FILES['crop_image']['name']) && is_array($_FILES['crop_image']['name'])) {
            $extension = array('jpg', 'jpeg', 'png', 'gif');

            foreach ($_FILES['crop_image']['name'] as $key => $value) {
                $filename = $_FILES['crop_image']['name'][$key];
                $filename_tmp = $_FILES['crop_image']['tmp_name'][$key];
                $destination_path = "../img/crop/" . $filename;
                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                $finalimg = '';

                if (in_array($ext, $extension)) {
                    // Auto rename image
                    $image = "Crop_image_" . rand(000, 999) . '.' . $ext;

                    // Check if the image name already exists in the database
                    while (true) {
                        $query = "SELECT crop_image FROM crop WHERE crop_image = $1";
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

                    $source_path = $_FILES['crop_image']['tmp_name'][$key];
                    $destination_path = "../img/crop/" . $image;

                    // Upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    // Check whether the image is uploaded or not
                    if (!$upload) {
                        echo "Image upload failed";
                        die();
                    }

                    $finalimg = $image;
                    $imageNamesArray[] = $finalimg; // Add image name to the array
                } else {
                    // Display error message for invalid file format
                }
            }
        } else {
            // Don't upload image and set the image value as blank
            echo "No Image uploaded";
            die();
        }

        // Convert the array to a comma-separated string
        $imageNamesString = implode(',', $imageNamesArray);
        $farming_practice_id = $_POST['farming_practice_id'];
        $user_id = $_POST['user_id'];
        $status = 'approved';
        $crop_name = $_POST['crop_name'];
        $crop_local_name = $_POST['crop_local_name'];
        $category = $_POST['category'];
        $crop_description = $_POST['crop_description'];

        // Validate data before insertion
        if (empty($crop_name) || empty($crop_local_name) || empty($category) || empty($crop_description) || empty($image)) {
            // Handle the case where any required field is empty
            echo "naay empty";
            exit();
        }

        // Inserting into Crop table using parameterized query
        $query_crop = "INSERT INTO crop (
        crop_image, crop_name, crop_description, upland_or_lowland,
        category, crop_local_name, crop_scientific_name, crop_variety, crop_origin,
        user_id, status
        ) VALUES (
            $1, $2, $3, $4, $5, $6, $7, $8, $9, $10,
            $11
        ) RETURNING crop_id";

        $stmt_crop = pg_prepare($con, "insert_crop", $query_crop);
        $query_run_crop = pg_execute($con, "insert_crop", array(
            $imageNamesString,
            handleEmpty($_POST['crop_name']),
            handleEmpty($_POST['crop_description']),
            handleEmpty($_POST['upland_or_lowland']),
            handleEmpty($_POST['category']),
            handleEmpty($_POST['crop_local_name']),
            handleEmpty($_POST['crop_scientific_name']),
            handleEmpty($_POST['crop_variety']),
            handleEmpty($_POST['crop_origin']),
            $user_id, $status
        ));

        if ($query_run_crop) {
            $row_crop = pg_fetch_row($query_run_crop);
            $crop_id = $row_crop[0];
            // $_SESSION['message'] = "Crop Created Successfully";
            // header("Location: list.php");
            // exit(0);
        } else {
            echo "Error: " . pg_last_error($con);
            exit(0);
        }

        // Inserting into crop_location table using parameterized query
        $query_crop_loc = "INSERT INTO crop_location (crop_id, location_id) VALUES ($1, $2) RETURNING crop_location_id";
        $stmt_crop_loc = pg_prepare($con, "insert_crop_loc", $query_crop_loc);
        $query_run_crop_loc = pg_execute($con, "insert_crop_loc", array(
            $crop_id, $location_id
        ));

        if ($query_run_crop_loc) {
            $row_crop_loc = pg_fetch_row($query_run_crop_loc);
            $crop_location_id = $row_crop_loc[0];
        } else {
            echo "Error: " . pg_last_error($con);
            exit(0);
        }

        // Inserting into crop_farming_practice table using parameterized query
        $query_farm_prac = "INSERT INTO crop_farming_practice (crop_id, farming_practice_id) VALUES ($1, $2) RETURNING crop_farming_practice_id";
        $stmt_farm_prac = pg_prepare($con, "insert_farm_prac", $query_farm_prac);
        $query_run_farm_prac = pg_execute($con, "insert_farm_prac", array(
            $crop_id, $farming_practice_id
        ));

        if ($query_run_farm_prac) {
            $row_farm_prac = pg_fetch_row($query_run_farm_prac);
            $crop_farming_practice_id = $row_farm_prac[0];
        } else {
            echo "Error: " . pg_last_error($con);
            exit(0);
        }

        // Inserting into crop_other_info table using parameterized query
        $query_crop_other_info = "INSERT INTO crop_other_info (crop_id, other_info_id) VALUES ($1, $2) RETURNING crop_other_info_id";
        $stmt_crop_other_info = pg_prepare($con, "insert_crop_other_info", $query_crop_other_info);
        $query_run_crop_other_info = pg_execute($con, "insert_crop_other_info", array(
            $crop_id, $other_info_id
        ));

        if ($query_run_crop_other_info) {
            $row_crop_other_info = pg_fetch_row($query_run_crop_other_info);
            $crop_other_info_id = $row_crop_other_info[0];
        } else {
            echo "Error: " . pg_last_error($con);
            exit(0);
        }

        // Updating Crop table using parameterized query
        $query_combine_crop = "UPDATE crop SET crop_location_id = $1, crop_farming_practice_id = $2, crop_other_info_id = $3 WHERE crop_id = $4 RETURNING crop_id";

        $stmt_combine_crop = pg_prepare($con, "update_combine_crop", $query_combine_crop);
        $query_run_combine_crop = pg_execute($con, "update_combine_crop", array(
            $crop_location_id, $crop_farming_practice_id, $crop_other_info_id, $crop_id
        ));

        if ($query_run_combine_crop) {
            $row_crop = pg_fetch_row($query_run_combine_crop);
            $crop_id = $row_crop[0];
        } else {
            echo "Error: " . pg_last_error($con);
            exit(0);
        }

        // Commit the transaction if everything is successful
        pg_query($con, "COMMIT");
        $_SESSION['message'] = "Crop Created Successfully";
        header("Location: list.php");
        exit(0);
    } catch (Exception $e) {
        // Rollback the transaction if an error occurs
        pg_query($con, "ROLLBACK");
        // Handle the error
        echo "Error: " . $e->getMessage();
        exit(0);
    }
} else {
    if (isset($_POST['save'])) {
        // Begin the database transaction
        pg_query($con, "BEGIN");
        try {
            // Function to handle empty values
            function handleEmpty($value)
            {
                return empty($value) ? 'Empty' : $value;
            }

            // Get user inputs for data in crop Location table
            $province_name = handleEmpty($_POST['province_name']);
            $municipality_name = handleEmpty($_POST['municipality_name']);
            $longtitude = handleEmpty($_POST['longtitude']);
            $latitude = handleEmpty($_POST['latitude']);

            // Inserting into location table using parameterized query
            $query_location = "INSERT INTO location (province_name, municipality_name, longtitude,
            latitude) 
            VALUES ($1, $2, $3, $4) RETURNING location_id";

            $query_run_location = pg_query_params($con, $query_location, array(
                $province_name, $municipality_name, $longtitude,
                $latitude
            ));

            if ($query_run_location) {
                $row_location = pg_fetch_row($query_run_location);
                $location_id = $row_location[0];
            } else {
                echo "Error: " . pg_last_error($con);
                exit(0);
            }

            // Get user inputs for data in crop Location table
            $other_info_type = handleEmpty($_POST['other_info_type']);
            $other_info_name = handleEmpty($_POST['other_info_name']);
            $other_info_description = handleEmpty($_POST['other_info_description']);
            $other_info_url = handleEmpty($_POST['other_info_url']);

            // Inserting into location table using parameterized query
            $query_other_info = "INSERT INTO other_info (other_info_type, other_info_name, other_info_description,
            other_info_url) 
            VALUES ($1, $2, $3, $4) RETURNING other_info_id";

            $query_run_other_info = pg_query_params($con, $query_other_info, array(
                $other_info_type, $other_info_name, $other_info_description,
                $other_info_url
            ));

            if ($query_run_other_info) {
                $row_other_info = pg_fetch_row($query_run_other_info);
                $other_info_id = $row_other_info[0];
            } else {
                echo "Error: " . pg_last_error($con);
                exit(0);
            }

            // Array to store uploaded image names
            $imageNamesArray = [];

            // Check if the image is selected
            if (isset($_FILES['crop_image']['name']) && is_array($_FILES['crop_image']['name'])) {
                $extension = array('jpg', 'jpeg', 'png', 'gif');

                foreach ($_FILES['crop_image']['name'] as $key => $value) {
                    $filename = $_FILES['crop_image']['name'][$key];
                    $filename_tmp = $_FILES['crop_image']['tmp_name'][$key];
                    $destination_path = "../img/crop/" . $filename;
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);

                    $finalimg = '';

                    if (in_array($ext, $extension)) {
                        // Auto rename image
                        $image = "Crop_image_" . rand(000, 999) . '.' . $ext;

                        // Check if the image name already exists in the database
                        while (true) {
                            $query = "SELECT crop_image FROM crop WHERE crop_image = $1";
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

                        $source_path = $_FILES['crop_image']['tmp_name'][$key];
                        $destination_path = "../img/crop/" . $image;

                        // Upload the image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        // Check whether the image is uploaded or not
                        if (!$upload) {
                            echo "Image upload failed";
                            die();
                        }

                        $finalimg = $image;
                        $imageNamesArray[] = $finalimg; // Add image name to the array
                    } else {
                        // Display error message for invalid file format
                    }
                }
            } else {
                // Don't upload image and set the image value as blank
                echo "No Image uploaded";
                die();
            }

            // Convert the array to a comma-separated string
            $imageNamesString = implode(',', $imageNamesArray);
            $farming_practice_id = $_POST['farming_practice_id'];
            $user_id = $_POST['user_id'];
            $status = 'pending';
            $crop_name = $_POST['crop_name'];
            $crop_local_name = $_POST['crop_local_name'];
            $category = $_POST['category'];
            $crop_description = $_POST['crop_description'];

            // Validate data before insertion
            if (empty($crop_name) || empty($crop_local_name) || empty($category) || empty($crop_description) || empty($image)) {
                // Handle the case where any required field is empty
                echo "naay empty";
                exit();
            }

            // Inserting into Crop table using parameterized query
            $query_crop = "INSERT INTO crop (
            crop_image, crop_name, crop_description, upland_or_lowland,
            category, crop_local_name, crop_scientific_name, crop_variety, crop_origin,
            user_id, status
            ) VALUES (
                $1, $2, $3, $4, $5, $6, $7, $8, $9, $10,
                $11
            ) RETURNING crop_id";

            $stmt_crop = pg_prepare($con, "insert_crop", $query_crop);
            $query_run_crop = pg_execute($con, "insert_crop", array(
                $imageNamesString,
                handleEmpty($_POST['crop_name']),
                handleEmpty($_POST['crop_description']),
                handleEmpty($_POST['upland_or_lowland']),
                handleEmpty($_POST['category']),
                handleEmpty($_POST['crop_local_name']),
                handleEmpty($_POST['crop_scientific_name']),
                handleEmpty($_POST['crop_variety']),
                handleEmpty($_POST['crop_origin']),
                $user_id, $status
            ));

            if ($query_run_crop) {
                $row_crop = pg_fetch_row($query_run_crop);
                $crop_id = $row_crop[0];
                // $_SESSION['message'] = "Crop Created Successfully";
                // header("Location: list.php");
                // exit(0);
            } else {
                echo "Error: " . pg_last_error($con);
                exit(0);
            }

            // Inserting into crop_location table using parameterized query
            $query_crop_loc = "INSERT INTO crop_location (crop_id, location_id) VALUES ($1, $2) RETURNING crop_location_id";
            $stmt_crop_loc = pg_prepare($con, "insert_crop_loc", $query_crop_loc);
            $query_run_crop_loc = pg_execute($con, "insert_crop_loc", array(
                $crop_id, $location_id
            ));

            if ($query_run_crop_loc) {
                $row_crop_loc = pg_fetch_row($query_run_crop_loc);
                $crop_location_id = $row_crop_loc[0];
            } else {
                echo "Error: " . pg_last_error($con);
                exit(0);
            }

            // Inserting into crop_farming_practice table using parameterized query
            $query_farm_prac = "INSERT INTO crop_farming_practice (crop_id, farming_practice_id) VALUES ($1, $2) RETURNING crop_farming_practice_id";
            $stmt_farm_prac = pg_prepare($con, "insert_farm_prac", $query_farm_prac);
            $query_run_farm_prac = pg_execute($con, "insert_farm_prac", array(
                $crop_id, $farming_practice_id
            ));

            if ($query_run_farm_prac) {
                $row_farm_prac = pg_fetch_row($query_run_farm_prac);
                $crop_farming_practice_id = $row_farm_prac[0];
            } else {
                echo "Error: " . pg_last_error($con);
                exit(0);
            }

            // Inserting into crop_other_info table using parameterized query
            $query_crop_other_info = "INSERT INTO crop_other_info (crop_id, other_info_id) VALUES ($1, $2) RETURNING crop_other_info_id";
            $stmt_crop_other_info = pg_prepare($con, "insert_crop_other_info", $query_crop_other_info);
            $query_run_crop_other_info = pg_execute($con, "insert_crop_other_info", array(
                $crop_id, $other_info_id
            ));

            if ($query_run_crop_other_info) {
                $row_crop_other_info = pg_fetch_row($query_run_crop_other_info);
                $crop_other_info_id = $row_crop_other_info[0];
            } else {
                echo "Error: " . pg_last_error($con);
                exit(0);
            }

            // Updating Crop table using parameterized query
            $query_combine_crop = "UPDATE crop SET crop_location_id = $1, crop_farming_practice_id = $2, crop_other_info_id = $3 WHERE crop_id = $4 RETURNING crop_id";

            $stmt_combine_crop = pg_prepare($con, "update_combine_crop", $query_combine_crop);
            $query_run_combine_crop = pg_execute($con, "update_combine_crop", array(
                $crop_location_id, $crop_farming_practice_id, $crop_other_info_id, $crop_id
            ));

            if ($query_run_combine_crop) {
                $row_crop = pg_fetch_row($query_run_combine_crop);
                $crop_id = $row_crop[0];
            } else {
                echo "Error: " . pg_last_error($con);
                exit(0);
            }

            // Commit the transaction if everything is successful
            pg_query($con, "COMMIT");
            $_SESSION['message'] = "Crop Created Successfully";
            header("Location: list.php");
            exit(0);
        } catch (Exception $e) {
            // Rollback the transaction if an error occurs
            pg_query($con, "ROLLBACK");
            // Handle the error
            echo "Error: " . $e->getMessage();
            exit(0);
        }
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

    // Check if the image files are selected
    if (!empty($_FILES['image']['name'])) {
        $images = $_FILES['image'];

        $uploadedImages = array();

        // Ensure $images['name'] is always an array
        if (!is_array($images['name'])) {
            $images['name'] = array($images['name']);
            $images['type'] = array($images['type']);
            $images['tmp_name'] = array($images['tmp_name']);
            $images['error'] = array($images['error']);
            $images['size'] = array($images['size']);
        }

        // Loop through each image file
        for ($i = 0; $i < count($images['name']); $i++) {
            $image = $images['name'][$i];

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
                    $source_path = $images['tmp_name'][$i];
                    $destination_path = "../img/crop/" . $image;

                    // Upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    // Check whether the image is uploaded or not
                    if (!$upload) {
                        echo "Failed to upload image";
                        die();
                    }

                    // Add the uploaded image to the array
                    $uploadedImages[] = $image;
                }
            }
        }

        $imageName = explode(',', $current_image);

        // Remove the current images if available
        foreach ($imageName as $current) {
            if ($current != "") {
                $remove_path = "../img/crop/" . $current;

                // Check if the file exists before attempting to remove
                if (file_exists($remove_path)) {
                    $remove = unlink($remove_path);

                    // Check whether the current image is removed or not
                    if (!$remove) {
                        echo "Failed to remove image";
                        die();
                    }
                }
            }
        }
    } else {
        // No new images selected, use the current ones
        $uploadedImages = explode(',', $current_image);
    }

    $finalimg = implode(',', $uploadedImages);

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
        $last_seen_location, $finalimg, $crop_name, $description, $upland_or_lowland,
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

if (isset($_POST['delete']) && $_SESSION['rank'] == 'curator') {
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
            // It has images, explode the string into an array
            $imageNames = explode(',', $current_image);

            // Iterate through the array to remove each image
            foreach ($imageNames as $imageName) {
                if ($imageName != "") {
                    $path = "../img/crop/" . $imageName;
                    $remove = unlink($path);

                    if ($remove == false) {
                        throw new Exception("Failed to remove image");
                    }
                }
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
