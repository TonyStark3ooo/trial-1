<?php
    
    include 'partials/_helpers.php';
    include './private/__API_KEYS.php';
    

    $results = giveSendingMails();
    
    $emails = array();

    while($row = mysqli_fetch_assoc($results)) {
        $temp = array("email"=>$row["Email"]);
        array_push($emails,$temp);
    }
    
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
        
    </body>
    </html>
    ';
    
    $img = file_get_contents($response["img"]);
    echo sendMails($emails,$body,$img,$response["safe_title"]);

?>