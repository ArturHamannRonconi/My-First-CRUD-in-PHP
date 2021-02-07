<?php 

$db = "mysql";
$db_name = "dbsql";
$db_host = "localhost";
$db_user = "root";
$db_pass = "";

$pdo = new PDO("{$db}:dbname={$db_name};host={$db_host}", $db_user, $db_pass);