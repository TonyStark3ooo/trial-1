<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "UDB";

    $isConnect = mysqli_connect($server, $username, $password, $database);
    $status = 4;
    if($isConnect){
        $status = 2;
        // echo "Connected";
    }
    else{
        echo "error";
    }
?>