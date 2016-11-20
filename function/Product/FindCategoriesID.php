<?php
session_start();
require_once '../../vendor/autoload.php';

use Emall\Auth\Redirect;
use Emall\Product\Product;

$product = new Product;
$home_url = '../../index.php';

if (isset($_POST['subcategoriesID'])) {
    $subcategoriesID = ($_POST['subcategoriesID']);
    $product->FindCategoriesID($subcategoriesID);
}else {
  Redirect::to($home_url); // for direct acces to this file
}
