<?php
session_start();
require('../html/navfoot/connection.php');
require('../admin/functions.php');

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = login($_POST);

    if (count($errors) == 0) {
        header("location: ../admin/crop/list.php");
        die();
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login - UMA</title>
    <link rel="stylesheet" href="../css/admin/login.css">
</head>

<body>

    <div class="login">
        <h1 class="text-center">Login</h1>
        <br><br>

        <?php
        include "../admin/message.php";
        ?>

        <div>
            <?php if (count($errors) > 0) : ?>
                <?php foreach ($errors as $error) : ?>
                    <?= $error ?> <br>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <br>
        <!-- Loigin Form starts here -->

        <form action="" method="POST" class="text-center">

            Email: <br>
            <input class="input" type="email" name="email" placeholder="Enter email"> <br><br>

            Password: <br>
            <input class="input" type="password" name="password" placeholder="Enter password"> <br><br>

            <input class="btn" type="submit" name="submit" value="login">
            <br><br>

        </form>

        <!-- Login Form ends here -->

        <p class="text-center">Return to homepage? - <a href="../admin/crop/list.php">Go Back</a></p>
        <p class="text-center">Want to signup? - <a href="signup.php">Sign Up</a></p>
    </div>
</body>

</html>