<?php
session_start();
require_once '../../autoloader.php';

$seller = new Bank();

$home_url = '../../../index.php';

if (isset($_POST['seller_bankID'])) {
    $seller_bankID = $_POST['seller_bankID'];
    $seller->getDataBank($seller_bankID);
} else {
    Redirect::to($home_url); // for direct acces to this file
}
