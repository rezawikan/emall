<?php
session_start();
require_once '../../vendor/autoload.php';

use Emall\Transaction\Withdrawal;
use Emall\Auth\Redirect;

$home_url = '../../index.php';
$seller   = new Withdrawal;

if (isset($_POST['sellerID'])) {
    $sellerID = $_POST['sellerID'];
    $seller->ViewDataWithdrawal($sellerID);
} else {
    Redirect::to($home_url); // for direct acces to this file
}
