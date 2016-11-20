<?php
session_start();
require_once 'vendor/autoload.php';

use Emall\Pagination\Pagination;
use Emall\Auth\Session;
use Emall\Auth\Filter;

$page     = new Pagination;
$sellerID = Session::get('sellerSession');
//
// echo $page->paginate_function(24,1 ,10 , 1);
//
// echo $a = strlen('Many desktop publishing packages and web page editors example for description');


echo date_format(new DateTime(), 'Y-m-d H:i:s');
$f ;
echo $f ?? 'dika';

// use Emall\Auth\Authentication as Auth;
// use Emall\Auth\Redirect;
// use Emall\Transaction\Balance;
// use Emall\Database\Database;
// use Emall\Product\Product;
//
// // $delete = new Product;
// // $delete->DeleteDataProduct('61');
// $page_position = 1;
// $item_per_page = 25;
//
// $user = Database::getInstance();
//
// $user->setTable('product');
// $result = $user->select()->orderBy('productID','ASC')->limit('0,25')->all();
//
// var_dump($result);


// $user->setTable('product');
// $user->select('(*)','COUNT')->orderBY('id','ASC')->limit($page_position . ',' . $item_per_page)->first();
// echo $user;

// echo Math.floor("123");
//
// $user = Database::getInstance();
//
// $user->setTable('sub_categories');
// $result = $user->select()->where('subcategoriesID','=',21)->first();
// $user->setTable('categories');
// $result = $user->join('sub_categories','categories.categoriesID','=','sub_categories.categoriesID')
// ->join('product','sub_categories.subcategoriesID','=','product.subcategoriesID')
// ->join('product_images','product.productID','=','product_images.product_id')
// ->where('product.sellerID','=',88)
// ->where('product_images.status','=','main')
// ->select('categories.categoryName, product.productID, product.productName, product_images.image_name, product.productPrice, product.productQty, product.productWeight')
// ->orderBy('productID','DESC')
// ->all();

// var_dump($result);

// $b = new Balance;
// echo $b->checkBalance(88);
// $string = '1.000.000';
// $a = str_replace(".","",$string);
// echo $a;
// var_dump((int)$a);

  //
  //   $mail = new PHPMailer;
  //   //$mail->SMTPDebug = 3;                               	// Enable verbose debug output
  //   $mail->isSMTP();                                      	// Set mailer to use SMTP
  //   $mail->Host = 'smtp.gmail.com';  						// Specify main and backup SMTP servers
  //   $mail->SMTPAuth = true;                               	// Enable SMTP authentication
  //   $mail->Username = 'tuantiket.id@gmail.com';             // SMTP username
  //   $mail->Password = 'qwerty!@#$%';                        // SMTP password
  //   $mail->SMTPSecure = 'ssl';                            	// Enable TLS encryption, `ssl` also accepted
  //   $mail->Port = 465;                                    	// TCP port to connect to
  //   $mail->setFrom('tuantiket.id@gmail.com', 'Emall');		// Add Sender
  //   $mail->addAddress('');     							// Add a recipient
  //   //$mail->addAddress('ellen@example.com');               // Name is optional
  //   $mail->addReplyTo('tuantiket.id@gmail.com', 'Information');
  //   //$mail->addCC('cc@example.com');
  //   //$mail->addBCC('bcc@example.com');
  //   //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
  //   //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
  //   $mail->isHTML(true);                                  	// Set email format to HTML
  //   $mail->Subject = "";
  //   $mail->Body    = "";
  //   $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
  //   //$mail->send();
  //
  // $mail->send();

// $id = Session::get('sellerSession');
//
// $seller->setTable('categories');
//
// $seller->setTable('categories');
// $categories = $seller->join('sub_categories','categories.categoriesID','=','sub_categories.categoriesID')
// ->join('product','sub_categories.subcategoriesID','=','product.subcategoriesID')
// ->join('product_images','product.productID','=','product_images.product_id')
// ->where('product.sellerID','=',Session::get('sellerSession'))
// ->where('product_images.status','=','main')
// ->select('categories.categoryName,product.productID, product.productName, product_images.image_name, product.productPrice, product.productQty, product.productWeight')
// ->all();
// foreach ($categories as $key => $category) {
//   var_dump($key);
//   echo " Ketegori : {$category->categoryName} <br/>";
//   echo " Nama : {$category->productName} <br/>";
//   echo " Nama : {$category->image_name} <br/>";
//   echo "~~~~~~~~~~~~~~~ <br/>";
// }
//
//
// for($i=0;$i<3;$i++){
//   echo $i ."<br />";
// }

// $categories = $seller->select()->all();
// foreach ($categories as $index => $category) {
//   echo $category->categoryName . "<br />";
//   $seller->setTable('sub_categories');
//   $sub_categories = $seller->select()->where('categoriesID','=',$category->categoriesID)->all();
//   if($sub_categories == null){
//       echo "-- kosong <br />";
//   }
//   foreach ($sub_categories as $key => $value) {
//     echo "--" . $value->subName . "<br />";
//   }
//
// }

