<?php
session_start();
require_once '../../autoloader.php';

$home_url = '../../../index.php';

$load = new Product;

$load->loadCategories();

// if (isset($_POST['sellerID'])) {
// 	 $sellerID = $_POST['sellerID'];
// 	 $seller->getAllDataBank($sellerID);
// 	//print_r($_POST);
// } else {
//     Redirect::to($home_url); // for direct acces to this file
// }
