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

// fetch all products, ordering alphabetically by name
$sql = "SELECT * FROM products ORDER BY name";
$result = $db->query($sql);

// loop through each product row, fetch an associative array, 
// and print the result in a <pre> tag
while ( $row = $result->fetch_assoc() ) {
	echo '<pre>';
	print_r($row);
	echo '</pre>';
}