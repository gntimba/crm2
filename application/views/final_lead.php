<?php
use PHPMailer\ PHPMailer\ PHPMailer;
use PHPMailer\ PHPMailer\ Exception;
$mail = new PHPMailer( true );
		try {
			//Server settings
			//$mail->SMTPDebug = 2; // Enable verbose debug output
			$mail->isSMTP(); // Set mailer to use SMTP
			$mail->Host = 'dopey.aserv.co.za'; // Specify main and backup SMTP servers
			$mail->SMTPAuth = true; // Enable SMTP authentication
			$mail->Username = 'info@ikworxitacademy.com'; // SMTP username
			$mail->Password = 'Password@2018'; // SMTP password
			$mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 25; // TCP port to connect to
			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);
			//Recipients
			$mail->setFrom( 'info@ikworxitacademy.com', 'Confirm Order' );
			//$mail->addAddress('gntimba@gmail.com', 'Joe User');     // Add a recipient
			$mail->addAddress( 'gntimba@gmail.com' ); // Name is optional
			//$mail->addReplyTo( $replyEmail, 'Demo' );
			//$mail->addCC('cc@example.com');
			//$mail->addBCC('bcc@example.com');

			//Attachments
			// $mail->addAttachment('docs/'.$docname);         // Add attachments
			// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

			//Content
			$mail->isHTML( true ); // Set email format to HTML
			$mail->Subject = 'Veify order';
			$mail->Body = $mess;
			//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			$mail->send();
			$feedback= '<div id="success" class="alert alert-success">Email Sent Successfully</div>';
		} catch ( Exception $e ) {
			$feedback= '<div id="success" class="alert alert-danger">Message could not be sent. Mailer Error: '. $mail->ErrorInfo.'</div>';
		}
echo json_encode(array('feedback'=>$feedback))


?>