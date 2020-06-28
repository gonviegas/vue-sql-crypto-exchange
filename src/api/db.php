<?php
function conn() {
    $host = 'localhost';

    // ******* PRODUCTION 
    $db   = 'dummy';
    $user = 'usurp';
    $pass = 'usurp';
    //         PRODUCTION *******
    
    // ******* DEPLOYMENT
    // $db   = 'gonvpt_dummy';
    // $user = 'gonvpt_regular';
    // $pass = '#(iXS^WT!Zjq';
    //         DEPLOYMENT *******
    
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    $received_data = json_encode(file_get_contents("php://input"));


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