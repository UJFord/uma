<?php

session_start();

$con = pg_connect("host=localhost dbname=farm_crops user=postgres password=123") or die("Could not connect to server\n");

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
