<?php
session_start();

$con = pg_connect("host=localhost dbname=farm_crops user=postgres password=123") or die("Could not connect to server\n");

if (isset($_POST['save'])) {
    // Escape user inputs for data in Tribe table
    $tribe_name = empty($_POST['tribe_name']) ? 'NULL' : "'" . $_POST['tribe_name'] . "'";
    $image = empty($_POST['image']) ? 'NULL' : "'" . $_POST['image'] . "'";
    $location = empty($_POST['location']) ? 'NULL' : "'" . $_POST['location'] . "'";
    $language_and_dialect = empty($_POST['language_and_dialect']) ? 'NULL' : "'" . $_POST['language_and_dialect'] . "'";
    $population = empty($_POST['population']) ? 'NULL' : "'" . $_POST['population'] . "'";
    $livelihood_and_practices = empty($_POST['livelihood_and_practices']) ? 'NULL' : "'" . $_POST['livelihood_and_practices'] . "'";
    $farming_practices = empty($_POST['farming_practices']) ? 'NULL' : "'" . $_POST['farming_practices'] . "'";
    $social_structure_and_kinship_system = empty($_POST['social_structure_and_kinship_system']) ? 'NULL' : "'" . $_POST['social_structure_and_kinship_system'] . "'";
    $beliefs_and_customs = empty($_POST['beliefs_and_customs']) ? 'NULL' : "'" . $_POST['beliefs_and_customs'] . "'";
    $challenges_and_threats = empty($_POST['challenges_and_threats']) ? 'NULL' : "'" . $_POST['challenges_and_threats'] . "'";
    $efforts_of_revitalization = empty($_POST['efforts_of_revitalization']) ? 'NULL' : "'" . $_POST['efforts_of_revitalization'] . "'";
    $other_info = empty($_POST['other_info']) ? 'NULL' : "'" . $_POST['other_info'] . "'";

    // Inserting into tribe table
    $query = "INSERT INTO tribe 
        (tribe_name, image, location, language_and_dialect, population, livelihood_and_practices, farming_practices,
        social_structure_and_kinship_system, beliefs_and_customs, challenges_and_threats, efforts_of_revitalization,
        other_info) 
        VALUES 
        ($tribe_name, $image, $location, $language_and_dialect,
        $population, $livelihood_and_practices, $farming_practices,
        $social_structure_and_kinship_system, $beliefs_and_customs, $challenges_and_threats,
        $efforts_of_revitalization, $other_info) 
        RETURNING tribe_id";

    $query_run = pg_query($con, $query);

    if ($query_run) {
        $row = pg_fetch_row($query_run);
        $tribe_id = $row[0];

        $_SESSION['message'] = "Tribe Created Successfully";
        header("Location: list.php");
        exit(0);
    } else {
        echo "Error: " . pg_last_error($con);
        // Handle the error, if needed
        exit(0);
    }
}

if (isset($_POST['update'])) {
    $tribe_id = pg_escape_string($con, $_POST['tribe_id']);
    $tribe_name = pg_escape_string($con, $_POST['tribe_name']);
    $image = pg_escape_string($con, $_POST['image']);
    $location = pg_escape_string($con, $_POST['location']);
    $language_and_dialect = pg_escape_string($con, $_POST['language_and_dialect']);
    $population = pg_escape_string($con, $_POST['population']);
    $livelihood_and_practices = pg_escape_string($con, $_POST['livelihood_and_practices']);
    $farming_practices = pg_escape_string($con, $_POST['farming_practices']);
    $social_structure_and_kinship_system = pg_escape_string($con, $_POST['social_structure_and_kinship_system']);
    $beliefs_and_customs = pg_escape_string($con, $_POST['beliefs_and_customs']);
    $challenges_and_threats = pg_escape_string($con, $_POST['challenges_and_threats']);
    $efforts_of_revitalization = pg_escape_string($con, $_POST['efforts_of_revitalization']);
    $other_info = pg_escape_string($con, $_POST['other_info']);

    // Function to wrap non-empty values in single quotes and handle empty values
    function handleValue($value) {
        if ($value === '') {
            return 'NULL';  // Set to NULL if empty
        } else {
            return "'" . $value . "'";  // Wrap in single quotes for non-empty values
        }
    }

    // Apply the function to each field
    $tribe_name = handleValue($tribe_name);
    $image = handleValue($image);
    $location = handleValue($location);
    $language_and_dialect = handleValue($language_and_dialect);
    $population = handleValue($population);
    $livelihood_and_practices = handleValue($livelihood_and_practices);
    $farming_practices = handleValue($farming_practices);
    $social_structure_and_kinship_system = handleValue($social_structure_and_kinship_system);
    $beliefs_and_customs = handleValue($beliefs_and_customs);
    $challenges_and_threats = handleValue($challenges_and_threats);
    $efforts_of_revitalization = handleValue($efforts_of_revitalization);
    $other_info = handleValue($other_info);

    $query = "UPDATE tribe SET 
            tribe_name = $tribe_name,
            image = $image,
            location = $location,
            language_and_dialect = $language_and_dialect,
            population = $population,
            livelihood_and_practices = $livelihood_and_practices,
            farming_practices = $farming_practices,
            social_structure_and_kinship_system = $social_structure_and_kinship_system,
            beliefs_and_customs = $beliefs_and_customs,
            challenges_and_threats = $challenges_and_threats,
            efforts_of_revitalization = $efforts_of_revitalization,
            other_info = $other_info
            WHERE tribe_id = $tribe_id";

    $query_run = pg_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Tribe Updated Successfully";
        header("Location: tribe.php?tribe_id=" . $_POST['tribe_id']); // Assuming your update page is named 'update.php'
        exit(0);
    } else {
        // echo "Error: " . pg_last_error($con);
        $_SESSION['message'] = "Tribe Not Updated";
        $_SESSION['message_type'] = 'error';
        $_SESSION['error_details'] = pg_last_error($con);
        header("Location: tribe.php");
        exit(0);
    }
}

if (isset($_POST['delete'])) {
    $tribe_id = pg_escape_string($con, $_POST['tribe_id']);
    $query = "DELETE FROM tribe WHERE tribe_id='$tribe_id'";
    $query_run = pg_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Agronomic Information Deleted Successfully";
        header("Location: list.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Agronomic Information Deletion Failed";
        $_SESSION['message_type'] = 'error';
        $_SESSION['error_details'] = pg_last_error($con);
        header("Location: tribe.php?tribe_id=" . $_POST['tribe_id']);
        exit(0);
    }
}
