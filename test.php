<?php

session_start();

if ( !isset($_SESSION['visits']) ) {
	$_SESSION['visits'] = 1;
}
else {
	$_SESSION['visits'] += 1;
}

echo $_SESSION['visits'];

?>

<hr>
<a href="test2.php">test2</a>

