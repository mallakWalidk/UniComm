<?php

//* Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include('../../core/init.php');

$user = new User($conn);

$data = json_decode(file_get_contents('php://input'),true);
$user -> name = $data['name'];
$user -> email = $data['email'];
$user -> gender = $data['gender'];
$user -> birth_date = $data['birth_date'];
$user -> phone = $data['phone'];
$user -> department = $data['department'];
$user -> password = $data['password'];
$user -> level = $data['level'];
$user -> type = $data['type'];
$user -> profile_pic = $data['profile_pic'];
if($user -> create()) {
    //* works fine
    echo json_encode(true);
} else {
    //* error
    echo json_encode(false);
}

?>