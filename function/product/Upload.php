<?php
session_start();

require_once '../../autoloader.php';
$home_url = '../../../index.php';
$update = Database::getInstance();
$upload = new FileUploader;
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

// foreach ($images as $image) {
//   $filename = $image['name'];
//   $fileType = $image['type'];
//   $tmp_file = $image['tmp_name'];
//   $error    = $image['error'];
//   $size     = $image['size'];
//
//   // $type = ['image/jpg','image/jpeg','']
//
//   if($fileType === 'image/jpg'){
//     if(!file_exists($filename)){
//       $file_name = str_replace(".JPG", "", $filename);
//     }
//
//   }
//
//
//   $random       = time();
//   $extension    = pathinfo($filename, PATHINFO_EXTENSION);
//   $new_filename = $filename . "_" . $random . "." . $extension;
//   $filepath     = "uploads/products/" . $new_filename;
//   var_dump($new_filename);
//   // var_dump($file_name);
//   // var_dump($images);
//
//   //
// }
