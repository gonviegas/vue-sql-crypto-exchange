<?php
require_once ('db.php');

$received_data = json_decode(file_get_contents('php://input'));
$data = array();

//STAFF - FETCH STORE WALLET

if ($received_data->action == "news") {
    
    $sql = "SELECT * FROM news ORDER BY id ASC";
    
    $stmt = conn()->prepare($sql);
    $stmt->execute();
    
    while ( $row = $stmt->fetch())  {
        $data[]=$row;
    }
    
    $stmt = null;
    
    echo json_encode($data);
}

if ($received_data->action == "news,DATE") {
    
    $sql = "SELECT * FROM news ORDER BY date ASC";
    
    $stmt = conn()->prepare($sql);
    $stmt->execute();
    
    while ( $row = $stmt->fetch())  {
        $data[]=$row;
    }
    
    $stmt = null;
    
    echo json_encode($data);
}

if ($received_data->action == "market,USD") {
    
    $sql = "SELECT currency, usd FROM store_wallet ORDER BY id ASC";
    
    $stmt = conn()->prepare($sql);
    $stmt->execute();
    
    while ( $row = $stmt->fetch())  {
        $data[]=$row;
    }
    
    $stmt = null;
    
    echo json_encode($data);
}

if ($received_data->action == "market,EUR") {
    
    $sql = "SELECT currency, eur FROM store_wallet ORDER BY id ASC";
    
    $stmt = conn()->prepare($sql);
    $stmt->execute();
    
    while ( $row = $stmt->fetch())  {
        $data[]=$row;
    }
    
    $stmt = null;
    
    echo json_encode($data);
}