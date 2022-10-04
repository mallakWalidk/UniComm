<?php

//* Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");


include('../../core/init.php');

$obj = new Course($conn);

$obj -> department = isset($_GET['dep_name']) ? $_GET['dep_name'] : null;

$rows = $obj -> read();
echo json_encode($rows);




?>