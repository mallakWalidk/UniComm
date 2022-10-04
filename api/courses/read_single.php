<?php

//* Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");


include('../../core/init.php');

$obj = new Course($conn);

$obj -> id = isset($_GET['id']) ? $_GET['id'] : null;


$row = $obj -> read_single();
echo json_encode($row);




?>