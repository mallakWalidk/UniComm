<?php

//* Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");


include('../../core/init.php');

$obj = new Post($conn);
$obj -> dep_name = isset($_GET['dep_name']) ? $_GET['dep_name'] : null;


$rows = $obj -> read_by_dep();
echo json_encode($rows);




?>