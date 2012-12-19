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