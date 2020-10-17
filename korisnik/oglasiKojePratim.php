<?php
// inicijalizujemo cas
session_start();
 
// da li je korisnik loginovan ako ne vrati ga nazad
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../prijava.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Berza - Klijent panel</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-dark border-right" id="sidebar-wrapper">
      <div class="list-group list-group-flush">
        <a style="color:white;" href="mojprofil.php" class="list-group-item list-group-item-action bg-dark">Početna <i class="lnr lnr-home"></i> </a>
        <a style="color:white;" href="oglasiKojePratim.php" class="list-group-item list-group-item-action bg-dark">Oglasi koje pratim <i class="lnr lnr-heart"></i> </a>
        <a style="color:white;" href="konkurisaniOglasi.php" class="list-group-item list-group-item-action bg-dark">Konkurisani oglasi <i class="lnr lnr-chevron-up"></i> </a>
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
          <h2>Oglasi koje pratim</h2>
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="../logout.php">Odjava <span class="sr-only">(current)</span></a>
            </li>
          </ul>
        </div>
      </nav>

  <div class="card mb-3">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID oglasa </th>
                        <th>Naslov</th>
                        <th>Opis oglasa</th>
                        <th>Tip oglasa</th>
                        <th>Id kategorije</th>
                        <th>Aktivan do</th>
                        <th>PoslodavacId</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID oglasa </th>
                        <th>Naslov</th>
                        <th>Opis oglasa</th>
                        <th>Tip oglasa</th>
                        <th>Id kategorije</th>
                        <th>Aktivan do</th>
                        <th>PoslodavacId</th>
                        <th>Status</th>
                    </tr>
                </tfoot>
                <tbody>
                        <tr>
                          <?php
                            $korUser = $_SESSION['username'];
                            $mysqli = new mysqli('localhost', 'root', '', 'itberza') or die($mysqli->error);
                            $result = $mysqli -> query("SELECT * FROM korisnik_oglas
                            JOIN korisnik on korisnik_oglas.korisnik_user=korisnik.idKorisnika
                            JOIN oglas on korisnik_oglas.oglasid_fk=oglas.idOglasa  WHERE korisnik_user = '$korUser'
                            AND aktivan = 1");
                            if($result->num_rows>=1)
                            {
                              $message="";
                              while($row=$result->fetch_assoc())
                              {
                              $message.="<tr>".
                              "<td>".$row['oglasid_fk']."</td>".
                              "<td>".$row['naslov']."</td>".
                              "<td>".$row['opis']."</td>".
                              "<td>".$row['tipOglasa']."</td>".
                              "<td>".$row['kategorijaId']."</td>".
                              "<td>".$row['trajeDo']."</td>".
                              "<td>".$row['poslodavacId']."</td>".
                              "<td>".$row['aktivan']."</td>";
                              }
                              echo $message;
                            }
                          ?>
                        </tr>
                </tbody>
            </table>
        </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>