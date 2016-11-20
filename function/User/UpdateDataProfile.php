<?php
session_start();
require_once '../../vendor/autoload.php';

use Emall\User\Profile;
use Emall\Files\ImagesProfile;
use Emall\Auth\Session;
use Emall\Auth\Redirect;

$seller     = new Profile;
$uploader   = new ImagesProfile;
$home_url   = '../../index.php';
$id         = Session::get('sellerSession');

if ($_POST) {
    if ($_FILES) {
        $uploader->setUserID($id);
        $uploader->setFileData($_FILES[0]);
        $uploader->setDirectory('../../uploads/profile/');
        $uploader->uploadImageProfile();
    }
    $firstName        = $_POST['firstName'];
    $lastName         = $_POST['lastName'];
    $email            = $_POST['email'];
    $address          = $_POST['address'];
    $province         = $_POST['province'];
    $city             = $_POST['city'];
    $district         = $_POST['districts'];
    $postalCode       = $_POST['postalCode'];
    $telpNum          = $_POST['telpNum'];
    $seller->updateProfile($id, $firstName,$lastName,$email,$address,$province,$city,$district,$postalCode,$telpNum);
} else {
    Redirect::to($home_url); // for direct acces to this file
}






































// session_start();
//
// require_once '../../autoloader.php';
// $seller   = new Profile();
// $id       = $_SESSION['sellerSession'];
//
// if($_FILES){
//   $time         = time();
//   $extension    = pathinfo($_FILES[0]["name"], PATHINFO_EXTENSION );
//   $source       = $_FILES[0]["tmp_name"];
//   $error        = $_FILES[0]["error"];
//   $filename     = $time . "." . $extension; // namafile.jpg
//   $destination  =  "../../uploads/".$filename;

 // $seller->checkImage($id ,$filename);

//jika file difolder tidak sama namanya dan di database
  // if(!file_exists($destination) && $seller->checkImage($id,$filename) ){
  //   move_uploaded_file($source, $destination);
  //   $seller->saveFileName($id, $filename)
 //  //   chmod ($destination,0755);
 //
 //  // jika file difolder tidak sama namanya tapi di database sama
 //  }else if(){
 //
 //
 //  }else {
 //    echo "Tidak Sukses";
 //    unlink($destination);
 //    $seller->deleteImage($id,$filename);
 //    move_uploaded_file($source, $destination);
 //    $seller->saveImage($id, $filename);
 //    chmod ($destination,0777);
 //  }
 // }


// $id       = $_SESSION['sellerSession'];
// $home_url = '../../../index.php';
//
// if($_POST){
//
//     $firstName        = $_POST['firstName'];
//     $lastName         = $_POST['lastName'];
//     $email            = $_POST['email'];
//     $address          = $_POST['address'];
//     $province         = $_POST['province'];
//     $city             = $_POST['city'];
//     $district         = $_POST['districts'];
//     $postalCode       = $_POST['postalCode'];
//     $telpNum          = $_POST['telpNum'];
//     $seller->updateProfile($id, $firstName,$lastName,$email,$address,$province,$city,$district,$postalCode,$telpNum);
// }else{
//     Redirect::to($home_url) // for direct acces to this file
// } -->
