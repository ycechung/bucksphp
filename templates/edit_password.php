<div class="page-header">
  <h1><?= h($page_title) ?></h1>
</div>

<?php // If an error is set, print it ?>
<?php if ( isset($alert) ): ?>
  <?= $alert ?>
<?php endif; ?>

<form id="contact-form" action="<?= $_SERVER['PHP_SELF'] ?>?action=update_password" class="form-horizontal" method="post">
  <?php if ( isset($_GET['reset_token']) ): ?>
    <input type="hidden" name="reset_token" value="<?= h($_GET['reset_token']) ?>">
  <?php else: ?>
    <div class="control-group">
      <label class="control-label" for="current_password">Current Password</label>
      <div class="controls">
        <input type="password" name="current_password" id="current_password" placeholder="Current Password">
      </div>
    </div>
  <?php endif; ?>
  <div class="control-group">
    <label class="control-label" for="password">New Password</label>
    <div class="controls">
      <input type="password" name="password" id="password" placeholder="New Password">
    </div>
  </div>
    <div class="control-group">
    <label class="control-label" for="password_confirmation">New Password (again)</label>
    <div class="controls">
      <input type="password" name="password_confirmation" id="password_confirmation" placeholder="New Password (again)">
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Save</button>
    </div>
  </div>
</form>