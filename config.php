<?php

// our mysql connection info

// dev environment
if ( $_SERVER['SERVER_NAME'] == 'localhost' ) {
	define('DB_USER', 'bucksphp');
	define('DB_PASSWORD', 'fQ4fRD5CVFXmCw9F');
	define('DB_NAME', 'bucksphp_store');
	define('DB_HOST', 'localhost');
}
// production environment
else {
	define('DB_USER', 'bucksphp');
	define('DB_PASSWORD', '3nKB4VQ2FQjJ86c86w');
	define('DB_NAME', 'bucksphp_store');
	define('DB_HOST', 'mysql.bucksphp.com');
}
