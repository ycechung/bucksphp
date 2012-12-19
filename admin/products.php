<?php

require '../header.php';

function qstr($str) {
	global $db;

	if ( is_null($str) ) {
		return 'NULL';
	}
	else {
		return '"' . $db->real_escape_string($str) . '"';
	}
}

$action = isset($_GET['action']) ? $_GET['action'] : null;

// Create
if ( $action == 'new' ) {
	print_template('admin/products/new', array(
		'page_title' => 'New Product'
	), 'admin');
}
// Create
elseif ( $action == 'create' ) {
	$reqs = array('name', 'price');

	foreach ( $reqs as $req ) {
		if ( !isset($_POST[$req]) || trim($_POST[$req]) == '' ) {
			$error = "Missing required field: " . $req;
			break;
		}
	}

	if ( isset($error) ) {
		print_template('admin/products/new', array(
			'page_title' => 'New Product',
			'error' => $error,
		), 'admin');
		die();
	}

	$safe = array();

	foreach ( $_POST as $key => $val ) {
		$safe[$key] = qstr(trim($val));
	}

	$sql = 'INSERT INTO products (name, price, description, image) VALUES (' . $safe['name'] . ', ' . $safe['price'] . ', ' . $safe['description'] . ', '. $safe['image'] . ')';

	if ( !$db->query($sql) ) {
		echo $db->error;
		die;
	}

	$product_id = $db->insert_id;

	$_SESSION['message'] = '<div class="alert alert-success"><a href="products.php?action=show&id=' . $product_id . '">' . $_POST['name'] . '</a> was added successfully.</div>';

	header('Location: products.php');
	exit;
}
// Update
elseif ( $action == 'edit' ) {
	if ( !isset($_GET['id']) || !$product = get_product($_GET['id']) ) {
		header('Location: products.php');
		die;
	}

	print_template('admin/products/edit', array(
		'page_title' => 'Edit Product: ' . $product['name'],
		'product' => $product,
	), 'admin');
}
// Update
elseif ( $action == 'update' ) {
	if ( !isset($_POST['id']) || !$product = get_product($_POST['id']) ) {
		header('Location: products.php');
		die;
	}

	$reqs = array('name', 'price');

	foreach ( $reqs as $req ) {
		if ( !isset($_POST[$req]) || trim($_POST[$req]) == '' ) {
			$error = "Missing required field: " . $req;
			break;
		}
	}

	if ( isset($error) ) {
		print_template('admin/products/edit', array(
			'page_title' => 'New Product',
			'error' => $error,
			'product' => $_POST,
		), 'admin');
		die();
	}

	$safe = array();

	foreach ( $_POST as $key => $val ) {
		$safe[$key] = qstr(trim($val));
	}

	$sql = 'UPDATE products SET name = ' . $safe['name'] . ', description = ' . $safe['description'] . ', image = ' . $safe['image'] . ', price = ' . $safe['price'] . ' WHERE id = ' . $product['id'];

	if ( !$db->query($sql) ) {
		echo $db->error;
		die;
	}

	$_SESSION['message'] = '<div class="alert alert-success"><a href="products.php?action=show&id=' . $product['id'] . '">' . $_POST['name'] . '</a> was updated successfully.</div>';

	header('Location: products.php');
	exit;
}
// Delete
elseif ( $action == 'delete' ) {
	if ( !isset($_GET['id']) || !$product = get_product($_GET['id']) ) {
		header('Location: products.php');
		die;
	}

	$sql = 'DELETE FROM products WHERE id = ' . qstr($_GET['id']);

	if ( !$db->query($sql) ) {
		echo $db->error;
		die;
	}

	$sql = 'DELETE FROM sizes WHERE product_id = ' . qstr($_GET['id']);

	if ( !$db->query($sql) ) {
		echo $db->error;
		die;
	}

	$_SESSION['message'] = '<div class="alert alert-success">' . $product['name'] . '</a> was deleted successfully.</div>';

	header('Location: products.php');
	exit;
}
// Read
elseif ( $action == 'show' ) {
	if ( !isset($_GET['id']) || !$product = get_product($_GET['id']) ) {
		header('Location: products.php');
		die;
	}

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

	print_template('admin/products/index', array(
		'products' => $products,
		'page_title' => 'Products'
	), 'admin');
}