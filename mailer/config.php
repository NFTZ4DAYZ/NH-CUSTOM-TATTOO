<?php
/*
 * Mailer Configuration File
 * Author: Webisir
 * Author URI: http://themeforest.net/user/webisir
*/

/* =========================================== MAIN RECIPIENT  =========================================== */

$to = 'rorkiteer34@gmail.com';						// TODO: Replace with your main email

/* ========================================= APPOINTMENT FORM ============================================ */

$send_to_artist = false;							// Set TRUE to send the message also to the selected artist
$artists_email = array(
	//'Artist A' => 'artist_a@domain.com',
    //'Artist B' => 'artist_b@domain.com',
	);

/* ============================================ SMTP SETTINGS ============================================ */

$smtp = false;							// Set TRUE if you want use a custom smtp server
$smtp_username = '';					// Add your smtp username
$smtp_password = '';					// Add your smtp password
$smtp_host = '';						// Set the hostname of the mail server (ex. smtp.gmail.com)
$smtp_port = '';						// Set the SMTP port number - likely to be 25, 465 or 587
$smtp_secure = '';						// Set the encryption system to use. Accepted values: 'ssl' or 'tls'