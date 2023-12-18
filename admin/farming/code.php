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
    $farming_name = $_POST['farming_name'];
    $description = $_POST['description'];
    $image = $_POST['image'];
    $importance = $_POST['importance'];
    $role_in_maintaining_upland_ecosystem = $_POST['role_in_maintaining_upland_ecosystem'];
    $timing = $_POST['timing'];
    $benefits = $_POST['benefits'];
    $environmental_impacts = $_POST['environmental_impacts'];
    $considerations = $_POST['considerations'];
    $sustainable_practices = $_POST['sustainable_practices'];
    $history_development = $_POST['history_development'];
    $construction_and_maintenance = $_POST['construction_and_maintenance'];
    $challenges = $_POST['challenges'];
    $principles = $_POST['principles'];
    $other_info = $_POST['other_info'];

    // Function to handle empty values and NULL values
    function handleValue($value)
    {
        return $value === '' ? 'Empty' : $value;
    }

    // Apply the function to each field
    $farming_name = handleValue($farming_name);
    $description = handleValue($description);
    $image = handleValue($image);
    $importance = handleValue($importance);
    $role_in_maintaining_upland_ecosystem = handleValue($role_in_maintaining_upland_ecosystem);
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

    // Update query with parameterized values
    $query = "UPDATE farming SET 
        farming_name = $1,
        description = $2,
        image = $3,
        importance = $4,
        role_in_maintaining_upland_ecosystem = $5,
        timing = $6,
        benefits = $7,
        environmental_impacts = $8,
        considerations = $9,
        sustainable_practices = $10,
        history_development = $11,
        construction_and_maintenance = $12,
        challenges = $13,
        principles = $14,
        other_info = $15
        WHERE farming_id = $16";

    // Execute parameterized query
    $query_run = pg_query_params($con, $query, array(
        $farming_name, $description, $image, $importance, $role_in_maintaining_upland_ecosystem, $timing,
        $benefits, $environmental_impacts, $considerations, $sustainable_practices, $history_development,
        $construction_and_maintenance, $challenges, $principles, $other_info, $farming_id
    ));

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
