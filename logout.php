<?php

session_start();
require_once 'autoloader.php';

$logoutSeller = new Authentication();
if (!$logoutSeller->is_logged_in()) {
		$logoutSeller->redirect('index.php');
}

if ($logoutSeller->is_logged_in()!="") {
		$logoutSeller->logout();
		Redirect::to('index.php');
}
