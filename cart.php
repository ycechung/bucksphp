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

?>

<div class="page-header">
	<h1>Shopping Cart</h1>
</div>

<?php // Shipping cart items are present... ?>
<?php if ( $_SESSION['cart'] ): ?>

	<?php // The update cart form ?>
	<form action="cart.php?action=update" method="post">
		<?php // The view cart table ?>
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Product</th>
					<th>Price</th>
					<th>Qty</th>
					<th>Subtotal</th>
				</tr>
			</thead>
			<tbody>

				<?php // Print a row for each item in the cart ?>
				<?php foreach ( $_SESSION['cart'] as $item ): ?>
					<tr>
						<td>
							<?php // Print the product name and size in a link to the detail page ?>
							<a href="detail.php?id=<?= $item['product_id'] ?>">
								<?= h($item['product']['name']) ?>
								(<?= h($item['size']) ?>)
							</a>
							<?php // Print a link to remove this item from the cart?>
							<a href="cart.php?action=remove&amp;id=<?= h($item['product_id']) ?>&amp;size=<?= h($item['size']) ?>" style="color:red"><small>remove</small></a>
						</td>
						<td>
							<?= number_format($item['price'], 2) ?>
						</td>
						<td>
							<?php // Print a text input that can be used to update this item's quantity ?>
							<input name="quantities[<?= h($item['product_id']) ?>][<?= h($item['size']) ?>]" type="text" class="input-small" value="<?= h($item['quantity']) ?>">
						</td>
						<td>
							<?php // Print the subtotal for this item (quantity * (product base price + size price difference)) ?>
							<?= number_format($item['quantity'] * $item['price'], 2) ?>
						</td>
					</tr>
				<?php endforeach ; ?>

				<?php // Add a row for the total cart price ?>
				<tr>
					<td colspan="3">
						Total
					</td>
					<td>$<?= number_format(cart_total(), 2) ?></td>
				</tr>
			</tbody>
		</table>
		<p>
			<?php // Print a link (styled as a red button) to empty the cart ?>
			<a href="cart.php?action=empty" class="btn btn-danger">Empty Cart</a>

			<?php // Print a button to submit the update cart form ?>
			<button class="btn">Update Cart</button>
		</p>
	</form>

	<?php // The Paypal upload cart form (see https://www.paypal.com/cgi-bin/webscr?cmd=p/pdn/howto_checkout-outside) ?>
	<form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post" class="pull-right">
		<input type="hidden" name="cmd" value="_cart">
		<input type="hidden" name="upload" value="1">
		<input type="hidden" name="business" value="bucksphp@gmail.com">
		<input type="hidden" name="currency_code" value="USD">

		<?php // add a set of inputs for each line item in the item_name_x format ?>
		<?php foreach ( array_values($_SESSION['cart']) as $i => $item ): ?>
			<input type="hidden" name="item_name_<?= $i+1 ?>" value="<?= h($item['product']['name']) ?>">
			<input type="hidden" name="on0_<?= $i+1 ?>" value="Size">
			<input type="hidden" name="os0_<?= $i+1 ?>" value="<?= h($item['size']) ?>">
			<input type="hidden" name="amount_<?= $i+1 ?>" value="<?= h($item['price']) ?>">
			<input type="hidden" name="quantity_<?= $i+1 ?>" value="<?= h($item['quantity']) ?>">
		<?php endforeach; ?>

		<p>
			<button type="submit" class="btn btn-primary">Checkout</button>
		</p>
	</form>

<?php // Print the thank you message (this is cart.php?action=thank) ?>
<?php elseif ( $action == 'thank' ): ?>
	<p>Thanks for your order!</p>

<?php // This is the view cart page, but no items are available to show. Print an empty cart message. ?>
<?php else: ?>
	<p class="none">No products in your cart :(</p>
<?php endif; ?>

<?php require 'footer.php'; // include footer HTML ?>
