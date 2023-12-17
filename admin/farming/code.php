<?php
session_start();

$con = pg_connect("host=localhost dbname=farm_crops user=postgres password=123") or die("Could not connect to server\n");

if (isset($_POST['save'])) {
    // Function to handle empty values
    function handleEmpty($value)
    {
        $emptyValue = 'Empty';
        return empty($value) ? $emptyValue : $value;
    }

    // Escape user inputs for data in Farming table
    $farming_name = handleEmpty($_POST['farming_name']);
    $description = handleEmpty($_POST['description']);
    $image = handleEmpty($_POST['image']);
    $importance = handleEmpty($_POST['importance']);
    $role_in_maintaining_upland_ecosystem = handleEmpty($_POST['role_in_maintaining_upland_ecosystem']);
    $timing = handleEmpty($_POST['timing']);
    $benefits = handleEmpty($_POST['benefits']);
    $environmental_impacts = handleEmpty($_POST['environmental_impacts']);
    $considerations = handleEmpty($_POST['considerations']);
    $sustainable_practices = handleEmpty($_POST['sustainable_practices']);
    $history_development = handleEmpty($_POST['history_development']);
    $construction_and_maintenance = handleEmpty($_POST['construction_and_maintenance']);
    $challenges = handleEmpty($_POST['challenges']);
    $principles = handleEmpty($_POST['principles']);
    $other_info = handleEmpty($_POST['other_info']);

    // Prepare the SQL query with placeholders
    $query = "INSERT INTO farming 
    (farming_name, description, image, importance, role_in_maintaining_upland_ecosystem, timing, benefits, environmental_impacts,
    considerations, sustainable_practices, history_development, construction_and_maintenance, challenges, principles, other_info) 
    VALUES 
    ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14, $15) 
    RETURNING farming_id";

    // Prepare the statement
    $stmt = pg_prepare($con, "insert_query", $query);

    if ($stmt) {
        // Bind parameters
        $params = array(
            $farming_name,
            $description,
            $image,
            $importance,
            $role_in_maintaining_upland_ecosystem,
            $timing,
            $benefits,
            $environmental_impacts,
            $considerations,
            $sustainable_practices,
            $history_development,
            $construction_and_maintenance,
            $challenges,
            $principles,
            $other_info
        );

        // Execute the statement
        $result = pg_execute($con, "insert_query", $params);

        if ($result) {
            $row = pg_fetch_row($result);
            $farming_id = $row[0];

            $_SESSION['message'] = "Farming Created Successfully";
            header("Location: list.php");
            exit(0);
        } else {
            echo "Error: " . pg_last_error($con);
            exit(0);
        }
    } else {
        echo "Error preparing statement: " . pg_last_error($con);
        exit(0);
    }

    // Close the database connection
    pg_close($con);
}

if (isset($_POST['update'])) {
    $farming_id = pg_escape_string($con, $_POST['farming_id']);
    $farming_name = pg_escape_string($con, $_POST['farming_name']);
    $description = pg_escape_string($con, $_POST['description']);
    $image = pg_escape_string($con, $_POST['image']);
    $importance = pg_escape_string($con, $_POST['importance']);
    $role_in_maintaining_upland_ecosystem = pg_escape_string($con, $_POST['role_in_maintaining_upland_ecosystem']);
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

    // Function to handle empty values and NULL values
    function handleValue($value)
    {
        if ($value === '') {
            $emptyValue = 'Empty';
            return $emptyValue;  // Set to NULL if empty
        } else {
            return "'" . pg_escape_string($value) . "'";  // Wrap in single quotes and escape for non-empty values
        }
    }

    // Apply the function to each field
    $farming_name = handleValue($_POST['farming_name']);
    $description = handleValue($_POST['description']);
    $image = handleValue($_POST['image']);
    $importance = handleValue($_POST['importance']);
    $role_in_maintaining_upland_ecosystem = handleValue($_POST['role_in_maintaining_upland_ecosystem']);
    $timing = handleValue($_POST['timing']);
    $benefits = handleValue($_POST['benefits']);
    $environmental_impacts = handleValue($_POST['environmental_impacts']);
    $considerations = handleValue($_POST['considerations']);
    $sustainable_practices = handleValue($_POST['sustainable_practices']);
    $history_development = handleValue($_POST['history_development']);
    $construction_and_maintenance = handleValue($_POST['construction_and_maintenance']);
    $challenges = handleValue($_POST['challenges']);
    $principles = handleValue($_POST['principles']);
    $other_info = handleValue($_POST['other_info']);
    $farming_id = handleValue($_POST['farming_id']);

    $query = "UPDATE farming SET 
        farming_name = $farming_name,
        description = $description,
        image = $image,
        importance = $importance,
        role_in_maintaining_upland_ecosystem = $role_in_maintaining_upland_ecosystem,
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
