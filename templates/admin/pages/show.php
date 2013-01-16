
<div class="page-header">
	<a href="pages.php?action=edit&amp;id=<?= $page['id'] ?>" class="btn btn-primary pull-right">Edit Page</a>
	<a href="pages.php?action=delete&amp;id=<?= $page['id'] ?>" class="btn btn-danger pull-right" onclick="return confirm('Are you sure?')">Delete Page</a>
	<h1><?= h($page['title']) ?></h1>
</div>

<?= nl2br(h($page['body'])) ?>
