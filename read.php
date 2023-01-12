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

$sql = "SELECT Id
            ,Merk
            ,Model
            ,Topsnelheid
            ,Prijs
            FROM DureAuto
            ORDER BY Prijs desc";

$statement = $pdo->prepare($sql);

$statement->execute();

$result = $statement->fetchAll(pdo::FETCH_OBJ);

$rows = "";
foreach ($result as $info) {
    $rows .= "<tr>
                <td>$info->Id</td>
                <td>$info->Merk</td>
                <td>$info->Model</td>
                <td>$info->Topsnelheid</td>
                <td>$info->Prijs</td>
                <td>
                    <a href='delete.php?id={$info->Id}'>
                        <img src='img/b_drop.png' alt='drop'</img>
                    </a>
                </td>
            </tr>";
}

?>

<a href="index.html">Home Page</a>
<h3>De vijf duurste auto's ter wereld</h3>
<table border="1">
    <thead>
        <th>Id</th>
        <th>Merk</th>
        <th>Model</th>
        <th>Topsnelheid</th>
        <th>Prijs</th>
        <th>Delete</th>
    </thead>
    <tbody>
        <?= $rows; ?>
    </tbody>
</table>