<?php
session_start();
require_once '../../vendor/autoload.php';

use Emall\Shipment\Shipment;

$shipment = new Shipment;

if (isset($_GET['action'])) {
  switch ($_GET['action']) {
    case 'showAllProvince':
      $province = $shipment->showAllProvince();
      echo $province;
      break;
    case 'showAllCity':
      $data_province = $_GET['province'];
      $city = $shipment->showAllCity($data_province);
      echo $city;
      break;
    case 'showAllDistricts':
      $data_city = $_GET['city'];
      $districts = $shipment->showAllSubDistricts($data_city);
      echo $districts;
    default:
      # code...
      break;
  }
}
