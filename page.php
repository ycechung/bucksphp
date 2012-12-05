<?php

// our mysql connection info
$user = 'bucksphp';
$password = 'fQ4fRD5CVFXmCw9F';
$database = 'bucksphp_store';
$host = 'localhost';

// connect to the mysql server
$db = new mysqli($host, $user, $password, $database);

// if the connection fails, an error message will be set
// check for that error message and kill the script if it exists
if ( $db->connect_errno ) {
	die("Failed to connect to database: " . $db->connect_error);
}

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

