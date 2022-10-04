<?php

//* Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");


include('../../core/init.php');

$user = new User($conn);

$user -> id = isset($_GET['id']) ? $_GET['id'] : null;
$user -> email = isset($_GET['email']) ? $_GET['email'] : null;


$row = $user -> read_single();
echo json_encode($row);




?>