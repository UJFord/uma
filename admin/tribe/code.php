<?php
session_start();

$con = pg_connect("host=localhost dbname=farm_crops user=postgres password=123") or die("Could not connect to server\n");

if (isset($_POST['save'])) {
    // Function to handle NULL values and escape single quotes
    function handleValue($value)
    {
        if ($value === '' || $value === 'NULL') {
            $emptyValue = "'Empty'";
            return $emptyValue; // Set to the string "Empty" if empty or NULL
        } else {
            return pg_escape_literal($value);  // Use pg_escape_literal for proper handling of single quotes
        }
    }

    // Escape user inputs for data in Tribe table
    $tribe_name = handleValue($_POST['tribe_name']);
    $image = handleValue($_POST['image']);
    $location = handleValue($_POST['location']);
    $language_and_dialect = handleValue($_POST['language_and_dialect']);
    $population = handleValue($_POST['population']);
    $livelihood_and_practices = handleValue($_POST['livelihood_and_practices']);
    $farming_practices = handleValue($_POST['farming_practices']);
    $social_structure_and_kinship_system = handleValue($_POST['social_structure_and_kinship_system']);
    $beliefs_and_customs = handleValue($_POST['beliefs_and_customs']);
    $challenges_and_threats = handleValue($_POST['challenges_and_threats']);
    $efforts_of_revitalization = handleValue($_POST['efforts_of_revitalization']);
    $other_info = handleValue($_POST['other_info']);

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
    $tribe_name = $_POST['tribe_name'];
    $image = $_POST['image'];
    $location = $_POST['location'];
    $language_and_dialect = $_POST['language_and_dialect'];
    $population = $_POST['population'];
    $livelihood_and_practices = $_POST['livelihood_and_practices'];
    $farming_practices = $_POST['farming_practices'];
    $social_structure_and_kinship_system = $_POST['social_structure_and_kinship_system'];
    $beliefs_and_customs = $_POST['beliefs_and_customs'];
    $challenges_and_threats = $_POST['challenges_and_threats'];
    $efforts_of_revitalization = $_POST['efforts_of_revitalization'];
    $other_info = $_POST['other_info'];

    // Function to handle empty values
    function handleValue($value)
    {
        return $value === '' ? 'Empty' : $value;
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

    // Update query with parameterized values
    $query = "UPDATE tribe SET 
            tribe_name = $1,
            image = $2,
            location = $3,
            language_and_dialect = $4,
            population = $5,
            livelihood_and_practices = $6,
            farming_practices = $7,
            social_structure_and_kinship_system = $8,
            beliefs_and_customs = $9,
            challenges_and_threats = $10,
            efforts_of_revitalization = $11,
            other_info = $12
            WHERE tribe_id = $13";

    // Execute parameterized query
    $query_run = pg_query_params($con, $query, array(
        $tribe_name, $image, $location, $language_and_dialect, $population, $livelihood_and_practices,
        $farming_practices, $social_structure_and_kinship_system, $beliefs_and_customs, $challenges_and_threats,
        $efforts_of_revitalization, $other_info, $tribe_id
    ));

    if ($query_run) {
        $_SESSION['message'] = "Tribe Updated Successfully";
        header("Location: tribe.php?tribe_id=" . $_POST['tribe_id']);
        exit(0);
    } else {
        echo "Error: " . pg_last_error($con);
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
