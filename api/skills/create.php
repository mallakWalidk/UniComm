<?php

//* Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include('../../core/init.php');

$skill = new Skill($conn);

$data = json_decode(file_get_contents('php://input'),true);
$skill -> user_id = $data['user_id'];
$skill -> name = $data['skills'];
$skill -> value = $data['skill_vals'];

if($skill -> create()) {
    //* works fine
    echo json_encode(true);
} else {
    //* error
    echo json_encode(false);
}

?>