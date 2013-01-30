<?php

require 'header.php';

echo "<pre>";
var_dump($db->stat());

exit;

class Employee {
	public $name = null;
	protected $position = "drone";

	public function __construct() {
		$this->name = "Charles";
	}

	protected function salary() {
		return 24000;
	}

	public function getSalary() {
		return $this->salary();
	}

	public function __destruct() {
		// this happens at the end
	}
}

class Boss extends Employee {
	public static $mood = "angry";

	public function __construct() {
		$this->name = "The Boss";
	}

	public function getPosition() {
		return $this->position;
	}
}

$employee = new Employee();
// $employee->name = "Bob";

echo "hello, my name is " . $employee->name . ". I make " . $employee->getSalary();
echo "<hr>";

$boss = new Boss();
echo "hello, my name is " . $boss->name . ". My position is " . $boss->getPosition();
echo ". my mood is " . $boss::$mood . ".";

echo "<hr>";
echo '$boss is a ' . get_class($boss);

echo "<hr>";

if ( $boss instanceof Employee ) {
	echo '$boss is an instanceof Employee';
}
else {
	echo '$boss is not an instanceof Employee';
}
echo "<hr>";

echo "All bosses are " . Boss::$mood;
echo "<hr>";
