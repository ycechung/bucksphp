<?php

/**
 * Database wrapper class
 *
 **/
class DB {
	/**
	 * Internal MySQLi connection
	 *
	 * @var mysqli
	 **/
	private $conn;

	/**
	 * The ID of the last created record (used to maintain compatability with mysqli)
	 *
	 * @var integer
	 **/
	public $insert_id = null;

	/**
	 * Create database connection. Throws generic exception on connect error.
	 *
	 * @var string $host - Database host
	 * @var string $user - Database username
	 * @var string $password - Database password
	 * @var string $database - Database name
	 **/
	public function __construct($host, $user, $password, $database) {
		// connect to the mysql server
		$this->conn = new mysqli($host, $user, $password, $database);

		// if the connection fails, an error message will be set
		// check for that error message and kill the script if it exists
		if ( $this->conn->connect_errno ) {
			throw new Exception("Failed to connect to database: " . $this->conn->connect_error);
		}
	}

	/**
	 * Escape a string for use in a query
	 *
	 * @var string $str - String to escape
	 * @return string
	 **/
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

	/**
	 * Select a single record based on a given query
	 *
	 * @var string $sql - The SQL query
	 * @return array
	 **/
	public function selectOne($sql) {
		if ( $result = $this->conn->query($sql) ) {
			if ( $result->num_rows > 0 ) {
				return $result->fetch_assoc();
			}
		}

		return false;
	}

	/**
	 * Select multiple records based on a given query
	 *
	 * @var string $sql - The SQL query
	 * @return array
	 **/
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

	/**
	 * Perform a database query and return the result
	 *
	 * @var string $sql - The SQL query
	 * @return mixed
	 **/
	public function query($sql) {
		$result = $this->conn->query($sql);
		$this->insert_id = $this->conn->insert_id;
		return $result;
	}

	/**
	 * Forward all methods that don't exist on to the internal mysqli connection
	 *
	 * @var string $method - Method name
	 * @var array $args - (optional) Arguments to pass to method
	 * @return mixed
	 **/
	public function __call($method, $args=array()) {
		return call_user_func_array(array($this->conn, $method), $args);
	}
}