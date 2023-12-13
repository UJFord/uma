<?php
session_start();

$con = pg_connect("host=localhost dbname=farm_crops user=postgres password=123") or die("Could not connect to server\n");

if (isset($_POST['save'])) {
    // Escape user inputs for data in Farming table
    $farming_name = empty($_POST['farming_name']) ? 'NULL' : "'" . $_POST['farming_name'] . "'";
    $description = empty($_POST['description']) ? 'NULL' : "'" . $_POST['description'] . "'";
    $image = empty($_POST['image']) ? 'NULL' : "'" . $_POST['image'] . "'";
    $importance = empty($_POST['importance']) ? 'NULL' : "'" . $_POST['importance'] . "'";
    $role_in_maintaning_upland_ecosystem = empty($_POST['role_in_maintaning_upland_ecosystem']) ? 'NULL' : "'" . $_POST['role_in_maintaning_upland_ecosystem'] . "'";
    $timing = empty($_POST['timing']) ? 'NULL' : "'" . $_POST['timing'] . "'";
    $benefits = empty($_POST['benefits']) ? 'NULL' : "'" . $_POST['benefits'] . "'";
    $environmental_impacts = empty($_POST['environmental_impacts']) ? 'NULL' : "'" . $_POST['environmental_impacts'] . "'";
    $considerations = empty($_POST['considerations']) ? 'NULL' : "'" . $_POST['considerations'] . "'";
    $sustainable_practices = empty($_POST['sustainable_practices']) ? 'NULL' : "'" . $_POST['sustainable_practices'] . "'";
    $history_development = empty($_POST['history_development']) ? 'NULL' : "'" . $_POST['history_development'] . "'";
    $construction_and_maintenance = empty($_POST['construction_and_maintenance']) ? 'NULL' : "'" . $_POST['construction_and_maintenance'] . "'";
    $challenges = empty($_POST['challenges']) ? 'NULL' : "'" . $_POST['challenges'] . "'";
    $principles = empty($_POST['principles']) ? 'NULL' : "'" . $_POST['principles'] . "'";
    $other_info = empty($_POST['other_info']) ? 'NULL' : "'" . $_POST['other_info'] . "'";

    // Inserting into Farming table
    $query = "INSERT INTO farming 
    (farming_name, description, image, importance, role_in_maintaning_upland_ecosystem, timing, benefits, environmental_impacts,
    considerations, sustainable_practices, history_development, construction_and_maintenance, challenges, principles, other_info) 
    VALUES 
    ($farming_name, $description, $image, $importance, $role_in_maintaning_upland_ecosystem, $timing, $benefits, $environmental_impacts,
    $considerations, $sustainable_practices, $history_development, $construction_and_maintenance, $challenges,
    $principles, $other_info) 
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

    // Function to wrap non-empty values in single quotes and handle empty values
    function handleValue($value)
    {
        if ($value === '') {
            return 'NULL';  // Set to NULL if empty
        } else {
            return pg_escape_literal($value);  // Wrap in single quotes for non-empty values
        }
    }

    // Apply the function to each field
    $farming_name = handleValue($farming_name);
    $description = handleValue($description);
    $image = handleValue($image);
    $importance = handleValue($importance);
    $role_in_maintaning_upland_ecosystem = handleValue($role_in_maintaning_upland_ecosystem);
    $timing = handleValue($timing);
    $benefits = handleValue($benefits);
    $environmental_impacts = handleValue($environmental_impacts);
    $considerations = handleValue($considerations);
    $sustainable_practices = handleValue($sustainable_practices);
    $history_development = handleValue($history_development);
    $construction_and_maintenance = handleValue($construction_and_maintenance);
    $challenges = handleValue($challenges);
    $principles = handleValue($principles);
    $other_info = handleValue($other_info);

    $query = "UPDATE farming SET 
            farming_name = $farming_name,
            description = $description,
            image = $image,
            importance = $importance,
            role_in_maintaning_upland_ecosystem = $role_in_maintaning_upland_ecosystem,
            timing = $timing,
            benefits = $benefits,
            environmental_impacts = $environmental_impacts,
            considerations = $considerations,
            sustainable_practices = $sustainable_practices,
            history_development = $history_development,
            construction_and_maintenance = $construction_and_maintenance,
            challenges = $challenges,
            principles = $principles,
            other_info = $other_info
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
