<?php
//* Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");


include_once('../../core/init.php');


$skill = new Skill($conn);

$data = json_decode(file_get_contents("php://input"));
$skill->id = $data;


if ($skill->delete()) {
    echo json_encode(true);
} else {
    echo json_encode(false);
}
