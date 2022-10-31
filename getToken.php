<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type: application/json; charst=UTF-8");

require_once __DIR__ . "/lib/class_user.php";
$user = new User();

$result = '';
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "POST":
        $data_input = json_decode(file_get_contents("php://input"), true);
        $result = $user->login($data_input);
        break;
    default :
        break;
}

echo $result;
?>