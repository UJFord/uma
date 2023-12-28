<?php 
session_start();
require('../../html/navfoot/connection.php'); 
?>

<html>

<head>
    <title>Login - UMA</title>
    <link rel="stylesheet" href="../../css/admin/login.css">
</head>

<body>

    <div class="login">
        <h1 class="text-center">Login</h1>
        <br><br>

        <?php
            include "../message.php";
        ?>

        <br>
        <!-- Loigin Form starts here -->

        <form action="" method="POST" class="text-center">

            Email: <br>
            <input class="input" type="text" name="username" placeholder="Enter username"> <br><br>

            Password: <br>
            <input class="input" type="password" name="password" placeholder="Enter password"> <br><br>

            <input class="btn" type="submit" name="submit" value="login">
            <br><br>

        </form>

        <!-- Login Form ends here -->

        <p class="text-center">Not an admin? - <a href="#">Go Back</a></p>
        <p class="text-center">No Account? - <a href="signup.php">Sign Up</a></p>
    </div>
</body>

</html>

<?php

//CHeck whether the Submit Button is Clicked or NOt
if (isset($_POST['submit'])) {
    //Process for Login
    //1. Get the Data from Login form
    // $username = $_POST['username'];
    // $password = md5($_POST['password']);
    $username = pg_escape_string($connection, $_POST['username']);

    $raw_password = md5($_POST['password']);
    $password = pg_escape_string($connection, $raw_password);

    //2. SQL to check whether the user with username and password exists or not
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";

    //3. Execute the Query
    $res = pg_query($connection, $sql);

    //4. Count rows to check whether the user exists or not
    $count = pg_num_rows($res);

    if ($count == 1) {
        //User Available and Login Success
        $_SESSION['message'] = "<div class='success'>Login Successful.</div>";
        $_SESSION['user'] = $username; //TO check whether the user is logged in or not and logout will unset it

        //Redirect to Home Page/Dashboard
        header('location: ../crop/list.php');

    } else {
        //User not Available and Login Fail
        $_SESSION['message'] = "<div class='error text-center'>Username or Password did not match.</div>";
        //Redirect to login page
        header('location: login.php');
        exit();
    }
}

?>