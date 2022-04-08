<?php

    include '_dbConnect.php';
    
    function randomHex16(){
        return bin2hex(random_bytes(16)); 
    }


    function mailSanitizer($mail){
        $sanitized =  filter_var($mail, FILTER_SANITIZE_EMAIL);
        if (filter_var($sanitized, FILTER_VALIDATE_EMAIL)) {
        return [$sanitized,$mail=== $sanitized];}
        else{
            return[false,false];
        }
    }

    function searchMail($mail){
        global $connect;
        $query = "SELECT * from udb where Email='$mail'";
        $check = mysqli_query($connect,$query);
        if(isZero(mysqli_num_rows($check))){
            return [true,$check];
        }
        else{
            return [false,$check];
        }
    }

    function insertIntoDB($mail){

        // db format :::  colls -->(`ID`, `Email`, `Is Verified`, `Time Created`) values -->(NULL, '$', '0', current_timestamp());

        global $connect;
        $query = "INSERT INTO `udb` (`ID`, `Email`, `Is Verified`, `Time Created`) VALUES (NULL, '$mail', '0', current_timestamp())";
            mysqli_query($connect,$query);
    }

    function showAlert($alert){
        if($alert){
            echo"<script ype='text/javascript'> alert('$alert')</script>";
        }
    }

    function isZero($var){
        return $var == 0;
    }

?>