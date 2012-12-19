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

print_template('contact', array(
  'alert' => (isset($alert) ? $alert : null)
));
