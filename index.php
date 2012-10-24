<?php

$products = array(
	array(
		'name' => 'Walrus T-Shirt',
		'description' => 'Lorem ipsum adipisicing sint consequat do veniam ea. Lorem ipsum dolore sit eu dolore ut est eiusmod.',
		'image' => 'http://www.cottonable.com/wp-content/uploads/2010/01/walrus-cartoon-tee-t-shirt-animal-illustration-apparel-clothing-mustache-fuzzy-ink-men.jpg',
		'price' => 12.0,
		'sizes' => array(
			'Small',
			'Medium',
			'Large',
			'XL',
			'2XL'
		),
	),
	array(
		'name' => 'Dolphin T-Shirt',
		'description' => 'Lorem ipsum adipisicing sint consequat do veniam ea. Lorem ipsum dolore sit eu dolore ut est eiusmod.',
		'image' => 'http://www.animalshirts.net/dolphinshirts/10-3081.jpg',
		'price' => 13.50,
		'sizes' => array(
			'Small',
			'Medium',
			'Large',
			'XL'
		)
	),
	array(
		'name' => 'Angry Leopard Seal',
		'description' => 'Lorem ipsum adipisicing sint consequat do veniam ea. Lorem ipsum dolore sit eu dolore ut est eiusmod.',
		'image' => 'http://rlv.zcache.com/leopard_seal_vs_penguin_battle_tshirt-p235094727998853049z7of7_210.jpg',
		'price' => 12,
		'sizes' => array(
			'Small',
			'Medium',
			'Large',
			'XL'
		)
	),
	array(
		'name' => 'Harry Otter Tee',
		'description' => 'Lorem ipsum adipisicing sint consequat do veniam ea. Lorem ipsum dolore sit eu dolore ut est eiusmod.',
		'image' => 'http://2.bp.blogspot.com/-dYqVW-0sjaE/T7uM4QzX-HI/AAAAAAAAEew/M_PcTjVjT_U/s640/Harry+Otter.jpg',
		'price' => '14.99',
		'sizes' => array(
			'Youth Large',
			'Small',
			'Medium',
			'Large',
			'XL'
		)
	),
	array(
		'name' => 'Polar Bear Hoodie',
		'description' => 'Lorem ipsum adipisicing sint consequat do veniam ea. Lorem ipsum dolore sit eu dolore ut est eiusmod.',
		'image' => 'http://www.toxel.com/wp-content/uploads/2009/07/hoodie06.jpg',
		'price' => 34.99,
		'sizes' => array(
			'Small',
			'Medium',
			'Large',
		)
	),
	array(
		'name' => 'Porpoise Pun Tee',
		'description' => 'Lorem ipsum adipisicing sint consequat do veniam ea. Lorem ipsum dolore sit eu dolore ut est eiusmod.',
		'image' => 'http://skreened.com/render-product/r/u/a/ruacboqgyfiugvwqfqas/for-all-intensive-porpoises-t-shirt.american-apparel-juniors-fitted-tee.light-blue.w760h760.jpg',
		'price' => 16,
		'sizes' => array(
			'Small',
			'Medium',
			'Large',
			'XL',
			'2XL',
			'3XL'
		)
	),	
);

// a prettier version of print_r()
function pre($array) {
	echo '<pre>';
	print_r($array);
	echo '</pre>';
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Dolphinitively Tees - The Finest in Marine Mammal Apparel</title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<style type="text/css">
		body {
			padding-top: 40px;
		}

		.thumbnails img {
			height: 200px;
		}
		</style>
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
							<img src="<?= $product['image'] ?>" alt="Photo of <?= $product['name'] ?>">

							<div class="caption">
								<h3><?php echo $product['name'] ?></h3>
								<p><?= $product['description'] ?></p>
								<p><button type="submit" class="btn btn-primary">Buy</button></p>
							</div>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</body>
</html>
