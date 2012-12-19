<?php

// include header HTML and functions
require 'header.php';

// if ?id parameter isn't set or a product with the given id paramter doesn't exist, redirect to the index page
if ( !isset($_GET['id']) || !$product = get_product($_GET['id']) ) {
	// always call exit() after using the Location header, as the script will continue
	// to execute even after the user has been redirected
	// (also note that exit() is one of the weird php functions that doesn't require parenthesis)
	header("Location: index.php");
	exit;
}

print_template('detail', array(
	'product' => $product
));