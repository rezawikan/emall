<?php

namespace Emall\Email;

use PHPMailer;

class Email
{
  // sending mail with php mailer
	public static function sendMail($email,$message,$subject)
	{
  	try {
	  		$mail = new PHPMailer;
	  		//$mail->SMTPDebug = 3;                               	// Enable verbose debug output
				$mail->isSMTP();                                      	// Set mailer to use SMTP
				$mail->Host = 'smtp.gmail.com';  						// Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                               	// Enable SMTP authentication
				$mail->Username = 'tuantiket.id@gmail.com';             // SMTP username
				$mail->Password = 'qwerty!@#$%';                        // SMTP password
				$mail->SMTPSecure = 'ssl';                            	// Enable TLS encryption, `ssl` also accepted
				$mail->Port = 465;                                    	// TCP port to connect to
				$mail->setFrom('tuantiket.id@gmail.com', 'Emall');		// Add Sender
				$mail->addAddress($email);     							// Add a recipient
				//$mail->addAddress('ellen@example.com');               // Name is optional
				$mail->addReplyTo('tuantiket.id@gmail.com', 'Information');
				//$mail->addCC('cc@example.com');
				//$mail->addBCC('bcc@example.com');
				//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
				//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
				$mail->isHTML(true);                                  	// Set email format to HTML
				$mail->Subject = $subject;
				$mail->Body    = $message;
				$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
				//$mail->send();

			if ($mail->send()) {
			    //echo 'Message has been sent';
			    return true;
			} else {
				//echo 'Message could not be sent.';
			    //echo 'Mailer Error: ' . $mail->ErrorInfo;
			    return false;
			}
		} catch (phpmailerException $e) {
				echo $e->errorMessage(); //Pretty error messages from PHPMailer
		} catch (Exception $e) {
				echo $e->getMessage(); //Boring error messages from anything else!
		}
 	}
}
