<?php
require_once ('db.php');

$sql = "SELECT * FROM users ORDER BY id ASC";

// $result = $dblink->query("SELECT * FROM actor LIMIT 3");

$stmt = conn()->prepare($sql);
$stmt->execute();

  $data = array();

  while ( $row = $stmt->fetch())  {
	$data[]=$row;
  }

  $stmt = null;


echo json_encode($data);
