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
  $korisnikuser = $_SESSION['username'];
  $mysqli = new mysqli('localhost', 'root', '', 'itberza') or die($mysqli->error);
  $result = $mysqli -> query("SELECT * FROM korisnik WHERE korisnik.user='$korisnikuser' LIMIT 1");
  if($result->num_rows>=1)
  {
    while($row=$result->fetch_assoc())
    {
      $ime = $row['ime'];
      $prezime = $row['prezime'];
      $email = $row['email'];
      $password = $row['password'];
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Berza - Korisnicki panel</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">

    <script type="text/javascript">
      
      function checkInput() {
        var ime = document.getElementById('ime').value;
        var prezime = document.getElementById('prezime').value;
        var mail = document.getElementById('mail').value;
        var password = document.getElementById('password').value;

        if(ime == "" || ime == null){
            alert("Popunite polje naziv!");
            return false;
        }
        if(prezime == "" || prezime == null){
            alert("Popunite polje adresa!");
            return false;
        }
        if(mail == "" || mail == null){
            alert("Popunite polje mail!");
            return false;
        } 
        if(password == "" || password == null){
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
        <a style="color:white;" href="mojprofil.php" class="list-group-item list-group-item-action bg-dark">Početna <i class="lnr lnr-home"></i> </a>
        <a style="color:white;" href="oglasiKojePratim.php" class="list-group-item list-group-item-action bg-dark">Oglasi koje pratim <i class="lnr lnr-heart"></i> </a>
        <a style="color:white;" href="oglasiKonkurs.php" class="list-group-item list-group-item-action bg-dark">Konkurisani oglasi <i class="lnr lnr-chevron-up"></i> </a>
        <a style="color:white;" href="podesavanja.php" class="list-group-item list-group-item-action bg-dark">Podešavanja <i class="lnr lnr-cog"></i></a>
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
              <a class="nav-link" href="../logout.php">Odjava <span class="sr-only">(current)</span></a>
            </li>
          </ul>
        </div>
      </nav>

  <div class="card mb-3">
    <div class="card-header">
      <h3 class="text-center">Izmena podataka korisnika</h3>
    </div>
      <div class="card-body">
          <center>
            <form style="width: 350px;" class="form-group" method="POST" action="izmeniPodatke.php" onsubmit="return checkInput()">
              <label><b>Ime kornisnika:</b></label><br>
              <input type="text" id="ime" class="form-control" value="<?php echo $ime; ?>" name="imeKorisnika">
              <label><b>Prezime kornisnika:</b></label><br>
              <input type="text" id="prezime" class="form-control" value="<?php echo $prezime; ?>" name="prezimeKorisnika">
              <label><b>Email kornisnika:</b></label><br>
              <input type="text" id="mail" class="form-control" value="<?php echo $email; ?>" name="mailKorisnika">
              <label><b>Password kornisnika:</b></label><br>
              <input type="password" id="password" class="form-control" value="<?php echo $password; ?>" name="password"><br>          
              <input type="submit" class="btn btn-common btn-info" name="izmeniPodatke" value="Sačuvaj izmene">

            </form>
          </center>
      </div>
    </div>
  </div>
</body>
</html>