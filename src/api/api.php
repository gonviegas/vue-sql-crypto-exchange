<?php
require_once ('db.php');

// $verify_address = "https://www.gonv.pt/verify";
$verify_address = "http://localhost:8080/#/user/verify";

$received_data = json_decode(file_get_contents('php://input'));
$data = array();

//STAFF - FETCH ALL USERS
if ($received_data->action == "staff_fetchAllCustomer") {
    
    $sql = "SELECT * FROM customer ORDER BY id ASC";
    
    $stmt = conn()->prepare($sql);
    $stmt->execute();
    
    while ( $row = $stmt->fetch())  {
        $data[]=$row;
    }
    
    $stmt = null;
    
    echo json_encode($data);
}

//STAFF - FETCH ALL WALLETS
if ($received_data->action == "staff_fetchAllWallet") {
    
    $sql = "SELECT * FROM wallet ORDER BY id ASC";
    
    $stmt = conn()->prepare($sql);
    $stmt->execute();
    
    while ( $row = $stmt->fetch())  {
        $data[]=$row;
    }
    
    $stmt = null;
    
    echo json_encode($data);
}

//STAFF - FETCH ALL STAFF
if ($received_data->action == "staff_fetchAllStaff") {
    
    $sql = "SELECT * FROM staff ORDER BY id ASC";
    
    $stmt = conn()->prepare($sql);
    $stmt->execute();
    
    while ( $row = $stmt->fetch())  {
        $data[]=$row;
    }
    
    $stmt = null;
    
    echo json_encode($data);
}


//STAFF - FETCH STORE WALLET
if ($received_data->action == "staff_fetchAllStoreWallet") {

    $sql = "SELECT * FROM store_wallet ORDER BY id ASC";
    
    $stmt = conn()->prepare($sql);
    $stmt->execute();
    
    while ( $row = $stmt->fetch())  {
        $data[]=$row;
    }
    
    $stmt = null;
    
    echo json_encode($data);
}

//STAFF - FETCH ALL TRANSFERS
if ($received_data->action == "staff_fetchAllTransfer") {
    
    $sql = "SELECT * FROM transfer ORDER BY id ASC";
    
    $stmt = conn()->prepare($sql);
    $stmt->execute();
    
    while ( $row = $stmt->fetch())  {
        $data[]=$row;
    }
    
    $stmt = null;
    
    echo json_encode($data);
}

//ADMIN - FETCH ALL NEWS
if ($received_data->action == "admin_fetchAllNews") {
    
    $sql = "SELECT * FROM news ORDER BY date ASC";
    
    $stmt = conn()->prepare($sql);
    $stmt->execute();
    
    while ( $row = $stmt->fetch())  {
        $data[]=$row;
    }
    
    $stmt = null;
    
    echo json_encode($data);
}

//ADMIN - INSERT 
if($received_data->action == "admin_insertStoreWallet")
{
    $data = array(
        ':currency' => $received_data->currency,
        ':balance' => $received_data->balance
    );

 $sql = "INSERT INTO store_wallet (currency, balance, fee, usd, eur) VALUES (:currency, :balance, 1, 0, 0)";

 $stmt = conn()->prepare($sql);
 $stmt->execute($data);

 $output = array('message' => 'Data Inserted');

 echo json_encode($output);
}

if($received_data->action == "admin_insertCustomer")
{
    $data = array(
    ':first_name' => $received_data->first_name,
    ':last_name' => $received_data->last_name
    );

    $sql = " INSERT INTO customer (first_name, last_name) VALUES (:first_name, :last_name)";

    $stmt = conn()->prepare($sql);
    $stmt->execute($data);

    $output = array( 'message' => 'Data Inserted');

    echo json_encode($output);
}

//USER - SIGNUP
if ($received_data->action == "user_signup") {
    $email      = $received_data->email;
    $password   = $received_data->password;
    $cpassword  = $received_data->cpassword;

    
    if (!empty($password) && $password === $cpassword && !empty($email)) {
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $data['err']= true;
            $data['msg']= "Email format is invalid.";
        }

        else {
            $sql = "SELECT email FROM customer";

            $stmt = conn()->prepare($sql);
            $stmt->execute(); 
            $r = $stmt->fetch();

            $stmt = null; 

            if ($email == $r['email']) {
                $data['err']= true;
                $data['msg']= "Account already exists.";
                
            } else {
                
                $password   = password_hash($received_data->cpassword, PASSWORD_BCRYPT);
                $status     = 'unverified';
                $token      = sha1(bin2hex(date('U')));
                $timestamp  = date('U');

                $sql = "INSERT IGNORE INTO customer (email, first_name, last_name, status, password, token, timestamp) VALUES (?, ?, ?, ?, ?, ?, ?)";

                $stmt = conn()->prepare($sql);

                $data['err']= false;
                $data['msg']= "Sign Up successful. Please follow the link in your email to verify your account";
                
                if ($stmt->execute([$email, $first_name, $last_name, $status, $password, $token, $timestamp])) {
                    $stmt = null;

                    $subject = 'Account verification';
                    $message = 'Thank you for signing up!<br>Click the following link to verify your account: <br><b><a href='.$verify_address.'</a></b>';
                    
                        // $message = 'Thank you for signing up!<br>Click the following link to verify your account: <br><b><a href=https://www.gonv.pt/verify.php?token='.$token.'&email='.$email.'>'.$token.'</a></b>';

                    email($email, $subject, $message);

                }
            } 
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
    
    if (!empty($password) && !empty($email)) {
        $sql = "SELECT email, password, token, status FROM customer WHERE email = ?";

        $stmt = conn()->prepare($sql);
        if ($stmt->execute([$email])) {
            $r = $stmt->fetch();

            $stmt = null; 

            if (password_verify($password, $r['password'])) {
                if ('active' == $r['status']) {
                    session_start();
                    //session_regenerate_id();

                    $_SESSION['loggedin'] = true;
                    $_SESSION['email'] = $r['email'];
                    $_SESSION['token'] = $r['token'];
                    
                    $data['err']= false;
                    $data['msg']= "Login Successful";
                } 
                else if('unverified' == $r['status']) {
                    $data['err']= true;
                    $data['msg']= "Account unverified. Please check your email to verify your account.";
                }
                else if('blocked' == $r['status']) {
                    $data['err']= true;
                    $data['msg']= "Account blocked. Please contact support for more info.";
                }
                else if('suspended' == $r['status'] || 'active' !== $r['status'] || 'unverified' !== $r['status'] || 'blocked' !== $r['status']) {
                    $data['err']= true;
                    $data['msg']= "Account suspended. Please contact support for more info.";
                }
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

