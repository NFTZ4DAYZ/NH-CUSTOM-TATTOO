<?php
/*
 * Mailer Script: Contact Form
 * Author: Webisir
 * Author URI: http://themeforest.net/user/webisir
*/

require( 'config.php' );

if ( isset( $_POST['email'] ) ) {

	// Function to strip html tags from form data
	function cleanFields( $elem ) {
		return strip_tags( $elem );
	}

	extract( array_map( 'cleanFields', $_POST ) );

	// Check if all fields are valid (It's an additional check if the javascript validation has failed)
	if ( empty( $name ) || empty( $email ) || empty( $message ) ) {

		echo 'fail';

	} else {

		// required for SMTP
		if ( $smtp ) {
			date_default_timezone_set('Etc/UTC');
		}

		require 'PHPMailer/PHPMailerAutoload.php';

		$mail = new PHPMailer;

		if ( $smtp ) {
			// SMTP configuration
			$mail->isSMTP();
			$mail->Host = $smtp_host;
			$mail->Port = $smtp_port;
			$mail->SMTPSecure = $smtp_secure;
			$mail->SMTPAuth = true;
			$mail->Username = $smtp_username;
			$mail->Password = $smtp_password;
		}

		$mail->setFrom( $email, '=?UTF-8?B?' . base64_encode( $name ) . '?=' );
		$mail->addReplyTo( $email );
		$mail->addAddress( $to );
		$mail->Subject = '=?UTF-8?B?' . base64_encode( $subject ) . '?=';
		$mail->isHTML( true );
		$mail->Body = $message;
		$mail->CharSet = 'UTF-8';

		if ( $mail->send() ) {
		    echo 'success';
		} else {
		    echo 'fail';
		}

	}

}