<?php

require 'header.php';

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
else {
	print_template('profile', array(
		'user' => $user,
		'page_title' => $user['name']
	));
}