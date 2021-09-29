<?php
session_start();
$dbHost = 'localhost';
$dbName = 'nodeapp';
$dbPassword = '';
$dbUsername = 'root';
$conn = mysqli_connect($dbHost, $dbName, $dbUsername, $dbPassword);
?>