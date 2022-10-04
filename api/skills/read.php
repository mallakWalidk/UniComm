<?php

//* Headers
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");


include('../../core/init.php');

$skill = new Skill($conn);


$result = $skill -> read();
$rows = $result -> fetch_all(MYSQLI_ASSOC);
echo json_encode($rows);




?>