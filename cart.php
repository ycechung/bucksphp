<?php

// include header HTML and functions
require 'header.php';

if ( !isset($_SESSION['cart']) ) {
	$_SESSION['cart'] = array();
}

function add_to_cart($product_id, $size, $qty=1) {
	global $products;

	if ( $qty < 1 ) {
		return false;
	}

	$product = $products[$product_id];
	$unique_id = $product_id . $size;

	if ( !isset($_SESSION['cart'][$unique_id]) ) {
		$size_price = $product['sizes'][$size];

		$_SESSION['cart'][$unique_id] = array(
			'product_id' => $product_id,
			'product' => $product,
			'size' => $size,
			'price' => $product['price'] + $size_price,
			'quantity' => $qty
		);
	}
	else {
		$_SESSION['cart'][$unique_id]['quantity'] += $qty;
	}
}

if ( isset($_GET['action']) ) {
	$action = $_GET['action'];
}
else {
	$action = null;
}

if ( $action == 'add' ) {
	// add the product to our cart
	$product_id = $_POST['id'];
	$size = $_POST['size'];

	add_to_cart($product_id, $size);

	header('Location: cart.php');
	exit;
}
elseif ( $action == 'update' ) {
	$_SESSION['cart'] = array();

	foreach ( $_POST['quantities'] as $product_id => $sizes ) {
		foreach ( $sizes as $size => $qty ) {
			add_to_cart($product_id, $size, $qty);
		}
	}

	header('Location: cart.php');
	exit;
}
elseif ( $action == 'empty' ) {
	$_SESSION['cart'] = array();
	header('Location: cart.php');
	exit;
}
elseif ( $action == 'remove' ) {
	$unique_id = $_GET['id'] . $_GET['size'];
	unset($_SESSION['cart'][$unique_id]);
	header('Location: cart.php');
	exit;
}
elseif ( $action == 'thank' ) {
	$_SESSION['cart'] = array();
}

$cart_total = 0;

foreach ( $_SESSION['cart'] as $item ) {
	$subtotal = $item['quantity'] * $item['price'];
	$cart_total += $subtotal;
}


?>

<div class="page-header">
	<h1>Shopping Cart</h1>
</div>

<?php if ( $_SESSION['cart'] ): ?>

	<form action="cart.php?action=update" method="post">
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
				<?php foreach ( $_SESSION['cart'] as $item ): ?>
					<tr>
						<td>
							<a href="detail.php?id=<?= $item['product_id'] ?>">
								<?= h($item['product']['name']) ?>
								(<?= h($item['size']) ?>)
							</a>
							<a href="cart.php?action=remove&amp;id=<?= $item['product_id'] ?>&amp;size=<?= $item['size'] ?>" style="color:red"><small>remove</small></a>
						</td>
						<td>
							<?= number_format($item['price'], 2) ?>
						</td>
						<td>
							<input name="quantities[<?= $item['product_id'] ?>][<?= $item['size'] ?>]" type="text" class="input-small" value="<?= $item['quantity'] ?>">
						</td>
						<td>
							<?= number_format($item['quantity'] * $item['price'], 2) ?>
						</td>
					</tr>
				<?php endforeach ; ?>
				<tr>
					<td colspan="3">
						Total
					</td>
					<td>$<?= number_format($cart_total, 2) ?></td>
				</tr>
			</tbody>
		</table>
		<p>
			<button class="btn">Update Cart</button>
			<a href="cart.php?action=empty" class="btn btn-danger">Empty Cart</a>
		</p>
	</form>

	<form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post" class="pull-right">
		<input type="hidden" name="cmd" value="_cart">
		<input type="hidden" name="upload" value="1">
		<input type="hidden" name="business" value="bucksphp@gmail.com">
		<input type="hidden" name="currency_code" value="USD">

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

<?php elseif ( $action == 'thank' ): ?>
	<p>Thanks for your order!</p>

<?php else: ?>
	<p class="none">No products in your cart :(</p>
<?php endif; ?>
