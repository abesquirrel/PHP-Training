<?php
/* Defining credentials, server name and database */
const DB_SERVER = '172.17.0.1';
const DB_USERNAME = 'root';
const DB_PASSWORD = 'docker';
const DB_NAME = 'loginapp';

/* Attempt to connect to MariaDB database*/
try {
	$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
} catch (mysqli_sql_exception $e) {
	echo "Failed to connect to database: " . $e->getMessage();
}

function function_alert($msg) {
	echo "<script type='text/javascript'>alert('$msg');</script>";
}