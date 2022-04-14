<?php
    if(isset($_SERVER["REQUEST_METHOD"])){

        if($_SERVER["REQUEST_METHOD"]=="GET"){
    
            require 'partials/_helpers.php';
    
            if(isset($_SERVER['REQUEST_URI'])){
                $url = $_SERVER['REQUEST_URI'];
                $url_components = parse_url($url);
                parse_str($url_components['query'], $params);
                $user_email = $params['email'];
                $user_hash = $params['sub'];
        
                if(password_verify($user_email."rtCamp",$user_hash)){
                    $query = "UPDATE `udb` SET `Is Verified` = '1' WHERE `udb`.`Email` = '$user_email'";
                    dbOperation($query);
                    $query = "UPDATE `udb` SET `time verified` = current_timestamp()  WHERE `udb`.`Email` = '$user_email'";
                    dbOperation($query);
                    
                    header("location: Thankyou.html");
                }
                else{
                    header("location: Bad.html");
                }
            }
        }
    }
?>