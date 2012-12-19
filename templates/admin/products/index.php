
<div class="page-header">
	<a href="products.php?action=new" class="btn btn-primary pull-right">New Product</a>
	<h1><?= h($page_title) ?></h1>
</div>

<?php if ( isset($_SESSION['message']) ): ?>
	<?= $_SESSION['message'] ?>
	<?php unset($_SESSION['message']); ?>
<?php endif; ?>

<?php if ( $products ): ?>
	<table id="products-table" class="table table-striped table-bordered">
		<thead>
			<tr>
				<th></th>
				<th>Name</th>
				<th>Price</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ( $products as $product ): ?>
				<tr>
					<td><?= product_image_tag($product, 'thumbnail'); ?></td>
					<td><a href="products.php?id=<?= $product['id'] ?>&amp;action=show"><?= h($product['name']) ?></a></td>
					<td><?= number_format($product['price'], 2) ?></td>
					<td>
						<a class="btn btn-small" href="products.php?action=edit&amp;id=<?= $product['id'] ?>">Edit</a>
						<a class="btn btn-small btn-danger" href="products.php?action=delete&amp;id=<?= $product['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php else: // no products ?>
	<p>No products found!</p>
<?php endif; ?>
