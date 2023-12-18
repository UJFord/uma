<?php
session_start();

$con = pg_connect("host=localhost dbname=farm_crops user=postgres password=123") or die("Could not connect to server\n");

if (isset($_POST['save'])) {
    // Escape user inputs for data in Ritual table
    $emptyValue = 'Empty';

    $ritual_name = empty($_POST['ritual_name']) ? $emptyValue : $_POST['ritual_name'];
    $description = empty($_POST['description']) ? $emptyValue : $_POST['description'];
    $image = empty($_POST['image']) ? $emptyValue : $_POST['image'];
    $purpose = empty($_POST['purpose']) ? $emptyValue : $_POST['purpose'];
    $timing = empty($_POST['timing']) ? $emptyValue : $_POST['timing'];
    $participants = empty($_POST['participants']) ? $emptyValue : $_POST['participants'];
    $items_used = empty($_POST['items_used']) ? $emptyValue : $_POST['items_used'];
    $other_info = empty($_POST['other_info']) ? $emptyValue : $_POST['other_info'];

    // Inserting into Ritual table using parameterized query
    $query = "INSERT INTO ritual 
        (ritual_name, description, image, purpose, timing, participants, items_used, other_info) 
        VALUES 
        ($1, $2, $3, $4, $5, $6, $7, $8) 
        RETURNING ritual_id";

    $result = pg_prepare($con, "insert_ritual", $query);

    if ($result) {
        $query_run = pg_execute($con, "insert_ritual", array(
            $ritual_name,
            $description,
            $image,
            $purpose,
            $timing,
            $participants,
            $items_used,
            $other_info
        ));

        if ($query_run) {
            $row = pg_fetch_row($query_run);
            $ritual_id = $row[0];

            $_SESSION['message'] = "ritual Created Successfully";
            header("Location: list.php");
            exit(0);
        } else {
            echo "Error: " . pg_last_error($con);
            // Handle the error, if needed
            exit(0);
        }
    } else {
        echo "Error preparing query: " . pg_last_error($con);
        // Handle the error, if needed
        exit(0);
    }
}

if (isset($_POST['update'])) {
    $ritual_id = pg_escape_string($con, $_POST['ritual_id']);
    $description = $_POST['description'];
    $ritual_name = $_POST['ritual_name'];
    $image = $_POST['image'];
    $purpose = $_POST['purpose'];
    $timing = $_POST['timing'];
    $participants = $_POST['participants'];
    $items_used = $_POST['items_used'];
    $other_info = $_POST['other_info'];

    // Function to handle empty values
    function handleValue($value)
    {
        return $value === '' ? 'Empty' : $value;
    }

    // Apply the function to each field
    $ritual_name = handleValue($ritual_name);
    $description = handleValue($description);
    $image = handleValue($image);
    $purpose = handleValue($purpose);
    $timing = handleValue($timing);
    $participants = handleValue($participants);
    $items_used = handleValue($items_used);
    $other_info = handleValue($other_info);

    // Update query with parameterized values
    $query = "UPDATE ritual SET 
            ritual_name = $1,
            description = $2,
            image = $3,
            purpose = $4,
            timing = $5,
            participants = $6,
            items_used = $7,
            other_info = $8
            WHERE ritual_id = $9";

    // Execute parameterized query
    $query_run = pg_query_params($con, $query, array(
        $ritual_name, $description, $image, $purpose, $timing, $participants, $items_used, $other_info, $ritual_id
    ));

    if ($query_run) {
        $_SESSION['message'] = "Ritual Updated Successfully";
        header("Location: ritual.php?ritual_id=" . $_POST['ritual_id']);
        exit(0);
    } else {
        $_SESSION['message'] = "Ritual Not Updated";
        $_SESSION['message_type'] = 'error';
        $_SESSION['error_details'] = pg_last_error($con);
        header("Location: ritual.php?ritual_id=" . $_POST['ritual_id']);
        exit(0);
    }
}

if (isset($_POST['delete'])) {
    $ritual_id = pg_escape_string($con, $_POST['ritual_id']);
    $query = "DELETE FROM ritual WHERE ritual_id='$ritual_id'";
    $query_run = pg_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Ritual Deleted Successfully";
        header("Location: list.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Ritual Deletion Failed";
        $_SESSION['message_type'] = 'error';
        $_SESSION['error_details'] = pg_last_error($con);
        header("Location: ritual.php?ritual_id=" . $_POST['ritual_id']);
        exit(0);
    }
}
