<?php

namespace Emall\Product;

use PDO;
use DateTime;
use Emall\Auth\Session;
use Emall\Database\Database;
use Emall\Files\ImagesProduct;

class Product
{
  private $conn;
  private $uploadProduct;

  public function __construct()
  {
      $this->conn   = Database::getInstance();
      $this->uploadProduct = new ImagesProduct;
  }

  public function LoadCategories()
  {
    try {
        $user = $this->conn;
        $user->setTable('categories');
        $result = $user->select()->all();
        echo json_encode($result);
    } catch (Exception $e) {
        echo "Error" . $e->getMessage();
    }
  }

  public function LoadSubCategories($categoryID)
  {
    try {
        $user = $this->conn;
        $user->setTable('sub_categories');
        $result = $user->select()->where('categoriesID','=',$categoryID)->all();
        echo json_encode($result);
    } catch (Exception $e) {
        echo "Error" . $e->getMessage();
    }
  }

  public function LoadDataProducts($sellerID)
  {
    try {
        $user = $this->conn;
        $user->setTable('categories');
        $result = $user->join('sub_categories','categories.categoriesID','=','sub_categories.categoriesID')
        ->join('product','sub_categories.subcategoriesID','=','product.subcategoriesID')
        ->join('product_images','product.productID','=','product_images.product_id')
        ->where('product.sellerID','=',$sellerID)
        ->where('product_images.status','=','main')
        ->select('categories.categoryName, product.productID, product.productName, product_images.image_name, product.productPrice, product.productQty, product.productWeight')
        ->orderBy('productID','DESC')
        ->all();

        if ($result == null){
          $result['empty'] = 'Kosong';
        }
        echo json_encode($result);
    } catch (Exception $e) {
        echo "Error" . $e->getMessage();
    }
  }

  public function AddDataProduct($productName, $description, $price, $quantity, $sub_categories, $weight, $images)
  {
    try {
        $user = $this->conn;
        $user->setTable('product');
        $user->create([
          'productName'         => $productName,
          'productDescription'  => $description,
          'productPrice'        => $price,
          'productQty'          => $quantity,
          'subcategoriesID'     => $sub_categories,
          'productWeight'       => $weight,
          'sellerID'            => Session::get('sellerSession'),
          'create_at'           => date_format(new DateTime(), 'Y-m-d H:i:s')
        ]);

        $lastid = $user->lastID();
        $upload = $this->uploadProduct;

        if ($images != null) {
            foreach ($images as $index => $image) {
              // $upload->setUserID($id);
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
    } catch (Exception $e) {
        echo "Error" . $e->getMessage();
    }
  }

  public function EditDataProduct($productID)
  {
    try {
        $user = $this->conn;
        $user->setTable('product');
        $result = $user->select()->where('productID','=',$productID)->first();
        echo json_encode($result);
    } catch (Exception $e) {
        echo "Error" . $e->getMessage();
    }
  }

  public function FindCategoriesID($subcategoriesID)
  {
    try {
        $user = $this->conn;
        $user->setTable('sub_categories');
        $result = $user->select()->where('subcategoriesID','=',$subcategoriesID)->first();
        echo json_encode($result);
    } catch (Exception $e) {
        echo "Error" . $e->getMessage();
    }
  }

  public function UpdateDataProduct($subcategories, $productName, $description, $price, $weight, $quantity, $productID)
  {
    try {
        $update = $this->conn;
        $update->setTable('product');
        $result = $update->where('productID','=', $productID)
        ->update([
          'subcategoriesID'     => $subcategories,
          'productName'         => $productName,
          'productDescription'  => $description,
          'productPrice'        => $price,
          'productWeight'       => $weight,
          'productQty'          => $quantity
        ]);

        $status['valid'] = 'Data product successfully updated';
        echo json_encode($status);
		} catch (PDOException $e){
				echo "Error : ". $e->message();
		}
  }

  public function ViewDataProductDetails($productID)
  {
    try {
        $user = $this->conn;
        $user->setTable('product');
        $result = $user->select()->where('productID','=',$productID)->first();
        return $result;
    } catch (Exception $e) {
        echo "Error" . $e->getMessage();
    }
  }

  public function ViewDataProductImage($productID)
  {
    try {
        $user = $this->conn;
        $user->setTable('product_images');
        $result = $user->select('image_name')->where('product_id','=',$productID)->all();
        return $result;
    } catch (Exception $e) {
        echo "Error" . $e->getMessage();
    }
  }

  // delete data product
  public function DeleteDataProduct($lastID)
  {
    try {
        $delete = $this->uploadProduct;

        for ($index=0; $index < 3; $index++) {
          $delete->deletePrevImageProduct($lastID,$index);
        }

        $user = $this->conn;
        $user->setTable('product');
        $result = $user->where('productID','=',$lastID)->delete();

        $result['valid'] = 'Data product has been delete';
        echo json_encode($result);
    } catch (PDOException $e){
        echo "Error :" .$e->message();
    }
  }
}
