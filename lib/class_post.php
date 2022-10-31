<?php
require_once __DIR__ . "/class_db.php";
class Post extends DB {
    private $table = "posts";

    function getAll(){
        $sql = "select * from `$this->table` where status =1";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0){
            $response = [];
            while ($row = $result->fetch_assoc()){
                $response[] = $row;
            }
            return json_encode($response);
        } else{
            return json_encode(array(
               'status' => 0,
               'massage' => 'not found any post'
            ));
        }
    }
}

?>
