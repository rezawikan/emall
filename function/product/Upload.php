<?php
session_start();
require_once '../../vendor/autoload.php';

use Emall\Database\Database;
use Emall\Files\ImagesProduct;
use Emall\Auth\Session;
use Emall\Auth\Redirect;

$home_url = '../../index.php';
$update = Database::getInstance();
$upload = new ImagesProduct;
$id     = Session::get('sellerSession');
$images = $_FILES;
$status = [];

if ($_POST) {
    $productName    = $_POST['productName'];
    $description    = $_POST['description'];
    $price          = $_POST['price'];
    $qty            = $_POST['quantity'];
    $weight         = $_POST['weight'];
    $sub_categories = $_POST['subcategories'];


    $update->setTable('product');
    $update->create([
      'productName'         => $productName,
      'productDescription'  => $description,
      'productPrice'        => $price,
      'productQty'          => $qty,
      'subcategoriesID'     => $sub_categories,
      'productWeight'       => $weight,
      'sellerID'            => $id
    ]);

    $lastid = $update->lastID();

    if ($_FILES) {
        foreach ($images as $index => $image) {
          $upload->setUserID($id);
          $upload->setFileData($_FILES[$index]);
          $upload->setDirectory('../../uploads/product/');
          $upload->uploadImageProduct($lastid, $index);
          if($index == 0){
            $upload->setMainImage();
          }
        }
    }

    $status['valid'] = 'Data product successfully saved';
    echo json_encode($status);
}else {
  Redirect::to($home_url); // for direct acces to this file
}
