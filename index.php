<?php

// include header HTML and functions
require 'header.php';

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

print_template('index', array(
	'products' => $products
));
