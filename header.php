<?php

define("INCLUDES_DIR", realpath(dirname(__FILE__)) . '/includes/');

// environment-specific and sensitive information goes here
require realpath(dirname(__FILE__)) . '/config.php';

// include database wrapper
require INCLUDES_DIR . 'DB.php';

// connect to the mysql server
try {
	$db = new DB(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
}
catch ( Exception $ex ) {
	error_log("Database connection failed: " . $ex->getMessage());
	die("Everything went wrong! Sorry :(");
}

// Start up session handling
session_start();

// if the session variable "cart" doesn't exist, set it to an empty array
if ( !isset($_SESSION['cart']) ) {
	$_SESSION['cart'] = array();
}

/**
 *  A prettier version of print_r()
 *
 * @param array $array
 **/
function pr($array) {
	echo '<pre>';
	print_r($array);
	echo '</pre>';
}

/**
 * We want to escape all of our dynamic output with htmlentities() (to prevent HTML
 * errors), but htmlentities() is a lot to type. here we create a shorter version
 * called  "h" to make life easier
 *
 * @param string $str
 * @return string
 **/
function h($str){
	return htmlentities($str);
}

/**
 * If a product has an image URL, print an image tag for it. Otherwise, print a generic image tag.
 *
 * @param array $product - An indivual product array
 * @param string $class - (Optional) A CSS class for the image tag
 * @return string
 **/
function product_image_tag($product, $class='') {
	if ( $product['image'] ) {
		return '<img src="' . h($product['image']) . '" alt="Photo of ' . h($product['name']) . '" class="' . $class . '">';
	}
	else {
		return '<img src="http://placehold.it/200x200&text=' . h($product['name']) . '" alt="Photo Missing" class="' . $class . '">';
	}
}

/**
 * Returns "active" if the given tab matches the current page. Otherwise, returns an empty string.
 *
 * @param string $tab
 * @return string
 **/
function tab_class($tab) {
	if ( basename($_SERVER['PHP_SELF'], '.php') == $tab || strstr($_SERVER["REQUEST_URI"], $tab) ) {
		return 'active';
	}
	else {
		return '';
	}
}

/**
 * Removes all potential spam headers from a string
 *
 * @param string $str
 * @return string
 **/
function sanitize_mail_headers($str) {
  $badness = array("\r", "\n", "%0a", "%0d", "Content-Type", "bcc:", "to:", "cc:");

  return str_ireplace($badness, '', $str);
}

/**
 * Add a product to the user's shopping cart
 *
 * @param int $product_id - The product's index in the global $products array
 * @param string $size - The size of the product being added
 * @param int $qty - The quantity to add. Defaults to 1
 * @return boolean
 **/
function add_to_cart($product_id, $size, $qty=1) {
	// if any of the input parameters are invalid, return false to indicate failure
	if ( is_null($product_id) || is_null($size) || $qty < 1 ) {
		return false;
	}

	// fetch the relevant product from the database
	$product = get_product($product_id);

	// if the product doesn't exist, return false
	if ( !$product ) {
		return false;
	}

	// create a unique indifier for this product and size
	$unique_id = $product_id . $size;

	// if this unique item isn't in the cart yet...
	if ( !isset($_SESSION['cart'][$unique_id]) ) {
		// the price difference for this size
		$size_price = $product['sizes'][$size];

		// add a line item to the cart
		$_SESSION['cart'][$unique_id] = array(
			'product_id' => $product_id,
			'product' => $product,
			'size' => $size,
			// the price for this unique item (product base price + size price difference)
			'price' => $product['price'] + $size_price,
			'quantity' => $qty
		);
	}
	// the given product and size combo was already in the cart, so we just
	// need to update its quantity
	else {
		$_SESSION['cart'][$unique_id]['quantity'] += $qty;
	}

	// return true to indicate that the function worked
	return true;
}

/**
 * Calculate the total price of all items in the user's shopping cart
 *
 * @return float
 **/
function cart_total() {
	$cart_total = 0;

	foreach ( $_SESSION['cart'] as $item ) {
		$subtotal = $item['quantity'] * $item['price'];
		$cart_total += $subtotal;
	}

	return $cart_total;
}

/**
 * Return the total number of items in the user's shopping cart
 *
 * @return int
 **/
function cart_item_count() {
	$item_count = 0;

	foreach ( $_SESSION['cart'] as $item ) {
		$item_count += $item['quantity'];
	}

	return $item_count;
}

/**
 * Return a fully-formed product array for a given product ID
 *
 * @param int $id - The product record's ID
 * @return array
 **/
function get_product($id) {
	// we need to access the global $db variable
	global $db;

	// select the product row from the database, *making sure to escape the data with real_escape_string() before we send it to MySQL*
	$sql = 'SELECT * FROM products WHERE id = ' . $db->escape($id);

	if ( $product = $db->selectOne($sql) ) {
		// add an empty sizes array to the product
		$product['sizes'] = array();

		// select all sizes for this product, ordering them by their weight attribute
		$sql = 'SELECT * FROM sizes WHERE product_id = ' . $db->escape($id) . ' ORDER BY weight';

		$sizes = $db->selectAll($sql);

		// add each size to the product's sizes array in the format we expect (Small => 0.00, 2XL => 1.00, etc.)
		foreach ( $sizes as $size ) {
			$product['sizes'][$size['name']] = $size['price_difference'];
		}

		// return the product array
		return $product;
	}
	// no product found. return false
	else {
		return false;
	}
}

/**
 * Render a template file
 *
 * @param string $__template - The path to the template file (relative to the templates directory)
 * @param array $vars - (optional) An array of variables to pass into the template
 * @param string $__layout - (optional) The layout file to use (from templates/layouts). Defaults to "store".
 * @return void
 **/
function print_template($__template, $vars=array(), $__layout='store') {
	extract($vars);

	ob_start();
	require 'templates/' . $__template . '.php';
	$page_content = ob_get_contents();
	ob_end_clean();

	if ( $__layout ) {
		require 'templates/layouts/' . $__layout . '.php';
	}
	else {
		echo $page_content;
	}
}

/**
 * Quote and escape a string destined for the database
 *
 * @param string $str
 * @return string
 **/
function qstr($str) {
	// use the global MySQL connection
	global $db;

	return $db->escape($str);
}
