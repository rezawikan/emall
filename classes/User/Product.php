<?php

namespace Emall\User;

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
        ->select('categories.categoryName, product.productName, product_images.image_name, product.productPrice, product.productQty, product.productWeight')
        ->all();
        echo json_encode($result);
    } catch (Exception $e) {
        echo "Error" . $e->getMessage();
    }

  }
}
