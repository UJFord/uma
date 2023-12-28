<?php
session_start();
require '../../html/navfoot/connection.php';

?>

<?php
// Destroy session
session_destroy(); //  unsets $_SESSION['user']

// Redirect to login page
header('location:../login/login.php');
?>