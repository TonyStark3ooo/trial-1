<?php
// db format :::  colls -->(`ID`, `Email`, `Is Verified`, `Time Created`) values -->(NULL, '$', '0', current_timestamp());
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include 'partials/_dbConnect.php';
        $mail = $_POST["mail_id"];
        $query = "SELECT * from udb where Email='$mail'";
        $check = mysqli_query($isConnect,$query);

        $alert = '';
        if(mysqli_num_rows($check)==0){
            $query = "INSERT INTO `udb` (`ID`, `Email`, `Is Verified`, `Time Created`) VALUES (NULL, '$mail', '0', current_timestamp())";
            mysqli_query($isConnect,$query);
            $alert = 'Thank you, Enjoy your subscription';
        }
        else{
            $row = mysqli_fetch_assoc($check);
            // $mailStatus = $row['Is Verified'];
            $alert = 'You alredy have subscribed';
        }
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
    <?php
        if($alert != ""){
            echo"<script ype='text/javascript'> alert('$alert')</script>";
        }
    ?>
</body>
</html>