<?php
    $host = "HOSTNAME";
    $user = "USER";
    $pass = "DBPASSWORD";
    $db = "DBNAME";

    $sql = mysqli_connect($host,$user,$pass,$db);
    function run($sql){
        if ($sql){
            return $sql;
        }else{
            return mysqli_error($sql);
        }
    }
