<div class="page-header">
	<h1><?= h($page_title) ?></h1>
</div>

<?php // if an error is set, print it ?>
<?php if ( isset($error) ): ?>
	<div class="alert alert-error"><?= h($error) ?></div>
<?php endif; ?>

<form id="page-form" action="sizes.php?action=create&amp;product_id=<?= h($product['id']) ?>" class="form-horizontal" method="post">
  <div class="control-group">
    <label class="control-label" for="name">Name</label>
    <div class="controls">
      <input type="text" name="name" id="name" placeholder="Name" value="">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="price_difference">Price Difference</label>
    <div class="controls">
      <input type="text" name="price_difference" id="price_difference" placeholder="Price Difference" value="">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="weight">Weight</label>
    <div class="controls">
      <input type="text" name="weight" id="weight" placeholder="Weight" value="">
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Submit</button>
    </div>
  </div>
</form>