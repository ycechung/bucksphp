<?php

/**
 * Removes all potential spam headers from a string
 *
 * @param string $str
 * @return string
 **/
function sanitize_mail_headers($str) {
  $badness = array("\r", "\n", "%0a", "%0d", "Content-Type", "bcc:", "to:", "cc:");

  return str_ireplace($badness, '', $str);
}

function h($str) {
  return htmlentities($str);
}
 
 
// if ?action=thank is in the URL, set a thank you alert
if ( isset($_GET['action']) && $_GET['action'] == 'thank' ) {
  $alert = '<div class="alert alert-success">Thank You for your message!</div>';
}
// if ?action=send is in the URL...
elseif ( isset($_GET['action']) && $_GET['action'] == 'send' ) {
  $alert = null;

  // these fields are required. we can't send the email without them
  $reqs = array('name', 'email', 'message', 'phone_number', 'service', 'day', 'message' );

  // loop through each requirement
  foreach ( $reqs as $req ) {
    // if the field is missing or (trimmed of whitespace) it's blank, set an error message
    if ( !isset($_POST[$req]) || trim($_POST[$req]) == '' ) {
      // ucfirst will capitalize the first letter
      $alert .= '<div class="alert alert-error">' . ucfirst($req) . ' is missing!</div>';
      // break;
    }
  }

  // if the given email address doesn't match, set an error message
  if ( !preg_match('/^(.*)\@(.*)\.(.*)$/', $_POST['email']) ) {
    $alert .= '<div class="alert alert-error">Invalid email address!</div>';
  }

  // if no error has been set
  if ( !isset($alert) ) {
    // send the message to this address
    $to = 'dschudesigns@gmail.com';

    // email subject
    $subject = 'Estimate Inquiry';

    // email body
    $body = "Message: " . $_POST['message'] . "\n";
    $body .= "Phone: " . $_POST['phone_number'] . "\n";
    $body .= "Day: " . $_POST['day'] . "\n";
    $body .= "Service: " . $_POST['service'] . "\n";

    $contact_times = array();

    foreach ( array('morning', 'afternoon', 'evening') as $time ) {
      if ( isset($_POST[$time]) ) {
        $contact_times[] = $time;
      }
    }

    $body .= "Contact time: " . implode($contact_times, ', ') . "\n";

    if ( $_POST['newsletter'] == 'positive' ) {
      $body .= "Newsletter: yes\n";
    }
    else {
      $body .= "Newsletter: no\n";
    }
	
    // We need to make sure that no malicious spam headers have been sent through our form. To do this,
    // we pass all input through the sanitize_mail_headers function defined in header.php
    $headers = 'From: ' . sanitize_mail_headers($_POST['name']) . ' <' . sanitize_mail_headers($_POST['email']) . '>';

    // Sent the email. If it works, redirect to the current page with ?action=thank in the URL
    if ( mail($to, $subject, $body, $headers) ) {
      header("Location: " . $_SERVER['PHP_SELF'] . '?action=thank');
      exit; // stop the script from continuing to execute after redirect
    }
    // The email failed to send. Set an error message.
    else {
      $alert = '<div class="alert alert-error">Sorry, but your message could not be sent at this time.</div>';
    }
  }
}



// Radio Button

$receive_newsletter = true;

if (isset($_POST['contact_submitted']) && $_POST['newsletter'] == 'negative') {
  $receive_newsletter = false;
}

?>



<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">


<title>GSS Landscaping - Contact Us</title>

<link rel="shortcut icon" href="Assets/gss.ico" type="image/x-icon" />

<meta name="author" content="GSS Landscaping" />

<meta name="description" content="Landscaping, Hardscaping" />

<meta name="keywords" content="Landscaping" />

<meta name="copyright" content="2012 | D.Schu Designs" />

<meta name="owner" content="Owner's Name Here, GSS Landscaping" />

<meta name="classification" content="Landscaping">

<meta name="reply-to" content="youremail@gmail.com" /> 


<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<link href="gss-layout.css" rel="stylesheet" type="text/css">

</head>

<body>
<div class="container">
  <header> <img src="Assets/gss-banner.gif" alt="GSS Landscaping" name="Logo" width="960" height="200" border="0" usemap="#Social_Media" id="Banner" style="background: #C6D580; display:block;" />
    <map name="Social_Media">
      <area shape="rect" coords="207,140,225,159" href="http://www.linkedin.com/" target="_new" alt="LinkedIn">
      <area shape="rect" coords="229,140,247,158" href="http://www.facebook.com" target="_new" alt="Facebook">
      <area shape="rect" coords="252,140,270,158" href="http://www.twitter.com" target="_new" alt="Twitter">
    </map>
    
  </header>
  
  
  <div class="sidebar1">
  
    <aside>
      <table width="198" height="324" border="0" align="left" cellspacing="0">
        <tr>
          <td width="74" height="30">&nbsp;</td>
        </tr>
        <tr>
          <td height="58"><center><img src="Assets/home-button.gif" alt="Home" width="161" height="56" border="0" usemap="#Index"></center></td>
        </tr>
        <tr>
          <td height="58"><center><img src="Assets/about-button.gif" alt="About" width="161" height="56" border="0" usemap="#About"></center></td>
        </tr>
        <tr>
          <td height="58"><center><img src="Assets/services-button.gif" alt="Services" width="161" height="56" border="0" usemap="#Services"></center></td>
        </tr>
        <tr>
          <td height="30"><center><img src="Assets/portfolio-button.gif" alt="Portfolio" width="161" height="56" border="0" usemap="#Portfolio"></center></td>
        </tr>
        <tr>
          <td height="45"><center><img src="Assets/contact-button.gif" alt="Contact" width="161" height="56" border="0" usemap="#Contact"></center></td>
        </tr>
        <tr>
          <td height="45">&nbsp;</td>
        </tr>
      </table>
      
    </aside>
  <!-- end .sidebar1 --></div>
  
  <article class="content">
   
    <section>
    


