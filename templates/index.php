
<div class="page-header">
	<h1>All Products</h1>
	<p>Lorem ipsum adipisicing sint consequat do veniam ea. Lorem ipsum dolore sit eu dolore ut est eiusmod. Lorem ipsum adipisicing sint consequat do veniam ea. Lorem ipsum dolore sit eu dolore ut est eiusmod.</p>
</div>

<ul class="thumbnails">
	<?php // Loop through each product, print its thumbnail image, and link to the related detail page ?>
	<?php foreach ( $products as $product ): ?>
		<li class="span3">
			<a class="thumbnail" href="detail.php?id=<?= $product['id'] ?>">
				<?php // Print the image tag for this product ?>
				<?= product_image_tag($product); ?>
			</a>
		</li>
	<?php endforeach; ?>
</ul>