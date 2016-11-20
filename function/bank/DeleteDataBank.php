<?php
session_start();
require_once '../../vendor/autoload.php';

use Emall\Transaction\Bank;
use Emall\Auth\Redirect;

$seller   = new Bank;
$home_url = '../../index.php';

if (isset($_POST['seller_bankID'])) {
    $seller_bankID = $_POST['seller_bankID'];
	  $seller->DeleteDataBank($seller_bankID);
} else {
	 	Redirect::to($home_url); // for direct acces to this file
}
?>
