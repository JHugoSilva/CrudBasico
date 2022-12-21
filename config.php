<?php

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);

$dbName = "teste";
$dbHost = "localhost";
$dbUser = "hugox";
$dbPass = "123";

try {
    $pdo = new PDO("mysql:dbname={$dbName};host={$dbHost}", "{$dbUser}", "{$dbPass}");
} catch (\PDOException $e) {
    echo "ERRO BANCO: " . $e->getMessage();
}
