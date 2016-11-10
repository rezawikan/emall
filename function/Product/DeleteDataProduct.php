<?php
session_start();
require_once '../../vendor/autoload.php';

use Emall\Product\Product;
use Emall\Auth\Redirect;

$seller   = new Product;
$home_url = '../../index.php';

if (isset($_POST['productID'])) {
    $productID = $_POST['productID'];
	  $seller->DeleteDataProduct($productID);
} else {
	 	Redirect::to($home_url); // for direct acces to this file
}
?>
