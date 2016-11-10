<?php
session_start();
require_once '../../vendor/autoload.php';

use Emall\Auth\Authentication as Auth;
use Emall\Auth\Redirect;

$seller 	= new Auth;
$home_url = '../../index.php'; // redirect link

if (isset($_POST['email'])) {
	 $email = $_POST['email'];
	 $seller->forgotPassword($email);
} else {
	 	Redirect::to($home_url); // for direct acces to this file
}
