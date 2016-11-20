<?php
session_start();
require_once '../../vendor/autoload.php';

use Emall\Transaction\Withdrawal;
use Emall\Auth\Redirect;

$home_url = '../../index.php';
$seller = new Withdrawal;

if (isset($_POST['sellerID'],$_POST['seller_bankID'])) {
		$sellerID = $_POST['sellerID'];
		$seller_bankID = $_POST['seller_bankID'];
		$seller->selectDataBank($sellerID,$seller_bankID);
} else {
		Redirect::to($home_url); // for direct acces to this file
}
