<?php

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
            $arr['password'] = md5($data['password']);
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

function login($data)
{
    $errors = array();

    // validate
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email";
    }

    if (strlen(trim($data['password'])) < 4) {
        $errors[] = "Password must be at least 4 characters";
    }

    // check
    if (count($errors) == 0) {
        $arr['email'] = $data['email'];
        $arr['password'] = md5($data['password']);

        $query = "select * from users where email = :email and password = :password limit 1";
        
        $row = database_run($query, $arr);

        if(is_array($row)){
            $_SESSION['USER'] = $row;
            $_SESSION['LOGGED_IN'] = true;
        }else{
            $errors[] = "<div class='error text-center'>Email or Password did not match.</div>";
        }
    }

    return $errors;
}

function database_run($query, $vars = array())
{
    $dsn = "pgsql:host=localhost dbname=farm_crops user=postgres password=123";

    try {
        $pdo = new PDO($dsn);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stm = $pdo->prepare($query);
        $check = $stm->execute($vars);

        if ($check) {
            $data = $stm->fetchAll();
            if (count($data) > 0) {
                return $data;
            }
        }

        return false;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

function check_login($redirect = true){
    if(isset($_SESSION['USER']) && isset($_SESSION['LOGGED_IN'])){

        return true;
    }

    if($redirect){
        header("location: login.php");
        die();
    }else{
        return false;
    }
}