<div class="page-header">
  <h1><?= h($page_title) ?></h1>
</div>

<?php // if an error is set, print it ?>
<?php if ( isset($error) ): ?>
  <div class="alert alert-error"><?= h($error) ?></div>
<?php endif; ?>

<form id="page-form" action="sizes.php?action=update&amp;product_id=<?= h($product['id']) ?>" class="form-horizontal" method="post">
  <input type="hidden" name="id" value="<?= h($size['id']) ?>">

  <div class="control-group">
    <label class="control-label" for="name">Name</label>
    <div class="controls">
      <input type="text" name="name" id="name" placeholder="Name" value="<?= h($size['name']) ?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="price_difference">Price Difference</label>
    <div class="controls">
      <input type="text" name="price_difference" id="price_difference" placeholder="Price Difference" value="<?= number_format($size['price_difference'], 2) ?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="weight">Weight</label>
    <div class="controls">
      <input type="text" name="weight" id="weight" placeholder="Weight" value="<?= h($size['weight']) ?>">
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Update</button>
    </div>
  </div>
</form>