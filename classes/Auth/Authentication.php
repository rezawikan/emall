<?php

namespace Emall\Auth;

use DateTime;
use Emall\Email\Email;
use Emall\Auth\Session;
use Emall\Auth\Redirect;
use Emall\Database\Database;

class Authentication
{

	// private property
	private $conn;
	private $statusActive 	= "A";
	private $statusInactive = "N";
	private $statusSuspend 	= "S";

	public function __construct()
	{
		$this->conn = Database::getInstance();
	}

	// register new user
	public function register($email, $username, $firstName, $lastName, $password, $code)
	{
		try {
					$pass = password_hash($password, PASSWORD_DEFAULT);
					$user = $this->conn;
					$user->setTable('seller');
					// $user->create([
					// 	'email'			=> $email,
					// 	'username'	=> $username,
					// 	'firstName'	=> $firstName,
					// 	'lastName' 	=> $lastName,
					// 	'password'	=> $pass,
					// 	'code'			=> $code,
					// 	'create_at' => date_format(new DateTime(), 'Y-m-d H:i:s')
					// ]);

					return true;

		}catch (PDOException $e) {
			echo "Error ". $e->getMessage();
		}
	}

	// set balance
	public function startBalance($id)
	{
		$user = $this->conn;
		$user->setTable('seller_balance');
		$user->create([
			'sellerID' => $id
		]);

		return true;
	}

	// check match password
	public function checkPassword($fpassword, $spassword)
	{
		if ($fpassword != $spassword) {
				return false;
		} else {
				return true;
		}
	}

	// checkbox check
	public function checkedBox($checkbox)
	{
		if (isset($checkbox) && $checkbox != "") {
    		return true;
		}	else {
				return false;
		}
	}

	// check session and cookie user
	public function is_logged_in(){
	  if (Session::exists('sellerSession') && isset($_COOKIE['id']))
		{
	  		return true;
	  } else {
	  		return false;
	  }
	}

	// check available username
	public function checkUser($username)
	{
		try {
			$user = $this->conn;
			$user->setTable('seller');
			$result = $user->select()->where('username','=',$username)->first();

			if($result == null){
				return true;
			}else {
				return false;
			}
		}catch(PDOException $e){
			echo "Error : ". $e->getMessage();
		}
	}

	// check available email
	public function checkEmail($email)
	{
		try {
				$user = $this->conn;
				$user->setTable('seller');
				$result = $user->select()->where('email','=',$email)->first();

				if ($result == null) {
						return true;
				} else {
						return false;
			}
		}catch(PDOException $e){
			echo "Error : ". $e->getMessage();
		}
	}

	// user login
	public function login($username, $pass)
	{
		try {
				$user = $this->conn;
				$user->setTable('seller');
				$result = $user->select()->where('username','=',$username)->orWhere('email','=',$username)->first();

			if ($result) {
				if ($result->status == "A") {
						if (password_verify($pass,$result->password)) {
								Session::set('sellerSession',$result->sellerID);
								setcookie('id', $result->sellerID, time() + (86400 * 30), "/");
								$status['success'] = 'login successfully';
						} else {
							$status['wrong'] = 'your password is wrong';
						}
				} else if ($result->status == $this->statusSuspend) {
						$status['suspend'] = 'your account is suspend, Please contact admin';
				} else {
						$status['inactive'] = 'your account is not active';
				}
			} else {
					$status['notfound'] = 'Not found, do you have account?';
			}

			echo json_encode($status);
		} catch (PDOException $e) {
				echo "Error ". $e->getMessage;
		}
	}

	// logout and destroy session
	public function logout()
	{
		Session::destroy();
		Session::empty('sellerSession');
		setcookie("id", "", time() - (86400 * 30), "/");
	}

	// check user for verified account
	public function verify($id, $code)
	{
		try {
				$user = $this->conn;
				$user->setTable('seller');
				$result = $user->select('sellerID, status')
				->where('sellerID','=',$id)
				->where('code','=',$code)
				->first();

			if ($result != false) {
					if ($result->status == $this->statusInactive) {
							$result = $user->where('sellerID','=',$id)
							->update([
								'status' => $this->statusActive
							]);
							return true;
				}	else if ($result->status == $this->statusActive) {
						return false;
				}
			} else {
					Redirect::to('index.php');
			}
		} catch (PDOException $e) {
			echo "Error : ".$e->getMessage();
		}
	}

