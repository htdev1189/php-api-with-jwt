<?php
require_once __DIR__ . "/class_db.php";
require_once __DIR__ . "/../vendor/autoload.php";
use \Firebase\JWT\JWT;





class User extends DB
{

    private $table = "users";

    function addToken($token,$id){
        $sql = "update users set token = ? where id = ? ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si",$token,$id);
        $stmt->execute();
        $stmt->close();
    }

    function existToken($token){
        $sql = "select * from users where token = '{$token}' ";
        /*$stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s",$token);
        $stmt->execute();
        print_r($stmt);exit();
        if ($stmt->num_rows > 0) {
            return true;
        } else{
            return false;
        }
        $stmt->close();*/

        $query = $this->conn->query($sql);
        if ($query->num_rows > 0) {
            return true;
        } else{
            return false;
        }
    }

    /*login*/
    function login($data_input){
        $username = array_key_exists("username", $data_input) ? $data_input['username'] : '';
        $password = array_key_exists("password", $data_input) ? $data_input['password'] : '';

        if ($username != "" && $password != ""){
            $sql = "select * from `$this->table` where username = '$username'";
            $query = $this->conn->query($sql);
            if ($query->num_rows > 0){
                $user_info = $query->fetch_assoc();

                /* Kiem tra password thong qua Hash
                 * */
                if (password_verify($password,$user_info['password'])){

                    $request_data = [
                        'iat'  => time(),//bắt đầu
                        'iss'  => "http://apiphpjwt.htdev",
                        'nbf'  => time(),// Có thể liên lục (nếu > 0 thì sau đ từng đso giây mới có thể request tiếp)
                        'exp'  => time() + 60*60*24, // hết hạn sau 60s
                        'userName' => 'admin',
                    ];
                    $token = JWT::encode($request_data,$this->primary_key,$this->ALGORITHM);
                    /* store token to database */
                    $this->addToken($token,$user_info['id']);

                    http_response_code(200);
                    return json_encode(array(
                        'status' => 1,
                        'massage' => "Login success",
                        'token' => $token
                    ));
                } else{
                    http_response_code(401);
                    return json_encode(array(
                        'status' => 0,
                        'massage' => "Pass wrong!!!"
                    ));
                }

            } else{
                http_response_code(401);
                return json_encode(array(
                    'status' => 0,
                    'massage' => "Username wrong!!!"
                ));
            }
        }else{
            http_response_code(401);
            return json_encode(array(
                'status' => 0,
                'massage' => "Check empty fields"
            ));
        }
    }
}