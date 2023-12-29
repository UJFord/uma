<?php
// Authorization
// Check whether the admin is logged in or not
if (!isset($_SESSION['user'])) // if admin session is not set
{
    // Admin is not logged in
    // Redirect to with message
    $_SESSION['messgage'] = "<div class='error text-center'>Please Login to Access Admin Panel.</div>";
    // REdirect to login page
    header('location:../login/login.php');
}
