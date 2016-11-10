<?php

namespace Emall\Product;
use PDO;
use Emall\Database\Database;

class Product
{
  private $conn;

  public function __construct()
  {
      $this->conn = Database::getInstance();
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
        ->all();

        if ($result == null){
          $result['empty'] = 'Kosong';
        }
        echo json_encode($result);
    } catch (Exception $e) {
        echo "Error" . $e->getMessage();
    }
  }

  // delete data product
  public function DeleteDataProduct($productID)
  {
    try {
        $user = $this->conn;
        $user->setTable('product');
        $result = $user->where('productID','=',$productID)->delete();

        $result['valid'] = 'Data product has been delete!';
        echo json_encode($result);
    } catch (PDOException $e){
        echo "Error :" .$e->message();
    }
  }
}
