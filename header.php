<?php

// include the product list (or die trying)
require 'products.php';

// a prettier version of print_r()
function pr($array) {
	echo '<pre>';
	print_r($array);
	echo '</pre>';
}

// we want to escape all of our dynamic output with htmlentities() (to prevent HTML
// errors), but htmlentities() is a lot to type. here we create a shorter version 
// called  "h" to make life easier
function h($str){
	return htmlentities($str);
}

function product_image_tag($product, $class='') {
	if ( $product['image'] ) {
		return '<img src="' . h($product['image']) . '" alt="Photo of ' . h($product['name']) . '" class="' . $class . '">';
	}
	else {
		return '<img src="http://placehold.it/200x200&text=' . h($product['name']) . '" alt="Photo Missing" class="' . $class . '">';
	}
}

function tab_class($tab) {
	if ( basename($_SERVER['PHP_SELF'], '.php') == $tab ) {
		return 'active';
	}
	else {
		return '';
	}
}

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
			});
		</script>
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top">
		  <div class="navbar-inner">
		    <a class="brand" href="index.php">Dolphinitively Tees</a>
		    <ul class="nav">
		      <li class="<?= tab_class('index') ?>"><a href="index.php">Home</a></li>
		      <li class="<?= tab_class('contact') ?>"><a href="contact.php">Contact</a></li>
		      <li class="<?= tab_class('about') ?>"><a href="about.php">About Us</a></li>
		    </ul>
		  </div>
		</div>
		<div class="container">