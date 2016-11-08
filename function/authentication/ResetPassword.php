<?php
session_start();
require_once '../../autoloader.php';
$seller = new Authentication();

$home_url = '../../../index.php'; // redirect link

$result = array();

	if (isset($_POST['password'],
					$_POST['id'],
					$_POST['code'])
	) {
  $password = $_POST['password'];
  $id 			= base64_decode($_POST['id']);
  $code 		= $_POST['code'];

  if ($seller->updatePassword($password, $id)) {
      $seller->updateTemporaryCode($code, $id);
      $result['status'] = 'success';
      echo json_encode($result);
  }
} else {
		Redirect::to($home_url); // for direct acces to this file
}
