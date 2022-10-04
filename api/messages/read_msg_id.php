<?php

//* Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");


include('../../core/init.php');

$obj = new Message($conn);

$obj -> sender_id = isset($_GET['sender_id']) ? $_GET['sender_id'] : die("no sender_id");
$obj -> reciever_id = isset($_GET['reciever_id']) ? $_GET['reciever_id'] : die("no reciever_id");

$row = $obj -> read_msg_id();
echo json_encode($row);




?>