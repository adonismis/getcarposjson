<?php
ignore_user_abort(true);
set_time_limit(0);


include_once "CarMap.php";
include_once "LineNotify.php";

if("Y"=="Y"){   

    sleep(20); // sleep 1分鐘 (以秒為單位)


    $CarDataUrl = 'http://117.56.173.200/ilepb_test/api/getcarposjson.ashx';
    $RouteId = 24; //垃圾車所屬ID
    $MapX = '24.772515';    //目的地座標X
    $MapY = '121.790057';    //目的地座標Y

    $carposition = new CarMap($CarDataUrl, $RouteId, $MapX, $MapY); //建立新物件
    $meter = $carposition->GetCarPosition();

    echo $meter;

    if($meter<=50){
      $Token = 'Ugy1sIpxGnjN7dY3oHeX8D6yTm0KkEnRkVbterWTJI5';
      $notify = new LineNotify($Token);
      $notify->PoMessage(" $meter 垃圾車快到嘍!!");
    }

    $content = date("Y-m-d H:i:s") . PHP_EOL;
    file_put_contents("carposlog.txt",$content,FILE_APPEND);
    unset($content);

    $ch = curl_init();
    $options = array( 
      CURLOPT_URL => "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'], 
      CURLOPT_HEADER => false, 
      CURLOPT_RETURNTRANSFER => true, 
      CURLOPT_TIMEOUT=>1,
      CURLOPT_USERAGENT => "Google Bot", 
      CURLOPT_FOLLOWLOCATION => true
    );

    curl_setopt_array($ch, $options);
    curl_exec($ch);
}



?>

