<?php

//* Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");


include('../../core/init.php');

$user = new User($conn);


$result = $user -> read();
$rows = $result -> fetch_all(MYSQLI_ASSOC);
echo json_encode($rows);




?>