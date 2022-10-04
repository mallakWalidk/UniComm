<?php

//* Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include('../../core/init.php');

$obj = new Post($conn);

$data = json_decode(file_get_contents('php://input'), true);
$obj -> id = $data['id'];
$obj -> author_id = $data['author_id'];
$obj -> body = $data['body'];
$obj -> image = $data['image'];


if($obj -> update()) {
    //* works fine
    echo json_encode(true);
} else {
    //* error
    echo json_encode(false);
}


?>