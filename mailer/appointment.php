<?php
/*
 * Mailer Script: Appointment Form
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
	if ( empty( $first_name ) || empty( $last_name ) || empty( $email ) || empty( $phone ) || empty( $size ) || empty( $description ) ) {

		echo 'fail';

	} else {

		$subject = 'New Appointment Request from ' . $first_name . ' ' . $last_name;

		$message = '<html><body>';
		$message .= '<h2>' . $subject . '</h2><br>';
		$message .= '<table rules="all" cellpadding="10" style="border-color: #cccccc;">';
		$message .= '<tr><td style="width: 120px;">First Name</td><td><strong>' . $first_name . '</strong></td></tr>';
		$message .= '<tr><td>Last Name</td><td><strong>' . $last_name . '</strong></td></tr>';
		$message .= '<tr><td>Email</td><td><strong>' . $email . '</strong></td></tr>';
		$message .= '<tr><td>Phone Number</td><td><strong>' . $phone . '</strong></td></tr>';
		$message .= '<tr><td>Part of body</td><td><strong>' . $part_body . '</strong></td></tr>';
		if ( isset( $custom ) ) $message .= '<tr><td>Specific part of body</td><td><strong>' . $custom . '</strong></td></tr>';
		$message .= '<tr><td>Size</td><td><strong>' . $size . '</strong></td></tr>';
		$message .= '<tr><td>Color</td><td><strong>' . $color . '</strong></td></tr>';
		$message .= '<tr><td>Description</td><td><strong>' . $description . '</strong></td></tr>';
		$message .= '<tr><td>Artist</td><td><strong>' . $artist . '</strong></td></tr>';
		$message .= '</table></body></html>';

		// required for SMTP
		if ( $smtp ) {
			date_default_timezone_set('Etc/UTC');
		}

		require( 'PHPMailer/PHPMailerAutoload.php' );

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

		$mail->setFrom( $email, '=?UTF-8?B?' . base64_encode( $first_name . ' ' . $last_name ) . '?=' );
		$mail->addReplyTo( $email );

		$mail->addAddress( $to );
		if ( $send_to_artist && array_key_exists( $artist, $artists_email ) ) {
			$mail->addAddress( $artists_email[$artist] );
		}

		$mail->Subject = '=?UTF-8?B?' . base64_encode( $subject ) . '?=';
		$mail->isHTML( true );
		$mail->Body = $message;
		$mail->CharSet = 'UTF-8';

		if ( $mail->send() ) {
		    echo 'success';
		} else {
		    echo 'fail ' . $mail->ErrorInfo;
		}

	}

}