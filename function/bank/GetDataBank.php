<?php
session_start();
require_once '../../vendor/autoload.php';

use Emall\Transaction\Bank;
use Emall\Auth\Redirect;

$seller 	= new Bank;
$home_url = '../../index.php';

if (isset($_POST['sellerID'])) {
	 $sellerID = $_POST['sellerID'];
	 $seller->getAllDataBank($sellerID);
	//print_r($_POST);
} else {
    Redirect::to($home_url); // for direct acces to this file
}
