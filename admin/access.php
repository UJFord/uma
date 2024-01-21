<?php
ob_start(); // Add this at the beginning
function access($rank){
    if(isset($_SESSION['ACCESS']) && !$_SESSION["ACCESS"][$rank]){
        $_SESSION['message'] = "<div class='text-center'>Access denied</div>";
        header("location: ../crop/list.php");
        die();
    }
}

$_SESSION["ACCESS"]["VIEWER"] = isset($_SESSION['rank']) && $_SESSION['rank'] == "viewer";

$_SESSION["ACCESS"]["ADMIN"] = isset($_SESSION['rank']) && $_SESSION['rank'] == "admin";

$_SESSION["ACCESS"]["CURATOR"] = isset($_SESSION['rank']) && $_SESSION['rank'] == "curator";

ob_end_flush(); // Add this at the end
?>