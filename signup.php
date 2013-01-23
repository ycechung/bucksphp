<?php

require 'header.php';
require 'includes/PasswordHash.php';

if ( isset($_SESSION['user']) ) {
  header("Location: profile.php");
  exit;
}

$action = isset($_GET['action']) ? $_GET['action'] : null;

if ( $action == 'signup' ) {
	// set an error if required fields are missing
	$reqs = array('name', 'email', 'password', 'password_confirmation');

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

	if ( strlen($_POST['password']) < 8 ) {
		$alert = '<div class="alert alert-error">Password must be at least 8 characters long!</div>';
	}

	if ( $_POST['password'] != $_POST['password_confirmation'] ) {
		$alert = '<div class="alert alert-error">Passwords do not match!</div>';
	}

	if ( isset($alert) ) {
		print_template('signup', array(
			'page_title' => "Signup",
			'alert' => $alert,
		));
		die;
	}

	$hasher = new PasswordHash(8, FALSE);
	$hashed_password = $hasher->HashPassword($_POST['password']);

	// escape user input
	$safe = array();

	foreach ( $_POST as $key => $val ) {
		$safe[$key] = qstr($val);
	}

	$sql = 'INSERT INTO users (name, email, password) VALUES (' . $safe['name'] . ', ' . $safe['email'] . ', ' . qstr($hashed_password) . ')';

	if ( !$db->query($sql) ) {
		echo $db->error;
		die;
	}

	$user_id = $db->insert_id;

	$sql = 'SELECT * FROM users WHERE id = ' . qstr($user_id);
	$result = $db->query($sql);
	$_SESSION['user'] = $result->fetch_assoc();

	header('Location: profile.php');
	exit;
}

print_template('signup', array(
	'page_title' => "Signup"
));