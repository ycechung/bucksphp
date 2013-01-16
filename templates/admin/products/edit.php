<div class="page-header">
	<h1><?= h($page_title) ?></h1>
</div>

<?php // if an error is set, print it ?>
<?php if ( isset($error) ): ?>
	<div class="alert alert-error"><?= h($error) ?></div>
<?php endif; ?>

<form id="product-form" action="products.php?action=update" class="form-horizontal" method="post" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?= h($product['id']) ?>">

  <div class="control-group">
    <label class="control-label" for="name">Name</label>
    <div class="controls">
      <input type="text" name="name" id="name" placeholder="Name" value="<?= h($product['name']) ?>">
    </div>
  </div>
    <div class="control-group">
    <label class="control-label" for="description">Description</label>
    <div class="controls">
      <textarea rows="3" name="description" id="description" placeholder="Description..."><?= h($product['description']) ?></textarea>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="image">Picture URL</label>
    <div class="controls">
      <input type="text" name="image" id="image" placeholder="Picture URL" value="<?= h($product['image']) ?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="image_file">Picture File</label>
    <div class="controls">
      <input type="file" name="image_file" id="image_file">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="price">Price</label>
    <div class="controls">
      <input type="text" name="price" id="price" placeholder="Price" value="<?= h($product['price']) ?>">
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Update</button>
    </div>
  </div>
</form>