	// forgot password
	public function forgotPassword($email)
	{
		try {
				$user = $this->conn;
				$user->setTable('seller');
				$result = $user->select('sellerID, status, username, code')->where('email','=',$email)->first();

			if ($result != false) {
					$report 		= $result->status;
					$username 	= $result->username;
					$sellerID 	= $result->sellerID;
					$code 			= $result->code;


					if ($report != $this->statusSuspend) {
						$id = base64_encode($sellerID);

					$message 	= "
					<!doctype html>
			            <html>
			              <head>
			                <meta name='viewport' content='width=device-width'>
			                <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
			                <title>Reset Password</title>
			                <style media='all' type='text/css'>
			                @media all {
			                  .btn-primary table td:hover {
			                    background-color: #34495e !important;
			                  }
			                  .btn-primary a:hover {
			                    background-color: #34495e !important;
			                    border-color: #34495e !important;
			                  }
			                }

			                @media all {
			                  .btn-secondary a:hover {
			                    border-color: #34495e !important;
			                    color: #34495e !important;
			                  }
			                }

			                @media only screen and (max-width: 620px) {
			                  table[class=body] h1 {
			                    font-size: 28px !important;
			                    margin-bottom: 10px !important;
			                  }
			                  table[class=body] h2 {
			                    font-size: 22px !important;
			                    margin-bottom: 10px !important;
			                  }
			                  table[class=body] h3 {
			                    font-size: 16px !important;
			                    margin-bottom: 10px !important;
			                  }
			                  table[class=body] p,
			                  table[class=body] ul,
			                  table[class=body] ol,
			                  table[class=body] td,
			                  table[class=body] span,
			                  table[class=body] a {
			                    font-size: 16px !important;
			                  }
			                  table[class=body] .wrapper,
			                  table[class=body] .article {
			                    padding: 10px !important;
			                  }
			                  table[class=body] .content {
			                    padding: 0 !important;
			                  }
			                  table[class=body] .container {
			                    padding: 0 !important;
			                    width: 100% !important;
			                  }
			                  table[class=body] .header {
			                    margin-bottom: 10px !important;
			                  }
			                  table[class=body] .main {
			                    border-left-width: 0 !important;
			                    border-radius: 0 !important;
			                    border-right-width: 0 !important;
			                  }
			                  table[class=body] .btn table {
			                    width: 100% !important;
			                  }
			                  table[class=body] .btn a {
			                    width: 100% !important;
			                  }
			                  table[class=body] .img-responsive {
			                    height: auto !important;
			                    max-width: 100% !important;
			                    width: auto !important;
			                  }
			                  table[class=body] .alert td {
			                    border-radius: 0 !important;
			                    padding: 10px !important;
			                  }
			                  table[class=body] .span-2,
			                  table[class=body] .span-3 {
			                    max-width: none !important;
			                    width: 100% !important;
			                  }
			                  table[class=body] .receipt {
			                    width: 100% !important;
			                  }
			                }

			                @media all {
			                  .ExternalClass {
			                    width: 100%;
			                  }
			                  .ExternalClass,
			                  .ExternalClass p,
			                  .ExternalClass span,
			                  .ExternalClass font,
			                  .ExternalClass td,
			                  .ExternalClass div {
			                    line-height: 100%;
			                  }
			                  .apple-link a {
			                    color: inherit !important;
			                    font-family: inherit !important;
			                    font-size: inherit !important;
			                    font-weight: inherit !important;
			                    line-height: inherit !important;
			                    text-decoration: none !important;
			                  }
			                }
			                </style>
			              </head>
			              <body class=' style='font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background-color: #f6f6f6; margin: 0; padding: 0;'>
			                <table border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6;' width='100%' bgcolor='#f6f6f6'>
			                  <tr>
			                    <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
			                    <td class='container' style='font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0 auto !important; max-width: 580px; padding: 10px; width: 580px;' width='580' valign='top'>
			                      <div class='content' style='box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;'>

			                        <!-- START CENTERED WHITE CONTAINER -->
			                        <span class='preheader' style='color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;'>Email confirmation for your account in Emall</span>
			                        <table class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #fff; border-radius: 3px;' width='100%'>

			                          <!-- START MAIN CONTENT AREA -->
			                          <tr>
			                            <td class='wrapper' style='font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;' valign='top'>
			                              <table border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;' width='100%'>
			                                <tr>
			                                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>
			                                    <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;'>Hi $username,</p>
			                                    <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;'>Thanks for join with us. Please activate your account by clicking the button below.</p>
			                                    <table border='0' cellpadding='0' cellspacing='0' class='btn btn-primary' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;' width='100%'>
			                                      <tbody>
			                                        <tr>
			                                          <td align='left' style='font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;' valign='top'>
			                                            <table border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;'>
			                                              <tbody>
			                                                <tr>
			                                                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #1ab394; border-radius: 5px; text-align: center;' valign='top' bgcolor='#1ab394' align='center'> <a href='http://localhost/skripsi/seller/reset_password.php?id=$id&code=$code' target='_blank' style='display: inline-block; color: #ffffff; background-color: #1ab394; border: solid 1px #1ab394; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #1ab394;'>Reset Your Password</a> </td>
			                                                </tr>
			                                              </tbody>
			                                            </table>
			                                          </td>
			                                        </tr>
			                                      </tbody>
			                                    </table>
			                                    <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;'>We may need to communicate important service level issues with you from time to time, so it's <strong>important we have an up-to-date email address</strong> for you on file.</p>
			                                    <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;'>Good luck! Hope it works.</p>
			                                    <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;'>The Emall Team</p>
			                                  </td>
			                                </tr>
			                              </table>
			                            </td>
			                          </tr>

			                          <!-- END MAIN CONTENT AREA -->
			                          </table>

			                        <!-- START FOOTER -->
			                        <div class='footer' style='clear: both; padding-top: 10px; text-align: center; width: 100%;'>
			                          <table border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;' width='100%'>
			                            <tr>
			                              <td class='content-block' style='font-family: sans-serif; vertical-align: top; padding-top: 10px; padding-bottom: 10px; font-size: 12px; color: #999999; text-align: center;' valign='top' align='center'>
			                                <span class='apple-link' style='color: #999999; font-size: 12px; text-align: center;'>Company Inc, 3 Abbey Road, San Francisco CA 94102</span>
			                                <br> Don't like these emails? <a href='http://i.imgur.com/CScmqnj.gif' style='text-decoration: underline; color: #999999; font-size: 12px; text-align: center;'>Unsubscribe</a>.
			                              </td>
			                            </tr>
			                            <tr>
			                              <td class='content-block powered-by' style='font-family: sans-serif; vertical-align: top; padding-top: 10px; padding-bottom: 10px; font-size: 12px; color: #999999; text-align: center;' valign='top' align='center'>
			                                Powered by <a href='http://htmlemail.io' style='color: #999999; font-size: 12px; text-align: center; text-decoration: none;'>HTMLemail</a>.
			                              </td>
			                            </tr>
			                          </table>
			                        </div>

			                        <!-- END FOOTER -->

			            <!-- END CENTERED WHITE CONTAINER -->
			                      </div>
			                    </td>
			                    <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
			                  </tr>
			                </table>
			              </body>
			            </html>
					";

					$subject 	= "Password Reset";
					Email::sendMail($email, $message, $subject);
					$status['sent'] = 'Please check your email to reset your password';
				}

				else if ($report == $this->statusSuspend) {
					$status['suspend'] = 'Please contact admin, your account is suspended';
				}
			} else {
					$status['notfound'] = 'Email is not registered';
			}
			echo json_encode($status);
		} catch (PDOException $e) {
			echo "Error : ".$e->getMessage();
		}
	}

