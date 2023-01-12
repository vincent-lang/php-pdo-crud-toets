<?php

echo "Het id is: " . $_GET['id'] . "<br>";

require('config.php');

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass);

    if ($pdo) {
        echo "Er is een verbinding gemaakt met de database<br>";
    } else {
        echo "Internal server error<br>";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

$sql = "DELETE FROM DureAuto
        WHERE Id = :SQLId";

$statement = $pdo->prepare($sql);

$statement->bindValue(':SQLId', $_GET['id'], PDO::PARAM_INT);

$result = $statement->execute();

if ($result) {
    echo "Record is succesvol verwijderd";
    header('Refresh:3;url=read.php');
} else {
    echo "Internal server error, record is niet verwijderd";
    header('Refresh:3;url=read.php');
}