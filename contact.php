<?php

require 'header.php';

pr($_POST);

?>

<div class="page-header">
	<h1>Contact Us</h1>
</div>

<form class="form-horizontal" method="post">
  <div class="control-group">
    <label class="control-label" for="email">Email</label>
    <div class="controls">
      <input type="email" name="email" id="email" placeholder="Email">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="name">Name</label>
    <div class="controls">
      <input type="text" name="name" id="name" placeholder="First and last name">
    </div>
  </div>
   <div class="control-group">
    <label class="control-label" for="message">Message</label>
    <div class="controls">
      <textarea rows="3" name="message" id="message" placeholder="Your message..."></textarea>
    </div>
  </div> 
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Submit</button>
    </div>
  </div>
</form>

<?php require 'footer.php'; ?>