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
 * Maak een select-query die op basis van een id het record ophaalt
 */
$sql = "SELECT  HAVE.Id
               ,HAVE.NaamAchtbaan
               ,HAVE.NaamPretpark
               ,HAVE.Land
               ,HAVE.Topsnelheid
               ,HAVE.Hoogte
        
        FROM HoogsteAchtbaanVanEuropa AS HAVE
        
        WHERE HAVE.Id = :id";

$statement = $pdo->prepare($sql);

var_dump($_GET);

$statement->bindValue(':id', $_GET['id'], PDO::PARAM_INT);

$statement->execute();

$result = $statement->fetch(PDO::FETCH_OBJ);

var_dump($result);

echo $result->NaamAchtbaan;



?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>

    

    <div class="container mt-4">

    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <h3 class="text-primary">Wijzig achtbaangegevens</h3>
        </div>
        <div class="col-3"></div>
    </div>

    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <form action="create.php" method="POST">
                <div class="mb-3">
                    <label for="inputNaamAchtbaan" class="form-label">Naam Achtbaan:</label>
                    <input name="naamAchtbaan" placeholder="Vul de naam van de achtbaan in" type="text" class="form-control" id="inputNaamAchtbaan" value="<?= $result->NaamAchtbaan;  ?>">
                </div>
                <div class="mb-3">
                    <label for="inputNaamPretpark" class="form-label">Naam Pretpark:</label>
                    <input name="naamPretpark" placeholder="Vul de naam van de achtbaan in" type="text" class="form-control" id="inputNaamPretpark">
                </div>
                <div class="mb-3">
                    <label for="inputLand" class="form-label">Land:</label>
                    <input name="land" placeholder="Vul de naam van het land in" type="text" class="form-control" id="inputLand">
                </div>
                <div class="mb-3">
                    <label for="inputTopsnelheid" class="form-label">Topsnelheid:</label>
                    <input name="topsnelheid" placeholder="Vul de topsnelheid in" type="number" min="0" max="255" class="form-control" id="inputTopsnelheid">
                </div>
                <div class="mb-3">
                    <label for="inputHoogte" class="form-label">Hoogte:</label>
                    <input name="hoogte" placeholder="Vul de hoogte in" type="number" min="0" max="255" class="form-control" id="inputHoogte">
                </div>
                <div class="d-grid gap-2">
                    <button name="submit" type="submit" class="btn btn-primary btn-lg mt-2">Verstuur</button>
                </div>
            </form>
          </div>
          <div class="col-3"></div>
        </div>




    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>