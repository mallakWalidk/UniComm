<?php

//* Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");


include('../../core/init.php');

$obj = new Comment($conn);

$obj -> post_id = isset($_GET['post_id']) ? $_GET['post_id'] : null;

$rows = $obj -> read();
echo json_encode($rows);




?>