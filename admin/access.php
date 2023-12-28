<?php
function access($rank){
    if(isset($_SESSION['ACCESS']) && !$_SESSION["ACCESS"][$rank]){
        $_SESSION['message'] = "<div class='text-center'>Access denied</div>";
        header("location: ../login/login.php");
        die();
    }
}
$_SESSION["ACCESS"]["USER"] = isset($_SESSION['rank']) && $_SESSION['rank'] == "user";

$_SESSION["ACCESS"]["ADMIN"] = isset($_SESSION['rank']) && $_SESSION['rank'] == "admin";

$_SESSION["ACCESS"]["CURATOR"] = isset($_SESSION['rank']) && $_SESSION['rank'] == "curator";

?>