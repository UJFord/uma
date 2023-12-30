<?php
session_start();
$con = pg_connect("host=localhost dbname=farm_crops user=postgres password=123") or die("Could not connect to server\n");

if (isset($_POST['approve'])) {
    $crop_id = $_POST['crop_id'];
    $select = "UPDATE crops SET status = 'approved' WHERE crop_id = '$crop_id' ";
    $result = pg_query($con, $select);
    if ($result) {
        header("location: approval.php");
        exit; // Ensure that the script stops executing after the redirect header
    } else {
        echo "Error updating record"; // Display an error message if the query fails
    }
}

if (isset($_POST['delete'])) {
    $crop_id = $_POST['crop_id'];
    $select = "DELETE FROM crops WHERE crop_id = '$crop_id' ";
    $result = pg_query($con, $select);

    if ($result) {
        header("location: approval.php");
        exit; // Ensure that the script stops executing after the redirect header
    } else {
        echo "Error deleting record"; // Display an error message if the query fails
    }
}
