<?php
// header("Access-Control-Allow-Origin: http://localhost:8080");
require_once ('db.php');

$res = array('err' => false);

if (!empty($_POST)) {
    $password   = $_POST['password'];
    $email      = $_POST['email'];

    if (!empty($password) && !empty($email)) {
        $sql = "SELECT email, password, token, level FROM users WHERE email = ? AND level > ? AND status > ? LIMIT 1";

        $stmt = conn()->prepare($sql);
        if ($stmt->execute([$email, 0, 0])) {
            $n = $stmt->rowCount();
            $r = $stmt->fetch();

            $stmt = null;
            
            if ($n === 1 && password_verify($password, $r['password'])) {
                session_start();
                //session_regenerate_id();

                $_SESSION['loggedin'] = true;

                $_SESSION['email'] = $r['email'];
                $_SESSION['token'] = $r['token'];
                $_SESSION['level'] = $r['level'];

                $res['msg']= "Login Successful";
            } else {
                $res['err']= true;
                $res['msg']= "Invalid Email or Password";
            }
        }
    } else {
        $res['err']= true;
        $res['msg']= "All fields are required";
    }
    // header("Content-type: application/json");
    echo json_encode($res);
}

