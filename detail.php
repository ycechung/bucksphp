<?php

// include header HTML and functions
require 'header.php';

// if ?id parameter isn't set or a product with the index of the id paramter doesn't
// exist, redirect to the index page
if ( !isset($_GET['id']) || !isset($products[$_GET['id']]) ) {
	// always call exit() after using the Location header, as the script will continue
	// to execute even after the user has been redirected
	// (also note that exit() is one of the weird php functions that doesn't require
	// parenthesis)
	header("Location: index.php");
	exit;
}

// select the item from the products array with the index corresponding to the given id
$product = $products[$_GET['id']];

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

<?php // The Paypal "buy now" form ?>
<form class="buy" name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post">
	<input type="hidden" name="cmd" value="_xclick">
	<input type="hidden" name="business" value="bucksphp@gmail.com">
	<input type="hidden" name="currency_code" value="USD">
	<input type="hidden" name="item_name" value="<?= h($product['name']) ?>">
	<input type="hidden" name="on0" value="Size">

	<?php // Add a data attribute named "base-price" to the amount input, so we can calculate the price difference ?>
	<input type="hidden" id="paypal_amount" data-base-price="<?= h($product['price']) ?>" name="amount" value="<?= h($product['price']) ?>">

	<?php // Print a select field with all available sizes ?>
	<select class="size" name="os0">
		<option value="">Select a size...</option>

		<?php // Loop through each product size ?>
		<?php foreach ( $product['sizes'] as $size => $price_difference ): ?>
			<?php // Add a data attribute called "price-difference" to the option, so we can add it to the base price and get the total amount ?>
			<option value="<?= h($size) ?>" data-price-difference="<?= h($price_difference) ?>">
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
		<button type="submit" class="btn btn-primary">Buy</button>
	</p>
</form>

<?php require 'footer.php'; // include footer HTML ?>