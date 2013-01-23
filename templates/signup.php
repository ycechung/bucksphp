<div class="page-header">
  <h1><?= h($page_title) ?></h1>
</div>

<?php // If an error is set, print it ?>
<?php if ( isset($alert) ): ?>
  <?= $alert ?>
<?php endif; ?>

<form id="contact-form" action="<?= $_SERVER['PHP_SELF'] ?>?action=signup" class="form-horizontal" method="post">
  <div class="control-group">
    <label class="control-label" for="name">Name</label>
    <div class="controls">
      <input type="text" name="name" id="name" placeholder="First and Last name" value="<?= isset($_POST['name']) ? h($_POST['name']) : '' ?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="email">Email</label>
    <div class="controls">
      <input type="text" name="email" id="email" placeholder="Email" value="<?= isset($_POST['email']) ? h($_POST['email']) : '' ?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="password">Password</label>
    <div class="controls">
      <input type="password" name="password" id="password" placeholder="Password">
    </div>
  </div>
    <div class="control-group">
    <label class="control-label" for="password_confirmation">Password (again)</label>
    <div class="controls">
      <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Password (again)">
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Signup</button>
    </div>
  </div>
</form>