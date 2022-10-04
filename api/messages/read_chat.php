<?php

//* Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");


include('../../core/init.php');

$obj = new Message($conn);

$obj -> msg_id = isset($_GET['msg_id']) ? $_GET['msg_id'] : null;

$rows = $obj -> read_chat();
echo json_encode($rows);




?>