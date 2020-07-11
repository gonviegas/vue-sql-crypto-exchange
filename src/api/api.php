<?php
require_once ('db.php');

$received_data = json_decode(file_get_contents('php://input'));
$data = array();


//UPDATE CRYPTO PRICES IN STORE WALLET
if($received_data->action == 'updateCryptoPrices')
{
    
        $btc_usd = $received_data->btc_usd;
        $btc_eur = $received_data->btc_eur;
        $eth_usd = $received_data->eth_usd;
        $eth_eur = $received_data->eth_eur;
        $xrp_usd = $received_data->xrp_usd;
        $xrp_eur = $received_data->xrp_eur;
        $xlm_usd = $received_data->xlm_usd;
        $xlm_eur = $received_data->xlm_eur;
        $dgb_usd = $received_data->dgb_usd;
        $dgb_eur = $received_data->dgb_eur;
    

    $sql = "UPDATE store_wallet SET usd = ?, eur = ?  WHERE currency = 'btc'";

    $stmt = conn()->prepare($sql);
    $stmt->execute([$btc_usd, $btc_eur]);
    $stmt = null;
    
    $sql = "UPDATE store_wallet SET usd = ?, eur = ?  WHERE currency = 'eth'";

    $stmt = conn()->prepare($sql);
    $stmt->execute([$eth_usd, $eth_eur ]);
    $stmt = null;

    $sql = "UPDATE store_wallet SET usd = ?, eur = ?  WHERE currency = 'xrp'";

    $stmt = conn()->prepare($sql);
    $stmt->execute([$xrp_usd, $xrp_eur]);
    $stmt = null;
    
    $sql = "UPDATE store_wallet SET usd = ?, eur = ?  WHERE currency = 'xlm'";

    $stmt = conn()->prepare($sql);
    $stmt->execute([$xlm_usd, $xlm_eur ]);
    $stmt = null;

    $sql = "UPDATE store_wallet SET usd = ?, eur = ?  WHERE currency = 'dgb'";

    $stmt = conn()->prepare($sql);
    $stmt->execute([$dgb_usd, $dgb_eur]);
    $stmt = null;
}

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
    
    $sql = "SELECT * FROM wallet ORDER BY customer_id ASC";
    
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
/////////////////////////////////
/////////////ADMIN - STOREWALLET
/////////////////////////////////
if($received_data->action == "admin_insertStoreWallet")
{
    $data = array(
        ':currency' => $received_data->currency,
        ':balance' => $received_data->balance,
        ':fee' => $received_data->fee
    );

    $sql = "INSERT INTO store_wallet (currency, balance, fee, usd, eur) VALUES (:currency, :balance, :fee, 0, 0)";

    $stmt = conn()->prepare($sql);
    $stmt->execute($data);

    $output = array('message' => 'Data Inserted');

    echo json_encode($output);

}

if($received_data->action == "admin_fetchSingleStoreWallet")
{
    $sql = "SELECT * FROM store_wallet WHERE id = '".$received_data->id."'";

    $stmt = conn()->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetchAll();
        

    foreach($result as $row)
    {
    $data['id'] = $row['id'];
    $data['currency'] = $row['currency'];
    $data['balance'] = $row['balance'];
    $data['fee'] = $row['fee'];
    }

    echo json_encode($data);
}

if($received_data->action == 'admin_deleteStoreWallet') {
    $sql = "DELETE FROM store_wallet WHERE id = '".$received_data->id."'";

    $stmt = conn()->prepare($sql);
    $stmt->execute();

    $output = array(
    'message' => 'Data Deleted'
    );

 echo json_encode($output);
}

if($received_data->action == 'admin_updateStoreWallet')
{
    $data = array(
        ':currency' => $received_data->currency,
        ':balance' => $received_data->balance,
        ':fee' => $received_data->fee,
        ':id'   => $received_data->hiddenId
    );

    $sql = "UPDATE store_wallet SET currency = :currency, balance = :balance, fee = :fee  WHERE id = :id";

    $stmt = conn()->prepare($sql);
    $stmt->execute($data);

    $output = array(
    'message' => 'Data Updated'
    );
    echo json_encode($output);
}


