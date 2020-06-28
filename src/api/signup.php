<?php
// header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Origin: THE_FRONTEND_DOMAIN");
require_once ('db.php');

if (!empty($_POST)) {
    $password   = $_POST['password'];
    $cpassword  = $_POST['cpassword'];
    $email      = $_POST['email'];


    if (!empty($password) && $password === $cpassword && !empty($email)) {
        $password   = password_hash($_POST['cpassword'], PASSWORD_BCRYPT);
        $level      = 0;
        $status     = 0;
        $token      = sha1(bin2hex(date('U')));
        $timestamp  = date('U');

        $sql = "INSERT INTO users (email, password, level, status, token, timestamp) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = conn()->prepare($sql);
        if ($stmt->execute([$email, $password, $level, $status, $token, $timestamp])) {
            $stmt = null;

            echo "User signed up!";

            // $subject = 'Verify your account';
            // $message = 'Click the link to verify your account: <br><b><a href=https://www.app.com/verify.php?token='.$token.'&email='.$email.'>'.$token.'</a></b>';
            // $output = '<p>A confirmation message has been sent to '.$email.'</p>';

            // email($email, $subject, $message, $output);
        }
    } elseif ($password !== $cpassword) {
        echo "Passwords do not match";
    } else {
        echo "All fields are required";
    }
}