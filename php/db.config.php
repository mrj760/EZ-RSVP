<?php
//Establish all vars needed to connect to DB
$HOST = "localhost";
$PORT = "5432";
$USER = "events";
$PASSWORD = "Testing123!";
$DB = "events";

//Create new connection for php to communicate with postgresql db
$CONNECTION = pg_connect("host=$HOST port=$PORT dbname=$DB user=$USER password=$PASSWORD connect_timeout=3");

if (!$CONNECTION) {
	echo "Failed to connect to database";
	exit;
}

//No error means it successfully connected
?>
