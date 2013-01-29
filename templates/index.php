
<div class="page-header">
	<h1><?= $page_title ?></h1>
	<p>Lorem ipsum adipisicing sint consequat do veniam ea. Lorem ipsum dolore sit eu dolore ut est eiusmod. Lorem ipsum adipisicing sint consequat do veniam ea. Lorem ipsum dolore sit eu dolore ut est eiusmod.</p>
</div>

<ul class="thumbnails">
	<?php // Loop through each product, print its thumbnail image, and link to the related detail page ?>
	<?php foreach ( $products as $product ): ?>
		<li class="span3">
			<a class="thumbnail" href="detail.php?id=<?= $product['id'] ?>">
				<?php // Print the image tag for this product ?>
				<?= product_image_tag($product); ?>
			</a>
		</li>
	<?php endforeach; ?>
</ul>

<?php /* Only show pagination if more than one page exists */ ?>
<?php if ( $page_count > 1 ): ?>
	<div class="pagination">
	  <ul>
	  	<?php /* There is a previous page to link to */ ?>
	  	<?php if ( $prev_page ): ?>
	  		<li><a href="index.php?page=<?= h($prev_page) ?>&amp;q=<?= h($search_term) ?>">Prev</a></li>
	  	<?php /* This is the first page. Show disabled prev link */ ?>
	  	<?php else: ?>
	    	<li class="disabled"><a href="">Prev</a></li>
	    <?php endif; ?>

	    <?php /* Link to all available page numbers */ ?>
	    <?php for ( $p = 1; $p <= $page_count; $p++ ): ?>
	    	<?php /* Set li class to active for current page */ ?>
	    	<li class="<?= $p == $current_page ? 'active' : '' ?>">
	    		<a href="index.php?page=<?= h($p) ?>&amp;q=<?= h($search_term) ?>"><?= h($p) ?></a>
	    	</li>
	    <?php endfor; ?>

	    <?php /* There is a next page to link to */ ?>
    	<?php if ( $next_page ): ?>
    		<li><a href="index.php?page=<?= h($next_page) ?>&amp;q=<?= h($search_term) ?>">Next</a></li>
    	<?php /* This is the last. Show disabled next link */ ?>
    	<?php else: ?>
      	<li class="disabled"><a href="">Next</a></li>
      <?php endif; ?>
	  </ul>
	</div>
<?php endif; ?>