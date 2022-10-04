<?php
//* Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");


include_once('../../core/init.php');


$obj = new Post($conn);


$data = json_decode(file_get_contents("php://input"), true);
$obj->id = $data;


if ($obj->delete()) {
    echo json_encode(true);
} else {
    echo json_encode(false);
}
