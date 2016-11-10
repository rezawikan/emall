<?php

namespace Emall\Transaction;
use PDO;
use Emall\Database\Database;

class Withdrawal
{

	private $conn;

	public function __construct()
	{
		$this->conn = Database::getInstance();
	}

	// show data bank according seller id
	public function selectBank($sellerID)
	{
		try {
				$user = $this->conn;
				$user->setTable('seller_bank');
				$result = $user->join('bank','seller_bank.bankID','=','bank.bankID')
				->where('seller_bank.sellerID','=',$sellerID)
				->select('seller_bank.seller_bankID, seller_bank.bankID, seller_bank.accountNumber, seller_bank.ownerName,bank.bankName')
				->all();
	      echo json_encode($result);
		} catch(PDOException $e) {
				echo "Error: " .$e->getMessage();
		}
	}

	// show details particular account data bank
	public function selectDataBank($sellerID, $seller_bankID)
	{
		try {
				$user = $this->conn;
				$user->setTable('seller_bank');
				$result = $user->join('bank','seller_bank.bankID','=','bank.bankID')
				->where('seller_bank.sellerID','=',$sellerID)
				->where('seller_bank.seller_bankID','=',$seller_bankID)
				->all();

	      echo json_encode($result);
		} catch (PDOException $e) {
				echo "Error: " .$e->getMessage();
		}

	}

	// request withdrawal
	public function addWithdrawal($sellerID, $bankName, $accountNumber, $branch, $ownerName, $amount)
	{
		try {
				$user = $this->conn;
				$user->setTable('withdrawal');
				$result = $user->create([
					'sellerID' 			=> $sellerID,
					'bankName'			=> $bankName,
					'accountNumber' => $accountNumber,
					'branch' 				=> $branch,
					'ownerName'			=> $ownerName,
					'amount'				=> $amount
				]);

				$result['valid'] = 'Withdrawal has created, we will take a process a few hours';
				echo json_encode($result);
		}catch(PDOException $e){
			echo "Error : ".$e->getMessage();
		}
	}

	//  check available balance
	public function checkBalance($sellerID)
	{
		try {
				$user = $this->conn;
				$user->setTable('seller_balance');
				$result = $user->select('balance')->where('sellerID','=', $sellerID)->first();
				return $result->balance;
		}catch(PDOException $e){
			echo "Error : ".$e->getMessage();
		}
	}

	// get details data withdrawals
	public function getDataWithdrawal($sellerID)
	{
		try {
				$user =$this->conn;
				$user->setTable('withdrawal');
				$result = $user->select()->Where('sellerID','=',$sellerID)->all();
				if ($result == null) {
						$result['empty'] = 'Kosong';
				}
			echo json_encode($result);
		} catch (PDOException $e) {
				echo "Error :".$e->Message();
		}
	}
}
