<?php
$host = 'localhost';
$database = 'global';
$user = 'hashchanov';
$password = 'neto1709';
$link = "mysql:host=$host;dbname=$database;charset=UTF8";
$options = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);
?>
