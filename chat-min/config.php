<?php

$user_table = 'users';

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'application';


$connection = new mysqli($host , $username , $password , $database);

if ($connection->connect_error) {
  die("Connection failed: " . $connection->connect_error);
}

?>