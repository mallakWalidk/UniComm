<?php
session_start();

//* Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");


include('../../core/init.php');

$obj = new Message($conn);

$obj -> id = $_GET['id'];

$rows = $obj -> read();
echo json_encode($rows);




?>