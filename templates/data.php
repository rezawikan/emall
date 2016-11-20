<?php
session_start();
require_once 'vendor/autoload.php';

use Emall\Auth\Authentication;
use Emall\Database\Database;
use Emall\Auth\Redirect;


// initialize classes
$seller     = Database::getInstance();
$log        = new Authentication;

$id = $_SESSION['sellerSession'];

if (!$log->is_logged_in()) {
    Redirect::to('index.php');
}

// get data users
$seller->setTable('seller');
$user = $seller->select()->where('sellerID','=',$id)->first();
$user->fullName = $user->firstName . ' ' .$user->lastName;
