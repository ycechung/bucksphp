<?php

$sql = 'SELECT * FROM pages WHERE id = ' . (int)$_GET['id'];
$result = $db->query($sql);
$page = $result->fetch_assoc();

require 'header.php';

?>

<div class="page-header">
	<h1><?= h($page['title']) ?></h1>
</div>

<?= nl2br(h($page['body'])) ?>

<?php require 'footer.php'; ?>