	// check valid temporary code
	public function checkTemporaryCode($id, $code)
	{
		try {
				$user = $this->conn;
				$user->setTable('seller');
				$result = $user->select()->where('sellerID','=',$id)->where('tempCode','=',$code)->first();

				if ($result != false) {
					 return true;
				} else {
						return false;
				}
		} catch (PDOException $e) {
			echo "Error".$e->getMessage();
		}
	}

	// check valid code to set new password
	public function checkCode($id, $code)
	{
		try {
				$user = $this->conn;
				$user->setTable('seller');
				$result = $user->select()->where('sellerID','=',$id)->where('code','=',$code)->first();

				if ($result != false ) {
						return true;
				} else {
						return false;
				}
		}catch(PDOException $e){
			echo "Error".$e->getMessage();
		}
	}

	// set a new password
	public function updatePassword($fpassword, $id)
	{
		try {
				$password = password_hash($fpassword, PASSWORD_DEFAULT);
				$user = $this->conn;
				$user->setTable('seller');
				$result = $user->where('sellerID','=',$id)->update([
					'password' => $password
				]);

				return true;
		} catch (PDOException $e) {
			echo "Error". $e->getMessage();
		}
	}

	// update temporary code
	public function updateTemporaryCode($code, $id)
	{
		try {
				$random = $this->generateRandomString(50);
				$user = $this->conn;
				$user->setTable('seller');
				$result = $user->where('SellerID','=',$id)->update([
					'tempCode'	=> $code,
					'code'			=> $random
				]);

				return true;
		}catch(PDOException $e){
			echo "Error". $e->getMessage();
		}
	}

	public function generateRandomString($length)
	{
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    $a ='';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
}
