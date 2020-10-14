<?php
// inicijalizujemo cas
session_start();
 
// da li je korisnik loginovan ako ne vrati ga nazad
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../prijava.php");
    exit;
}
?>

<?php
  $poslodavacuser = $_SESSION['username'];
  $mysqli = new mysqli('localhost', 'root', '', 'itberza') or die($mysqli->error);
  $result = $mysqli -> query("SELECT * FROM oglas JOIN poslodavac on oglas.poslodavacId=poslodavac.idPoslodavca 
    WHERE poslodavac.user='$poslodavacuser' LIMIT 1");
  if($result->num_rows>=1)
  {
    while($row=$result->fetch_assoc())
    {
      $naziv = $row['naziv'];
      $adresa = $row['adresa'];
      $mail = $row['mail'];
      $telefon = $row['telefon'];
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Berza - Poslodavac panel</title>
    <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/sidebar.css">

    <script type="text/javascript">
      
      function checkInput() {
        var naziv = document.getElementById('naziv').value;
        var adresa = document.getElementById('adresa').value;
        var mail = document.getElementById('mail').value;
        var telefon = document.getElementById('telefon').value;

        if(naziv == "" || naziv == null){
            alert("Popunite polje naziv!");
            return false;
        }
        if(adresa == "" || adresa == null){
            alert("Popunite polje adresa!");
            return false;
        }
        if(mail == "" || mail == null){
            alert("Popunite polje mail!");
            return false;
        } 
        if(telefon == "" || telefon == null){
          alert("Popunite polje telefon!");
          return false;
        }
      }
    </script>



<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-dark border-right" id="sidebar-wrapper">
      <div class="list-group list-group-flush">
        <a style="color:white;" href="dobrodosli.php" class="list-group-item list-group-item-action bg-dark">Početna</a>
        <a style="color:white;" href="oglasi.php" class="list-group-item list-group-item-action bg-dark">Moji oglasi</a>
        <a style="color:white;" href="aktivniOglasi.php" class="list-group-item list-group-item-action bg-dark">Aktivni oglasi</a>
        <a style="color:white;" href="neaktivniOglasi.php" class="list-group-item list-group-item-action bg-dark">Neaktivni oglasi</a>
        <a style="color:white;" href="neaktivniOglasi.php" class="list-group-item list-group-item-action bg-dark">Pregled prijava</a>
        <a style="color:white;" href="podesavanja.php" class="list-group-item list-group-item-action bg-dark">Podešavanja</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <h2>Podešavanja</h2>
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="logout.php">Odjava <span class="sr-only">(current)</span></a>
            </li>
          </ul>
        </div>
      </nav>

  <div class="card mb-3">
    <div class="card-header">
      <h3 class="text-center">Izmena podataka kompanije</h3>
    </div>
      <div class="card-body">
          <center>
            <form style="width: 350px;" class="form-group" method="POST" action="izmeniPodatke.php" onsubmit="return checkInput()">
              <label><b>Naziv kompanije:</b></label><br>
              <input type="text" id="naziv" class="form-control" value="<?php echo $naziv; ?>" name="nazivKompanije">
              <label><b>Adresa kompanije:</b></label><br>
              <input type="text" id="adresa" class="form-control" value="<?php echo $adresa; ?>" name="adresaKompanije">
              <label><b>Mail kompanije:</b></label><br>
              <input type="text" id="mail" class="form-control" value="<?php echo $mail; ?>" name="mailKompanije">
              <label><b>Telefon kompanije:</b></label><br>
              <input type="text" id="telefon" class="form-control" value="<?php echo $telefon; ?>" name="telefonKompanije"><br>          
              <input type="submit" class="btn btn-common btn-info" name="izmeniPodatke" value="Sačuvaj izmene">

            </form>
          </center>
      </div>
    </div>
  </div>
</body>
</html>