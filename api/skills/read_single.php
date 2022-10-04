<?php

//* Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");


include('../../core/init.php');

$skill = new Skill($conn);

$skill -> user_id = isset($_GET['user_id']) ? $_GET['user_id'] : null;


$rows = $skill -> read_single();
echo json_encode($rows);




?>