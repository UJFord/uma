<?php
session_start();

$con = pg_connect("host=localhost dbname=farm_crops user=postgres password=123") or die("Could not connect to server\n");

if (isset($_POST['save'])) {
    // Escape user inputs for data in Ritual table
    $ritual_name = empty($_POST['ritual_name']) ? 'NULL' : "'" . $_POST['ritual_name'] . "'";
    $description = empty($_POST['description']) ? 'NULL' : "'" . $_POST['description'] . "'";
    $image = empty($_POST['image']) ? 'NULL' : "'" . $_POST['image'] . "'";
    $purpose = empty($_POST['purpose']) ? 'NULL' : "'" . $_POST['purpose'] . "'";
    $timing = empty($_POST['timing']) ? 'NULL' : "'" . $_POST['timing'] . "'";
    $participants = empty($_POST['participants']) ? 'NULL' : "'" . $_POST['participants'] . "'";
    $items_used = empty($_POST['items_used']) ? 'NULL' : "'" . $_POST['items_used'] . "'";
    $other_info = empty($_POST['other_info']) ? 'NULL' : "'" . $_POST['other_info'] . "'";

    // Inserting into Ritual table
    $query = "INSERT INTO ritual 
        (ritual_name, description, image, purpose, timing, participants, items_used, other_info) 
        VALUES 
        ($ritual_name, $description, $image, $purpose, $timing, $participants, $items_used, $other_info) 
        RETURNING ritual_id";

    $query_run = pg_query($con, $query);

    if ($query_run) {
        $row = pg_fetch_row($query_run);
        $ritual_id = $row[0];

        $_SESSION['message'] = "ritual Created Successfully";
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
    $ritual_id = pg_escape_string($con, $_POST['ritual_id']);
    $description = pg_escape_string($con, $_POST['description']);
    $ritual_name = pg_escape_string($con, $_POST['ritual_name']);
    $image = pg_escape_string($con, $_POST['image']);
    $purpose = pg_escape_string($con, $_POST['purpose']);
    $timing = pg_escape_string($con, $_POST['timing']);
    $participants = pg_escape_string($con, $_POST['participants']);
    $items_used = pg_escape_string($con, $_POST['items_used']);
    $other_info = pg_escape_string($con, $_POST['other_info']);

    // Function to wrap non-empty values in single quotes and handle empty values
    function handleValue($value)
    {
        if ($value === '') {
            return 'NULL';  // Set to NULL if empty
        } else {
            return "'" . $value . "'";  // Wrap in single quotes for non-empty values
        }
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

    $query = "UPDATE ritual SET 
            ritual_name = $ritual_name,
            description = $description,
            image = $image,
            purpose = $purpose,
            timing = $timing,
            participants = $participants,
            items_used = $items_used,
            other_info = $other_info
            WHERE ritual_id = $ritual_id";

    $query_run = pg_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Ritual Updated Successfully";
        header("Location: ritual.php?ritual_id=" . $_POST['ritual_id']);
        exit(0);
    } else {
        // echo "Error: " . pg_last_error($con);
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
