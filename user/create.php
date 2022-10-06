<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: CREATE");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    include_once '../config.php';
    $result = [];
    function filter($n){
        $a = htmlspecialchars($n);
        return $a;
    }
    function email_check($email) {
        $v = "/[a-zA-Z0-9_-.+]+@[a-zA-Z0-9-]+.[a-zA-Z]+/";
        return !filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    if (isset($_GET['name'])){
        $name = filter($_GET['name']);
        $email = filter($_GET['email']);
        $pass = md5($_GET['password']);

        if(strlen($_GET['password']) < 8){
            $result = [
                "error"   => "Parol kamida 8 ta belgidan iborat bo'lishi kerak",
                "success" => "0"
            ];
        }elseif (email_check($email)){
            $result = [
                "error"   => "Email yaroqli emas",
                "success" => "0"
            ];
        }elseif(strlen($name) < 4){
            $result = [
                "error"   => "Bu negadir odam bolasi ismiga o'xshamayapdi",
                "success" => "0"
            ];
        }else{
            $data = mysqli_query($sql,"INSERT INTO `user`(`id`, `name`, `email`, `password`) VALUES (NULL,'$name','$email','$pass')");
            if ($data){
                $result = [
                    "error"   => "Malumotlar saqlandi",
                    "success" => "1"
                ];
            }else{
                $result = [
                    "error"   => "Malumot saqlashda hatolik",
                    "success" => "0"
                ];
            }
        }
    }else{
        $result = [
            "error"   => "Malumot kelishidagi hatolik",
            "success" => "0"
        ];
    }
    echo json_encode($result);
?>