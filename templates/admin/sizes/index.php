
<div class="page-header">
	<a href="sizes.php?action=new&amp;product_id=<?= h($product['id']) ?>" class="btn btn-primary pull-right">New Size</a>
	<h1><?= h($page_title) ?></h1>
</div>

<?php if ( isset($_SESSION['message']) ): ?>
	<?= $_SESSION['message'] ?>
	<?php unset($_SESSION['message']); ?>
<?php endif; ?>

<?php if ( $sizes ): ?>
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Name</th>
				<th>Price Diff.</th>
				<th>Weight</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ( $sizes as $size ): ?>
				<tr>
					<td><a href="sizes.php?id=<?= h($size['id']) ?>&amp;action=show&amp;product_id=<?= h($product['id']) ?>"><?= h($size['name']) ?></a></td>
					<td><?= number_format($size['price_difference'], 2) ?></td>
					<td><?= h($size['weight']) ?></td>
					<td>
						<a class="btn btn-small" href="sizes.php?action=edit&amp;id=<?= $size['id'] ?>&amp;product_id=<?= h($product['id']) ?>">Edit</a>
						<a class="btn btn-small btn-danger" href="sizes.php?action=delete&amp;id=<?= $size['id'] ?>&amp;product_id=<?= h($product['id']) ?>" onclick="return confirm('Are you sure?')">Delete</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php else: // no sizes ?>
	<p>No sizes found for this product!</p>
<?php endif; ?>
