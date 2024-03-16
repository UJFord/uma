<?php
$connection = pg_connect("host=localhost dbname=farm_crops-before-redesign user=postgres password=123");
if (!$connection) {
    echo "An error occured";
    exit;
}

?>