/////////////////////////////////
/////////////ADMIN - Customers
/////////////////////////////////

if($received_data->action == "admin_insertCustomer")
{
    $data = array(
        ':email' => $received_data->email,
        ':first_name' => $received_data->first_name,
        ':last_name' => $received_data->last_name,
        ':verified' => $received_data->verified,
        ':status' => $received_data->status,
        ':password' => password_hash($received_data->password, PASSWORD_BCRYPT),
        ':token' => sha1(bin2hex(date('U'))),
        ':timestamp' => date('U')
    );

    $sql = "INSERT INTO customer(email, first_name, last_name, verified, status, password, token, timestamp) VALUES (:email, :first_name, :last_name,:verified, :status, :password, :token, :timestamp)";

    $stmt = conn()->prepare($sql);
    $stmt->execute($data);

    $output = array('message' => 'Data Inserted');

    echo json_encode($output);

}

if($received_data->action == 'admin_updateCustomer')
{
    $data = array(
        ':email' => $received_data->email,
        ':first_name' => $received_data->first_name,
        ':last_name' => $received_data->last_name,
        ':verified' => $received_data->verified,
        ':status' => $received_data->status,
        ':password' => password_hash($received_data->password, PASSWORD_BCRYPT),
        ':id'   => $received_data->hiddenId
    );

    $sql = "UPDATE customer SET email = :email, first_name = :first_name, last_name = :last_name, verified = :verified, status = :status, password = :password WHERE id = :id";

    $stmt = conn()->prepare($sql);
    $stmt->execute($data);

    $output = array(
    'message' => 'Data Updated'
    );
    echo json_encode($output);
}

if($received_data->action == "admin_fetchSingleCustomer")
{
    $sql = "SELECT * FROM customer WHERE id = '".$received_data->id."'";

    $stmt = conn()->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetchAll();
        

    foreach($result as $row)
    {
    $data['id'] = $row['id'];
    $data['email'] = $row['email'];
    $data['first_name'] = $row['first_name'];
    $data['last_name'] = $row['last_name'];
    $data['verified'] = $row['verified'];
    $data['status'] = $row['status'];
    $data['password'] = $row['password'];
    $data['token'] = $row['token'];
    $data['timestamp'] = $row['timestamp'];
    }

    echo json_encode($data);
}

if($received_data->action == 'admin_deleteCustomer') {
    $sql = "DELETE FROM customer WHERE id = '".$received_data->id."'";

    $stmt = conn()->prepare($sql);
    $stmt->execute();

    $output = array(
    'message' => 'Data Deleted'
    );

 echo json_encode($output);
}

/////////////////////////////////
/////////////ADMIN - Staff
/////////////////////////////////

if($received_data->action == "admin_insertStaff")
{
    $data = array(
        ':first_name' => $received_data->first_name,
        ':last_name' => $received_data->last_name,
        ':username' => $received_data->username,
        ':email' => $received_data->email,
        ':level' => $received_data->level,
        ':active' => $received_data->active,
        ':password' => password_hash($received_data->password, PASSWORD_BCRYPT),
        ':token' => sha1(bin2hex(date('U'))),
    );

    $sql = "INSERT INTO staff(first_name, last_name, username, email, level, active, password, token) VALUES (:first_name, :last_name, :username, :email, :level, :active, :password, :token)";

    $stmt = conn()->prepare($sql);
    $stmt->execute($data);

    $output = array('message' => 'Data Inserted');

    echo json_encode($output);

}

