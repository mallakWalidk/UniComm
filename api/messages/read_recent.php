<?php

//* Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");


include('../../core/init.php');

$obj = new Message($conn);

$obj -> id = isset($_GET['id']) ? $_GET['id'] : die("no id");

$row = $obj -> read_recent();
echo json_encode($row);




?>