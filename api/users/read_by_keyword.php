<?php

//* Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");


include('../../core/init.php');

$user = new User($conn);

$data = json_decode(file_get_contents('php://input'), true);
$user -> name = $data['name'] . '%';


$rows = $user -> read_by_keyword();
echo json_encode($rows);




?>