if($received_data->action == 'admin_updateStaff')
{
    $data = array(
        ':first_name' => $received_data->first_name,
        ':last_name' => $received_data->last_name,
        ':username' => $received_data->username,
        ':email' => $received_data->email,
        ':level' => $received_data->level,
        ':active' => $received_data->active,
        ':password' => password_hash($received_data->password, PASSWORD_BCRYPT),
        ':id'   => $received_data->hiddenId
    );

    $sql = "UPDATE staff SET first_name = :first_name, last_name = :last_name, username = :username, email = :email,  level = :level, active = :active, password = :password WHERE id = :id";

    $stmt = conn()->prepare($sql);
    $stmt->execute($data);

    $output = array(
    'message' => 'Data Updated'
    );
    echo json_encode($output);
}

if($received_data->action == "admin_fetchSingleStaff")
{
    $sql = "SELECT * FROM staff WHERE id = '".$received_data->id."'";

    $stmt = conn()->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetchAll();
        

    foreach($result as $row)
    {
    $data['id'] = $row['id'];
    $data['first_name'] = $row['first_name'];
    $data['last_name'] = $row['last_name'];
    $data['username'] = $row['username'];
    $data['email'] = $row['email'];
    $data['active'] = $row['active'];
    $data['level'] = $row['level'];
    $data['password'] = $row['password'];
    $data['token'] = $row['token'];
    }

    echo json_encode($data);
}

if($received_data->action == 'admin_deleteStaff') {
    $sql = "DELETE FROM staff WHERE id = '".$received_data->id."'";

    $stmt = conn()->prepare($sql);
    $stmt->execute();

    $output = array(
    'message' => 'Data Deleted'
    );

 echo json_encode($output);
}

/////////////////////////////////
/////////////ADMIN - News
/////////////////////////////////

if($received_data->action == "admin_insertNews")
{
    $data = array(
        ':title' => $received_data->title,
        ':body' => $received_data->body,
        ':date' => date('Y-m-d')
    );

    $sql = "INSERT INTO news(title, body, date) VALUES (:title, :body, :date)";

    $stmt = conn()->prepare($sql);
    $stmt->execute($data);

    $output = array('message' => 'Data Inserted');

    echo json_encode($output);

}

if($received_data->action == 'admin_updateNews')
{
    $data = array(
        ':title' => $received_data->title,
        ':body' => $received_data->body,
        ':id'   => $received_data->hiddenId
    );

    $sql = "UPDATE news SET title = :title, body = :body WHERE id = :id";

    $stmt = conn()->prepare($sql);
    $stmt->execute($data);

    $output = array(
    'message' => 'Data Updated'
    );
    echo json_encode($output);
}

if($received_data->action == "admin_fetchSingleNews")
{
    $sql = "SELECT * FROM news WHERE id = '".$received_data->id."'";

    $stmt = conn()->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetchAll();
        

    foreach($result as $row)
    {
    $data['id'] = $row['id'];
    $data['title'] = $row['title'];
    $data['body'] = $row['body'];
    }

    echo json_encode($data);
}

if($received_data->action == 'admin_deleteNews') {
    $sql = "DELETE FROM news WHERE id = '".$received_data->id."'";

    $stmt = conn()->prepare($sql);
    $stmt->execute();

    $output = array(
    'message' => 'Data Deleted'
    );

 echo json_encode($output);
}

/////////////////////////////////
/////////////ADMIN - Wallet
/////////////////////////////////

if($received_data->action == "admin_insertWallet")
{
    $data = array(
        ':customer_id' => $received_data->customer_id,
        ':currency' => $received_data->currency,
        ':balance' => $received_data->balance
    );

    $sql = "INSERT INTO wallet(customer_id, currency, balance, usd, eur, value) VALUES (:customer_id, :currency, :balance, 0, 0, 0)";

    $stmt = conn()->prepare($sql);
    $stmt->execute($data);

    $output = array('message' => 'Data Inserted');

    echo json_encode($output);

}

