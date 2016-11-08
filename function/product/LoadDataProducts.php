<?php
session_start();
require_once '../../autoloader.php';

$load = new Product;

$home_url = '../../../index.php';

if (isset($_POST['sellerID'])) {
    $sellerID = $_POST['sellerID'];
	  $load->LoadDataProducts($sellerID);
} else {
	 	Redirect::to($home_url); // for direct acces to this file
}
