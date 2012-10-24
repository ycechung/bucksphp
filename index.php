<?php

// include the product list
require 'products.php';

// a prettier version of print_r()
function pre($array) {
	echo '<pre>';
	print_r($array);
	echo '</pre>';
}

// shorter version of htmlentities
function h($str){
	return htmlentities($str);
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Dolphinitively Tees - The Finest in Marine Mammal Apparel</title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script type="text/javascript">
			$(function(){
				// validate that a size has been selected
				$('form.buy').submit(function(e){
					if ( $(this).find('select.size').val() == '' ) {
						alert("Please select a size!");
						return false;
					}
				});

				// normalize height of thumbnails
				var h = 0;
				$('.thumbnail').each(function(i, div){
					if ( $(div).height() > h ) {
						h = $(div).height();
					}
				}).height(h);
			});
		</script>
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top">
		  <div class="navbar-inner">
		    <a class="brand" href="index.php">Dolphinitively Tees</a>
		    <ul class="nav">
		      <li class="active"><a href="index.php">Home</a></li>
		      <li><a href="#">Contact</a></li>
		      <li><a href="#">About Us</a></li>
		    </ul>
		  </div>
		</div>
		<div class="container">
			<div class="page-header">
				<h1>All Products</h1>
				<p>Lorem ipsum adipisicing sint consequat do veniam ea. Lorem ipsum dolore sit eu dolore ut est eiusmod. Lorem ipsum adipisicing sint consequat do veniam ea. Lorem ipsum dolore sit eu dolore ut est eiusmod.</p>
			</div>
			<ul class="thumbnails">
				<?php foreach ( $products as $product ): ?>
					<li class="span4">
						<div class="thumbnail">
							<?php if ( $product['image'] ): ?>
								<img src="<?= h($product['image']) ?>" alt="Photo of <?= h($product['name']) ?>">
							<?php else: ?>
								<img src="http://placehold.it/200x200" alt="No Photo">
							<?php endif; ?>

							<div class="caption">
								<h3><?php echo h($product['name']) ?></h3>
								<h4>$<?= number_format($product['price'], 2) ?></h4>
								<p><?= nl2br(h($product['description'])) ?></p>

								<form class="buy" name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post">
									<input type="hidden" name="cmd" value="_xclick">
									<input type="hidden" name="business" value="ken@37i.net">
									<input type="hidden" name="currency_code" value="USD">
									<input type="hidden" name="item_name" value="<?= h($product['name']) ?>">
									<input type="hidden" name="amount" value="<?= h($product['price']) ?>">
									<input type="hidden" name="on0" value="Size">
									
						
									<select class="size" name="os0">
										<option value="">Select a size...</option>
										<?php foreach ( $product['sizes'] as $size ): ?>
											<option value="<?= h($size) ?>"><?= h($size) ?></option>
										<?php endforeach; ?>
									</select>

									<p>
										<button type="submit" class="btn btn-primary">Buy</button>
									</p>
								</form>
							</div>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</body>
</html>
