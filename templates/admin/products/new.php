<div class="page-header">
	<h1><?= h($page_title) ?></h1>
</div>

<?php // if an error is set, print it ?>
<?php if ( isset($error) ): ?>
	<div class="alert alert-error"><?= h($error) ?></div>
<?php endif; ?>

<form id="product-form" action="products.php?action=create" class="form-horizontal" method="post">
  <div class="control-group">
    <label class="control-label" for="name">Name</label>
    <div class="controls">
      <input type="text" name="name" id="name" placeholder="Name" value="">
    </div>
  </div>
    <div class="control-group">
    <label class="control-label" for="description">Description</label>
    <div class="controls">
      <textarea rows="3" name="description" id="description" placeholder="Description..."></textarea>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="image">Picture URL</label>
    <div class="controls">
      <input type="text" name="image" id="image" placeholder="Picture URL" value="">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="price">Price</label>
    <div class="controls">
      <input type="text" name="price" id="price" placeholder="Price" value="">
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Submit</button>
    </div>
  </div>
</form>