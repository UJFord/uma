<?php

//function for signup
function signup($data)
{
    $errors = array();

    // validate
    if (!preg_match('/^[a-zA-Z ]+$/', $data['first_name'])) {
        $errors[] = "<div class='error text-center'>Please enter a valid first_name.</div>";
    }

    if (!preg_match('/^[a-zA-Z ]+$/', $data['last_name'])) {
        $errors[] = "<div class='error text-center'>Please enter a valid last_name.</div>";
    }

    if (!preg_match('/^[a-zA-Z0-9]+$/', $data['username'])) {
        $errors[] = "<div class='error text-center'>Please enter a valid username.</div>";
    }

    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "<div class='error text-center'>Please enter a valid email.</div>";
    }

    if (strlen(trim($data['password'])) < 8) {
        $errors[] = "<div class='error text-center'>Password must be at least 8 characters.</div>";
    }

    if ($data['password'] != $data['password2']) {
        $errors[] = "<div class='error text-center'>Password must match.</div>";
    }

    // Retrieve account type
    $accountTypeQuery = "SELECT * FROM account_type WHERE type_name = 'viewer'";
    $accountTypeResult = database_run($accountTypeQuery);

    if ($accountTypeResult) {
        $user = $accountTypeResult[0];
        $account_type_id = $user['account_type_id'];

        // Save user data
        if (count($errors) == 0) {
            $arr['first_name'] = $data['first_name'];
            $arr['last_name'] = $data['last_name'];
            $arr['gender'] = $data['gender'];
            $arr['username'] = $data['username'];
            $arr['email'] = $data['email'];
            $arr['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            $arr['affiliation'] = $data['affiliation'];
            $arr['account_type_id'] = $account_type_id;

            $query = "INSERT INTO users (first_name, last_name, gender, username, email, password, affiliation, account_type_id) 
                    VALUES (:first_name, :last_name, :gender, :username, :email, :password, :affiliation, :account_type_id)";
            database_run($query, $arr);
        }
    } else {
        $errors[] = "Error retrieving account type";
    }

    return $errors;
}

//function for login
function login($data)
{
    $errors = array();

    // validate
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email";
    }

    if (strlen(trim($data['password'])) < 3) {
        $errors[] = "Password must be at least 3 characters";
    }

    // check
    if (count($errors) == 0) {
        $email = $data['email'];
        $providedPassword = $data['password'];

        $query = "SELECT user_id, password, first_name, last_name FROM users WHERE email = :email LIMIT 1";

        $row = database_run($query, array(':email' => $email));

        if (!empty($row) && password_verify($providedPassword, $row[0]['password'])) {
            // Only store essential information in the session
            $_SESSION['USER']['user_id'] = $row[0]['user_id'];
            $_SESSION['USER']['first_name'] = $row[0]['first_name'];
            $_SESSION['LOGGED_IN'] = true;
        } else {
            $errors[] = "<div class='error text-center'>Email or Password did not match.</div>";
        }
    }


    return $errors;
}

//function to connect to db
function database_run($query, $vars = array())
{
    $dsn = "pgsql:host=localhost dbname=farm_crops user=postgres password=123";

    try {
        $pdo = new PDO($dsn);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stm = $pdo->prepare($query);
        $check = $stm->execute($vars);

        if ($check) {
            // Check if it's a SELECT query before attempting to fetch data
            if ($stm->columnCount() > 0) {
                $data = $stm->fetchAll(PDO::FETCH_ASSOC);
                return $data;
            } else {
                // If it's not a SELECT query, return true for success
                return true;
            }
        }

        return false;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

// function for login checkup. to see if user is logged in
function check_login($redirect = true)
{
    if (isset($_SESSION['USER']) && isset($_SESSION['LOGGED_IN'])) {
        return true;
    }

    if ($redirect) {
        header("location: ../login/login.php");
        die();
    } else {
        return false;
    }
}
