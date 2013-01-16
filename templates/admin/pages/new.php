<div class="page-header">
	<h1><?= h($page_title) ?></h1>
</div>

<?php // if an error is set, print it ?>
<?php if ( isset($error) ): ?>
	<div class="alert alert-error"><?= h($error) ?></div>
<?php endif; ?>

<form id="page-form" action="pages.php?action=create" class="form-horizontal" method="post">
  <div class="control-group">
    <label class="control-label" for="title">Title</label>
    <div class="controls">
      <input type="text" name="title" id="title" placeholder="Title" value="">
    </div>
  </div>
    <div class="control-group">
    <label class="control-label" for="body">Body</label>
    <div class="controls">
      <textarea rows="3" name="body" id="body" placeholder="Body..."></textarea>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Submit</button>
    </div>
  </div>
</form>