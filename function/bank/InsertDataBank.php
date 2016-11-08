<?php
session_start();
    require_once '../../autoloader.php';

    $seller = new Bank();

    $home_url = '../../../index.php';

    if (isset($_POST['sellerID'],
              $_POST['bankID'],
              $_POST['accountNumber'],
              $_POST['ownerName'],
              $_POST['branch'])
    ) {
        $sellerID       = $_POST['sellerID'];
        $bankID         = $_POST['bankID'];
        $accountNumber  = $_POST['accountNumber'];
        $ownerName      = $_POST['ownerName'];
        $branch         = $_POST['branch'];

        if ($seller->NumberOfBank($sellerID) >= 5) {
          $result['error'] = 'Maximum bank account is 5';
          echo json_encode($result);
        } else {
            $seller->addBank($sellerID, $bankID, $accountNumber, $ownerName, $branch);
        }
    } else {
        Redirect::to($home_url); // for direct acces to this file
    }
