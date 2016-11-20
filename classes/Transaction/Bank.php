<?php

namespace Emall\Transaction;

use PDO;
use DateTime;
use Emall\Auth\Session;
use Emall\Database\Database;

class Bank
{
	private $conn;

	public function __construct()
	{
  	$this->conn = Database::getInstance();
	}

	// add data bank
	public function AddDataBank($sellerID, $bankID, $accountNumber, $ownerName, $branch)
	{
		try {
				$user = $this->conn;
				$user->setTable('seller_bank');
				$result = $user->create([
					'sellerID' 			=> $sellerID,
					'bankID'				=> $bankID,
					'accountNumber'	=> $accountNumber,
					'ownerName'			=> $ownerName,
					'branch'				=> $branch,
					'create_at' 		=> date_format(new DateTime(), 'Y-m-d H:i:s')
				]);

		    $result['valid'] = 'Data bank successfully saved';
	      echo json_encode($result);
		} catch (PDOException $e){
				echo "Error : ". $e->message();
		}
	}

	// get data seller bank
	public function EditDataBank($seller_bankID)
	{
		try {
				$user = $this->conn;
				$user->setTable('seller_bank');
				$result = $user->select()
				->where('seller_bankID','=',$seller_bankID)
				->first();
			  echo json_encode($result);
		} catch (PDOException $e){
				echo "Error : " .$e->message();
		}
	}

	// update data seller bank
	public function UpdateDataBank($seller_bankID, $bankID, $accountNumber, $ownerName, $branch)
	{
		try {
				$user = $this->conn;
				$user->setTable('seller_bank');
				$result = $user->where('seller_bankID','=',$seller_bankID)
				->update([
					'bankID' 				=> $bankID,
					'accountNumber' => $accountNumber,
					'ownerName'			=> $ownerName,
					'branch'				=> $branch
				]);

				$result['valid'] = 'Data bank has been updated!';
				echo json_encode($result);
		} catch (PDOException $e) {
				echo "Error : ". $e->message();
		}
	}

	// delete bank account
	public function DeleteDataBank($seller_bankID)
	{
		try {
				$user = $this->conn;
				$user->setTable('seller_bank');
				$result = $user->where('seller_bankID','=',$seller_bankID)->delete();

			  $result['valid'] = 'Data bank has been delete!';
			  echo json_encode($result);
		} catch (PDOException $e){
				echo "Error :" .$e->message();
		}
	}

	// get details seller data bank
	public function ViewDataBank($sellerID)
	{
		try {
				$user = $this->conn;
				$user->setTable('seller_bank');
				$result = $user->join('bank','seller_bank.bankID','=','bank.bankID')
				->where('seller_bank.sellerID','=',$sellerID)
				->select('seller_bank.seller_bankID, seller_bank.sellerID, seller_bank.accountNumber, seller_bank.ownerName, seller_bank.branch, bank.bankName')
				->all();

				if ($result == null){
					$result['empty'] = 'Kosong';
				}
				echo json_encode($result);
		} catch (PDOException $e) {
				echo "Error :". $e->message();
		}
	}

	public function NumberOfBank($sellerID)
	{
		try {
			$user = $this->conn;
			$user->setTable('seller_bank');
			$result = $user->select('sellerID')
			->where('sellerID','=',$sellerID)
			->all();
			return count((array)$result);
		} catch (PDOException $e){
				echo "Error : " .$e->message();
		}
	}
}
