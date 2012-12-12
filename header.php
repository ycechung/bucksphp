<?php

// environment-specific and sensitive information goes here
require 'config.php';

// connect to the mysql server
$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// if the connection fails, an error message will be set
// check for that error message and kill the script if it exists
if ( $db->connect_errno ) {
	die("Failed to connect to database: " . $db->connect_error);
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
	if ( basename($_SERVER['PHP_SELF'], '.php') == $tab ) {
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

	// select the relevant product from the global products array
	$product = get_product($product_id);

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
 * @var int
 **/
function cart_item_count() {
	$item_count = 0;

	foreach ( $_SESSION['cart'] as $item ) {
		$item_count += $item['quantity'];
	}

	return $item_count;
}

function get_product($id) {
	global $db;

	$sql = 'SELECT * FROM products WHERE id = "' . $db->real_escape_string($id) . '"';
	$result = $db->query($sql);

	if ( $result->num_rows > 0 ) {
		$product = $result->fetch_assoc();
		$product['sizes'] = array();

		$sql = 'SELECT * FROM sizes WHERE product_id = "' . $db->real_escape_string($id) . '" ORDER BY weight';
		$result = $db->query($sql);

		while ( $size = $result->fetch_assoc() ) {
			$product['sizes'][$size['name']] = $size['price_difference'];
		}

		return $product;
	}
	else {
		return false;
	}
}

// Now print the opening HTML...

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Dolphinitively Tees - The Finest in Marine Mammal Apparel</title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8">

		<?php // Include the Twitter Bootstrap CSS framework ?>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">

		<?php // Include our own CSS ?>
		<link rel="stylesheet" type="text/css" href="css/style.css">

		<?php // Include the jQuery Javascript framework ?>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

		<?php // A bit of Javascript to add some UI niceties. We can treat this as a black box for now ?>
		<script type="text/javascript">
			$(function(){
				// validate that a size has been selected
				$('form.buy').submit(function(e){
					if ( $(this).find('select.size').val() == '' ) {
						alert("Please select a size!");
						return false;
					}
				});

				// update the product price when the size selector is changed
				$('form.buy select.size').change(function(e){
					var $input = $('#paypal_amount');
					var diff = $(this).find('option:selected').data('price-difference');
					var base_price = $input.data('base-price');
					var total = diff + base_price;
					$input.val(total);
				});
			});
		</script>
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top">
		  <div class="navbar-inner">
		    <a class="brand" href="index.php">Dolphinitively Tees</a>
		    <ul class="nav">
		    	<?php // Give the current tab the class "active", so we can highlight it with CSS ?>
		      <li class="index <?= tab_class('index') ?>"><a href="index.php">Home</a></li>
		      <li class="contact <?= tab_class('contact') ?>"><a href="contact.php">Contact</a></li>
		      <li class="about <?= tab_class('about') ?>"><a href="about.php">About Us</a></li>
		      <li class="cart <?= tab_class('cart') ?>">
		      	<a href="cart.php">
		      		Shopping Cart
		      		<?php // If there are items in the shopping cart, print the total quantity with the shopping cart link ?>
		      		<?php if ( cart_item_count() > 0 ): ?>
		      			<sup><?= number_format(cart_item_count()) ?></sup>
		      		<?php endif; ?>
		      	</a>
		     </li>
		     <?php // Only show the logout link if a user is logged in ?>
		     <?php if ( isset($_SESSION['user']) ): ?>
		     	<li class="logout pull-right"><a href="logout.php">Log out</a></li>
		     <?php endif; ?>
		    </ul>
		  </div>
		</div>
		<div class="container">