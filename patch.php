<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once 'config.php';
    $result = [];
    function is_obj_empty($obj){
        if( is_null($obj) ){
            return true;
        }
        foreach( $obj as $key => $val ){
            return false;
        }
        return true;
    }
    if ($_SERVER['REQUEST_METHOD'] == 'PATCH'){
        $json = $_GET;
        $id = $_GET['id'];
        $data = mysqli_query($sql,"SELECT * FROM `user` WHERE id='$id'");
        try {
            $arr = mysqli_fetch_assoc($data);
            foreach ($json as $key => $value){
                $arr[$key] = $value;
            }
            $name  = $arr['name'];
            $email = $arr['email'];
            $update = mysqli_query($sql,"UPDATE `user` SET `name`='$name',`email`='$email' WHERE id='$id'");
            if ($update){
                $result = [
                    "message"  => "Malumotlar saqlandi",
                    "success"  => "1"
                ];
            }else{
                $result = [
                    "error"  => "Malumotlar saqlashda hatolik",
                    "success"  => "0"
                ];
            }
        }catch (Exception $e) {
            $result = [
                "error"  => "Malumotlar kelishidagi hatolik",
                "success"  => "0"
            ];
        }
    }else{
        $result = [
            "error"  => "Request kelishdagi hatolik",
            "success"  => "0"
        ];
    }
    http_response_code(200);
    echo json_encode($result);