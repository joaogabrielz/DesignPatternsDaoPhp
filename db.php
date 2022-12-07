<?php

ini_set('display_errors', 1);

$db = '';
$host = '';
$user = '';
$pass = '';

$conn = new PDO("mysql:dbname=$db;host=$host", $user, $pass);

