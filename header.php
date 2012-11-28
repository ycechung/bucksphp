<?php

// include the product list (or die trying)
require 'products.php';

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

// Start up session handling
session_start();

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
		      <li class="<?= tab_class('index') ?>"><a href="index.php">Home</a></li>
		      <li class="<?= tab_class('contact') ?>"><a href="contact.php">Contact</a></li>
		      <li class="<?= tab_class('about') ?>"><a href="about.php">About Us</a></li>
  		      <li class="<?= tab_class('cart') ?>"><a href="cart.php">Shopping Cart</a></li>
		    </ul>
		  </div>
		</div>
		<div class="container">