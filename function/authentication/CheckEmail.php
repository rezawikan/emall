<?php
session_start();

require_once '../../autoloader.php';

$seller = new Authentication;

if (isset($_POST['email'])) { // is empty or not
		$email = $_POST['email'];
		if ($seller->checkEmail($email)) { // checking email
				$isAvailable = true;
		} else {
				$isAvailable = false;
		}
} else {
		Redirect::to($home_url); // for direct acces to this file
}

// Finally, return a JSON
echo json_encode(array(
	'valid' => $isAvailable, // get result
));
