<?php

// include header HTML and functions
require 'header.php';

// valid login credentials
$valid_email = 'bucksphp@gmail.com';
$valid_password = 'the_password';

// if email and password were POSTed, attempt to log the user in
if ( isset($_POST['email']) && isset($_POST['password']) ) {
  // if email and password both match the valid credentials...
  if ( $_POST['email'] == $valid_email && $_POST['password'] == $valid_password ) {
    // store email address in the session as "user"
    $_SESSION['user'] = $_POST['email'];

    // redirect to login page
    header('Location: login.php');
    exit;
  }
  // email and/or password didn't match our credentials. set an error message
  else {
    $alert = '<p class="alert alert-error">Invalid email/password combination</p>';
  }
}

?>

<div class="page-header">
  <h1>Customer Login</h1>
</div>

<?php // If an error is set, print it ?>
<?php if ( isset($alert) ): ?>
  <?= $alert ?>
<?php endif; ?>

<?php // If the session var "user" is set, the user is logged in. Print a greeting. ?>
<?php if ( isset($_SESSION['user']) ): ?>
  <p>Hello, <b><?= h ($_SESSION['user']) ?></b>. Welcome to Dolphinitively Tees!</p>

<?php // No user. Print the login form. ?>
<?php else: ?>
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
<?php endif; ?>

<?php require 'footer.php'; // include footer HTML ?>