<?php

$dsn='mysql:host=127.0.0.1;dbname=topsite';
$username='mysql';
$pass='mysql';

try {
$connection = new PDO($dsn, $username, $pass);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $exception){
throw new \InvalidArgumentException($exception->getMessage());
}