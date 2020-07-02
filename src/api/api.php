<?php
header("Access-Control-Allow-Origin: http://localhost:8080");
header('Access-Control-Allow-Headers: Content-Type');

function conn() {
    $host = 'localhost';

    // ******* DEV 
    $db   = 'dummy';
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

//ADMIN - FETCH ALL USERS
if ($received_data->action == "admin_fetchAll_users") {
    
    $sql = "SELECT * FROM users ORDER BY id ASC";
    
    $stmt = conn()->prepare($sql);
    $stmt->execute();
    
    while ( $row = $stmt->fetch())  {
        $data[]=$row;
    }
    
    $stmt = null;
    
    echo json_encode($data);
}

//USER - LOGIN
if ($received_data->action == "user_login") {
    
    $password = $received_data->password;
    $email = $received_data->email;
    
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

                $data['msg']= "Login Successful";
            
            } else {
                $data['err']= true;
                $data['msg']= "Invalid Email or Password";
            }
        }
    } else {
        $data['err']= true;
        $data['msg']= "All fields are required";
    }
    
    echo json_encode($data);
}