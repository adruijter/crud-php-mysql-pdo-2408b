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


if (isset($_POST['submit'])) {

    /**
     * We gaan de $_POST waarden schoonmaken met de functie
     * filter_input_array. Deze functie filtert de waarden van een
     * array met een opgegeven filter. In dit geval FILTER_SANITIZE_STRING
     */
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    /**
     * Var_dump om te testen of de $_POST goed gevuld is
     */
    // var_dump($_POST);

        /**
     * Maak een update-query die de gegevens uit het formulier in de tabel zet
     * van de database
     */
    $sql = "UPDATE HoogsteAchtbaanVanEuropa AS HAVE
            SET    HAVE.NaamAchtbaan = :naamAchtbaan
                  ,HAVE.NaamPretpark = :naamPretpark
                  ,HAVE.Land         = :land
                  ,HAVE.Topsnelheid  = :topsnelheid
                  ,HAVE.Hoogte       = :hoogte
                  ,HAVE.Bouwjaar     = :bouwjaar
            
            WHERE  HAVE.Id = :id";

    /**
     * Bereidt de sql-query voor voor uitvoering in PDO
     * en stop het resultaat in een variabele $statement
     */
    $statement = $pdo->prepare($sql);


    /**
     * Koppel de waarden uit het formulier aan de query
     */
    $statement->bindValue(':naamAchtbaan', $_POST['naamAchtbaan'], PDO::PARAM_STR);
    $statement->bindValue(':naamPretpark', $_POST['naamPretpark'], PDO::PARAM_STR);
    $statement->bindValue(':land', $_POST['land'], PDO::PARAM_STR);
    $statement->bindValue(':topsnelheid', $_POST['topsnelheid'], PDO::PARAM_INT);
    $statement->bindValue(':hoogte', $_POST['hoogte'], PDO::PARAM_INT);
    $statement->bindValue(':id', $_POST['Id'], PDO::PARAM_INT);
    $statement->bindValue(':bouwjaar', $_POST['bouwjaar'], PDO::PARAM_STR);

    /**
     * Voer nu de gepreparede sql-query uit op de database
     */
    $result = $statement->execute();
    
    // var_dump($result);
    /**
     * Stuur de gebruiker terug naar de index.php
     */
    if ($result) {
        $display = 'flex';
        $message = 'Het record is gewijzigd';
    } else {
        $display = 'flex';
        $message = 'Er is iets misgegaan met het wijzigen van het record';
    }

    header('Refresh:4; url=index.php');    
} else {


/**
 * Maak een select-query die op basis van een id het record ophaalt
 */
$sql = "SELECT  HAVE.Id
               ,HAVE.NaamAchtbaan
               ,HAVE.NaamPretpark
               ,HAVE.Land
               ,HAVE.Topsnelheid
               ,HAVE.Hoogte
               ,HAVE.Bouwjaar
        
        FROM HoogsteAchtbaanVanEuropa AS HAVE
        
        WHERE HAVE.Id = :id";

/**
 * Met de method prepare van het pdo-object maak je de sql-query geschikt voor gebruik in 
 * het PDO-object. De gepreparede sql-query stoppen we in de variabele $statement
 */
$statement = $pdo->prepare($sql);

/**
 * Koppel de id aan de query
 */
$statement->bindValue(':id', $_GET['id'], PDO::PARAM_INT);

/**
 * Voer nu de gepreparede sql-query uit op de database
 */
$statement->execute();

/**
 * Haal de geselecteerde record binnen als een object en stop deze in de variabele $result
 */

$result = $statement->fetch(PDO::FETCH_OBJ);

}
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
  <body>

    

    <div class="container mt-4">
    <div class="row" style="display:<?= $display ?? 'none'; ?>">
        <div class="col-3"></div>
        <div class="col-6">
            <div class="alert alert-success text-center" role="alert">
                Het record is gewijzigd
            </div>
        </div>
        <div class="col-3"></div>
    </div>

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
            <form action="update.php" method="POST">
                <div class="mb-3">
                    <label for="inputNaamAchtbaan" class="form-label">Naam Achtbaan:</label>
                    <input name="naamAchtbaan" placeholder="Vul de naam van de achtbaan in" type="text" class="form-control" id="inputNaamAchtbaan" value="<?= $result->NaamAchtbaan ?? $_POST['naamAchtbaan']; ?>">
                </div>
                <div class="mb-3">
                    <label for="inputNaamPretpark" class="form-label">Naam Pretpark:</label>
                    <input name="naamPretpark" placeholder="Vul de naam van de achtbaan in" type="text" class="form-control" id="inputNaamPretpark" value="<?= $result->NaamPretpark ?? $_POST['naamPretpark']; ?>" >
                </div>
                <div class="mb-3">
                    <label for="inputLand" class="form-label">Land:</label>
                    <input name="land" placeholder="Vul de naam van het land in" type="text" class="form-control" id="inputLand" value="<?= $result->Land ?? $_POST['land']; ?>">
                </div>
                <div class="mb-3">
                    <label for="inputTopsnelheid" class="form-label">Topsnelheid:</label>
                    <input name="topsnelheid" placeholder="Vul de topsnelheid in" type="number" min="0" max="255" class="form-control" id="inputTopsnelheid" value="<?= $result->Topsnelheid ?? $_POST['topsnelheid']; ?>">
                </div>
                <div class="mb-3">
                    <label for="inputHoogte" class="form-label">Hoogte:</label>
                    <input name="hoogte" placeholder="Vul de hoogte in" type="number" min="0" max="255" class="form-control" id="inputHoogte" value="<?= $result->Hoogte ?? $_POST['hoogte']; ?>">
                </div>
                <div class="mb-3">
                    <label for="inputBouwjaar" class="form-label">Bouwjaar:</label>
                    <input name="bouwjaar" placeholder="Vul het bouwjaar in" type="date" min="1900-01-01"  class="form-control" id="inputHoogte" value="<?= $result->Bouwjaar ?? $_POST['bouwjaar']; ?>">
                </div>
                <input type="hidden" name="Id" value="<?= $result->Id ?? $_POST['Id']; ?>">
                <div class="d-grid gap-2">
                    <button name="submit" type="submit" class="btn btn-primary btn-lg mt-2" value="submit">Wijzig</button>
                </div>
            </form>
          </div>
          <div class="col-3"></div>
        </div>

        <div class="row mt-3">
            <div class="col-3"></div>
            <div class="col-6">
                <a href="index.php">
                    <i class="bi bi-arrow-left-square-fill text-danger" style="font-size:1.5em"></i>
                </a>
            </div>
            <div class="col-3"></div>
        </div>




    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>