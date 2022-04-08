<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "UDB";

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