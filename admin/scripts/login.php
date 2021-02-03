<?php

function login($username, $password, $ip)
{
    // return 'You are trying to login with U:'.$username.'P:'.$password.'.';

    // check against user DB to check credentials
    // Check if UN and PW match DB
    $pdo = Database::getInstance()->getConnection();
    $get_user_querry = 'SELECT * FROM tbl_user WHERE user_name = :username AND user_pass=:password';
    $user_set = $pdo->prepare($get_user_querry);
    $user_set->execute(
        array(
            ':username'=>$username,
            ':password'=>$password
        )
    );

    if ($found_user = $user_set->fetch(PDO::FETCH_ASSOC)){
        // Found user, log in!
        // Debugging line only
        // return "Logging in!!";

        // Indicate the ID
        $found_user_id = $found_user['user_id'];

        // Write user and id into session
        $_SESSION['user_id'] = $found_user_id;
        $_SESSION['user_name'] = $found_user['user_fname'];
        

        // Update user IP
        $update_user_query = 'UPDATE tbl_user SET user_ip = :user_ip WHERE user_id=:user_id';
        $update_user_set = $pdo->prepare($update_user_query);
        $update_user_set->execute(
            array(
                ':user_ip'=>$ip,
                ':user_id'=>$found_user_id
            )
        );

        // Redirect user back to index.php
        redirect_to('index.php');

    } else {
        // Invalid attemp, rejected!
        return "Learn how to type!!";
    }
}

function confirm_logged_in()
{
    if(!isset($_SESSION['user_id'])){
        redirect_to("admin_login.php");
    }
}

function logout()
{
    session_destroy();

    redirect_to('admin_login.php');
}