<?php

require 'header.php';

if ( !isset($_GET['id']) || !isset($products[$_GET['id']]) ) {
	header("Location: index.php");
	exit;
}

$product = $products[$_GET['id']];

?>

<div class="page-header">
	<h1><?= h($product['name']) ?></h1>
</div>

<ul class="breadcrumb">
  <li><a href="index.php">All Products</a> <span class="divider">/</span></li>
  <li class="active"><?= h($product['name']) ?></li>
</ul>

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
	<input type="hidden" id="paypal_amount" name="amount" value="<?= h($product['price']) ?>">
	<input type="hidden" name="on0" value="Size">
	<input type="hidden" id="base_price" value="<?= h($product['price']) ?>">
	

	<?php // Print a select field with all available sizes ?>
	<select class="size" name="os0">
		<option value="">Select a size...</option>
		<?php foreach ( $product['sizes'] as $size => $price_difference ): ?>
			<option value="<?= h($size) ?>" data-price-difference="<?= $price_difference ?>">
				<?= h($size) ?>
				<?php if ( $price_difference ): ?>
					($<?= number_format($price_difference, 2) ?>)
				<?php endif; ?>
			</option>
		<?php endforeach; ?>
	</select>

	<p>
		<button type="submit" class="btn btn-primary">Buy</button>
	</p>
</form>

<?php require 'footer.php'; ?>