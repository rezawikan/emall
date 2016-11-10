<?php
session_start();
require_once '../../vendor/autoload.php';

use Emall\User\Bank;
use Emall\Auth\Redirect;
use Emall\Product\Product;

$load     = new Product;
$home_url = '../../../index.php';
$data     = $_POST['type'];

switch ($data) {
  case 'LoadCategories':
    $load->loadCategories();
    break;
  case 'LoadDataProducts':
    if (isset($_POST['sellerID'])) {
        $sellerID = $_POST['sellerID'];
        $load->LoadDataProducts($sellerID);
    } else {
        Redirect::to($home_url); // for direct acces to this file
    }
    break;
  case 'LoadSubCategories':
    if (isset($_POST['categoriesID'])) {
        $categoryID = $_POST['categoriesID'];
        $load->LoadSubCategories($categoryID);
    } else {
        Redirect::to($home_url); // for direct acces to this file
    }
    break;
  default:
    break;
}
