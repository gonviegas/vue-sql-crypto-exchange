<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: *');

function conn() {
    $host = 'localhost';

    // ******* DEV 
    $db   = 'crypto-exchange';
    $user = 'root';
    $pass = 'root';
    //         DEV *******
    
    // ******* DEPLOYMENT
    // $db   = 'gonvpt_crypto-exchange';
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

//  PHP Mailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function email($to, $subject, $message)
{
    require $_SERVER['DOCUMENT_ROOT'].'vendor/autoload.php';
    $mail = new PHPMailer(true);

    try {
      
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'hosting63.serverhs.org';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'mail@gonv.pt';
        $mail->Password   = '%mD-G+qxIOE^';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom('mail@gonv.pt', 'GONV.PT');
        $mail->addAddress($to);
        $mail->addReplyTo('no-reply@gonv.pt', 'Information');

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;
        //$mail->AltBody = 'Copy-past this code somewhere: '.$token;

        $mail->send();
    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
}