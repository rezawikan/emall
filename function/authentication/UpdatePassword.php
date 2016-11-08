<?php
session_start();
require_once '../../autoloader.php';
$seller = new Authentication();

$home_url = '../../../index.php'; // redirect link

$result = array();

if (isset($_POST['password'],$_POST['id'])){
  $password 	= $_POST['password'];
  $id 		    = $_POST['id'];

  if ($seller->updatePassword($password, $id))	{
      $result['valid'] = 'success';
      echo json_encode($result);
  }
} else {
		Redirect::to($home_url); // for direct acces to this file
}
