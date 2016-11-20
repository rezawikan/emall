<?php
session_start();
require_once '../../vendor/autoload.php';

use Emall\Product\Product;
use Emall\Transaction\Converter;
use Emall\Auth\Redirect;

$home_url = '../../index.php';
$seller   = new Product;
$images   = $_FILES;
$status   = [];

if (isset($_POST['productName'],
          $_POST['description'],
          $_POST['price'],
          $_POST['quantity'],
          $_POST['weight'],
          $_POST['subcategories']
    )) {
    $productName    = $_POST['productName'];
    $description    = $_POST['description'];
    $price          = Converter::toInteger($_POST['price']);
    $quantity       = $_POST['quantity'];
    $weight         = $_POST['weight'];
    $sub_categories = $_POST['subcategories'];
    
    $seller->AddDataProduct($productName, $description, $price, $quantity, $sub_categories, $weight, $images);
}else {
  Redirect::to($home_url); // for direct acces to this file
}
