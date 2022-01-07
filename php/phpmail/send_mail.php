<?php
/*##########Script Information#########
  # Purpose: Send mail Using PHPMailer#
  #          & Gmail SMTP Server 	  #
  #	Author : Umesh Chaudhari		  #
  # Version: 1.0					  #
  #####################################*/

//Include required PHPMailer files
	// require 'includes/PHPMailer.php';
	// require 'includes/SMTP.php';
	// require 'includes/Exception.php';
//Define name spaces
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
//Create instance of PHPMailer
	$mail = new PHPMailer();
//Set mailer to use smtp
	$mail->isSMTP();
//Define smtp host
	$mail->Host = "smtp.gmail.com";
//Enable smtp authentication
	$mail->SMTPAuth = true;
//Set smtp encryption type (ssl/tls)
	$mail->SMTPSecure = "tls";
//Port to connect smtp
	$mail->Port = "587";
//Set gmail username
	$mail->Username = "sender@gmail.com";
//Set gmail password
	$mail->Password = "senderpass";
//Email subject
	$mail->Subject = "Organ Donation Center";
//Set sender email
	$mail->setFrom('sender@gmail.com');
//Enable HTML
	$mail->isHTML(true);
	function upc_send_mail($reciverMail,$htmlText){
		global $mail;
		//Email body
	    $mail->Body = $htmlText;
	    //Add recipient
		$mail->addAddress($reciverMail);
		//Finally send email
			if (!$mail->send() ) {
				echo "Message could not be sent. Mailer Error: "{$mail->ErrorInfo};
			}
		//Closing smtp connection
		$mail->smtpClose();
	}
	// upc_send_mail('umeshchaudhariupc@gmail.com',"<h1>PCCOE</h1>");
?>