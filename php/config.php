<?php
session_start();
$dbHost = 'localhost';
$dbName = 'nodeapp';
$dbPassword = '';
$dbUsername = 'root';
$dbc = mysqli_connect($dbHost, $dbName, $dbUsername, $dbPassword);
?>