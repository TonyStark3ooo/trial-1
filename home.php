<?php


if($_SERVER["REQUEST_METHOD"]=="POST"){
        include 'partials/_dbConnect.php';
        include 'partials/_helpers.php';

        
        $alert = '';
        $mail = $_POST["mail_id"];

        list($noMatchFound,$resuls) = searchMail($mail);
        if($noMatchFound){
            list($isMailValid, $noChangeInMail) = mailSanitizer($mail);
            if($isMailValid){
                if($noChangeInMail){
                    insertIntoDB($mail);
                    $alert = 'Thank you\nEnjoy your subscription';
                }
                else{
                    $alert = 'Your Email is valid but not sanitized please enter it as\n'.$isMailValid;
                }
            }else{
                $alert = "We are failed to validate your Email address\n kindly check it and try again";
            }
        }
        else{
            $row = mysqli_fetch_assoc($resuls);
            // $mailStatus = $row['Is Verified'];
            $alert = 'You alredy have subscribed';
        }
        showAlert($alert);
    }



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>rt camp assignment</title>
    <link rel="icon" type="image/x-icon" href="Assets/Logos/RTC-logo.png">
    <link rel="stylesheet" href="StyleSheet.css">
</head>
<body>
    
    <header>
        <p>Welcome to, XKCD WebComic mail subsrciption</p>
        <div class="back-img"></div>
    </header>
    <section>
        <form  method="post">
            <p class="heading-2">subsrciption</p>
            <input type="email" name="mail_id" id="mailBox" placeholder="Email here">
            <input type="submit" value="Subscribe!!" class="btn">
        </form>
        <div class="right-img">
            <p>!! Some of Eye-Conic Comic Pages !!</p>
            <div class="swipper">
                <p class="left"><</p>
                <p class="right">></p>
            </div>
        </div>
    </section>
    <footer>
        <div class="caution"></div>
        <p>
            This page is created under assignment of RT Camp. This page does not generate any kind of income.
        </p>
    </footer>
</body>
</html>