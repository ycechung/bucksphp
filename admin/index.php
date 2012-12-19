<?php

// require the global header
require '../header.php';

// print the admin index template
print_template('admin/index', array(
	'motd' => "T-Shirts are good."
), 'admin');