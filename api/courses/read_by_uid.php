<?php

//* Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");


include('../../core/init.php');

$obj = new Course($conn);

$obj -> department = isset($_GET['dep_name']) ? $_GET['dep_name'] : null;
$obj -> author_id = isset($_GET['uid']) ? $_GET['uid'] : null;

$rows = $obj -> read_by_uid();
echo json_encode($rows);




?>