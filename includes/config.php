<?php 
// Define database connection parameters
define("server", "localhost");
define("username", "root");
define("password", "");
define("db_name", "stjohnmaryvianney");

// Create database connection objects
$connection = new mysqli(server, username, password, db_name);
$connection2 = new mysqli(server, username, password, db_name);
?>
