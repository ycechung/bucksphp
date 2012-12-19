<!DOCTYPE html>
<html lang="en">
	<head>
		<title>
			<?php if ( isset($page_title) ): ?>
				<?= $page_title . ' | ' ?>
			<?php endif; ?>
			Dolphinitively Tees - The Finest in Marine Mammal Apparel
		</title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8">

		<?php // Include the Twitter Bootstrap CSS framework ?>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">

		<?php // Include our own CSS ?>
		<link rel="stylesheet" type="text/css" href="../css/style.css">

		<?php // Include the jQuery Javascript framework ?>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

	</head>
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top">
		  <div class="navbar-inner">
		    <a class="brand" href="index.php">Dolphinitively Dashboard</a>
		    <ul class="nav">
		      <li class="products <?= tab_class('products') ?>"><a href="products.php">Products</a></li>
		      <li class="pages"><a href="pages.php">Pages</a></li>
		    </ul>
		  </div>
		</div>
		<div class="container">
			<?= $page_content ?>
		</div>
	</body>
</html>