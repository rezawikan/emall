<?php
session_start();
require_once '../../vendor/autoload.php';

use Emall\Pagination\Pagination;
use Emall\Auth\Session;
use Emall\Auth\Redirect;
use Emall\Auth\Filter;

$page     = new Pagination;
$home_url = '../../index.php';
$sellerID = Session::get('sellerSession');

if ($_POST) {
  if (isset($_POST['page'])) {
      if (!is_numeric($_POST['page'])){
          $page_number = 1;
      } else {
          $page_number = Filter::IntegerFilter($_POST['page']);
      }
  } else {
      $page_number = 1;
  }

  if (isset($_POST['limit'])) {
      if (!is_numeric($_POST['limit'])){
          $item_per_page = 24;
      } else {
          $item_per_page = $_POST['limit'];
      }
  } else {
      $item_per_page = 24;
  }

  if (isset($_POST['subcategories'])) {
      if (!is_numeric($_POST['subcategories'])){
          $subcategories = null;
      } else {
          $subcategories = Filter::IntegerFilter($_POST['subcategories']);
      }
  } else {
      $subcategories = null;
  }
  //
  // if (isset($_POST['sort'])) {
  //     if (is_string($_POST['sort'])){
  //         $sort = Filter::StringFilter($_POST['sort']);
  //     } else {
  //         $sort = 'ASC';
  //     }
  // } else {
  //     $sort = 'ASC';
  // }

  if (isset($subcategories)) {
      $total_records = $page->TotalRows($sellerID, $subcategories);
  } else {
      $total_records = $page->TotalRows($sellerID);
  }

  $total_pages        = ceil($total_records/$item_per_page);
  $page_position      = (($page_number-1) * $item_per_page);
  $results            = $page->resultRange($page_position, $item_per_page, $sellerID, $subcategories);

  // if(isset($sort)){
  //   $results = sort($results);
  // }

  echo json_encode($results);
} else {
    Redirect::to($home_url); // for direct acces to this file
}
