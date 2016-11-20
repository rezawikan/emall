<?php
session_start();
require_once '../../vendor/autoload.php';

use Emall\Product\Product;
use Emall\Transaction\Converter;
use Emall\Files\ImagesProduct;
use Emall\Auth\Redirect;

$seller = new Product;
$upload = new ImagesProduct;
$status = [];

$home_url = '../../index.php';

if(isset($_POST['subcategories'],
         $_POST['productName'],
         $_POST['description'],
         $_POST['price'],
         $_POST['weight'],
         $_POST['quantity'],
         $_POST['productID']
         )
  ) {
    $subcategories  = $_POST['subcategories'];
    $productName    = $_POST['productName'];
    $description    = $_POST['description'];
    $price          = Converter::toInteger($_POST['price']);
    $weight         = $_POST['weight'];
    $quantity       = $_POST['quantity'];
    $productID      = $_POST['productID'];

    $seller->UpdateDataProduct($subcategories, $productName, $description, $price, $weight, $quantity, $productID);


    if ($_FILES) {
        foreach ($_FILES as $index => $image) {
          // $upload->setUserID($id);
          $upload->setFileData($_FILES[$index]);
          $upload->setDirectory('../../uploads/product/');
          $upload->updateImageProduct($productID, $index);
          if($index === 0){
            $upload->setMainImage();
          }
        }
    }
} else {
    Redirect::to($home_url); // for direct acces to this file
}
