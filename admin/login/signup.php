<?php
session_start();
require('../../html/navfoot/connection.php');
?>

<html>

<head>
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../../css/admin/login.css">
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

        <br>
        <!-- Loigin Form starts here -->

        <form action="" autocomplete="off" method="POST" class="text-center">

            First Name: <br>
            <input class="input" type="text" name="first_name" placeholder="First Name" required> <br><br>

            Last Name: <br>
            <input class="input" type="text" name="last_name" placeholder="Last Name" required> <br><br>

            Gender: <br>
            <input class="input" type="text" name="gender" placeholder="Gender" required> <br><br>

            Email: <br>
            <input class="input" type="email" name="email" placeholder="Email" required> <br><br>

            Password: <br>
            <input class="input" type="password" name="password" placeholder="Password" required> <br><br>

            Affiliation: <br>
            <input class="input" type="text" name="affiliation" placeholder="Affiliation" required> <br><br>

            <input type="submit" name="submit" value="Signup" class="btn">
            <br><br>

        </form>

        <!-- Login Form ends here -->

        <p class="text-center">Already have an Account? - <a href="login.php">Go Back</a></p>
    </div>

</body>

</html>

<?php

//CHeck whether the Submit Button is Clicked or NOt
if (isset($_POST['submit'])) {

    // incase if the client want to add userID
    // function create_userID($connection)
    // {
    //     $IDnumber = "";

    //     do {
    //         $rand = "userID_" . rand(0, 25) . '.';
    //         $IDnumber .= $rand;

    //         // Check if $rand already exists in the database
    //         $query = "SELECT COUNT(*) as count FROM users WHERE \"userID\" = $1";
    //         // Execute the query using your database connection and fetch the result
    //         $result = pg_query_params($connection, $query, array($rand));

    //         // Check if the query execution is successful
    //         if ($result !== false) {
    //             // Fetch the result as an associative array
    //             $row = pg_fetch_assoc($result);
    //             $exists = $row['count'] > 0;
    //         } else {
    //             // Handle query failure, log or display an error message
    //             $_SESSION['message'] = "Failed to query database";
    //             die();
    //         }
    //     } while ($exists);
    //     return $IDnumber;
    // }
    // $userID = create_userID($connection);

    // Process for Signup
    // 1. Get the Data from Signup form
    $first_name = pg_escape_string($connection, $_POST['first_name']);
    $last_name = pg_escape_string($connection, $_POST['last_name']);
    $gender = pg_escape_string($connection, $_POST['gender']);
    $email = pg_escape_string($connection, $_POST['email']);
    $affiliation = pg_escape_string($connection, $_POST['affiliation']);

    //  get the account type
    $accountType = "select * from account_type where type_name = 'viewer'";
    $query_acc_run = pg_query($connection, $accountType);
    if (pg_num_rows($query_acc_run) > 0) {
        $user = pg_fetch_assoc($query_acc_run);
        $account_type_id = $user['account_type_id'];
    }

    $raw_password = md5($_POST['password']);
    $password = pg_escape_string($connection, $raw_password);

    // 2. SQL to insert data into admin
    $sql = "INSERT INTO \"user\" (first_name, last_name, gender, email, affiliation, password, account_type_id) 
            VALUES ($1, $2, $3, $4, $5, $6, $7)";

    $res = pg_query_params($connection, $sql, array($first_name, $last_name, $gender, $email, $affiliation, $password, $account_type_id));

    if ($res) {
        $_SESSION['message'] = "<div class='success text-center'>User Created Successfully.</div>";
        header("Location: login.php");
        exit(0);
    } else {
        echo "Error: " . pg_last_error($connection);
        // $_SESSION['failed'] = "<div class='error text-center'>Failed to Create User.</div>";
        // header("Location: signup.php");
        exit(0);
    }
}

?>