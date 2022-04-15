<?php
    require '../private/__API_KEYS.php';
    $server = "remotemysql.com";
    $username = "DhFCtDuGv7";
    $password = $mysql_Server_password;
    $database = "DhFCtDuGv7";

    $connect = mysqli_connect($server, $username, $password, $database);
    $status = 4;
    if($connect){
        $status = 2;
        // echo "Connected";
    }
    else{
        echo "error";
    }
?>