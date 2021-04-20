<?php
class CarMap {
    public $cardataurl = "";
    public $routeid    = "";
  
    public function __construct($CarDataUrl, $RouteId, $MapX, $MapY){
      $this->cardataurl = $CarDataUrl;
      $this->routeid = $RouteId;
      $this->mapx = $MapX;
      $this->mapy = $MapY;
  
    }
  
    public function GetCarPosition(){
      $url     = $this->cardataurl;
      $routeid = $this->routeid;
      $mapx = $this->mapx;
      $mapy = $this->mapy;
  
      $resutlt = file_get_contents($url);
      $data    = json_decode($resutlt, true);
  
      foreach ($data as $key => $car) {
        if($car["ROUTEID"]==$routeid){
          $car["GPSTIME"] = date("Y-m-d H:i:s", strtotime($car["GPSTIME"] ." +8 hours"));
          $str = "車號:". $car["CARNO"] . " - 座標：" .$car["N"]. "," .$car["E"];
          $str = $this->GetDistance($mapx, $mapy, $car["N"], $car["E"]);
        }
      }
      
      return $str;
    }
  
    /* 計算兩組經緯度坐標 之間的距離 */
    public function GetDistance($lat1, $lng1, $lat2, $lng2, $len_type = 1, $decimal = 2) {
      $radLat1 = $lat1 * PI() / 180.0;
      $radLat2 = $lat2 * PI() / 180.0;
      $a = $radLat1 - $radLat2;
      $b = ($lng1 * PI() / 180.0) - ($lng2 * PI() / 180.0);
      $s = 2 * asin(sqrt(pow(sin($a/2),2) + cos($radLat1) * cos($radLat2) * pow(sin($b/2),2)));
      $s = $s * 6378.137;
      $s = round($s * 1000);
      if ($len_type > 1){
        $s /= 1000;
      }
      return round($s, $decimal);
    }
  
}