
<div class="page-header">
	<a href="pages.php?action=new" class="btn btn-primary pull-right">New Page</a>
	<h1><?= h($page_title) ?></h1>
</div>

<?php if ( isset($_SESSION['message']) ): ?>
	<?= $_SESSION['message'] ?>
	<?php unset($_SESSION['message']); ?>
<?php endif; ?>

<?php if ( $pages ): ?>
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Title</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ( $pages as $page ): ?>
				<tr>
					<td><a href="pages.php?id=<?= $page['id'] ?>&amp;action=show"><?= h($page['title']) ?></a></td>
					<td>
						<a class="btn btn-small" href="pages.php?action=edit&amp;id=<?= $page['id'] ?>">Edit</a>
						<a class="btn btn-small btn-danger" href="pages.php?action=delete&amp;id=<?= $page['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php else: // no pages ?>
	<p>No pages found!</p>
<?php endif; ?>
