<div class="page-header">
  <h1>Customer Login</h1>
</div>

<?php // If an error is set, print it ?>
<?php if ( isset($alert) ): ?>
  <?= $alert ?>
<?php endif; ?>

<form id="contact-form" action="<?= $_SERVER['PHP_SELF'] ?>" class="form-horizontal" method="post">
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
    <div class="controls">
      <button type="submit" class="btn">Submit</button>
    </div>
  </div>
</form>

<p>Not signed up yet? <a href="signup.php">Register now!</a></p>
<p>Forgot your password? <a href="reset_password.php">Reset it.</a></p>