<?php
session_start();

$con = pg_connect("host=localhost dbname=farm_crops user=postgres password=123") or die("Could not connect to server\n");

if (isset($_POST['update']) && $_SESSION['rank'] == 'curator') {
    $user_id = pg_escape_string($con, $_POST['user_id']);
    $current_account_type_id = pg_escape_string($con, $_POST['current_account_type_id']);
    $first_name = pg_escape_string($con, $_POST['first_name']);
    $last_name = pg_escape_string($con, $_POST['last_name']);
    $gender = pg_escape_string($con, $_POST['gender']);
    $email = pg_escape_string($con, $_POST['email']);
    $username = pg_escape_string($con, $_POST['username']);
    $affiliation = pg_escape_string($con, $_POST['affiliation']);

    if (isset($_POST['account_type_id']) && $_POST['account_type_id'] !== "") {
        $account_type_id = pg_escape_string($con, $_POST['account_type_id']);
    } else {
        $account_type_id = $current_account_type_id;
    }


    $query_user = "UPDATE users SET first_name = $1, last_name = $2, gender = $3, email = $4, username = $5, affiliation = $6, account_type_id = $7 WHERE user_id = $8";
    $params_user = array($first_name, $last_name, $gender, $email, $username, $affiliation, $account_type_id, $user_id);
    $query_run_user = pg_query_params($con, $query_user, $params_user);

    if ($query_run_user) {
        header("location: user.php?user_id=" . $_POST['user_id']);
        exit();
    } else {
        echo "Error: " . pg_last_error($con);
        exit(0);
    }
}

if (isset($_POST['delete']) && $_SESSION['rank'] == 'curator') {
    $user_id = $_POST['user_id'];

    // Update related records in the "crop" table
    $query_update_crop = "UPDATE crop SET user_id = NULL WHERE user_id = $1";
    $query_run_update_crop = pg_query_params($con, $query_update_crop, [$user_id]);

    // Check if the update query was successful
    if ($query_run_update_crop) {
        // Proceed with the user deletion
        $query_delete_user = "DELETE FROM users WHERE user_id = $1";
        $query_run_delete_user = pg_query_params($con, $query_delete_user, [$user_id]);

        // Check if the user deletion query was successful
        if ($query_run_delete_user) {
            $_SESSION['message'] = "User Deleted.";
            header("location: list.php");
            exit();
        } else {
            echo "Error deleting user: " . pg_last_error($con);
            exit();
        }
    } else {
        echo "Error updating related records: " . pg_last_error($con);
        exit();
    }
}
