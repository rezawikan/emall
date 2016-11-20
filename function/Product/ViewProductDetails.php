<?php
session_start();
require_once '../../vendor/autoload.php';

use Emall\Product\Product;
use Emall\Auth\Redirect;
use Emall\Transaction\Converter;

$home_url   = '../../index.php';
$load       = new Product;
$results    = [];
$productID  = $_POST['productID'];
$product    = $load->ViewDataProductDetails($productID);

if ($product != false) {
    $images   = $load->ViewDataProductImage($productID);
    $dateTime = new DateTime($product->create_at);
    $parse    =  Parsedown::instance()
                  ->setBreaksEnabled(true) # enables automatic line breaks
                  ->setMarkupEscaped(true) # escapes markup (HTML)
                  ->text($product->productDescription);
    $product->productDescription = $parse;
    $product->create_at = $dateTime->format('Y-m-d');
    $product->images    = $images;
    echo json_encode($product);
} else {
    $results['empty'] = 'Not Found';
    echo json_encode($results);
}
