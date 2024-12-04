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
            <form>
                <div class="mb-3">
                    <label for="inputNaamAchtbaan" class="form-label">Naam Achtbaan:</label>
                    <input placeholder="Vul de naam van de achtbaan in" type="text" class="form-control" id="inputNaamAchtbaan">
                </div>
                <div class="mb-3">
                    <label for="inputNaamAchtbaan" class="form-label">Naam Pretpark:</label>
                    <input placeholder="Vul de naam van de achtbaan in" type="text" class="form-control" id="inputNaamAchtbaan">
                </div>
                <div class="mb-3">
                    <label for="inputLand" class="form-label">Land:</label>
                    <input placeholder="Vul de naam van het land in" type="text" class="form-control" id="inputLand">
                </div>
                <div class="mb-3">
                    <label for="inputTopsnelheid" class="form-label">Topsnelheid:</label>
                    <input placeholder="Vul de topsnelheid in" type="number" min="0" max="255" class="form-control" id="inputTopsnelheid">
                </div>
                <div class="mb-3">
                    <label for="inputHoogte" class="form-label">Hoogte:</label>
                    <input placeholder="Vul de hoogte in" type="number" min="0" max="255" class="form-control" id="inputHoogte">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
          <div class="col-3"></div>
        </div>

    </div>


    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html> 
  