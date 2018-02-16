<?php

require('includes/connect.php');
// restart session
session_start();

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $options = [
        'cost' => 10
    ];

    // query for the user in the database
    $queryUser = "SELECT * FROM users WHERE username  = '{$username}' LIMIT 1";

    if($user = $connection->query($queryUser)->fetch_object()){

        // check number of attempts
        if($user->attempt >= 3){
            $error =  'Maximum attempts reached, you are locked out!';
        }

        // check password
        if(password_verify($password, $user->password)){
            $_SESSION['lastLogin'] = $user->last_login;
            $queryUpdateAttempts = "UPDATE users SET attempt = null, last_login = NOW() WHERE id = {$user->id}";
            $connection->query($queryUpdateAttempts);

            header("Location: /login/admin/welcome.php");
            die();
        }
        else{
            // if password is wrong, add to attempts
            $newAttempt = $user->attempt + 1;
            $queryUpdateAttempts = "UPDATE users SET attempt = {$newAttempt} WHERE id = {$user->id}";
            $connection->query($queryUpdateAttempts);
        }
    }
    else{
        // if user is not found, display error
        $error = 'Cannot find user.';
    }
}
