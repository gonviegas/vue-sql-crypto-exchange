<?php
require_once ('db.php');

$sql = "SELECT * FROM users ORDER BY id ASC";

// $result = $dblink->query("SELECT * FROM actor LIMIT 3");

$stmt = conn()->prepare($sql);
$stmt->execute();
//Initialize array variable
  $res = array();

//Fetch into associative array
  while ( $row = $stmt->fetch())  {
	$res[]=$row;
  }
  $stmt = null;
//Print array in JSON format
 echo json_encode($res);
