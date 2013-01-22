<?php

// Product CRUD actions

// include the global header file
require '../header.php';

// set an action based on the ?action param
$action = isset($_GET['action']) ? $_GET['action'] : null;

// if no product_id is set or an invalid product_id is set, redirect to the products index
if ( !isset($_GET['product_id']) || !$product = get_product($_GET['product_id']) ) {
	header('Location: products.php');
	die;
}

// new size form
if ( $action == 'new' ) {
	print_template('admin/sizes/new', array(
		'page_title' => 'New Size for ' . $product['name'],
		'product' => $product
	), 'admin');
}
// create a size record
elseif ( $action == 'create' ) {
	// set an error if required fields are missing
	$reqs = array('name');

	foreach ( $reqs as $req ) {
		if ( !isset($_POST[$req]) || trim($_POST[$req]) == '' ) {
			$error = "Missing required field: " . $req;
			break;
		}
	}

	// if an error is set, print the new form with the error message
	if ( isset($error) ) {
		print_template('admin/sizes/new', array(
			'page_title' => 'New Size',
			'product' => $product,
			'error' => $error,
		), 'admin');
		die;
	}

	// sanitize all POST input
	$safe = array();

	foreach ( $_POST as $key => $val ) {
		$safe[$key] = qstr(trim($val));
	}

	// insert the new size into the database
	$sql = 'INSERT INTO sizes (name, price_difference, weight, product_id) VALUES (' . $safe['name'] . ', ' . $safe['price_difference'] . ', ' . $safe['weight'] . ', '. qstr($product['id']) . ')';

	// kill the script if the query fails
	if ( !$db->query($sql) ) {
		echo $db->error;
		die;
	}

	// Set a message to show on next page view stating that the action was successful
	$size_id = $db->insert_id;

	$_SESSION['message'] = '<div class="alert alert-success"><a href="sizes.php?action=show&id=' . $size_id . '&product_id=' . $product['id'] . '">' . $_POST['name'] . '</a> was added successfully.</div>';

	// Redirect to the index page
	header('Location: sizes.php?product_id=' . $product['id']);
	exit;
}
// edit size form
elseif ( $action == 'edit' ) {
	// if the id param is missing, redirect to the index page
	if ( !isset($_GET['id']) ) {
		header('Location: sizes.php?product_id=' . $product['id']);
		die;
	}

	// fetch size record for this id
	$sql = 'SELECT * FROM sizes WHERE id = ' . qstr($_GET['id']);
	$result = $db->query($sql);
	$size = $result->fetch_assoc();

	// print the edit size template
	print_template('admin/sizes/edit', array(
		'page_title' => 'Edit Size for ' . $product['name'] . ': ' . $size['name'],
		'product' => $product,
		'size' => $size,
	), 'admin');
}
// update a size record
elseif ( $action == 'update' ) {
	// if the id param is missing, redirect to the index page
	if ( !isset($_POST['id']) || !$_GET['id'] ) {
		header('Location: sizes.php?product_id=' . $product['id']);
		die;
	}

	// set an error if required fields are missing
	$reqs = array('name');

	foreach ( $reqs as $req ) {
		if ( !isset($_POST[$req]) || trim($_POST[$req]) == '' ) {
			$error = "Missing required field: " . $req;
			break;
		}
	}

	// if an error is set, print the edit page form with the error message
	if ( isset($error) ) {
		print_template('admin/sizes/edit', array(
			'page_title' => 'Edit Size',
			'error' => $error,
			'size' => $_POST,
			'product' => $product,
		), 'admin');
		die;
	}

	// sanitize all POST input
	$safe = array();

	foreach ( $_POST as $key => $val ) {
		$safe[$key] = qstr(trim($val));
	}

	// Update the size record
	$sql = 'UPDATE sizes SET name = ' . $safe['name'] . ', price_difference = ' . $safe['price_difference'] . ', weight = ' . $safe['weight'] . ' WHERE id = ' . $safe['id'];

	// kill the script if the query fails
	if ( !$db->query($sql) ) {
		echo $db->error;
		die;
	}

	// Set a message to show on next page view stating that the action was successful
	$_SESSION['message'] = '<div class="alert alert-success"><a href="sizes.php?action=show&product_id=' . $product['id'] . '&id=' . $_POST['id'] . '">' . $_POST['name'] . '</a> was updated successfully.</div>';

	// redirect to the index page
	header('Location: sizes.php?product_id=' . $product['id']);
	die;
}
// delete a size record
elseif ( $action == 'delete' ) {
	// if the id param is missing, redirect to the index page
	if ( !isset($_GET['id']) || !$_GET['id'] ) {
		header('Location: sizes.php?product_id=' . $product['id']);
		die;
	}

	// delete the page record from the database
	$sql = 'DELETE FROM sizes WHERE id = ' . qstr($_GET['id']);

	// kill the script if the query fails
	if ( !$db->query($sql) ) {
		echo $db->error;
		die;
	}

	// Set a message to show on next page view stating that the action was successful
	$_SESSION['message'] = '<div class="alert alert-success">Size was deleted successfully.</div>';

	// redirect to the index page
	header('Location: sizes.php?product_id=' . $product['id']);
	exit;
}
// show details for a size
elseif ( $action == 'show' ) {
	// if the id param is missing, redirect to the index page
	if ( !isset($_GET['id']) || !$_GET['id'] ) {
		header('Location: sizes.php?product_id=' . $product['id']);
		die;
	}

	// select a single size record from the database
	$sql = 'SELECT * FROM sizes WHERE id = ' . qstr($_GET['id']);
	$result = $db->query($sql);
	$size = $result->fetch_assoc();

	// print the show template
	print_template('admin/sizes/show', array(
		'size' => $size,
		'product' => $product,
		'page_title' => 'Size for ' . $product['name'] . ': ' . $size['name']
	), 'admin');
}
// sizes index
else {
	// select all sizes for the given product, ordered by weight
	$sql = 'SELECT * FROM sizes WHERE product_id = ' . qstr($product['id']) . ' ORDER BY weight';
	$result = $db->query($sql);

	// build an array of size records
	$sizes = array();

	while ( $row = $result->fetch_assoc() ) {
		$sizes[] = $row;
	}

	// print sizes index template
	print_template('admin/sizes/index', array(
		'sizes' => $sizes,
		'product' => $product,
		'page_title' => 'Sizes for ' . $product['name']
	), 'admin');
}