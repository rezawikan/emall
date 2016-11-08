<?php
session_start();
require_once '../../autoloader.php';

$home_url = '../../../index.php';

$seller = new Withdrawal();
if (isset($_POST['seller_bankID'],$_POST['amount'])) {
		$seller_bankID	= $_POST['seller_bankID'];
		$amount 				= $_POST['amount'];
		$id 						= Session::get('sellerSession');
		if ($seller->checkBalance($id) < $amount) {
				$result['error'] = 'Please, ensure your balance is available';
				echo json_encode($result);
		} else {
			$seller->addWithdrawal($seller_bankID, $amount);
		}
} else {
		Redirect::to($home_url); // for direct acces to this file
}
