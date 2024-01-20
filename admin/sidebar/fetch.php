<?php
//fetch.php;
error_log("fetch.php accessed");

if (isset($_POST["view"])) {
    include('../../html/navfoot/connection.php');

    $query_1 = "SELECT * FROM crop WHERE status='pending'";
    $result_1 = pg_query($connection, $query_1);
    $count = pg_num_rows($result_1);
    $output = '';
    $data = array(
        'notification'   => $output,
        'unseen_notification' => $count
    );
    echo json_encode($data);
}
