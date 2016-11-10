<?php
session_start();
require_once '../../vendor/autoload.php';

use Emall\Auth\Authentication as Auth;
use Emall\Auth\Redirect;
use Emall\Auth\Token;

$seller   = new Auth;
$status   = array();
$home_url = '../../index.php'; // redirect link

if (Token::checkToken($_POST['token'])) {
  if (isset($_POST['username'], $_POST['password'])) { // all fill
    	$username   = $_POST['username'];
    	$password   = $_POST['password'];
    	$seller->login($username, $password); // checking to login
  } else {
    		Redirect::to('index.php'); // for direct acces to this file
  }
} else {
  $status['reload'] = 'Please realod this page ';
  echo json_encode($status);
}
