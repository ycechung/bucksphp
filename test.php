
<?php if ( isset($_REQUEST['name']) && isset($_REQUEST['thing']) ): ?>
	<h1>Hello, <?php echo htmlentities($_REQUEST['name']) ?>. What is your favorite <?php echo htmlentities($_REQUEST['thing']) ?>?</h1>
<?php endif; ?>

<form method="post" action="http://google.com">
	<input type="text" name="name" placeholder="Name">
	<input type="text" name="thing" placeholder="Thing">
	<input type="submit" value="Submit">
</form>
