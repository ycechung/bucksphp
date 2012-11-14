<?php

require 'header.php';

if ( isset($_GET['action']) && $_GET['action'] == 'thank' ) {
  $alert = '<div class="alert alert-success">Thanks for your message!</div>';
}
elseif ( isset($_GET['action']) && $_GET['action'] == 'send' ) {
  $reqs = array('name', 'email', 'message');

  foreach ( $reqs as $req ) {
    if ( !isset($_POST[$req]) || !$_POST[$req] ) {
      $alert = '<div class="alert alert-error">' . ucfirst($req) . ' is missing!</div>';
      break;
    }
  }

  if ( !preg_match('/(.*)@bucksphp\.com$/', $_POST['email']) ) {
    $alert = '<div class="alert alert-error">Invalid email address!</div>';
  }

  if ( !isset($alert) ) {
    $to = 'bucksphp@gmail.com';
    $subject = 'BucksPHP Contact Form Message';
    $message = $_POST['message'];
    $headers = 'From: ' . sanitize_mail_headers($_POST['name']) . ' <' . sanitize_mail_headers($_POST['email']) . '>';

    if ( mail($to, $subject, $message, $headers) ) {
      header("Location: " . $_SERVER['PHP_SELF'] . '?action=thank');
      exit;
    }
    else {
      $alert = '<div class="alert alert-error">Sorry, but your message could not be sent at this time.</div>';
    }
  }
}

?>

<div class="page-header">
	<h1>Contact Us</h1>
</div>

<?php if ( isset($alert) ): ?>
  <?= $alert ?>
<?php endif; ?>

<form action="contact.php?action=send" class="form-horizontal" method="post">
  <div class="control-group">
    <label class="control-label" for="email">Email</label>
    <div class="controls">
      <input type="text" name="email" id="email" placeholder="Email" value="<?= isset($_POST['email']) ? h($_POST['email']) : '' ?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="name">Name</label>
    <div class="controls">
      <input type="text" name="name" id="name" placeholder="First and last name" value="<?= isset($_POST['name']) ? h($_POST['name']) : '' ?>">
    </div>
  </div>
   <div class="control-group">
    <label class="control-label" for="message">Message</label>
    <div class="controls">
      <textarea rows="3" name="message" id="message" placeholder="Your message..."><?= isset($_POST['message']) ? h($_POST['message']) : '' ?></textarea>
    </div>
  </div> 
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Submit</button>
    </div>
  </div>
</form>

<?php require 'footer.php'; ?>