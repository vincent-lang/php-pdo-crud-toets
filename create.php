<?php

require("config.php");

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    if ($pdo) {
    } else {
    }
} catch(PDOException $e) {
    echo $e->getMessage();
}

$sql = "INSERT INTO DureAuto (Id
                            ,Merk
                            ,Model
                            ,Topsnelheid
                            ,Prijs)
                    VALUES  (NULL
                            ,:Merk
                            ,:Model
                            ,:Topsnelheid
                            ,:Prijs);";
$statement = $pdo->prepare($sql);

$statement->bindValue(":Merk", $_POST['Merk'], PDO::PARAM_STR);
$statement->bindValue(":Model", $_POST['Model'], PDO::PARAM_STR);
$statement->bindValue(":Topsnelheid", $_POST['Topsnelheid'], PDO::PARAM_STR);
$statement->bindValue(":Prijs", $_POST['Prijs'], PDO::PARAM_STR);

$statement->execute();

header("location: read.php");