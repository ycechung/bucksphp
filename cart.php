<?php

// include header HTML and functions
require 'header.php';

//
// this bit saves us from having to check if $_GET['action'] is set every
// time we want to use it...
//
// if an ?action is set in the URL, set $action to its value
if ( isset($_GET['action']) ) {
	$action = $_GET['action'];
}
// otherwise set action to null
else {
	$action = null;
}

//
// Add to cart (cart.php?action=add)
//
if ( $action == 'add' ) {
	// if either of these variables are missing, set them to null to avoid a PHP warning
	$product_id = isset($_POST['id']) ? $_POST['id'] : null;
	$size = isset($_POST['size']) ? $_POST['size'] : null;

	// add the posted product id and size to the cart
	add_to_cart($product_id, $size);

	// redirect to the view cart page
	header('Location: cart.php');
	exit;
}
//
// Update cart (cart.php?action=update)
//
elseif ( $action == 'update' ) {
	// reset the cart variable to an empty array
	$_SESSION['cart'] = array();

	// the input from the update cart form will look like this:
	//
	// Array
	// (
	//     [quantities] => Array
	//         (
	//             [0] => Array
	//                 (
	//                     [Large] => 1
	//                 )
	//             [1] => Array
	//                 (
	//                     [Medium] => 2
	//                     [XL] => 1
	//                 )
	//         )
	// )

	// loop through the POSTed input and re-add each item to the cart
	foreach ( $_POST['quantities'] as $product_id => $sizes ) {
		foreach ( $sizes as $size => $qty ) {
			add_to_cart($product_id, $size, $qty);
		}
	}

	// redirect to the view cart page
	header('Location: cart.php');
	exit;
}
//
// Empty cart (cart.php?action=empty)
//
elseif ( $action == 'empty' ) {
	// reset the cart variable to an empty array
	$_SESSION['cart'] = array();

	// redirect to the view cart page
	header('Location: cart.php');
	exit
	;
}
//
// Remove an item from the cart (cart.php?action=remove&id=$id&size=$size)
//
elseif ( $action == 'remove' ) {
	// build the unique line item identifier from the product id and size
	$unique_id = $_GET['id'] . $_GET['size'];
	// remove that line item from the cart array
	unset($_SESSION['cart'][$unique_id]);

	// redirect to the view cart page
	header('Location: cart.php');
	exit;
}
//
// Thanks for buying message shown on return from Paypal (cart.php?action=thank)
//
elseif ( $action == 'thank' ) {
	// reset the cart variable to an empty array
	$_SESSION['cart'] = array();
}

// If we're still here, print the view cart (or thanks) page:
print_template('view_cart', array(
	'action' => $action
));

?>
