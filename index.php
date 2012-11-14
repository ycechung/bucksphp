
<?php require 'header.php'; ?>

<div class="page-header">
	<h1>All Products</h1>
	<p>Lorem ipsum adipisicing sint consequat do veniam ea. Lorem ipsum dolore sit eu dolore ut est eiusmod. Lorem ipsum adipisicing sint consequat do veniam ea. Lorem ipsum dolore sit eu dolore ut est eiusmod.</p>
</div>
<ul class="thumbnails">
	<?php // Loop through each product ?>
	<?php foreach ( $products as $id => $product ): ?>
		<li class="span3">
			<a class="thumbnail" href="detail.php?id=<?= $id ?>">
				<?= product_image_tag($product); ?>
			</a>
		</li>
	<?php endforeach; ?>
</ul>

<?php require 'footer.php'; ?>