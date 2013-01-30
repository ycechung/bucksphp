<?php

class DB {
	private $conn;

	public $insert_id = null;

	public function __construct($host, $user, $password, $database) {
		// connect to the mysql server
		$this->conn = new mysqli($host, $user, $password, $database);

		// if the connection fails, an error message will be set
		// check for that error message and kill the script if it exists
		if ( $this->conn->connect_errno ) {
			throw new Exception("Failed to connect to database: " . $this->conn->connect_error);
		}
	}

	public function escape($str) {
		// if the string is null, use the MySQL NULL constant
		if ( is_null($str) ) {
			return 'NULL';
		}
		// otherwise, double quote the string and escape any bad characters
		else {
			return '"' . $this->conn->real_escape_string($str) . '"';
		}
	}

	public function selectOne($sql) {
		if ( $result = $this->conn->query($sql) ) {
			if ( $result->num_rows > 0 ) {
				return $result->fetch_assoc();
			}
		}

		return false;
	}

	public function selectAll($sql) {
		$result = $this->conn->query($sql);

		// create an array to hold the records
		$rows = array();

		// store each record in an associative array called $row
		while ( $row = $result->fetch_assoc() ) {
			// add the $row to the array
			$rows[] = $row;
		}

		return $rows;
	}

	public function query($sql) {
		$result = $this->conn->query($sql);
		$this->insert_id = $this->conn->insert_id;
		return $result;
	}

	public function __call($method, $args=array()) {
		return call_user_func_array(array($this->conn, $method), $args);
	}
}