<?php
header("Access-Control-Allow-Origin: http://localhost:8080");
header('Access-Control-Allow-Headers: Content-Type');

function conn() {
    $host = 'localhost';

    // ******* DEV 
    $db   = 'crypto-exchange';
    $user = 'root';
    $pass = 'root';
    //         DEV *******
    
    // ******* DEPLOYMENT
    // $db   = 'gonvpt_dummy';
    // $user = 'gonvpt_regular';
    // $pass = '#(iXS^WT!Zjq';
    //         DEPLOYMENT *******
    
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    $options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
  ];
    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
        return $pdo;
        $pdo = null;
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    };
}

$received_data = json_decode(file_get_contents('php://input'));
$data = array();

//ADMIN LVL 0+1 - FETCH ALL USERS
if ($received_data->action == "admin_fetchAll_users") {
    
    $sql = "SELECT * FROM customer ORDER BY id ASC";
    
    $stmt = conn()->prepare($sql);
    $stmt->execute();
    
    while ( $row = $stmt->fetch())  {
        $data[]=$row;
    }
    
    $stmt = null;
    
    echo json_encode($data);
}

//USER - SIGNUP
if ($received_data->action == "user_signup") {

    $email      = $received_data->email;
    $password   = $received_data->password;
    $cpassword  = $received_data->cpassword;

    if (!empty($password) && $password === $cpassword && !empty($email)) {
        $password   = password_hash($received_data->cpassword, PASSWORD_BCRYPT);
        $status     = 'unverified';
        $token      = sha1(bin2hex(date('U')));
        $timestamp  = date('U');

        $sql = "INSERT IGNORE INTO customer (email, first_name, last_name, status, password, token, timestamp) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = conn()->prepare($sql);
        
        if ($stmt->execute([$email, $first_name, $last_name, $status, $password, $token, $timestamp])) {
            $stmt = null;

            $data['err']= true;
            $data['msg']= "Sign Up successful.";
            

            // $subject = 'Verify your account';
            // $message = 'Click the link to verify your account: <br><b><a href=https://www.app.com/verify.php?token='.$token.'&email='.$email.'>'.$token.'</a></b>';
            // $output = '<p>A confirmation message has been sent to '.$email.'</p>';

            // email($email, $subject, $message, $output);
        }
    } 
    elseif ($password !== $cpassword) {
        $data['err']= true;
        $data['msg']= "Passwords do not match";
    } 
    else {
        $data['err']= true;
        $data['msg']= "All fields are required";
    }
    echo json_encode($data);
}

//USER - LOGIN
if ($received_data->action == "user_login") {
    
    $email = $received_data->email;
    $password = $received_data->password;
    $status = 'active';
    
    if (!empty($password) && !empty($email)) {
        $sql = "SELECT email, password, token, status FROM customer WHERE email = ? AND status = ?";

        $stmt = conn()->prepare($sql);
        if ($stmt->execute([$email, $status])) {
            // $n = $stmt->rowCount();
            $r = $stmt->fetch();

            $stmt = null;
            
            if ($status === $r['status'] && password_verify($password, $r['password'])) {
                session_start();
                //session_regenerate_id();

                $_SESSION['loggedin'] = true;

                $_SESSION['email'] = $r['email'];
                $_SESSION['token'] = $r['token'];
                
                $data['err']= false;
                $data['msg']= "Login Successful";
            } 
            else {
                $data['err']= true;
                $data['msg']= "Invalid Email or Password";
            }
        } 
    } 
    else {
        $data['err']= true;
        $data['msg']= "All fields are required";
    }
    
    echo json_encode($data);
}