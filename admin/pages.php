<?php

// Product CRUD actions

// include the global header file
require '../header.php';

// set an action based on the ?action param
$action = isset($_GET['action']) ? $_GET['action'] : null;

// show the new page form
if ( $action == 'new' ) {
	print_template('admin/pages/new', array(
		'page_title' => 'New Page'
	), 'admin');
}
// create a page record
elseif ( $action == 'create' ) {
	// set an error if required fields are missing
	$reqs = array('title', 'body');

	foreach ( $reqs as $req ) {
		if ( !isset($_POST[$req]) || trim($_POST[$req]) == '' ) {
			$error = "Missing required field: " . $req;
			break;
		}
	}

	// if an error is set, print the new product form with the error message
	if ( isset($error) ) {
		print_template('admin/pages/new', array(
			'page_title' => 'New Page',
			'error' => $error,
		), 'admin');
		die;
	}

	// sanitize all POST input
	$safe = array();

	foreach ( $_POST as $key => $val ) {
		$safe[$key] = qstr(trim($val));
	}

	// insert the new page into the database
	$sql = 'INSERT INTO pages (title, body) VALUES (' . $safe['title'] . ', ' . $safe['body'] . ')';

	// kill the script if the query fails
	if ( !$db->query($sql) ) {
		echo $db->error;
		die;
	}

	// Set a message to show on next page view stating that the action was successful
	$page_id = $db->insert_id;

	$_SESSION['message'] = '<div class="alert alert-success"><a href="pages.php?action=show&id=' . $page_id . '">' . $_POST['title'] . '</a> was added successfully.</div>';

	// Redirect to the index page
	header('Location: pages.php');
	exit;
}
// show the edit page form
elseif ( $action == 'edit' ) {
	// if the id param is missing, redirect to the index page
	if ( !isset($_GET['id']) ) {
		header('Location: pages.php');
		die;
	}

	$sql = 'SELECT * FROM pages WHERE id = ' . qstr($_GET['id']);
	$result = $db->query($sql);
	$page = $result->fetch_assoc();

	// print the edit page template
	print_template('admin/pages/edit', array(
		'page_title' => 'Edit Page: ' . $page['title'],
		'page' => $page,
	), 'admin');
}
// update a page record
elseif ( $action == 'update' ) {
	// if the id param is missing, redirect to the index page
	if ( !isset($_POST['id']) ) {
		header('Location: pages.php');
		die;
	}

	// set an error if required fields are missing
	$reqs = array('title', 'body');

	foreach ( $reqs as $req ) {
		if ( !isset($_POST[$req]) || trim($_POST[$req]) == '' ) {
			$error = "Missing required field: " . $req;
			break;
		}
	}

	// if an error is set, print the edit page form with the error message
	if ( isset($error) ) {
		print_template('admin/pages/edit', array(
			'page_title' => 'Edit Page',
			'error' => $error,
			'page' => $_POST,
		), 'admin');
		die;
	}

	// sanitize all POST input
	$safe = array();

	foreach ( $_POST as $key => $val ) {
		$safe[$key] = qstr(trim($val));
	}

	// Update the page record
	$sql = 'UPDATE pages SET title = ' . $safe['title'] . ', body = ' . $safe['body'] . ' WHERE id = ' . $safe['id'];

	// kill the script if the query fails
	if ( !$db->query($sql) ) {
		echo $db->error;
		die;
	}

	// Set a message to show on next page view stating that the action was successful
	$_SESSION['message'] = '<div class="alert alert-success"><a href="pages.php?action=show&id=' . $safe['id'] . '">' . $_POST['title'] . '</a> was updated successfully.</div>';

	// redirect to the index page
	header('Location: pages.php');
	exit;
}
// delete a page record
elseif ( $action == 'delete' ) {
	// if the id param is missing, redirect to the index page
	if ( !isset($_GET['id']) ) {
		header('Location: pages.php');
		die;
	}

	// delete the page record from the database
	$sql = 'DELETE FROM pages WHERE id = ' . qstr($_GET['id']);

	// kill the script if the query fails
	if ( !$db->query($sql) ) {
		echo $db->error;
		die;
	}

	// Set a message to show on next page view stating that the action was successful
	$_SESSION['message'] = '<div class="alert alert-success">Page was deleted successfully.</div>';

	// redirect to the index page
	header('Location: pages.php');
	exit;
}
// show details about a single page
elseif ( $action == 'show' ) {
	// if the id param is missing, redirect to the index page
	if ( !isset($_GET['id']) ) {
		header('Location: pages.php');
		die;
	}

	// select a single page record from the database
	$sql = 'SELECT * FROM pages WHERE id = ' . qstr($_GET['id']);
	$result = $db->query($sql);
	$page = $result->fetch_assoc();

	// print the show template
	print_template('admin/pages/show', array(
		'page' => $page,
		'page_title' => 'Page: ' . $page['title']
	), 'admin');
}
// pages index
else {
	// select all pages sorted by title
	$sql = "SELECT * FROM pages ORDER BY title";
	$result = $db->query($sql);

	// create an array of page records
	$pages = array();

	while ( $row = $result->fetch_assoc() ) {
		$pages[] = $row;
	}

	// print the pages index page
	print_template('admin/pages/index', array(
		'pages' => $pages,
		'page_title' => 'Pages'
	), 'admin');
}