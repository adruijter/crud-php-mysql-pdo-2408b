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
 * Stuur de gebruiker terug naar de index.php
 */
header('Refresh: 3; url=index.php');

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD met PHP en MySQL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <div class="alert alert-success text-center" role="alert">
                    De gegevens zijn verwijderd. U wordt teruggestuurd naar de index-pagina.
                </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>




