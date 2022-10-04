<?php

//* Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include('../../core/init.php');

$obj = new Course($conn);

$data = json_decode(file_get_contents('php://input'),true);
$obj -> author_id = $data['author_id'];
$obj -> department = $data['department'];
$obj -> author_id = $data['author_id'];
$obj -> course_name = $data['course_name'];
$obj -> subject_name = $data['subject_name'];
$obj -> file = $data['file'];
$obj -> faculty = $data['faculty'];

if($obj -> create()) {
    //* works fine
    echo json_encode(true);
} else {
    //* error
    echo json_encode(false);
}

?>