<?php
session_start();
  	require_once '../../autoloader.php';

    $seller = new Bank();

    $home_url = '../../../index.php';

    if(isset($_POST['Useller_bankID'],
             $_POST['UbankID'],
             $_POST['UaccountNumber'],
             $_POST['UownerName'],
             $_POST['Ubranch'])
      ) {
        $seller_bankID  = $_POST['Useller_bankID'];
        $bankID         = $_POST['UbankID'];
        $accountNumber  = $_POST['UaccountNumber'];
        $ownerName      = $_POST['UownerName'];
        $branch         = $_POST['Ubranch'];
        $seller->updateBank($seller_bankID, $bankID, $accountNumber, $ownerName, $branch);
    } else {
        Redirect::to($home_url); // for direct acces to this file
    }
