<?php

//* Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");


include('../../core/init.php');

$user = new User($conn);

$user -> department = isset($_GET['dep_name']) ? $_GET['dep_name'] : null;


$rows = $user -> read_by_dep();
echo json_encode($rows);




?>