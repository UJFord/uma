<?php
session_start();
require('../sidebar/side.php');

require('../functions.php');
require "../mail.php";
check_login();

$errors = array();
// to send verify code in the datbase
if ($_SERVER['REQUEST_METHOD'] == 'GET' && !check_verified()) {

    // send email
    $vars['code'] = strval(mt_rand(10000, 99999));

    // save to database
    $vars['expires'] = (time() + (60 * 10));

    $vars['email'] = $_SESSION['USER']['email'];

    $query = "insert into verify (code, expires, email) values (:code, :expires, :email)";
    database_run($query, $vars);

    $message = "your code is ". $vars['code'];
    $subject = "Email verification";
    $recipient = $vars['email'];

    send_mail($recipient, $subject, $message);
}

// verification process
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!check_verified()) {

        $vars = array();
        $vars['email'] = $_SESSION['USER']['email'];
        $vars['code'] = $_POST['code'];

        $query = "SELECT * FROM verify WHERE code = :code AND email = :email";
        $row = database_run($query, $vars);

        if (is_array($row) && !empty($row)) {
            $row = $row[0];
            $time = time();
            if ($row['expires'] > $time) {
                $id = $_SESSION['USER']['user_id'];
                $query = "update users set email_verified = email where user_id = $id";
                $row = database_run($query);

                header("location: profile.php");
                die();
            } else {
                $_SESSION['message'] = "Code expired.";
            }
        } else {
            $_SESSION['message'] = "Wrong code.";
        }
    } else {
        $_SESSION['message'] = "you are already verified.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <!-- cutom css -->
    <link rel="stylesheet" href="../../css/admin/list.css" />
    <!-- favicon -->
    <link rel="shortcut icon" href="img/logo/Uma logo.svg" type="image/x-icon" />
    <title>Uma | AdminPage</title>
</head>

<body class="overflow-hidden">

    <!-- container of everything -->
    <div class="row ">

        <!-- space holder of side panel -->
        <section class=" d-none d-md-block col col-4 col-lg-3 col-xl-2 p-0 m-0"></section>
        <!-- main panel -->
        <section id="nav-cards" class="p-0 m-0 col col-md-4 col-lg-9 col-xl-10">
            <div class=" py-3 px-4">
                <!-- title and filter -->
                <div class="row d-flex justify-content-between mb-3">
                    <!-- title -->
                    <div class="col-6">
                        <h2 id="crops-title" class="fw-semibold">Verify</h2>
                    </div>
                </div>

                <?php include '../message.php'; ?>

                <div class="text-center">
                    <br>An email was sent to your address. paste the code from your email. <br>
                    <?php if (count($errors) > 0) : ?>
                        <?php foreach ($errors as $error) : ?>
                            <?= $error ?> <br>
                        <?php endforeach; ?>

                    <?php endif; ?>
                </div>

                <br>

                <!-- Verify starts here -->
                <form action="" method="POST" class="text-center">

                    <br>An email was sent to your address. paste the code from your email. <br>

                    Email: <br>
                    <input class="input" type="number" name="code" placeholder="Enter your Code"> <br><br>

                    <input class="btn-primary" type="submit" name="verify" value="verify">
                    <br><br>

                </form>
            </div>
        </section>

    </div>

    <!-- scipts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/57e83eb6e4.js" crossorigin="anonymous"></script>

</body>

</html>