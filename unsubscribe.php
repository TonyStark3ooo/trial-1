<?php
    if(isset($_SERVER['REQUEST_URI'])){
        $url = $_SERVER['REQUEST_URI'];
        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);
        $user_email = $params['email'];
        $user_hash = $params['unsub'];

        if(isset($_SERVER["REQUEST_METHOD"])){

            if($_SERVER["REQUEST_METHOD"]=="POST"){
                include 'partials/_helpers.php';
                $alert = '';
                list($noMatchFound,$resuls) = searchMail($user_email);
                if($noMatchFound){
                    header("Location: Bad.html");
                }
                else{
                        if(password_verify(strrev($user_email."rtCamp"),$user_hash)){
                            $query = "DELETE FROM `udb` WHERE Email='$user_email'";
                            dbOperation($query);
                            $alert = "We lost our family member\ncalled`".$user_email."`";
                            header("Location: ByeBye.html");
                        }
                        else{
                            header("Location: Bad.html");
                        }
                }
            }
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>unsubscribe</title>
    <link rel="icon" type="image/x-icon" href="Assets/Logos/RTC-logo.png">
    <link rel="stylesheet" href="StyleSheet.css">
</head>
<body>
    <h1>Its like we are loosing our family member <img class="inline-img" src="assets/Images/sad.png" alt=""></h1>
    
    <h4>Please click unsubscribe if u are not here accidently!!!</h2>
    <form action="" method="POST">
        <input type="submit" value="unsubscribe" class="btn">
    </form>
</body>
</html>