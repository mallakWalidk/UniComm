<?php

//* Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include('../../core/init.php');

$obj = new Message($conn);

$data = json_decode(file_get_contents('php://input'),true);
$obj -> sender_id = $data['sender_id'];
$obj -> reciever_id = $data['reciever_id'];
$obj -> body = $data['body'];

if ($data['msg_id'] == 'none') {
    $msg_id = rand(0,1000);
    $obj -> msg_id = $msg_id;
} else {
    $obj -> msg_id = $data['msg_id'];
}

if($obj -> create()) {
    //* works fine
    echo json_encode(true);
} else {
    //* error
    echo json_encode(false);
}

?>