<?php
session_start();
require "../mail.php";

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

        // Get user inputs for data in crop characteristics table
        $taste = handleEmpty($_POST['taste']);
        $aroma = handleEmpty($_POST['aroma']);
        $maturation = handleEmpty($_POST['maturation']);
        $pest_and_disease_resistance = handleEmpty($_POST['pest_and_disease_resistance']);

        // Inserting into characteristics table using parameterized query
        $query_characteristics = "INSERT INTO characteristics (taste, aroma, maturation,
        pest_and_disease_resistance) 
        VALUES ($1, $2, $3, $4) RETURNING characteristics_id";

        $query_run_characteristics = pg_query_params($con, $query_characteristics, array(
            $taste, $aroma, $maturation,
            $pest_and_disease_resistance
        ));

        if ($query_run_characteristics) {
            $row_characteristics = pg_fetch_row($query_run_characteristics);
            $characteristics_id = $row_characteristics[0];
        } else {
            echo "Error: " . pg_last_error($con);
            exit(0);
        }

        // Get user inputs for data in crop Location table
        $farming_practice_type = handleEmpty($_POST['farming_practice_type']);
        $farming_practice_name = handleEmpty($_POST['farming_practice_name']);
        $farming_practice_description = handleEmpty($_POST['farming_practice_description']);

        // Inserting into location table using parameterized query
        $query_farming_practice = "INSERT INTO farming_practice (farming_practice_type, farming_practice_name, farming_practice_description) 
        VALUES ($1, $2, $3) RETURNING farming_practice_id";

        $query_run_farming_practice = pg_query_params($con, $query_farming_practice, array(
            $farming_practice_type, $farming_practice_name, $farming_practice_description
        ));

        if ($query_run_farming_practice) {
            $row_farming_practice = pg_fetch_row($query_run_farming_practice);
            $farming_practice_id = $row_farming_practice[0];
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
                        echo "wala na upload ang image";
                        echo "Error: " . pg_last_error($con);
                        die();
                    }

                    $finalimg = $image;
                    $imageNamesArray[] = $finalimg; // Add image name to the array
                } else {
                    // Display error message for invalid file format
                    echo "invalid ang file format image";
                    echo "Error: " . pg_last_error($con);
                    die();
                }
            }
        } else {
            // Don't upload image and set the image value as blank
            echo "wala image na select";
            echo "Error: " . pg_last_error($con);
            die();
        }
        
        $imageNamesString = implode(',', $imageNamesArray);
        $user_id = $_POST['user_id'];
        $status = 'approved';

        // Inserting into Crop table using parameterized query
        $query_crop = "INSERT INTO crop (
        crop_image, crop_name, crop_description, upland_or_lowland, category, crop_local_name,
        planting_techniques, cultural_and_spiritual_significance, role_in_maintaining_upland_ecosystem,
        cultural_importance_and_traditional_knowledge, unique_features, cultural_use, associated_vegetation,
        threats, user_id, status
        ) VALUES (
            $1, $2, $3, $4, $5, $6, $7, $8, $9, $10,
            $11, $12, $13, $14, $15, $16
        ) RETURNING crop_id";

        $stmt_crop = pg_prepare($con, "insert_crop", $query_crop);
        $query_run_crop = pg_execute($con, "insert_crop", array(
            $imageNamesString,
            handleEmpty($_POST['crop_name']),
            handleEmpty($_POST['crop_description']),
            handleEmpty($_POST['upland_or_lowland']),
            handleEmpty($_POST['category']),
            handleEmpty($_POST['crop_local_name']),
            handleEmpty($_POST['planting_techniques']),
            handleEmpty($_POST['cultural_and_spiritual_significance']),
            handleEmpty($_POST['role_in_maintaining_upland_ecosystem']),
            handleEmpty($_POST['cultural_importance_and_traditional_knowledge']),
            handleEmpty($_POST['unique_features']),
            handleEmpty($_POST['cultural_use']),
            handleEmpty($_POST['associated_vegetation']),
            handleEmpty($_POST['threats']),
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

        // Inserting into crop_characteristics table using parameterized query
        $query_crop_characteristics = "INSERT INTO crop_characteristics (crop_id, characteristics_id) VALUES ($1, $2) RETURNING crop_characteristics_id";
        $stmt_crop_characteristics = pg_prepare($con, "insert_crop_characteristics", $query_crop_characteristics);
        $query_run_crop_characteristics = pg_execute($con, "insert_crop_characteristics", array(
            $crop_id, $characteristics_id
        ));

        if ($query_run_crop_characteristics) {
            $row_crop_characteristics = pg_fetch_row($query_run_crop_characteristics);
            $crop_characteristics_id = $row_crop_characteristics[0];
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
        $query_combine_crop = "UPDATE crop SET crop_location_id = $1, crop_farming_practice_id = $2, crop_other_info_id = $3, crop_characteristics_id = $4 WHERE crop_id = $5 RETURNING crop_id";

        $stmt_combine_crop = pg_prepare($con, "update_combine_crop", $query_combine_crop);
        $query_run_combine_crop = pg_execute($con, "update_combine_crop", array(
            $crop_location_id, $crop_farming_practice_id, $crop_other_info_id, $crop_characteristics_id, $crop_id
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
    if (isset($_POST['save']) && $_SESSION['rank'] == 'admin') {
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
            $farming_practice_type = handleEmpty($_POST['farming_practice_type']);
            $farming_practice_name = handleEmpty($_POST['farming_practice_name']);
            $farming_practice_description = handleEmpty($_POST['farming_practice_description']);

            // Inserting into location table using parameterized query
            $query_farming_practice = "INSERT INTO farming_practice (farming_practice_type, farming_practice_name, farming_practice_description) 
        VALUES ($1, $2, $3) RETURNING farming_practice_id";

            $query_run_farming_practice = pg_query_params($con, $query_farming_practice, array(
                $farming_practice_type, $farming_practice_name, $farming_practice_description
            ));

            if ($query_run_farming_practice) {
                $row_farming_practice = pg_fetch_row($query_run_farming_practice);
                $farming_practice_id = $row_farming_practice[0];
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
            $user_id = $_POST['user_id'];
            $status = 'pending';
            $crop_name = $_POST['crop_name'];
            $crop_local_name = $_POST['crop_local_name'];
            $category = $_POST['category'];
            $crop_description = $_POST['crop_description'];

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

        $message = "Curator there is a new crop waiting for approval";
        $subject = "Crop Data Approval";
        $recipient = " noel.salazar17.es@gmail.com";

        send_mail($recipient, $subject, $message);
    }
}

if (isset($_POST['update']) && $_SESSION['rank'] == 'curator') {
    // Assuming you have a variable $_POST['crop_id'] containing the ID of the crop to update
    // crops table
    $crop_id = pg_escape_string($con, $_POST['crop_id']);
    $current_crop_image = pg_escape_string($con, $_POST['current_crop_image']);
    $crop_location_id = pg_escape_string($con, $_POST['crop_location_id']);
    $crop_farming_practice_id = pg_escape_string($con, $_POST['crop_farming_practice_id']);
    $crop_other_info_id = pg_escape_string($con, $_POST['crop_other_info_id']);
    $user_id = pg_escape_string($con, $_POST['user_id']);

    $location_id = pg_escape_string($con, $_POST['location_id']);
    $other_info_id = pg_escape_string($con, $_POST['other_info_id']);
    $farming_practice_id = pg_escape_string($con, $_POST['farming_practice_id']);
    $characteristics_id = pg_escape_string($con, $_POST['characteristics_id']);

    $crop_name = pg_escape_string($con, $_POST['crop_name']);
    $crop_description = pg_escape_string($con, $_POST['crop_description']);
    $upland_or_lowland = pg_escape_string($con, $_POST['upland_or_lowland']);
    $crop_local_name = pg_escape_string($con, $_POST['crop_local_name']);
    $category = pg_escape_string($con, $_POST['category']);

    // Function to handle values and ensure they are strings
    function handleValue($value)
    {
        return is_string($value) ? $value : (string) $value;
    }

    // Apply the function to each field
    // crops table
    $crop_name = handleValue($_POST['crop_name']);
    $crop_description = handleValue($_POST['crop_description']);
    $upland_or_lowland = handleValue($_POST['upland_or_lowland']);
    $crop_local_name = handleValue($_POST['crop_local_name']);
    $crop_scientific_name = handleValue($_POST['crop_scientific_name']);
    $category = handleValue($_POST['category']);
    $crop_variety = handleValue($_POST['crop_variety']);
    $crop_origin = handleValue($_POST['crop_origin']);

    // Location Table
    $province_name = handleValue($_POST['province_name']);
    $municipality_name = handleValue($_POST['municipality_name']);
    $latitude = handleValue($_POST['latitude']);
    $longtitude = handleValue($_POST['longtitude']);

    // Update location table
    $query_location = "UPDATE location SET province_name = $1, municipality_name = $2, latitude = $3, longtitude = $4 WHERE location_id = $5";
    $params_location = array($province_name, $municipality_name, $latitude, $longtitude, $location_id);
    $query_run_location = pg_query_params($con, $query_location, $params_location);

    if (!$query_run_location) {
        echo "Error updating location: " . pg_last_error($con);
        exit(0);
    }

    // Other Info Table
    $other_info_type = handleValue($_POST['other_info_type']);
    $other_info_name = handleValue($_POST['other_info_name']);
    $other_info_description = handleValue($_POST['other_info_description']);
    $other_info_url = handleValue($_POST['other_info_url']);

    // Update Other Info table
    $query_other_info = "UPDATE other_info SET other_info_type = $1, other_info_name = $2, other_info_description = $3,
        other_info_url = $4 WHERE other_info_id = $5";
    $params_other_info = array($other_info_type, $other_info_name, $other_info_description, $other_info_url, $other_info_id);
    $query_run_other_info = pg_query_params($con, $query_other_info, $params_other_info);

    if (!$query_run_other_info) {
        echo "Error updating other_info: " . pg_last_error($con);
        exit(0);
    }
    // Farming Practice Table
    $farming_practice_type = handleValue($_POST['farming_practice_type']);
    $farming_practice_name = handleValue($_POST['farming_practice_name']);
    $farming_practice_description = handleValue($_POST['farming_practice_description']);

    // Update Farming Practice table
    $query_farm_prac = "UPDATE farming_practice SET farming_practice_type = $1, farming_practice_name = $2, farming_practice_description = $3 WHERE farming_practice_id = $4";
    $params_farm_prac = array($farming_practice_type, $farming_practice_name, $farming_practice_description, $farming_practice_id);
    $query_run_farm_prac = pg_query_params($con, $query_farm_prac, $params_farm_prac);

    if (!$query_run_farm_prac) {
        echo "Error updating Farming Practice: " . pg_last_error($con);
        exit(0);
    }

    // Function to generate a unique image name
    function generate_unique_image_name($ext)
    {
        return "Crop_Image_" . rand(000, 999) . '.' . $ext;
    }

    if (isset($_FILES['crop_image']['name'][0]) && is_array($_FILES['crop_image']['name']) && $_FILES['crop_image']['name'][0] != "") {
        $extension = array('jpg', 'jpeg', 'png', 'gif');
        $uploadedImages = array();

        foreach ($_FILES['crop_image']['name'] as $key => $value) {
            $filename = $_FILES['crop_image']['name'][$key];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);

            if (in_array($ext, $extension)) {
                // Auto rename image
                $image = generate_unique_image_name($ext);

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
                        $image = generate_unique_image_name($ext);
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

                $uploadedImages[] = $image; // Add image name to the array

            } else {
                // Display error message for invalid file format
            }
        }

        // Remove the current images if available
        $currentImages = explode(',', $current_crop_image);
        foreach ($currentImages as $current) {
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

        $finalimg = implode(',', $uploadedImages);
    } else {
        // No new images selected, use the current ones
        $finalimg = $current_crop_image;
    }

    // Update Crop table using parameterized query
    $query_crop = "UPDATE crop SET
        crop_name = $1, crop_local_name = $2, crop_scientific_name = $3, crop_description = $4, crop_image = $5, crop_variety = $6,
        crop_origin = $7, upland_or_lowland = $8, category = $9
        WHERE crop_id = $10";

    // Parameters for the query
    $params_crop = array(
        $crop_name, $crop_local_name, $crop_scientific_name, $crop_description, $finalimg, $crop_variety,
        $crop_origin, $upland_or_lowland, $category, $crop_id
    );

    // Prepare the statement
    $query_prepare_crop = pg_prepare($con, "update_crop", $query_crop);

    // Execute the statement with parameters
    $query_run_crop = pg_execute($con, "update_crop", $params_crop);

    if ($query_run_crop) {
        header("Location: crop.php?crop_id=" . $_POST['crop_id']);
        exit(0);
    } else {
        $_SESSION['message'] = "<div class='error'>Crop Update Failed.</div>";
        header("Location: crop.php?crop_id=" . $_POST['crop_id']);
        exit(0);
    }
}

if (isset($_POST['delete']) && $_SESSION['rank'] == 'curator') {
    $crop_id = $_POST['crop_id'];
    $current_crop_image = $_POST['current_crop_image'];
    $crop_location_id = $_POST['crop_location_id'];
    $crop_farming_practice_id = $_POST['crop_farming_practice_id'];
    $crop_other_info_id = $_POST['crop_other_info_id'];

    $location_id = $_POST['location_id'];
    $farming_practice_id = $_POST['farming_practice_id'];
    $other_info_id = $_POST['other_info_id'];

    // Start a database transaction
    pg_query($con, "BEGIN");

    try {
        // Delete from Crop table
        $query_delete_crop = "DELETE FROM crop WHERE crop_id = $1";
        $query_run_delete_crop = pg_query_params($con, $query_delete_crop, [$crop_id]);

        if (!$query_run_delete_crop) {
            throw new Exception("Failed to delete from Crop table");
        }

        // Delete from Crop Location table
        $query_delete_crop_loc = "DELETE FROM crop_location WHERE crop_location_id = $1";
        $query_run_delete_crop_loc = pg_query_params($con, $query_delete_crop_loc, [$crop_location_id]);

        if (!$query_run_delete_crop_loc) {
            throw new Exception("Failed to delete from Crop Location table");
        }

        // Delete from Crop Farming Practice table
        $query_delete_crop_farm = "DELETE FROM crop_farming_practice WHERE crop_farming_practice_id = $1";
        $query_run_delete_crop_farm = pg_query_params($con, $query_delete_crop_farm, [$crop_farming_practice_id]);

        if (!$query_run_delete_crop_farm) {
            throw new Exception("Failed to delete from Crop Farming Practice table");
        }

        // Delete from Crop Othher Info table
        $query_delete_crop_other_info = "DELETE FROM crop_other_info WHERE crop_other_info_id = $1";
        $query_run_delete_crop_other_info = pg_query_params($con, $query_delete_crop_other_info, [$crop_other_info_id]);

        if (!$query_run_delete_crop_other_info) {
            throw new Exception("Failed to delete from Crop Othher Info table");
        }

        // Delete from Location table
        $query_delete_location = "DELETE FROM location WHERE location_id = $1";
        $query_run_delete_location = pg_query_params($con, $query_delete_location, [$location_id]);

        if (!$query_run_delete_location) {
            throw new Exception("Failed to delete from Location table");
        }

        // Delete from Farming Practice table
        $query_delete_farming_practice = "DELETE FROM farming_practice WHERE farming_practice_id = $1";
        $query_run_delete_farming_practice = pg_query_params($con, $query_delete_farming_practice, [$farming_practice_id]);

        if (!$query_run_delete_farming_practice) {
            throw new Exception("Failed to delete from farming_practice table");
        }

        // Delete from Other Info table
        $query_delete_other_info = "DELETE FROM other_info WHERE other_info_id = $1";
        $query_run_delete_other_info = pg_query_params($con, $query_delete_other_info, [$other_info_id]);

        if (!$query_run_delete_other_info) {
            throw new Exception("Failed to delete from Other Info table");
        }

        // If everything is successful, commit the transaction
        pg_query($con, "COMMIT");

        // Check if the current image is available
        if ($current_crop_image != "") {
            // It has images, explode the string into an array
            $imageNames = explode(',', $current_crop_image);

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

        $_SESSION['message'] = "Crop and associated records deleted successfully";
        header("Location: list.php");
        exit(0);
    } catch (Exception $e) {
        // If any step fails, roll back the transaction
        pg_query($con, "ROLLBACK");

        echo "Error: " . $e->getMessage();
        exit(0);
    }
} else {
    $_SESSION['message'] = "Not Enough Authority";
    header("Location: crop.php?crop_id=" . $_POST['crop_id']);
    exit(0);
}
