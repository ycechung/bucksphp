<?php

// include header HTML and functions
require 'header.php';

// if ?action=thank is in the URL, set a thank you alert
if ( isset($_GET['action']) && $_GET['action'] == 'thank' ) {
  $alert = '<div class="alert alert-success">Thanks for your message!</div>';
}
// if ?action=send is in the URL...
elseif ( isset($_GET['action']) && $_GET['action'] == 'send' ) {
  // these fields are required. we can't send the email without them
  $reqs = array('name', 'email', 'message');

  // loop through each requirement
  foreach ( $reqs as $req ) {
    // if the field is missing or (trimmed of whitespace) it's blank, set an error message
    if ( !isset($_POST[$req]) || trim($_POST[$req]) == '' ) {
      // ucfirst will capitalize the first letter
      $alert = '<div class="alert alert-error">' . ucfirst($req) . ' is missing!</div>';
      break;
    }
  }

  // if the given email address doesn't match <something>@bucksphp.com, set an error message
  if ( !preg_match('/(.*)@bucksphp\.com$/', $_POST['email']) ) {
    $alert = '<div class="alert alert-error">Invalid email address!</div>';
  }

  // if no error has been set
  if ( !isset($alert) ) {
    // send the message to this address
    $to = 'bucksphp@gmail.com';

    // email subject
    $subject = 'BucksPHP Contact Form Message';

    // email body
    $message = $_POST['message'];

    // the from address (From: Some Body <some.body@bucksphp.com>)
    // We need to make sure that no malicious spam headers have been sent through our form. To do this,
    // we pass all input through the sanitize_mail_headers function defined in header.php
    $headers = 'From: ' . sanitize_mail_headers($_POST['name']) . ' <' . sanitize_mail_headers($_POST['email']) . '>';

    // Sent the email. If it works, redirect to the current page with ?action=thank in the URL
    if ( mail($to, $subject, $message, $headers) ) {
      header("Location: " . $_SERVER['PHP_SELF'] . '?action=thank');
      exit; // stop the script from continuing to execute after redirect
    }
    // The email failed to send. Set an error message.
    else {
      $alert = '<div class="alert alert-error">Sorry, but your message could not be sent at this time.</div>';
    }
  }
}

?>

<div class="page-header">
	<h1>Contact Us</h1>
</div>

<?php // If an alert was set above, print it ?>
<?php if ( isset($alert) ): ?>
  <?= $alert ?>
<?php endif; ?>

<form id="contact-form" action="contact.php?action=send" class="form-horizontal" method="post">
  <div class="control-group">
    <label class="control-label" for="email">Email</label>
    <div class="controls">
      <?php // If an email was previously entered, automatically fill it into the value be using a ternary if/else statement (see http://bit.ly/4slW) ?>
      <input type="text" name="email" id="email" placeholder="Email" value="<?= isset($_POST['email']) ? h($_POST['email']) : '' ?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="name">Name</label>
    <div class="controls">
      <?php // If a name was previously entered, automatically fill it into the value ?>
      <input type="text" name="name" id="name" placeholder="First and last name" value="<?= isset($_POST['name']) ? h($_POST['name']) : '' ?>">
    </div>
  </div>
   <div class="control-group">
    <label class="control-label" for="message">Message</label>
    <div class="controls">
      <?php // If a message was previously entered, automatically fill it into the value ?>
      <textarea rows="3" name="message" id="message" placeholder="Your message..."><?= isset($_POST['message']) ? h($_POST['message']) : '' ?></textarea>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Submit</button>
    </div>
  </div>
</form>

<?php require 'footer.php'; // include footer HTML ?>