<?php

require 'header.php';
require 'includes/PasswordHash.php';

$action = isset($_GET['action']) ? $_GET['action'] : null;
$alert = null;

if ( $action == 'reset' ) {
	$sql = 'SELECT * FROM users WHERE email = ' . qstr($_POST['email']);
	$result = $db->query($sql);

	if ( $result->num_rows > 0 ) {		
		// generate token
		$hasher = new PasswordHash(8, false);
		$password_reset_token = $hasher->HashPassword(microtime().uniqid().$_POST['email']);

		// save token in database
		$user = $result->fetch_assoc();
		$sql = "UPDATE users SET password_reset_token = " . qstr($password_reset_token) . " WHERE id = " . qstr($user['id']);
		$db->query($sql);

		// send email
		// mail()
		echo '<a href="profile.php?action=edit_password&user_id=' . $user['id'] . '&reset_token=' . $password_reset_token . '">reset password here</a>';
		die;
	}
	else {
		$alert = '<p class="alert alert-error">The provided email address does not exist.</p>';
	}
}

print_template('reset_password', array(
	'page_title' => "Reset Password",
	'alert' => $alert
));