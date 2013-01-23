<?php

// include header HTML and functions
require 'header.php';
require 'includes/PasswordHash.php';

if ( isset($_SESSION['user']) ) {
  header("Location: profile.php");
  exit;
}


$alert = null;

// if email and password were POSTed, attempt to log the user in
if ( isset($_POST['email']) && isset($_POST['password']) ) {

  $sql = 'SELECT * FROM users WHERE email = ' . qstr($_POST['email']);
  $result = $db->query($sql);

  if ( $result->num_rows > 0 ) {
    $user = $result->fetch_assoc();
    $hasher = new PasswordHash(8, false);

    if ( $hasher->CheckPassword($_POST['password'], $user['password']) ) {
      $_SESSION['user'] = $user;
      header('Location: profile.php');
      exit;
    }
    else {
      $alert = '<p class="alert alert-error">Invalid email/password combination</p>';
    }
  }
  else {
    $alert = '<p class="alert alert-error">Invalid email address</p>';
  }
}

print_template('login', array(
  'alert' => $alert
));
