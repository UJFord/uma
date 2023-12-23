<?php
session_start();

$con = pg_connect("host=localhost dbname=farm_crops user=postgres password=123") or die("Could not connect to server\n");

if (isset($_POST['save'])) {
    // Escape user inputs for data in Ritual table
    // Function to handle empty values
    function handleEmpty($value)
    {
        $emptyValue = 'Empty';
        return empty($value) ? $emptyValue : $value;
    }

    $emptyValue = 'Empty';

    $ritual_name = empty($_POST['ritual_name']) ? $emptyValue : $_POST['ritual_name'];
    $description = empty($_POST['description']) ? $emptyValue : $_POST['description'];
    $purpose = empty($_POST['purpose']) ? $emptyValue : $_POST['purpose'];
    $timing = empty($_POST['timing']) ? $emptyValue : $_POST['timing'];
    $participants = empty($_POST['participants']) ? $emptyValue : $_POST['participants'];
    $items_used = empty($_POST['items_used']) ? $emptyValue : $_POST['items_used'];
    $other_info = empty($_POST['other_info']) ? $emptyValue : $_POST['other_info'];

    // Check if the image is selected
    if (isset($_FILES['ritual_image']['name'])) {
        // Upload image
        $ritual_image = $_FILES['ritual_image']['name'];

        // Upload the image only if selected
        if ($ritual_image != "") {
            // Auto rename image
            $ext = pathinfo($ritual_image, PATHINFO_EXTENSION);
            $ritual_image = "Ritual_Image_" . rand(000, 999) . '.' . $ext;

            // Check if the image name already exists in the database
            while (true) {
                $query = "SELECT ritual_image FROM ritual WHERE ritual_image = $1";
                $result = pg_query_params($con, $query, array($ritual_image));

                if ($result === false) {
                    break;
                }

                $count = pg_num_rows($result);

                if ($count == 0) {
                    break;
                } else {
                    // If the image name exists, generate a new one
                    $ritual_image = "Ritual_Image_" . rand(000, 999) . '.' . $ext;
                }
            }

            $source_path = $_FILES['ritual_image']['tmp_name'];
            $destination_path = "../img/rituals/" . $ritual_image;

            // Upload the image
            $upload = move_uploaded_file($source_path, $destination_path);

            // Check whether the image is uploaded or not
            if (!$upload) {
                echo "Image uploaded";
                die();
            }
        }
    } else {
        echo 'Image not uploaded';
    }

    // Inserting into Ritual table using parameterized query
    $query = "INSERT INTO ritual 
        (ritual_name, description, ritual_image, purpose, timing, participants, items_used, other_info) 
        VALUES 
        ($1, $2, $3, $4, $5, $6, $7, $8) 
        RETURNING ritual_id";

    $result = pg_prepare($con, "insert_ritual", $query);

    if ($result) {
        $query_run = pg_execute($con, "insert_ritual", array(
            $ritual_name,
            $description,
            $ritual_image,
            $purpose,
            $timing,
            $participants,
            $items_used,
            $other_info
        ));

        if ($query_run) {
            $row = pg_fetch_row($query_run);
            $ritual_id = $row[0];

            // Escape user inputs for data in Farming table
            $farming_name = handleEmpty($_POST['farming_name']);
            $description = handleEmpty($_POST['description']);
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

            // Check if the image is selected
            if (isset($_FILES['image']['name'])) {
                // Upload image
                $image = $_FILES['image']['name'];

                // Upload the image only if selected
                if ($image != "") {
                    // Auto rename image
                    $ext = pathinfo($image, PATHINFO_EXTENSION);
                    $image = "Farming_Image_" . rand(000, 999) . '.' . $ext;

                    // Check if the image name already exists in the database
                    while (true) {
                        $query = "SELECT image FROM farming WHERE image = $1";
                        $result = pg_query_params($con, $query, array($image));

                        if ($result === false) {
                            break;
                        }

                        $count = pg_num_rows($result);

                        if ($count == 0) {
                            break;
                        } else {
                            // If the image name exists, generate a new one
                            $image = "Farming_Image_" . rand(000, 999) . '.' . $ext;
                        }
                    }

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../img/farming/" . $image;

                    // Upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    // Check whether the image is uploaded or not
                    if (!$upload) {
                        $_SESSION['message'] = "Failed to upload image";
                        header("Location: create.php");
                        die();
                    }
                }
            } else {
                // Don't upload image and set the image value as blank
                $image = "";
            }

            // Prepare the SQL query with placeholders
            $query = "INSERT INTO farming 
            (farming_name, description, image, importance, role_in_maintaining_upland_ecosystem, timing, benefits, environmental_impacts,
            considerations, sustainable_practices, history_development, construction_and_maintenance, challenges, principles, other_info, ritual_id) 
            VALUES 
            ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14, $15, $16) 
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
                    $other_info,
                    $ritual_id
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
    $farming_id = pg_escape_string($con, $_POST['farming_id']);
    $farming_name = $_POST['farming_name'];
    $description = $_POST['description'];
    $current_farming_image = $_POST['current_farming_image'];
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

    // Function to generate a unique image name
    function generate_unique_farming_image_name($ext)
    {
        return "Farming_Image" . rand(000, 999) . '.' . $ext;
    }

    // Check if the image is selected or not
    if (isset($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];

        // Check if a new image is available
        if ($image != "") {
            $ext = pathinfo($image, PATHINFO_EXTENSION);
            $image = generate_unique_farming_image_name($ext);

            // Check if the new image name already exists in the database
            $query = "SELECT image FROM farming WHERE image = $1";
            $result = pg_query_params($con, $query, array($image));

            // Check for errors
            if ($result === false) {
                echo "Error: " . pg_last_error($con);
                die();
            }

            $count = pg_num_rows($result);

            if ($count > 0) {
                // If the image name exists, generate a new one
                $image = generate_unique_farming_image_name($ext);
            } else {
                // Upload the new image
                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../img/farming/" . $image;

                // Upload the image
                $upload = move_uploaded_file($source_path, $destination_path);

                // Check whether the image is uploaded or not
                if (!$upload) {
                    echo "wala na upload ang farming";
                    die();
                }

                // Remove the current image if available
                if ($current_farming_image != "") {
                    $remove_path = "../img/farming/" . $current_farming_image;

                    // Check if the file exists before attempting to remove
                    if (file_exists($remove_path)) {
                        $remove = unlink($remove_path);

                        // Check whether the current image is removed or not
                        if (!$remove) {
                            echo "wala na remove";
                            die();
                        }
                    }
                }
            }
        } else {
            $image = $current_farming_image;
        }
    } else {
        $image = $current_farming_image;
    }

    // Update query with parameterized values for farming table
    $farming_query = "UPDATE farming SET 
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

    // Execute parameterized query for farming table
    $farming_query_run = pg_query_params($con, $farming_query, array(
        $farming_name, $description, $image, $importance, $role_in_maintaining_upland_ecosystem, $timing,
        $benefits, $environmental_impacts, $considerations, $sustainable_practices, $history_development,
        $construction_and_maintenance, $challenges, $principles, $other_info, $farming_id
    ));

    if (!$farming_query_run) {
        echo "Error updating farming: " . pg_last_error($con);
        exit(0);
    }

    // Continue with the update for the ritual table
    $ritual_id = pg_escape_string($con, $_POST['ritual_id']);
    $description = $_POST['description'];
    $ritual_name = $_POST['ritual_name'];
    $current_ritual_image = $_POST['current_ritual_image'];
    $purpose = $_POST['purpose'];
    $timing = $_POST['timing'];
    $participants = $_POST['participants'];
    $items_used = $_POST['items_used'];
    $other_info = $_POST['other_info'];

    // Apply the function to each field for the ritual table
    $ritual_name = handleValue($ritual_name);
    $description = handleValue($description);
    $purpose = handleValue($purpose);
    $timing = handleValue($timing);
    $participants = handleValue($participants);
    $items_used = handleValue($items_used);
    $other_info = handleValue($other_info);

    // Function to generate a unique image name
    function generate_unique_ritual_image_name($ext)
    {
        return "Ritual_Image_" . rand(000, 999) . '.' . $ext;
    }

    // Check if the image is selected or not
    if (isset($_FILES['ritual_image']['name'])) {
        $ritual_image = $_FILES['ritual_image']['name'];

        // Check if a new image is available
        if ($ritual_image != "") {
            $ext = pathinfo($ritual_image, PATHINFO_EXTENSION);
            $ritual_image = generate_unique_ritual_image_name($ext);

            // Check if the new image name already exists in the database
            $query = "SELECT ritual_image FROM ritual WHERE ritual_image = $1";
            $result = pg_query_params($con, $query, array($ritual_image));

            // Check for errors
            if ($result === false) {
                echo "Error: " . pg_last_error($con);
                die();
            }

            $count = pg_num_rows($result);

            if ($count > 0) {
                // If the image name exists, generate a new one
                $ritual_image = generate_unique_ritual_image_name($ext);
            } else {
                // Upload the new image
                $source_path = $_FILES['ritual_image']['tmp_name'];
                $destination_path = "../img/rituals/" . $ritual_image;

                // Upload the image
                $upload = move_uploaded_file($source_path, $destination_path);

                // Check whether the image is uploaded or not
                if (!$upload) {
                    echo "wala na upload and ritual";
                    die();
                }

                // Remove the current image if available
                if ($current_ritual_image != "") {
                    $remove_path = "../img/rituals/" . $current_ritual_image;

                    // Check if the file exists before attempting to remove
                    if (file_exists($remove_path)) {
                        $remove = unlink($remove_path);

                        // Check whether the current image is removed or not
                        if (!$remove) {
                            echo "wala na remove";
                            die();
                        }
                    }
                }
            }
        } else {
            $ritual_image = $current_ritual_image;
        }
    } else {
        $ritual_image = $current_ritual_image;
    }

    // Update query with parameterized values for ritual table
    $ritual_query = "UPDATE ritual SET 
            ritual_name = $1,
            description = $2,
            ritual_image = $3,
            purpose = $4,
            timing = $5,
            participants = $6,
            items_used = $7,
            other_info = $8
            WHERE ritual_id = $9";

    // Execute parameterized query for ritual table
    $ritual_query_run = pg_query_params($con, $ritual_query, array(
        $ritual_name, $description, $ritual_image, $purpose, $timing, $participants, $items_used, $other_info, $ritual_id
    ));

    if ($ritual_query_run) {
        $_SESSION['message'] = "Farming and Ritual Updated Successfully";
        header("Location: farming.php?farming_id=" . $_POST['farming_id']);
        exit(0);
    } else {
        echo "Error updating ritual: " . pg_last_error($con);
        exit(0);
    }
}

if (isset($_POST['delete'])) {
    $farming_id = pg_escape_string($con, $_POST['farming_id']);
    $result = pg_query($con, "select * from farming where farming_id='$farming_id'");
    $count = pg_num_rows($result);

    if ($count > 0) {
        while ($row = pg_fetch_assoc($result)) {
            $ritual_id = $row['ritual_id'];
        }
    }

    // Delete from Farming Table
    $query_delete_farming = "DELETE FROM farming WHERE farming_id=$1";
    $query_run_delete_farming = pg_query_params($con, $query_delete_farming, [$farming_id]);

    if ($query_run_delete_farming) {
        // Delete from Traditional Crop Traits table
        $query_delete_ritual = "DELETE FROM ritual WHERE ritual_id = $1";
        $query_run_delete_ritual = pg_query_params($con, $query_delete_ritual, [$ritual_id]);

        // Check if all deletions were successful
        if (
            $query_run_delete_ritual
        ) {
            $_SESSION['message'] = "Farming and associated records deleted successfully";
            header("Location: list.php");
            exit(0);
        } else {
            echo "Error: " . pg_last_error($con);
            exit(0);
        }
    } else {
        echo "Error: " . pg_last_error($con);
        exit(0);
    }
}
