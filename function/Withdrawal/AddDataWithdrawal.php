<?php
session_start();
require_once '../../vendor/autoload.php';

use Emall\Transaction\Withdrawal;
use Emall\Transaction\Converter;
use Emall\Auth\Redirect;
use Emall\Auth\Session;

$home_url = '../../../index.php';
$seller 	= new Withdrawal;

if (isset($_POST['bankName'])) {
		$sellerID 			= Session::get('sellerSession');
		$bankName				= $_POST['bankName'];
		$accountNumber	= $_POST['accountNumber'];
		$branch					= $_POST['branch'];
		$ownerName			= $_POST['ownerName'];
		$amount 				= Converter::toInteger($_POST['amount']);

		if ($seller->checkBalance($sellerID) < $amount) {
				$result['error'] = 'Please, ensure your balance is available';
				echo json_encode($result);
		} else {
			$seller->AddDataWithdrawal($sellerID, $bankName, $accountNumber, $branch, $ownerName, $amount);
		}
} else {
		Redirect::to($home_url); // for direct acces to this file
}
