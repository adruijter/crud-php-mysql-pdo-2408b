<?php
/**
 * Haal de inloggegevens op uit het bestand config.php
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
 * Maak een nieuw PDO-object zodat we een verbinding hebben met onze database
 */       
$pdo = new PDO($dsn, $dbUser, $dbPass);

/**
 * Maak een select-query die alle gegevens uit de de tabel HoogsteAchtbaanVanEuropa
 * haalt. Sorteer op op hoogte aflopend
 */

$sql = "SELECT  HAVE.Id
               ,HAVE.NaamAchtbaan
               ,HAVE.NaamPretpark
               ,HAVE.Land
               ,HAVE.Topsnelheid
               ,HAVE.Hoogte
               ,DATE_FORMAT(HAVE.Bouwjaar, '%d-%m-%Y') AS Bouwjaar
        
        FROM HoogsteAchtbaanVanEuropa AS HAVE
        
        ORDER BY Hoogte DESC" ;

/**
 * Met de method prepare van het pdo-object maak je de sql-query
 * klaar voor het PDO-object om uitgevoerd te worden. De gepreparde
 * sql-query stoppen we in de variabele $statement
 */

$statement = $pdo->prepare($sql);

/**
 * Voer nu de geprepardesql-quert uit op de database
 */
$statement->execute();

/**
 * Haal de geselecteerde records binnen als objecten in een array
 * en stop deze in een variabele $result
 */
$result = $statement->fetchAll(PDO::FETCH_OBJ);

/**
 * We tonen even de resultaten op het scherm zodat we weten wat we 
 * opgehaald hebben uit de database
 */
// var_dump($result);



?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hoogste Achtbanen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  </head>
  <body>
    <div class="container mt-3">
        
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10"><h3 class="text-primary">Hoogste achtbanen van Europa</h3></div>
            <div class="col-1"></div>
        </div>

        <div class="row">
          <div class="col-1"></div>
          <div class="col-3"><h6>Nieuwe achtbaan <a href="./create.php"><i class="bi bi-plus-square text-danger"></i></a></h5></div>
          <div class="col-2"></div>
        </div>

        <div class="row">
          <div class="col-1"></div>
          <div class="col-10">
              <table class="table table-hover">
                <thead>
                    <th>Naam Achtbaan</th>
                    <th>Naam Pretpark</th>
                    <th>Land</th>
                    <th>Topsnelheid</th>
                    <th>Hoogte</th>
                    <th>Bouwjaar</th>
                    <th>Update</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                    <?php foreach ($result as $row) : ?>
                        <tr>
                            <td><?= $row->NaamAchtbaan ?></td>
                            <td><?= $row->NaamPretpark ?></td>
                            <td><?= $row->Land ?></td>
                            <td class="text-center"><?= $row->Topsnelheid ?></td>
                            <td class="text-center"><?= $row->Hoogte ?></td>
                            <td><?= $row->Bouwjaar; ?></td>
                            <td class="text-center">
                              <a href="update.php?id=<?= $row->Id; ?>">
                                  <i class="bi bi-pencil-square text-primary"></i>
                              </a>
                            </td>
                            <td class="text-center">
                              <a href="delete.php?id=<?= $row->Id; ?>">
                                <i class="bi bi-x-square text-danger"></i>
                              </a>
                            </td>
                        </tr>
                    <?php endforeach;  ?>
                </tbody>
              </table>
          </div>
          <div class="col-1"></div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html> 
  