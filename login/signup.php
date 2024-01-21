<?php
session_start();
require('../html/navfoot/connection.php');
require('../admin/functions.php');

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = signup($_POST);

    if (count($errors) == 0) {
        $_SESSION['message'] = "<div class='success'>Signup successful wait for the verification in your email.</div>";
        header("location: index.php");
        die();
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/admin/login.css">
</head>

<body>

    <div class="login">
        <h1 class="text-center">Sign Up</h1>
        <br><br>

        <?php
        if (isset($_SESSION['failed'])) {
            echo $_SESSION['failed'];
            unset($_SESSION['failed']);
        }
        ?>

        <div>
            <?php if (count($errors) > 0) : ?>
                <?php foreach ($errors as $error) : ?>
                    <?= $error ?> <br>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <br>
        <!-- Login Form starts here -->

        <form action="" autocomplete="off" method="POST" class="text-center">

            First Name: <br>
            <input class="input" type="text" name="first_name" placeholder="First Name"> <br><br>

            Last Name: <br>
            <input class="input" type="text" name="last_name" placeholder="Last Name"> <br><br>

            Gender: <br>
            <input class="input" type="text" name="gender" placeholder="Gender"> <br><br>

            Username: <br>
            <input class="input" type="text" name="username" placeholder="Username"> <br><br>

            Email: <br>
            <input class="input" type="email" name="email" placeholder="Email"> <br><br>

            Password: <br>
            <input class="input" type="password" name="password" placeholder="Password"> <br><br>

            Confirm Password: <br>
            <input class="input" type="password" name="password2" placeholder="Retype Password"> <br><br>

            Affiliation: <br>
            <input class="input" type="text" name="affiliation" placeholder="Affiliation"> <br><br>

            <input type="submit" name="submit" value="Signup" class="btn">
            <br><br>

        </form>

        <!-- Login Form ends here -->

        <p class="text-center">Already have an Account? - <a href="index.php">Go Back</a></p>
    </div>

</body>

</html>