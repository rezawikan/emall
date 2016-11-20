<?php
session_start();
require_once '../../vendor/autoload.php';

use Emall\Transaction\Bank;
use Emall\Auth\Redirect;

$seller   = new Bank();
$home_url = '../../index.php';

if(isset($_POST['seller_bankID'],
         $_POST['bankID'],
         $_POST['accountNumber'],
         $_POST['ownerName'],
         $_POST['branch'])
  ) {
    $seller_bankID  = $_POST['seller_bankID'];
    $bankID         = $_POST['bankID'];
    $accountNumber  = $_POST['accountNumber'];
    $ownerName      = $_POST['ownerName'];
    $branch         = $_POST['branch'];
    $seller->UpdateDataBank($seller_bankID, $bankID, $accountNumber, $ownerName, $branch);
} else {
    Redirect::to($home_url); // for direct acces to this file
}
