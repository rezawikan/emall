<?php

namespace Emall\Shipment;

class Shipment
{

  // show all data province
  public function showAllProvince()
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "http://pro.rajaongkir.com/api/province",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "key: da06ea1541fd27c887829f63b8a05fba"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      echo $response;
    }
  }

  // show all data city
  public function showAllCity($province)
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "http://pro.rajaongkir.com/api/city?province=$province",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "key: da06ea1541fd27c887829f63b8a05fba"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      echo $response;
    }
  }

  // show all data district
  public function showAllSubDistricts($city)
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "http://pro.rajaongkir.com/api/subdistrict?city=$city",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "key: da06ea1541fd27c887829f63b8a05fba"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      echo $response;
    }
  }

  // calculation cost
  public function showCost($origin,$destination,$weight,$courier)
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "http://pro.rajaongkir.com/api/cost",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "origin=$origin&originType=subdistrict&destination=$destination&destinationType=subdistrict&weight=$weight&courier=$courier",
      CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded",
        "key: da06ea1541fd27c887829f63b8a05fba"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      echo $response;
    }

  }

  public function wayBill($waybill, $courier)
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "http://pro.rajaongkir.com/api/waybill",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "waybill=$waybill&courier=$courier",
      CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded",
        "key: da06ea1541fd27c887829f63b8a05fba"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      echo $response;
    }
  }



}

?>
