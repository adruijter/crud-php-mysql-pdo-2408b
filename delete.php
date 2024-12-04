<?php
/**
 * De inloggegevens van de gebruiker van de database
 */
include('config/config.php');

/**
 * We gaan gebruikmaken van PDO (PHP-DataObjects) en die wil de
 * inloggegevens in een dsn-string (data-sourcenamestring) hebben
 */
$dsn = "mysql:host=$dbHost;
        dbname=$dbName;
        charset=UTF8";

/**
 * Maak een nieuw PDO-object om gegevens te kunnen deleten
 */      
$pdo = new PDO($dsn, $dbUser, $dbPass);

/**
 * Maak een delete-query die de gegevens uit de tabel verwijderd
 */
$sql = "DELETE FROM HoogsteAchtbaanVanEuropa
        WHERE Id = :id";

/**
 * Bereidt de sql-query voor voor uitvoering in PDO
 */
$statement = $pdo->prepare($sql);

/**
 * Koppel de id aan de query
 */
$statement->bindParam(':id', $_GET['id'], PDO::PARAM_INT);

/**
 * Voer nu de gepreparde sql-query uit op de database
 */
$statement->execute();

/**
 * Geef een melding dat de gegevens verwijderd zijn * 
 */
 echo "Gegevens zijn verwijderd";

/**
 * Stuur de gebruiker terug naar de index.php
 */
header('Refresh: 3; url=index.php');




