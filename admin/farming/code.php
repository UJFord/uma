<?php
session_start();

$con = pg_connect("host=localhost dbname=farm_crops user=postgres password=123") or die("Could not connect to server\n");

if (isset($_POST['save'])) {
    // Inserting into Ritual table
    $query = "INSERT INTO farming 
        (farming_name, description, image, importance, role_in_maintaning_upland_ecosystem, timing, benefits, environmental_impacts,
        considerations, sustainable_practices, history_development, construction_and_maintenance, challenges, principles, other_info) 
        VALUES 
        ('{$_POST['farming_name']}', '{$_POST['description']}', '{$_POST['image']}', '{$_POST['importance']}', '{$_POST['role_in_maintaning_upland_ecosystem']}',
        '{$_POST['timing']}', '{$_POST['benefits']}', '{$_POST['environmental_impacts']}', '{$_POST['considerations']}'
        , '{$_POST['sustainable_practices']}', '{$_POST['history_development']}', '{$_POST['construction_and_maintenance']}'
        , '{$_POST['challenges']}', '{$_POST['principles']}', '{$_POST['other_info']}') 
        RETURNING farming_id";

    $query_run = pg_query($con, $query);

    if ($query_run) {
        $row = pg_fetch_row($query_run);
        $farming_id = $row[0];

        $_SESSION['message'] = "farming Created Successfully";
        header("Location: list.php");
        exit(0);
    } else {
        echo "Error: " . pg_last_error($con);
        // $_SESSION['message'] = "Tribe Not Created";
        // $_SESSION['message_type'] = 'error';
        // $_SESSION['error_details'] = pg_last_error($con);
        // header("Location: create.php");
        exit(0);
    }
}

if (isset($_POST['update'])) {
    $farming_id = pg_escape_string($con, $_POST['farming_id']);
    $farming_name = pg_escape_string($con, $_POST['farming_name']);
    $description = pg_escape_string($con, $_POST['description']);
    $image = pg_escape_string($con, $_POST['image']);
    $importance = pg_escape_string($con, $_POST['importance']);
    $role_in_maintaning_upland_ecosystem = pg_escape_string($con, $_POST['role_in_maintaning_upland_ecosystem']);
    $timing = pg_escape_string($con, $_POST['timing']);
    $benefits = pg_escape_string($con, $_POST['benefits']);
    $environmental_impacts = pg_escape_string($con, $_POST['environmental_impacts']);
    $considerations = pg_escape_string($con, $_POST['considerations']);
    $sustainable_practices = pg_escape_string($con, $_POST['sustainable_practices']);
    $history_development = pg_escape_string($con, $_POST['history_development']);
    $construction_and_maintenance = pg_escape_string($con, $_POST['construction_and_maintenance']);
    $challenges = pg_escape_string($con, $_POST['challenges']);
    $principles = pg_escape_string($con, $_POST['principles']);
    $other_info = pg_escape_string($con, $_POST['other_info']);

    $query = "UPDATE farming SET 
            farming_name = '$farming_name',
            description = '$description',
            image = '$image',
            importance = '$importance',
            role_in_maintaning_upland_ecosystem = '$role_in_maintaning_upland_ecosystem',
            timing = '$timing',
            benefits = '$benefits',
            environmental_impacts = '$environmental_impacts',
            considerations = '$considerations',
            sustainable_practices = '$sustainable_practices',
            history_development = '$history_development',
            construction_and_maintenance = '$construction_and_maintenance',
            challenges = '$challenges',
            principles = '$principles',
            other_info = '$other_info'
            WHERE farming_id = $farming_id";

    $query_run = pg_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Farming Updated Successfully";
        header("Location: farming.php?farming_id=" . $_POST['farming_id']);
        exit(0);
    } else {
        echo "Error: " . pg_last_error($con);
        // $_SESSION['message'] = "Ritual Not Updated";
        // $_SESSION['message_type'] = 'error';
        // $_SESSION['error_details'] = pg_last_error($con);
        // header("Location: ritual.php?farming_id=" . $_POST['farming_id']);
        exit(0);
    }
}

if (isset($_POST['delete'])) {
    $farming_id = pg_escape_string($con, $_POST['farming_id']);
    $query = "DELETE FROM farming WHERE farming_id='$farming_id'";
    $query_run = pg_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Farming Deleted Successfully";
        header("Location: list.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Farming Deletion Failed";
        $_SESSION['message_type'] = 'error';
        $_SESSION['error_details'] = pg_last_error($con);
        header("Location: farming.php?farming_id=" . $_POST['farming_id']);
        exit(0);
    }
}
?>
