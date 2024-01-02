<?php
session_start();

$con = pg_connect("host=localhost dbname=farm_crops user=postgres password=123") or die("Could not connect to server\n");

if (isset($_POST['update'])) {
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

    $crop_name = pg_escape_string($con, $_POST['crop_name']);
    $crop_description = pg_escape_string($con, $_POST['crop_description']);
    $upland_or_lowland = pg_escape_string($con, $_POST['upland_or_lowland']);
    $crop_local_name = pg_escape_string($con, $_POST['crop_local_name']);
    $crop_scientific_name = pg_escape_string($con, $_POST['crop_scientific_name']);
    $category = pg_escape_string($con, $_POST['category']);
    $crop_variety = pg_escape_string($con, $_POST['crop_variety']);
    $crop_origin = pg_escape_string($con, $_POST['crop_origin']);

    // Validate data before insertion
    if (empty($crop_name) || empty($crop_local_name) || empty($category) || empty($crop_description) || empty($current_crop_image)) {
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
    $crop_name = handleValue($con, $_POST['crop_name']);
    $crop_description = handleValue($con, $_POST['crop_description']);
    $upland_or_lowland = handleValue($con, $_POST['upland_or_lowland']);
    $crop_local_name = handleValue($con, $_POST['crop_local_name']);
    $crop_scientific_name = handleValue($con, $_POST['crop_scientific_name']);
    $category = handleValue($con, $_POST['category']);
    $crop_variety = handleValue($con, $_POST['crop_variety']);
    $crop_origin = handleValue($con, $_POST['crop_origin']);

    // Location Table
    $province_name = handleValue($_POST['province_name']);
    $municipality_name = handleValue($_POST['municipality_name']);
    $latitude = handleValue($_POST['latitude']);
    $longtitude = handleValue($_POST['longtitude']);

    // Update location table
    $query_location = "UPDATE location SET province_name = $1, municipality_name = $2, latitude = $3,
        longtitude = $4 WHERE location_id = $5";
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
    // Crop Farming Practice Table
    $farming_practice_id = pg_escape_string($con, $_POST['farming_practice_id']);

    // Update Crop Farming Practice table
    $query_crop_farm_prac = "UPDATE crop_farming_practice SET farming_practice_id = $1 WHERE crop_farming_practice_id = $2";
    $params_crop_farm_prac = array($crop_farm_prac_type, $crop_farming_practice_id);
    $query_run_crop_farm_prac = pg_query_params($con, $query_crop_farm_prac, $params_crop_farm_prac);

    if (!$query_run_crop_farm_prac) {
        echo "Error updating crop_farm_prac: " . pg_last_error($con);
        exit(0);
    }

    // Function to generate a unique image name
    function generate_unique_image_name($ext)
    {
        return "Crop_Image_" . rand(000, 999) . '.' . $ext;
    }

    // Check if the image files are selected
    if (!empty($_FILES['crop_image']['name'])) {
        $images = $_FILES['crop_image'];

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
                $query = "SELECT crop_image FROM crop WHERE crop_image = $1";
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

        $imageName = explode(',', $current_crop_image);

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
        $uploadedImages = explode(',', $current_crop_image);
    }

    $finalimg = implode(',', $uploadedImages);

    // Update Crop table using parameterized query
    $query_crop = "UPDATE crops SET
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
        $_SESSION['message'] = "Crop Updated Successfully";
        header("Location: crop.php?crop_id=" . $_POST['crop_id']);
        exit(0);
    } else {
        echo "Error: " . pg_last_error($con);
        exit(0);
    }
}
