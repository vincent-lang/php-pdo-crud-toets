<?php

require("config.php");

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    if ($pdo) {
        echo "Er is verbinding gemaakt met de MySQL database";
    } else {
        echo "Internal server error, contact database admin";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}