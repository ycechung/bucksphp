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
	echo 'create a size';
	pr($_POST);
}
// edit size form
elseif ( $action == 'edit' ) {
	echo 'show edit form';
}
// update a size record
elseif ( $action == 'update' ) {
	echo 'update a size';
}
// delete a size record
elseif ( $action == 'delete' ) {
	echo 'delete a size record';
}
// show details for a size
elseif ( $action == 'show' ) {
	echo 'show details for one size';
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