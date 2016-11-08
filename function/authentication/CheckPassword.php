<?php
session_start();
require_once '../../autoloader.php';
$seller = new Authentication();

$home_url = '../../../index.php'; // redirect link

$result = array();

if (isset($_POST['dataID'],$_POST['code'])) {
    $id   = base64_decode($_POST['dataID']);
    $code = $_POST['code'];
    // check id and code $_GET, code is used
    if ($seller->checkTemporaryCode($id, $code)) {
         $result['status'] = 'used';
    // check id and code $_GET
  } else if ($seller->checkCode($id, $code)) {
        $result['status'] = 'none';
    } else {
       $result['status'] = 'notfound';
    }
} else {
    Redirect::to($home_url); // for direct acces to this file
}

echo json_encode($result);
