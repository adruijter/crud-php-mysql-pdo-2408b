<?php
  if (isset($_POST['submit'])) {

    // var_dump($_POST);
  /**
   * De inloggegevens van de gebruiker van de database binnenhalen
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
   * We gaan de $_POST waarden schoonmaken met de functie
   * filter_input_array. Deze functie filtert de waarden van een
   * array met een opgegeven filter. In dit geval FILTER_SANITIZE_STRING
   */
  $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  /**
   * Maak een insert-query die de gegevens uit het formulier in de tabel zet
   * van de database
   */
  // Opdrachtje maak een insert query...
  $sql = "INSERT INTO HoogsteAchtbaanVanEuropa
          (
               NaamAchtbaan        
              ,NaamPretPark        
              ,Land                
              ,Topsnelheid         
              ,Hoogte              
              ,IsActief                
              ,Opmerking
              ,DatumAangemaakt     
              ,DatumGewijzigd
          )
          VALUES
          (    :naamAchtbaan
              ,:naamPretpark
              ,:land
              ,:topsnelheid
              ,:hoogte
              ,1 
              ,NULL
              ,SYSDATE(6) 
              ,SYSDATE(6)
          )";

  /**
   * Bereidt de sql-query voor voor uitvoering in PDO
   */
  $statement = $pdo->prepare($sql);

  $statement->bindValue(':naamAchtbaan', $_POST['naamAchtbaan'], PDO::PARAM_STR);
  $statement->bindValue(':naamPretpark', $_POST['naamPretpark'], PDO::PARAM_STR);
  $statement->bindValue(':land', $_POST['land'], PDO::PARAM_STR);
  $statement->bindValue(':topsnelheid', $_POST['topsnelheid'], PDO::PARAM_INT);
  $statement->bindValue(':hoogte', $_POST['hoogte'], PDO::PARAM_INT);

  /**
   * Voer de gepreparede sql-query uit
   */
  $statement->execute();

  /**
   * Geef een melding dat de gegevens zijn toegevoegd
   */
  echo "De gegevens zijn toegevoegd";

  header('Refresh:3; index.php');
  }
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
            <div class="col-3"></div>
            <div class="col-6"><h3 class="text-primary">Voer een nieuwe achtbaan in:</h3></div>
            <div class="col-3"></div>
        </div>

        <div class="row">
          <div class="col-3"></div>
          <div class="col-6">
            <form action="create.php" method="POST">
                <div class="mb-3">
                    <label for="inputNaamAchtbaan" class="form-label">Naam Achtbaan:</label>
                    <input name="naamAchtbaan" placeholder="Vul de naam van de achtbaan in" type="text" class="form-control" id="inputNaamAchtbaan">
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
  