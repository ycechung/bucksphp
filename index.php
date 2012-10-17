<?php

/*
this is a 
multiline comment
...
*/

// this is a single line comment

// this is a variable containing the string 'moose'
$str = 'moose';

// this is a for loop that prints moose 12 times
for ( $i = 0; $i < 12; $i++ ) {
	echo '<div style="text-align:center">
		hello, ' . $str . '</div>';
}

// this is a list of animals
$animals = array('dog', 'cat', 'squirrel');

// loop through each animal and print its name
foreach ( $animals as $animal ) {
	echo $animal . '<hr>';
}

// old school print the animals
for ( $i = 0; $i < count($animals); $i++ ) {
	echo '<div style="text-align:center">
		hello, ' . $animals[$i] . '</div>';
}

// keep going until x reaches 7
$x = 0;
while ( $x < 7 ) {
	echo "$x is less than 7<br>";
	$x++;
}

// calling my custom function
print_x_times(4, 'my string');

// calling my custom function again
print_x_times(5, 'my other string');
echo '<hr>';

// add 2 numbers
$total = 2 + '3';
echo $total;
echo '<hr>';

// multiply
$a = 4 * 5;
echo $a;
echo '<hr>';

// divide
$a = 26 / '4.75';
echo $a;

// this is a custom function i defined to print
// a string <x> number of times
function print_x_times($x, $str) {
	echo '<hr>';
	for ( $i = 0; $i < $x; $i++ ) {
		echo $str . '<br>';
	}
}