<?php

require 'header.php';
require 'includes/PasswordHash.php';

if ( isset($_GET['user_id']) && $_GET['user_id'] && isset($_GET['reset_token']) && !empty($_GET['reset_token']) ) {
	$sql = 'SELECT * FROM users WHERE id = ' . qstr($_GET['user_id']) . ' AND password_reset_token = ' . qstr($_GET['reset_token']);
	$result = $db->query($sql);

	if ( $result->num_rows > 0 ) {
		$_SESSION['user'] = $result->fetch_assoc();
	}
}

if ( !isset($_SESSION['user']) ) {
	header("Location: index.php");
	exit;
}

$sql = 'SELECT * FROM users WHERE id = ' . qstr($_SESSION['user']['id']);
$result = $db->query($sql);
$user = $result->fetch_assoc();

$action = isset($_GET['action']) ? $_GET['action'] : null;


if ( $action == 'edit' ) {
	print_template('edit_profile', array(
		'user' => $user,
		'page_title' => 'Edit Profile'
	));
}
else if ( $action == 'update' ) {
	// set an error if required fields are missing
	$reqs = array('name', 'email');

	foreach ( $reqs as $req ) {
		if ( !isset($_POST[$req]) || trim($_POST[$req]) == '' ) {
			$alert = "<p class='alert alert-error'>Missing required field: " . $req . "</p>";
			break;
		}
	}

	// if the given email address doesn't match <something>@<something>.<something, set an error message
	if ( !preg_match('/(.*)@(.*)\.(.*)$/', $_POST['email']) ) {
		$alert = '<div class="alert alert-error">Invalid email address!</div>';
	}

	if ( isset($alert) ) {
		print_template('edit_profile', array(
			'page_title' => "Edit Profile",
			'alert' => $alert,
			'user' => $_POST
		));
		die;
	}

	// escape user input
	$safe = array();

	foreach ( $_POST as $key => $val ) {
		$safe[$key] = qstr($val);
	}

	$sql = 'UPDATE users SET name = ' . $safe['name'] . ', email = ' . $safe['email'] . ', shipping_address=' . $safe['shipping_address'] . ', billing_address = ' . $safe['billing_address'] . ' WHERE id = ' . qstr($_SESSION['user']['id']);

	if ( !$db->query($sql) ) {
		echo $db->error;
		die;
	}

	header("Location: profile.php");
	exit;
}
elseif ( $action == 'edit_password' ) {
	print_template('edit_password', array(
		'user' => $user,
		'page_title' => 'Change Password'
	));
}
elseif ( $action == 'update_password' ) {
	$hasher = new PasswordHash(8, false);

	// set an error if required fields are missing
	$reqs = array('password', 'password_confirmation');

	foreach ( $reqs as $req ) {
		if ( !isset($_POST[$req]) || trim($_POST[$req]) == '' ) {
			$alert = "<p class='alert alert-error'>Missing required field: " . $req . "</p>";
			break;
		}
	}

	if ( isset($_POST['reset_token']) ) {
		if ( $user['password_reset_token'] != $_POST['reset_token'] ) {
			$alert = "<p class='alert alert-error'>Expired password token!</p>";
		}
	}
	else {
		if ( !$hasher->CheckPassword($_POST['current_password'], $user['password']) ) {
			$alert = "<p class='alert alert-error'>Invalid current password!</p>";
		}
	}

	if ( $_POST['password'] != $_POST['password_confirmation'] ) {
		$alert = '<div class="alert alert-error">Passwords do not match!</div>';
	}

	if ( strlen($_POST['password']) < 8 ) {
		$alert = '<div class="alert alert-error">Password must be at least 8 characters long!</div>';
	}

	if ( isset($alert) ) {
		print_template('edit_password', array(
			'user' => $user,
			'page_title' => 'Change Password',
			'alert' => $alert
		));
		die;
	}

	$sql = 'UPDATE users SET password = ?, password_reset_token = NULL WHERE id = ?';
	$statement = $db->prepare($sql);
	$statement->bind_param('sd', $hasher->HashPassword($_POST['password']), $_SESSION['user']['id']);
	$statement->execute();

	header("Location: profile.php");
	exit;
}
else {
	print_template('profile', array(
		'user' => $user,
		'page_title' => $user['name']
	));
}