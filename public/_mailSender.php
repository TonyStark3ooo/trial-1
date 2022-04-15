<?php
    
    require '../partials/_helpers.php';
    

    $results = giveSendingMails();

    while($row = mysqli_fetch_assoc($results)) {
        $email = $row["Email"];
        echo $email;
    
        $comicNumber = rand(0,614);
        $response = file_get_contents('https://xkcd.com/'.$comicNumber.'/info.0.json');
        $response = json_decode($response,true);

        $body = '
        <!DOCTYPE html>
        <html lang="en">
        <body>
            <div>
                <style>
                    @import url(//db.onlinewebfonts.com/c/d0cb04e3ee499a746d538ca81a60eca0?family=sammyfont);
                    *{
                        font-family: "sammyfont";
                        box-sizing: border-box;
                    }
            
                </style>
                
                <h1 style="font-weight: 700;color:rgb(33,33,33);">Its <strong>'.$response["safe_title"].'</strong> </h1>
                <h3 style="color:rgb(33,33,33);">comic number '.$response["num"].' released on '.$response["day"].'/'.$response["month"].'/'.$response["year"].'</h3>
                <img src='.$response["img"].' alt='.$response["alt"].'>
                <h3 style="color:rgb(33,33,33);">transcript</h3>
                <h4 style="font-weight: 500;color:rgb(33,33,33);">'.str_replace("\n","<br>",$response["transcript"]).'</h4>
            </div>
            <a href="https://janak-patel-rtc-assignment.herokuapp.com/unsubscribe.php?email='.$email.'&unsub='.password_hash(strrev($email."rtCamp"),PASSWORD_BCRYPT).'"style="font-weight: 700;font-size:22 ">Unsubscribe</a>
            or
            "https://janak-patel-rtc-assignment.herokuapp.com/unsubscribe.php?email='.$email.'&unsub='.password_hash(strrev($email."rtCamp"),PASSWORD_BCRYPT).'"
        </body>
        </html>
        ';
        
        $img = file_get_contents($response["img"]);
        sendMails($email,$body,$img,$response["safe_title"]);
    }
?>