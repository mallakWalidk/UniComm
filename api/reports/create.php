<?php

//* Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include('../../core/init.php');

$obj = new Report($conn);

$data = json_decode(file_get_contents('php://input'),true);
$obj -> post_id = $data['post_id'];
$obj -> body = $data['body'];

if($obj -> create()) {
    //* works fine
    echo json_encode(true);
} else {
    //* error
    echo json_encode(false);
}

?>