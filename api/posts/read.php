<?php

//* Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");


include('../../core/init.php');

$obj = new Post($conn);


$rows = $obj -> read();
echo json_encode($rows);




?>