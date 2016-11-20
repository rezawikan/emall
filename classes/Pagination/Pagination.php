<?php

namespace Emall\Pagination;

use Emall\Database\Database;

class Pagination
{
  private $conn ;

  public function __construct()
  {
    $this->conn = Database::getInstance();
  }

  public function TotalRows($sellerID, $subcategories = '')
  {
    $user = $this->conn;
    $user->setTable('product');
    if(is_null($subcategories)){
        $result = $user->select()->where('sellerID','=',$sellerID)->all();
    } else {
        $result = $user->select()->where('sellerID','=',$sellerID)->where('subcategoriesID','=',$subcategories)->all();
    }
    return count($result);
  }

  public function resultRange($page_position, $item_per_page, $sellerID, $subcategories)
  {
    $user = $this->conn;
    $user->setTable('product');
    if( is_null($subcategories)){
        $result = $user->join('product_images','product.productID','=','product_images.product_id')
        ->where('product.sellerID','=',$sellerID)
        ->where('product_images.status','=','main')
        ->select('product.productID, product.productName, product.shortDescription ,product.productDescription, product.productPrice, product.productQty, product.subcategoriesID, product.productWeight, product.sellerID, product_images.image_name, product_images.image_path, product_images.product_id, product_images.status')
        ->orderBy('productID','ASC')
        ->limit($page_position . ',' . $item_per_page )
        ->all();
    } else {
        $result = $user->join('product_images','product.productID','=','product_images.product_id')
        ->where('product.sellerID','=',$sellerID)
        ->where('product.subcategoriesID','=',$subcategories)
        ->where('product_images.status','=','main')
        ->select('product.productID, product.productName, product.shortDescription, product.productDescription, product.productPrice, product.productQty, product.subcategoriesID, product.productWeight, product.sellerID, product_images.image_name, product_images.image_path, product_images.product_id, product_images.status')
        ->orderBy('productID','ASC')
        ->limit($page_position . ',' . $item_per_page )
        ->all();
    }
    return $result;
  }

  function paginate_function($item_per_page, $current_page, $total_records, $total_pages, $first = '', $second = '', $subcategories = '')
  {
      $pagination = '';
      if ($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages) { //verify total pages and current page number
          $pagination .= '<ul class="pagination">';

          $right_links    = $current_page + 4;
          $previous       = $current_page - 3; //previous link
          $next           = $current_page + 1; //next link
          $first_link     = true; //boolean var to decide our first link

          if($current_page > 1) {
              $previous_link = ($previous==0) ? 1 : $previous;

              if ($previous_link > 0 && $current_page < 3){
                  $pagination .= '<li><a href="' . $first . $previous_link . $second . $subcategories . '" data-page="'.$previous_link.'" title="Previous">&lt;</a></li>'; //previous link
              } elseif ($current_page == 4 ) {
                  $pagination .= '<li><a href="' . $first . $previous_link . $second . $subcategories . '" data-page="'.$previous_link.'" title="Previous">&lt;</a></li>'; //previous link
              } elseif ($current_page > 4) {
                  $pagination .= '<li><a href="product.php?page=1' . $second . $subcategories . '" data-page="1" title="First">&laquo;</a></li>'; //first link
                  $pagination .= '<li><a href="' . $first . $previous_link . $second . $subcategories . '" data-page="'.$previous_link.'" title="Previous">&lt;</a></li>'; //previous link
              }

                for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
                    if($i > 0){
                        $pagination .= '<li><a href="product.php?page='.$i.'" data-page="'.$i.'" title="Page'.$i.'">'.$i.'</a></li>';
                    }
                }
            $first_link = false; //set first link to false
          }

          if ($first_link) { //if current active page is first link
              $pagination .= '<li class="active"><a href="#">'. $current_page .' <span class="sr-only">(current)</span></a></li>';
          } elseif ($current_page == $total_pages) { //if it's the last active link
              $pagination .= '<li class="active"><a href="#">'. $current_page .' <span class="sr-only">(current)</span></a></li>';
          } else { //regular current link
              $pagination .= '<li class="active"><a href="#">'. $current_page .' <span class="sr-only">(current)</span></a></li>';
          }

          for ($i = $current_page+1; $i < $right_links ; $i++) { //create right-hand side links
              if ($i<=$total_pages) {
                  $pagination .= '<li><a href="' . $first . $i . $second . $subcategories . '" data-page="'.$i.'" title="Page '. $i.'">'.$i.'</a></li>';
              }
          }

          if (($total_pages - $current_page) == 4) {
              $next_link = ($i > $total_pages) ? $total_pages : $i;
              $pagination .= '<li><a href="' . $first . $next_link . $second . $subcategories . '" data-page="'.$next_link.'" title="Next">&gt;</a></li>'; //next link

          } elseif ($current_page < $total_pages && ($total_pages - $current_page) > 3){
              $next_link = ($i > $total_pages) ? $total_pages : $i;
              $pagination .= '<li><a href="' . $first . $next_link . $second . $subcategories . '" data-page="'.$next_link.'" title="Next">&gt;</a></li>'; //next link
              $pagination .= '<li class="last"><a href="' . $first . $total_pages . $second . $subcategories . '" data-page="'.$total_pages.'" title="Last">&raquo;</a></li>'; //last link
          }
          $pagination .= '</ul>';
      }
      return $pagination; //return pagination links
  }

}
