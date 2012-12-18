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

?>

<div class="page-header">
	<h1><?= h($product['name']) ?></h1>
</div>

<ul class="breadcrumb">
  <li><a href="index.php">All Products</a> <span class="divider">/</span></li>
  <li class="active"><?= h($product['name']) ?></li>
</ul>

<?php // print a product <img> tag with the CSS class "img-polaroid" (which will give it a border) ?>
<?= product_image_tag($product, 'img-polaroid'); ?>

<?php // format the price to 2 decimal points ?>
<h4>$<?= number_format($product['price'], 2) ?></h4>

<?php // Turn description line breaks into <br> tags ?>
<p><?= nl2br(h($product['description'])) ?></p>

<?php // The add to cart form ?>
<form class="buy" action="cart.php?action=add" method="post">
	<?php // Set the product id with a hidden input ?>
	<input type="hidden" value="<?= h($_GET['id']) ?>" name="id">

	<?php // Print a select field with all available sizes ?>
	<select class="size" name="size">
		<option value="">Select a size...</option>

		<?php // Loop through each product size ?>
		<?php foreach ( $product['sizes'] as $size => $price_difference ): ?>
			<option value="<?= h($size) ?>">
				<?= h($size) // print the size name ?>

				<?php // the price difference is positive, put a + in front of it ?>
				<?php if ( $price_difference > 0 ): ?>
					(+$<?= number_format($price_difference, 2) ?>)
				<?php // the price difference is negative, put a - in front of it and pass it through abs() to get its absolute value ?>
				<?php elseif ( $price_difference < 0 ): ?>
					(-$<?= number_format(abs($price_difference), 2) ?>)
				<?php endif; ?>

			</option>
		<?php endforeach; ?>
	</select>

	<p>
		<button class="btn btn-primary">Add to Cart</button>
	</p>
</form>

<?php require 'footer.php'; // include footer HTML ?>