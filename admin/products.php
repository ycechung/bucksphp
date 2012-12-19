<?php

// Product CRUD actions

// include the global header file
require '../header.php';

// set an action based on the ?action param
$action = isset($_GET['action']) ? $_GET['action'] : null;

// Create
// ?action=new: Print new product form
if ( $action == 'new' ) {
	print_template('admin/products/new', array(
		'page_title' => 'New Product'
	), 'admin');
}
// Create
// ?action=create: Insert a product into the database
elseif ( $action == 'create' ) {
	// set an error if required fields are missing
	$reqs = array('name', 'price');

	foreach ( $reqs as $req ) {
		if ( !isset($_POST[$req]) || trim($_POST[$req]) == '' ) {
			$error = "Missing required field: " . $req;
			break;
		}
	}

	// if an error is set, print the new product form with the error message
	if ( isset($error) ) {
		print_template('admin/products/new', array(
			'page_title' => 'New Product',
			'error' => $error,
		), 'admin');
		die;
	}

	// sanitize all POST input
	$safe = array();

	foreach ( $_POST as $key => $val ) {
		$safe[$key] = qstr(trim($val));
	}

	// insert the new product into the database
	$sql = 'INSERT INTO products (name, price, description, image) VALUES (' . $safe['name'] . ', ' . $safe['price'] . ', ' . $safe['description'] . ', '. $safe['image'] . ')';

	// kill the script if the query fails
	if ( !$db->query($sql) ) {
		echo $db->error;
		die;
	}

	// Set a message to show on next page view stating that the action was successful
	$product_id = $db->insert_id;

	$_SESSION['message'] = '<div class="alert alert-success"><a href="products.php?action=show&id=' . $product_id . '">' . $_POST['name'] . '</a> was added successfully.</div>';

	// Redirect to the index page
	header('Location: products.php');
	exit;
}
// Update
// ?action=edit: Show the edit product form
elseif ( $action == 'edit' ) {
	// if the id param is missing or the product doesn't exist, redirect to the index page
	if ( !isset($_GET['id']) || !$product = get_product($_GET['id']) ) {
		header('Location: products.php');
		die;
	}

	// print the edit product template
	print_template('admin/products/edit', array(
		'page_title' => 'Edit Product: ' . $product['name'],
		'product' => $product,
	), 'admin');
}
// Update
// ?action=update: Update a product in the database
elseif ( $action == 'update' ) {
	// if the id param is missing or the product doesn't exist, redirect to the index page
	if ( !isset($_POST['id']) || !$product = get_product($_POST['id']) ) {
		header('Location: products.php');
		die;
	}

	// set an error if required fields are missing
	$reqs = array('name', 'price');

	foreach ( $reqs as $req ) {
		if ( !isset($_POST[$req]) || trim($_POST[$req]) == '' ) {
			$error = "Missing required field: " . $req;
			break;
		}
	}

	// if an error is set, print the new product form with the error message
	if ( isset($error) ) {
		print_template('admin/products/edit', array(
			'page_title' => 'New Product',
			'error' => $error,
			'product' => $_POST,
		), 'admin');
		die;
	}

	// sanitize all POST input
	$safe = array();

	foreach ( $_POST as $key => $val ) {
		$safe[$key] = qstr(trim($val));
	}

	// Update the product record
	$sql = 'UPDATE products SET name = ' . $safe['name'] . ', description = ' . $safe['description'] . ', image = ' . $safe['image'] . ', price = ' . $safe['price'] . ' WHERE id = ' . $product['id'];

	// kill the script if the query fails
	if ( !$db->query($sql) ) {
		echo $db->error;
		die;
	}

	// Set a message to show on next page view stating that the action was successful
	$_SESSION['message'] = '<div class="alert alert-success"><a href="products.php?action=show&id=' . $product['id'] . '">' . $_POST['name'] . '</a> was updated successfully.</div>';

	// redirect to the index page
	header('Location: products.php');
	exit;
}
// Delete
// ?action=delete
elseif ( $action == 'delete' ) {
	// if the id param is missing or the product doesn't exist, redirect to the index page
	if ( !isset($_GET['id']) || !$product = get_product($_GET['id']) ) {
		header('Location: products.php');
		die;
	}

	// delete the product record from the database
	$sql = 'DELETE FROM products WHERE id = ' . qstr($_GET['id']);

	// kill the script if the query fails
	if ( !$db->query($sql) ) {
		echo $db->error;
		die;
	}

	// delete the size records associated with this product from the database
	$sql = 'DELETE FROM sizes WHERE product_id = ' . qstr($_GET['id']);

	// kill the script if the query fails
	if ( !$db->query($sql) ) {
		echo $db->error;
		die;
	}

	// Set a message to show on next page view stating that the action was successful
	$_SESSION['message'] = '<div class="alert alert-success">' . $product['name'] . '</a> was deleted successfully.</div>';

	// redirect to the index page
	header('Location: products.php');
	exit;
}
// Read
elseif ( $action == 'show' ) {
	// if the id param is missing or the product doesn't exist, redirect to the index page
	if ( !isset($_GET['id']) || !$product = get_product($_GET['id']) ) {
		header('Location: products.php');
		die;
	}

	// print the show product template
	print_template('admin/products/show', array(
		'product' => $product,
		'page_title' => $product['name'])
	, 'admin');
}
// Read
else {
	// select all products sorted by name
	$sql = "SELECT * FROM products ORDER BY name";
	$result = $db->query($sql);

	// create an array to hold the products
	$products = array();

	// store each product record in an associative array called $row
	while ( $row = $result->fetch_assoc() ) {
		// add the $row to the products array
		$products[] = $row;
	}

	// print the product index page
	print_template('admin/products/index', array(
		'products' => $products,
		'page_title' => 'Products'
	), 'admin');
}