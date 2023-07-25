<?php

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "urals");

$conn = new mysqli('localhost', 'root', '', 'urals');
if ($conn->connect_error) {
   die('Connection Failed : ' . $conn->connect_error);
}

?>