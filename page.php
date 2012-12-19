<?php

require 'header.php';

$sql = 'SELECT * FROM pages WHERE id = ' . (int)$_GET['id'];
$result = $db->query($sql);
$page = $result->fetch_assoc();

print_template('page', array(
	'page' => $page
));

