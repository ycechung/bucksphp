<div class="page-header">
  <h1><?= h($page_title) ?></1>
</div>

<?php // If an error is set, print it ?>
<?php if ( isset($alert) ): ?>
  <?= $alert ?>
<?php endif; ?>

<form id="reset-password-form" action="<?= $_SERVER['PHP_SELF'] ?>?action=reset" class="form-horizontal" method="post">
  <div class="control-group">
    <label class="control-label" for="email">Email</label>
    <div class="controls">
      <input type="text" name="email" id="email" placeholder="Email">
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Reset password</button>
    </div>
  </div>
</form>