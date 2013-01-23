<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Dolphinitively Tees - The Finest in Marine Mammal Apparel</title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8">

		<?php // Include the Twitter Bootstrap CSS framework ?>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">

		<?php // Include our own CSS ?>
		<link rel="stylesheet" type="text/css" href="css/style.css">

		<?php // Include the jQuery Javascript framework ?>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

		<?php // A bit of Javascript to add some UI niceties. We can treat this as a black box for now ?>
		<script type="text/javascript">
			$(function(){
				// validate that a size has been selected
				$('form.buy').submit(function(e){
					if ( $(this).find('select.size').val() == '' ) {
						alert("Please select a size!");
						return false;
					}
				});

				// update the product price when the size selector is changed
				$('form.buy select.size').change(function(e){
					var $input = $('#paypal_amount');
					var diff = $(this).find('option:selected').data('price-difference');
					var base_price = $input.data('base-price');
					var total = diff + base_price;
					$input.val(total);
				});
			});
		</script>
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top">
		  <div class="navbar-inner">
		    <a class="brand" href="index.php">Dolphinitively Tees</a>
		    <ul class="nav">
		    	<?php // Give the current tab the class "active", so we can highlight it with CSS ?>
		      <li class="index <?= tab_class('index') ?>"><a href="index.php">Home</a></li>
		      <li class="contact <?= tab_class('contact') ?>"><a href="contact.php">Contact</a></li>
		      <li class="about <?= tab_class('about') ?>"><a href="about">About Us</a></li>
		      <li class="cart <?= tab_class('cart') ?>">
		      	<a href="cart.php">
		      		Shopping Cart
		      		<?php // If there are items in the shopping cart, print the total quantity with the shopping cart link ?>
		      		<?php if ( cart_item_count() > 0 ): ?>
		      			<sup><?= number_format(cart_item_count()) ?></sup>
		      		<?php endif; ?>
		      	</a>
		     </li>
		    </ul>
		    <ul class="nav pull-right session">
		     <?php // Only show the logout link if a user is logged in ?>
		     <?php if ( isset($_SESSION['user']) ): ?>
		     	<li class="profile"><a href="profile.php"><?= h($_SESSION['user']['name']) ?></a></li>
		     	<li class="logout"><a href="logout.php">Log out</a></li>
		     <?php else: ?>
		     	<li class="login"><a href="login.php">Log in</a></li>
		     	<li class="signup"><a href="signup.php">Sign up</a></li>
		     <?php endif; ?>
		    </ul>
		  </div>
		</div>
		<div class="container">
			<?= $page_content ?>
		</div>
		<footer id="footer" class="muted">
			<div class="container">
				&copy; <?= date('Y') ?> Dolphinitively Tees, LLC
				<a href="terms">Terms of Service</a>
				<a href="privacy">Privacy Policy</a>
				<a href="shipping">Shipping Info</a>
				<a href="returns">Returns</a>
			</div>
		</footer>
	</body>
</html>