<?php // If an alert was set above, print it ?>
<?php if ( isset($alert) ): ?>
  <?= $alert ?>
<?php endif; ?>

      
     
     <form action="gss-contact.php?action=send" method="post" name="Contact" id="Estimates">
        <table width="760" border="0" align="center" cellpadding="2" cellspacing="0" id="Contact_Form">
          <tr>
            <td height="63" colspan="2" class="form_text">Simply fill out the form below, including your email, phone number, estimate information, and the best time for us to contact you.
      You will receive a confirmation after submitting the form, and one of our representatives will get back to you as soon as possible. </td>
          </tr>
          <tr>
            <td width="334" class="form_text"><input name="required" type="hidden" id="required" value="name, email, phone_number, service, day, message ">
Name*</td>
            <td width="418"><span class="form_text">When is the Best Time To Contact You?</span></td>
          </tr>
          <tr>
            <td class="form_text"> <?php // If a name was previously entered, automatically fill it into the value ?><input name="name" type="text" id="Name" size="40" maxlength="100" placeholder="First and Last Name" value="<?= isset($_POST['name']) ? h($_POST['name']) : '' ?>"></td>
            <td class="form_text"><input type="checkbox" name="morning" id="morning">
  Morning
    <input type="checkbox" name="afternoon" id="afternoon">
Afternoon
<input type="checkbox" name="evening" id="evening">
Evening</td>
          </tr>
          <tr>
            <td class="form_text">Email*</td>
            <td class="form_text">Preferred Appointment Day*</td>
          </tr>
          <tr>
            <td class="form_text"><?php // If an email was previously entered, automatically fill it into the value be using a ternary if/else statement (see http://bit.ly/4slW) ?><input name="email" type="text" id="Email" size="40" maxlength="100" placeholder="Email" value="<?= isset($_POST['email']) ? h($_POST['email']) : '' ?>"></td>
            <td class="form_text"><?php // If a message was previously entered, automatically fill it into the value ?>
            <input name="day" type="text" id="Day" maxlength="16" value="<?= isset($_POST['day']) ? h($_POST['day']) : '' ?>"></td>
          </tr>
          <tr>
            <td class="form_text">Phone Number*</td>
            <td class="form_text">Service for Estimate*</td>
          </tr>
          <tr>
            <td class="form_text"><?php // If a message was previously entered, automatically fill it into the value ?>
            <input name="phone_number" type="text" id="phone_number" maxlength="16" value="<?= isset($_POST['phone_number']) ? h($_POST['phone_number']) : '' ?>"></td>
            <td class="form_text"><?php // If a message was previously entered, automatically fill it into the value ?>
            <input name="service" type="text" id="Service" placeholder="Service Desired" size="40" maxlength="100" value="<?= isset($_POST['service']) ? h($_POST['service']) : '' ?>"></td>
          </tr>
          <tr>
            <td class="form_text"><span class="form_text">Would You Like to Receive Our Quarterly Newsletter?</span>
            </td>
            <td class="form_text"><label>Comments/Notes*</label>
&nbsp;</td>
          </tr>
          <tr>
            <td class="form_text"><label>
              <input type="radio" name="newsletter" value="positive" id="Yes" <?= $receive_newsletter ? 'checked' : '' ?>>
              Yes</label>
              <br>
              <label>
                <input type="radio" name="newsletter" value="negative" id="No" <?= $receive_newsletter ? '' : 'checked' ?>>
            No</label></td>
            <td><span class="contact textarea">
            <?php // If a message was previously entered, automatically fill it into the value ?>
              <textarea name="message" id="message" cols="50" rows="4" placeholder="Additional Details..."><?= isset($_POST['message']) ? h($_POST['message']) : '' ?></textarea>
            </span></td>
          </tr>
          <tr>
            <td class="form_text">&nbsp;</td>
            <td><input name="contact_submitted" type="image" id="Submit" value="send" src="Assets/submit.png" align="right"></td>
          </tr>
        </table>
      </form>
      
        
     
      
      
      <p>&nbsp;</p>
    </section>
     
    
  <!-- end .content --></article>
  


  <footer>
  Copyright © 2012  All rights reserved.  Design by <a href="../index.html">D.Schu Designs</a></footer>
  <!-- end .container --></div>

<map name="Index">
  <area shape="rect" coords="4,3,149,47" href="gss-index.html" target="_self" alt="Home Page">
</map>

<map name="About">
  <area shape="rect" coords="4,3,149,49" href="gss-about.html" target="_self" alt="About Page">
</map>

<map name="Services">
  <area shape="rect" coords="5,4,151,48" href="gss-services.html" target="_self" alt="Services">
</map>

<map name="Portfolio">
  <area shape="rect" coords="3,3,150,47" href="gss-portfolio.html" target="_self" alt="Portfolio">
</map>

<map name="Contact">
  <area shape="rect" coords="3,3,150,47" href="gss-contact.html" target="_self" alt="Contact Page">
</map>

</body>
</html>