if($received_data->action == 'admin_updateWallet')
{
    $data = array(
        ':currency' => $received_data->currency,
        ':balance' => $received_data->balance,
        ':id'   => $received_data->hiddenId
    );

    $sql = "UPDATE wallet SET currency = :currency, balance = :balance  WHERE id = :id";

    $stmt = conn()->prepare($sql);
    $stmt->execute($data);

    $output = array(
    'message' => 'Data Updated'
    );
    echo json_encode($output);
}

if($received_data->action == "admin_fetchSingleWallet")
{
    $sql = "SELECT * FROM wallet WHERE id = '".$received_data->id."'";

    $stmt = conn()->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetchAll();
        

    foreach($result as $row)
    {
    $data['id'] = $row['id'];
    $data['customer_id'] = $row['customer_id'];
    $data['currency'] = $row['currency'];
    $data['balance'] = $row['balance'];
    }

    echo json_encode($data);
}

if($received_data->action == 'admin_deleteWallet') {
    $sql = "DELETE FROM wallet WHERE id = '".$received_data->id."'";

    $stmt = conn()->prepare($sql);
    $stmt->execute();

    $output = array(
    'message' => 'Data Deleted'
    );

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
                $verified     = 0;
                $status = 'inactive';
                $token      = sha1(bin2hex(date('U')));
                $timestamp  = date('U');

                $sql = "INSERT IGNORE INTO customer (email, first_name, last_name, verified, status, password, token, timestamp) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

                $stmt = conn()->prepare($sql);

                $data['err']= false;
                $data['msg']= "Sign Up successful. Please follow the link in your email to verify your account.";
                
                if ($stmt->execute([$email, $first_name, $last_name, $verified, $status, $password, $token, $timestamp])) {
                    $stmt = null;

                    $subject = 'Account verification';
                    // $message = 'Thank you for signing up!<br>Click the following link to verify your account: <br><b><a href=https://www.gonv.pt/api/verify.php?token='.$token.'&email='.$email.'>'.$token.'</a></b>';
                    $message = 'Thank you for signing up!<br>Click the following link to verify your account: <br><b><a href=http://localhost/api/verify.php?token='.$token.'&email='.$email.'>'.$token.'</a></b>';
                    
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

//STAFF - LOGIN
if ($received_data->action == "staff_login") {
    
    $username = $received_data->username;
    $password = $received_data->password;
    
    if (!empty($password) && !empty($username)) {
        $sql = "SELECT username, password, level FROM staff WHERE username = ?";

        $stmt = conn()->prepare($sql);
        if ($stmt->execute([$username])) {
            $r = $stmt->fetch();

            $stmt = null; 

            if (password_verify($password, $r['password'])) {
                
                $data['level'] = $r['level'];
                    
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
             
                    $data['email'] = $r['email'];
                    $data['token'] = $r['token'];
                    
                } 
                else if('inactive' == $r['status']) {
                    $data['err']= true;
                    $data['msg']= "Your account is not activated.";
                }
                else if('blocked' == $r['status']) {
                    $data['err']= true;
                    $data['msg']= "Account blocked. Please contact support for more info.";
                }
                else if('suspended' == $r['status'] || 'active' !== $r['status'] || 'inactive' !== $r['status'] || 'blocked' !== $r['status']) {
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

// User Fetch Wallet 

if ($received_data->action == "user_fetchAllWallet") {
    session_start();
    if (isset($_SESSION['loggedin'])) {

        $email = $_SESSION['email'];
        $token = $_SESSION['token'];

        $sql = "SELECT id FROM customer WHERE email = ?, token = ?";

        $stmt = conn()->prepare($sql);
        if ($stmt->execute([$email, $token])) {
            $r = $stmt->fetch();
            $stmt = null;
            
            $sql = "SELECT * FROM wallet WHERE customer_id = ?";
            
            $stmt = conn()->prepare($sql);
            $stmt->execute([$r['id']]);
            
            
            while ( $row = $stmt->fetch())  {
                $data[]=$row;
            }
            
            $stmt = null;
            
            echo json_encode($data);

        }
    } else {
        $data['msg']= "Session Expired. Please log in.";
    }
}