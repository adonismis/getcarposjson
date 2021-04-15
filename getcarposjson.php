<?php
    $url = "http://117.56.173.200/ilepb_test/api/getcarposjson.ashx";
    $resutlt = file_get_contents($url);
    $data = json_decode($resutlt, true);

    foreach ($data as $key => $car) {
      if($car["ROUTEID"]==25){
        $car["GPSTIME"] = date("Y-m-d H:i:s", strtotime($car["GPSTIME"] ." +8 hours"));
        $row = $car;
      }
    }



    
    /**
    * Line 傳訊息
    * 
    */
    $headers = array(
        'Content-Type: multipart/form-data',
        'Authorization: Bearer Ugy1sIpxGnjN7dY3oHeX8D6yTm0KkEnRkVbterWTJI5'
    );
    
    $message = array(
        'message' => 'Hello,Kira~'
    );
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://notify-api.line.me/api/notify");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
    $result = curl_exec($ch);
    
    curl_close($ch);




    /**
    * 計算兩組經緯度坐標 之間的距離
    * params ：lat1 緯度1； lng1 經度1； lat2 緯度2； lng2 經度2； len_type （1:m or 2:km);
    * return m or km
    */
    function GetDistance($lat1, $lng1, $lat2, $lng2, $len_type = 1, $decimal = 2) {
      $radLat1 = $lat1 * PI / 180.0;
      $radLat2 = $lat2 * PI / 180.0;
      $a = $radLat1 - $radLat2;
      $b = ($lng1 * PI / 180.0) - ($lng2 * PI / 180.0);
      $s = 2 * asin(sqrt(pow(sin($a/2),2) + cos($radLat1) * cos($radLat2) * pow(sin($b/2),2)));
      $s = $s * EARTH_RADIUS;
      $s = round($s * 1000);
      if ($len_type > 1)
      {
      $s /= 1000;
      }
      return round($s, $decimal);
    }



    print_r($row)
;?>

