<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once 'config.php';
    $result = [];
    if(isset($_GET['user']) and isset($_GET['email'])){
        $user = mysqli_escape_string($_GET['user']);
        $email = mysqli_escape_string($_GET['email']);
        $data = mysqli_query($sql,"SELECT * FROM `user` WHERE name='$user' AND email='$email'");
        $count = mysqli_num_rows($data);
        if($count > 0){
            $i = 0;
            while ($row = mysqli_fetch_assoc($data)) {
                $result[$i] = [
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'password' => $row['password'],
                    'success' => "1"
                ];
                $i ++;
            }
        }
        else{
            $result = [
                "error"    => "Bunday nomli foydalanuvchi yo'q",
                'success'  => "0"
            ];
        }
    }else{
        $result += [
            'error'    => "Malumot kelishidagi xatolik",
            'success'  => "0"
        ];
    }
    http_response_code(200);
    echo json_encode($result);
?>
