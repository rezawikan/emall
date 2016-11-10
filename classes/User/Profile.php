<?php

namespace Emall\User;
use PDO;
use Emall\Database\Database;

class Profile
{

  private $conn;

  public function __construct()
  {
    $this->conn = Database::getInstance();
	}

  // show all data profile
  public function getDataProfile($sellerID)
  {
    try {
        $user = $this->conn;
        $user->setTable('seller');
        $result = $user->select()->where('sellerID','=',$sellerID)->first();

        echo json_encode($result);
    } catch (PDOException $e) {
      echo "Error : ".$e->getMessage();
    }
  }

  // update new data profile
  public function updateProfile($id,$firstName,$lastName,$email,$address,$province,$city,$district,$postalCode,$telpNum)
  {
    try {
        $user = $this->conn;
        $user->setTable('seller');
        $result = $user->where('sellerID','=',$id)->update([
          'firstName' => $firstName,
          'lastName'  => $lastName,
          'email'     => $email,
          'address'   => $address,
          'province'  => $province,
          'city'      => $city,
          'districts' => $district,
          'postalcode' => $postalCode,
          'telpNumber' => $telpNum
        ]);

        $result['valid'] = 'Data bank successfully saved';
        echo json_encode($result);
    } catch (PDOException $e) {
      echo "Error : ".$e->getMessage();
    }
  }

  // save images profile
  public function saveFileName($id,$filename)
  {
    try {
        $user = $this->conn;
        $user->setTable('seller');
        $user->where('sellerID','=',$id)->update([
          'image' => $filename
        ]);

        return true;
    } catch (PDOException $e) {
      echo "Error : ".$e->getMessage();
    }
  }

}
 ?>
