<?php

    include '_dbConnect.php';
    include './private/__API_KEYS.php';
  
    
    
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

    function dbOperation($query){
        global $connect;
        mysqli_query($connect,$query);
    }

    function insertIntoDB($mail){

        // cols.: (`ID`, `Email`, `Is Verified`, `Time Created`, `verification hash`, `time verified`, `unsubscribe hash`, `time unsubscribe`)
        // VALUES .: (NULL, 'mail', '0', current_timestamp(), 'paasword_hash(email,BCRYPT)', current_timestamp(), 'password_hash(rev_email,BCRYPT)', current_timestamp());

        global $connect;
        $ver_hash = password_hash($mail."rtCamp",PASSWORD_BCRYPT);
        $unsub_hash = password_hash(strrev($mail."rtCamp"),PASSWORD_BCRYPT);
        $query = "INSERT INTO `udb` (`ID`, `Email`, `Is Verified`, `Time Created`, `verification hash`, `time verified`, `unsubscribe hash`, `time unsubscribe`) VALUES (NULL, '$mail', '0', current_timestamp(), '$ver_hash', NULL, '$unsub_hash', NULL);";
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

    function sendMails($email,$body,$img,$comicName){
        global $SendGrid_API;
        $name = "JanakPatel";
        $subject = "random XKCD comic";
        $headers = array(
            'Authorization: Bearer '.$SendGrid_API,
            'Content-Type: application/json'
        );

        $data = array(
            "personalizations" => array(
                array(
                    "to" =>array(
                        array(
                            "email" => $email
                            )
                        )
                         
                )
            ),
            "from" => array(
                "email" => "2018ecjan068@gmail.com",
                "name" => $name
            ),
            "subject" => $subject,
            "content" => array(
                array(
                    "type" => "text/html",
                    "value" => $body
                )
            ),
            "attachments" => array(
                array(
                    "content" => base64_encode($img),
                    "type" => "image/jpg",
                    "filename" => "comic-".$comicName,
                    "disposition" => "attachment",
                    "content_ID" => "comic-".$comicName,
                ),
            ) 
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.sendgrid.com/v3/mail/send");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    function giveSendingMails(){
        global $connect;
        $query = "SELECT Email from udb where `Is Verified`='1'";
        $results =  mysqli_query($connect,$query);
        return $results;
    }

    function sendVerification($email,$body){
        global $SendGrid_API;
        $name = "JanakPatel";
        $subject = "random XKCD comic";
        $headers = array(
            'Authorization: Bearer '.$SendGrid_API,
            'Content-Type: application/json'
        );

        $data = array(
            "personalizations" => array(
                array(
                    "to" =>array(
                        array(
                            "email" => $email
                            )
                        )
                         
                )
            ),
            "from" => array(
                "email" => "2018ecjan068@gmail.com",
                "name" => $name
            ),
            "subject" => $subject,
            "content" => array(
                array(
                    "type" => "text/html",
                    "value" => $body
                )
            ),
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.sendgrid.com/v3/mail/send");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
?>