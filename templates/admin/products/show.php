
<div class="page-header">
	<a href="products.php?action=edit&amp;id=<?= $product['id'] ?>" class="btn btn-primary pull-right">Edit Product</a>
	<a href="products.php?action=delete&amp;id=<?= $product['id'] ?>" class="btn btn-danger pull-right" onclick="return confirm('Are you sure?')">Delete Product</a>
	<h1><?= h($product['name']) ?></h1>
</div>

<div class="row">
	<div class="span4">
		<?= product_image_tag($product) ?>
	</div>
	<div class="span6">
		<p><b>Price:</b> <?= number_format($product['price'], 2) ?></p>

		<div class="description">
			<?= nl2br(h($product['description'])) ?>
		</div>
	</div>
</div>