<?php
    
    include 'partials/_helpers.php';
    
    function mailVerifier($email){
        $body = '
        <!DOCTYPE html>
        <html lang="en">
        <body>
        <div style="background: url(../Assets/Images/3806193.jpg); background-repeat:no-repeat; background-position:center;background-size:cover;padding:30px;width:max-content">
        <style>
            @import url(//db.onlinewebfonts.com/c/d0cb04e3ee499a746d538ca81a60eca0?family=sammyfont);
            *{
                font-family: "sammyfont";
                box-sizing: border-box;
            }
    
        </style>

        <h1 style="font-weight: 700; text-align:center;color:#fafafa;background:rgba(33,33,33,0.77);width:fit-content;padding:3px 10px;border-radius:8px"> Welcome to XKCD comic subsription</h1>
        <h3 style="font-weight: 600; text-align:center;color:#fafafa;background:rgba(33,33,33,0.77);width:fit-content;padding:3px 10px;border-radius:8px">Click below link to verfiy yourself for XKCD comic subsription</h3>
        <a href="http://localhost:8080/PHP_Coding/validator.php?email='.$email.'&sub='.password_hash($email."rtCamp",PASSWORD_BCRYPT).'"style="font-weight: 600; text-align:center;color:#fafafa;background: radial-gradient(50% 50% at 50% 50%, #363636 0%, rgba(22, 22, 22, 0.94) 0%, #1B2534 78.13%);width:fit-content;padding:3px 10px;border-radius:8px">Subscribe ✔</a>
        <h4 style="font-weight: 600; text-align:center;color:#fafafa;background:rgba(33,33,33,0.77);width:fit-content;padding:3px 10px;border-radius:8px">Ignore this mail if you have not subscribe for XKCD comic subsription</h4>
        </div>
        </body>
        </html>
        ';
        
        echo sendVerification($email,$body);
    }
?>