
<div class="page-header">
  <a href="sizes.php?action=edit&amp;product_id=<?= h($product['id']) ?>&amp;size=<?= h($size['id']) ?>" class="btn btn-primary pull-right">Edit Size</a>
  <a href="products.php?action=delete&amp;product_id=<?= h($product['id']) ?>&amp;size=<?= h($size['id']) ?>" class="btn btn-danger pull-right" onclick="return confirm('Are you sure?')">Delete Size</a>
  <h1><?= h($size['name']) ?></h1>
</div>

<p><b>Price Difference:</b> <?= number_format($size['price_difference'], 2) ?></p>
<p><b>Weight:</b> <?= h($size['weight'] ) ?></p>