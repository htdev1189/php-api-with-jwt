<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Content-type: application/json; charst=UTF-8");

require_once __DIR__ . "/../vendor/autoload.php";

use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

require_once __DIR__ . "/../lib/class_post.php";
require_once __DIR__ . "/../lib/class_user.php";
$post = new Post();
$user = new User();

$method = $_SERVER['REQUEST_METHOD'];

$allHeader = getallheaders();
$Bearer_token = array_key_exists("Authorization", $allHeader) ? $allHeader['Authorization'] : '';

// if empty
if ($Bearer_token == '') {
    http_response_code(400);
    echo json_encode(array(
        'status' => 0,
        'massage' => "Token not found in request"
    ));
    exit;
}


try {

    if (preg_match('/Bearer\s(\S+)/', $Bearer_token, $matches)) {
        $jwt_string = $matches[1];
    }

    $decoded = JWT::decode($jwt_string, new Key($user->primary_key, $user->ALGORITHM));

    switch ($method) {
        case "GET":
            /* if token exist in database => return response */
            if ($user->existToken($jwt_string)) {
                echo $post->getAll();
            }
            break;
        default:
            break;
    }
} catch (Exception $ex) {
    /*token het han*/
    http_response_code(500);
    echo json_encode(array(
        'status' => 0,
        'message' => $ex->getMessage()
    ));
    exit();
}

?>