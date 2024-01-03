<?php
session_start();

$con = pg_connect("host=localhost dbname=farm_crops user=postgres password=123") or die("Could not connect to server\n");
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['delete'])) {
    $crop_id = $_POST['crop_id'];
    $current_crop_image = $_POST['current_crop_image'];
    $crop_location_id = $_POST['crop_location_id'];
    $crop_farming_practice_id = $_POST['crop_farming_practice_id'];
    $crop_other_info_id = $_POST['crop_other_info_id'];

    $location_id = $_POST['location_id'];
    $farming_practice_id = $_POST['farming_practice_id'];
    $other_info_id = $_POST['crop_other_info_id'];

    // Validation Checks
    if (empty($crop_id) || empty($current_crop_image) || empty($crop_location_id) || empty($crop_farming_practice_id) || empty($crop_other_info_id)) {
        // Handle the case where parameters are missing
        $_SESSION['message'] = "Some data is missing cannot proceed";
        header("location: crop.php?crop_id=" . $crop_id);
        exit(0);
    }

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
}
