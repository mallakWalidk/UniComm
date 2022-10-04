<?php

//* Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include('../../core/init.php');

$obj = new Announcement($conn);

$data = json_decode(file_get_contents('php://input'), true);
$obj -> id = $data['id'];
$obj -> body = $data['body'];


if($obj -> update()) {
    //* works fine
    echo json_encode(true);
} else {
    //* error
    echo json_encode(false);
}


?>