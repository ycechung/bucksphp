<?php

$user = 'bucksphp';
$password = 'fQ4fRD5CVFXmCw9F';
$database = 'bucksphp_store';
$host = '127.0.0.1';

$db = new mysqli($host, $user, $password, $database);

if ( $db->connect_errno ) {
	die("Failed to connect to database: " . $db->connect_errno);
}


$sql = "SELECT * FROM products ORDER BY name";
$result = $db->query($sql);

while ( $row = $result->fetch_assoc() ) {
	echo '<pre>';
	print_r($row);
	echo '</pre>';
}