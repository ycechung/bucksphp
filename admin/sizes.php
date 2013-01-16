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

if ( $action == 'new' ) {
	print_template('admin/sizes/new', array(
		'page_title' => 'New Size for ' . $product['name'],
		'product' => $product
	), 'admin');
}
elseif ( $action == 'create' ) {
	echo 'create a size';
	pr($_POST);
}
elseif ( $action == 'edit' ) {
	echo 'show edit form';
}
elseif ( $action == 'update' ) {
	echo 'update a size';
}
elseif ( $action == 'delete' ) {
	echo 'delete a size record';
}
elseif ( $action == 'show' ) {
	echo 'show details for one size';
}
else { // sizes index
	$sql = 'SELECT * FROM sizes WHERE product_id = ' . qstr($product['id']) . ' ORDER BY weight';
	$result = $db->query($sql);

	$sizes = array();

	while ( $row = $result->fetch_assoc() ) {
		$sizes[] = $row;
	}

	print_template('admin/sizes/index', array(
		'sizes' => $sizes,
		'product' => $product,
		'page_title' => 'Sizes for product: ' . $product['name']
	), 'admin');
}