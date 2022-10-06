<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: DELETE");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    $result = [];
    include_once '../config.php';
    if (isset($_GET['id'])){
        $id = $_GET['id'];
        $data = mysqli_query($sql,"DELETE FROM `user` WHERE id='$id'");
        if ($data){
            $result = [
                "message" => "User o'chirildi",
                "success" => "1"
            ];
        }else{
            $result = [
                "error" => "Bunday nomli user mavjud emas",
                "success" => "0"
            ];
        }
    }else{
        $result = [
            "error" => "Malumot kelishidagi hatolik",
            "success" => "0"
        ];
    }
    echo json_encode($result);