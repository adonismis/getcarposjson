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
    
    $log_time  = "1";
    $data_time = "2";

    //讀取log
    $log_r = fopen("log.csv","a+");
    while ($data = fgetcsv($log_r, 1000, ",")) {
      $log_time = $data[2];
    }

    //判斷寫入
    $fp = fopen('file.csv', 'a+');
    $data = fgetcsv($fp, 1000, ",");
    $data_time = $data[2];
    if($log_time != $data_time){
      fputcsv($fp, $row);
      fputcsv($log_r, $row);
    }
    fclose($fp);

    print_r($row)
;?>

