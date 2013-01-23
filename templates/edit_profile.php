<div class="page-header">
  <h1><?= h($page_title) ?></h1>
</div>

<?php // If an error is set, print it ?>
<?php if ( isset($alert) ): ?>
  <?= $alert ?>
<?php endif; ?>

<form id="contact-form" action="<?= $_SERVER['PHP_SELF'] ?>?action=update" class="form-horizontal" method="post">
  <div class="control-group">
    <label class="control-label" for="name">Name</label>
    <div class="controls">
      <input type="text" name="name" id="name" placeholder="First and Last name" value="<?= isset($user['name']) ? h($user['name']) : '' ?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="email">Email</label>
    <div class="controls">
      <input type="text" name="email" id="email" placeholder="Email" value="<?= isset($user['email']) ? h($user['email']) : '' ?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="shipping_address">Shipping Address</label>
    <div class="controls">
      <textarea name="shipping_address" id="shipping_address" placeholder="1234 Main St, Anytown USA"><?= isset($user['shipping_address']) ? h($user['shipping_address']) : '' ?></textarea>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="billing_address">Billing Address</label>
    <div class="controls">
      <textarea name="billing_address" id="billing_address" placeholder="1234 Main St, Anytown USA"><?= isset($user['billing_address']) ? h($user['billing_address']) : '' ?></textarea>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Update Profile</button>
    </div>
  </div>
</form>