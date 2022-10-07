<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once 'config.php';
    $result = [];
    if ($_SERVER['REQUEST_METHOD'] == 'PUT'){
        $data = mysqli_query($sql,"SELECT * FROM `user`");

        if ($data){
            $count = mysqli_num_rows($data);
            if ($count > 0){
                $i = 0;
                $result = [
                    "message" => "Barcha malumotlar kemoqda",
                    "success" => "1"
                ];
                while ($row = mysqli_fetch_assoc($data)){
                    $result[$i] = [
                        "name"  => $row['name'],
                        "email" => $row['email']
                    ];
                    $i ++;
                }

            }else{
                $result = [
                    "message" => "Bazada malumot mavjud emas",
                    "success" => "1"
                ];
            }
        }else{
            $result = [
                "error"   => "Data mavjud emas",
                "success" => "0"
            ];
        }
    }else{
        $result = [
            "error"   => "Murojat qilishdagi hatolik",
            "success" => "0"
        ];
    }
    http_response_code(200);
    echo json_encode($result);