//
// eturn file_exists($this->fileDirectory . $this->dataImage);
//
// for($i=0; $i< 3; $i++){
//
//   echo $a->fileNameProduct($id, $i);
// }
// $user->setTable('seller_bank');
// $result = $user->select('sellerID')
// ->where('sellerID','=',$id)
// ->all();
// echo count((array)$result);

// $seller->NumberOfBank($id);
// $i = 0;
// $m = '';
// $user->setTable('product_images');
// $result = $user->select('image_name')->where('product_id','=',9)->all();
//
// foreach ($result as $index => $image) {
//   if($index == $i){
//       $m = $image->image_name."<br />";
//   }
//
// }
// echo $m;

			// $result = $user->select('sellerID')
			// ->where('sellerID','=',88)
			// ->all();
			//


// if (1 == 1) {

//         if (5 > 8) {
//       echo "benar";
//     } else {
//         echo "salah";
//     }
//     } else {
//          echo "salah bawah";
//     }


//
// $user->setTable('seller');
// $result = $user->select('sellerID, status')
// ->where('sellerID','=',0)
// ->first();
// $result = time();
//
// var_dump($result);
// // echo $username 	= $result->username;
// echo $sellerID 	= $result->sellerID;
// echo $code 			= $result->code;
// First Data
// $seller->setTable('seller');
// $users = $seller->select()->where('sellerID','=',$id)->first();
//
// // echo $users->sellerID;
// $name = 'images.jpg';
//
//
//   $a = strtolower(@end(explode('.', $name)));
//
// echo $a;


// if($_FILES){
//   $extension    = pathinfo($_FILES[0]["name"], PATHINFO_EXTENSION );
//   $filename     = $id.'.'.$extension;
//   $destination  =  "../../uploads/".$filename;
//   $error        = $_FILES[0]["error"];
//
//   if(!file_exists($destination)){
//      move_uploaded_file($_FILES[0]["tmp_name"], $destination);
//      $seller->saveFileName($id,$filename);
//      chmod($destination, 0644);
//
//   }else {
//     unlink($destination);
//     move_uploaded_file($_FILES[0]["tmp_name"], $destination);
//     $seller->saveFileName($id,$filename);
//     chmod($destination, 0644);
//
//   }
// }


// All Data
// $test->setTable('bank');
// $users = $test->select('bankID, bankName')->all();
// var_dump($users);

// WHERE
// $test->setTable('withdrawal');
// $test->select();
// $users = $test->where('status', '=', 'pending')->first();
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
// $users = $test->select()->where('seller_bankID', '=', 127)->all();
// $users = $test->where('seller_bankID', '=',127)->where('amount', '=', 2345658)->all();
// $users =  $test->where('amount', '=', 1000000)->orWhere('amount', '=', 2544534)->all();
// var_dump($users);

// CREATE
// $test->setTable('withdrawal');
// $test->create([
//  'seller_bankID' => 124,
//  'statusWithdrawal' => 'accept',
// ]);

//UPDATE
// $test->setTable('withdrawal');
// $test->where('statusWithdrawal', '=', 'accept')->update([
//  'statusWithdrawal' => 'success',
// ]);

//DELETE
// $test->setTable('withdrawal');
// $test->where('statusWithdrawal', '=', 'success')->delete();


// ORDER BY - LIMIT
// $test->setTable('withdrawal');
// $users = $test->select()->orderBy('amount', 'DESC')->all();
// $users = $test->select()->orderBy('amount', 'DESC')->limit(3)->all();
// var_dump($users);


//WHERE OR WHERE
// $test->setTable('seller_bank');
// $users = $test
//     ->select()
//     ->where('seller_bankID','=',125)
//     ->orWhere('seller_bankID','=',124)
//     ->where('accountNumber','=','464301002978506')->first();
// var_dump($users);


//JOIN
// $test->setTable('withdrawal');
// $users = $test
//     ->join('seller_bank','seller_bank.seller_bankID','=','withdrawal.seller_bankID')
//     ->join('bank','bank.bankID','=','seller_bank.bankID')
//     ->Where('sellerID','=',60)
//     ->select('withdrawal.amount, withdrawal.statusWithdrawal, withdrawal.lastUpdate, seller_bank.accountNumber, seller_bank.ownerName, bank.bankName')
//     ->all();
// var_dump($users);


// FULL JOIN
// $test->setTable('withdrawal');
// $users = $test->union('withdrawal.amount', 'seller_bank', 'seller_bank.seller_bankID', '=', 'withdrawal.seller_bankID',1)->union('withdrawal.amount', 'seller_bank', 'seller_bank.seller_bankID', '=', 'withdrawal.seller_bankID',2)->all();

// function generateRandomString($length = 50) {
//     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//     $charactersLength = strlen($characters);
//     $randomString = '';
//     $a ='';
//     for ($i = 0; $i < $length; $i++) {
//         $randomString .= $characters[rand(0, $charactersLength - 1)];
//     }
//     return $randomString;
// }
//
// echo generateRandomString(12);
?>
