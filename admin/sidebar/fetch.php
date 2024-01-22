<?php
//fetch.php;
error_log("fetch.php accessed");

if (isset($_POST["view"])) {
    include('../../html/navfoot/connection.php');

    $query_1 = "SELECT * FROM crop WHERE status='pending'";
    $result_1 = pg_query($connection, $query_1);
    $count = pg_num_rows($result_1);
    $output = '';

    $data1 = array(
        'notification'   => $output,
        'unseen_notification' => $count
    );

    $query_2 = "SELECT * FROM users WHERE email_verified IS NULL";
    $result_2 = pg_query($connection, $query_2);
    $count2 = pg_num_rows($result_2);
    $output2 = '';
    $data2 = array(
        'notification'   => $output2,
        'unseen_notification' => $count2
    );

    // Combine the two data arrays into a single array
    $combinedData = array(
        'data1' => $data1,
        'data2' => $data2
    );

    // Encode the combined array as JSON and echo it
    echo json_encode($combinedData);
}
?>
