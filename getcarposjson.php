<?php
include_once "CarMap.php";
include_once "LineNotify.php";

$CarDataUrl = 'http://117.56.173.200/ilepb_test/api/getcarposjson.ashx';
$RouteId = 24; //垃圾車所屬ID
$MapX = '24.772515';    //目的地座標X
$MapY = '121.790057';    //目的地座標Y

$carposition = new CarMap($CarDataUrl, $RouteId, $MapX, $MapY); //建立新物件
$str = $carposition->GetCarPosition();

echo $str;

$Token = 'Ugy1sIpxGnjN7dY3oHeX8D6yTm0KkEnRkVbterWTJI5';
$notify = new LineNotify($Token);
$notify->PoMessage("測試～");   




?>

