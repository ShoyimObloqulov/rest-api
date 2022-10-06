<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "resp-api";

    $sql = mysqli_connect($host,$user,$pass,$db);
    function run($sql){
        if ($sql){
            return $sql;
        }else{
            return mysqli_error($sql);
        }
    }