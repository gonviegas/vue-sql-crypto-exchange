<?php
header("Access-Control-Allow-Origin: http://localhost:8080");
header('Access-Control-Allow-Headers: Content-Type');

function conn() {
    $host = 'localhost';

    // ******* DEV 
    $db   = 'crypto-exchange';
    $user = 'usurp';
    $pass = 'usurp';
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