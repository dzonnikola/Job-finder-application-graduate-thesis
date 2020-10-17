<?php
// inicijalizujemo cas
session_start();

$db = new mysqli('localhost', 'root', '', 'itberza') or die($mysqli->error);
 
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
    <title>IT Berza - Poslodavac panel</title>
    <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/sidebar.css">
<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-dark border-right" id="sidebar-wrapper">
      <div class="list-group list-group-flush">
        <a style="color:white;" href="dobrodosli.php" class="list-group-item list-group-item-action bg-dark">Početna</a>
        <a style="color:white;" href="oglasi.php" class="list-group-item list-group-item-action bg-dark">Moji oglasi</a>
        <a style="color:white;" href="aktivniOglasi.php" class="list-group-item list-group-item-action bg-dark">Aktivni oglasi</a>
        <a style="color:white;" href="neaktivniOglasi.php" class="list-group-item list-group-item-action bg-dark">Neaktivni oglasi</a>
        <a style="color:white;" href="pregledPrijava.php" class="list-group-item list-group-item-action bg-dark">Pregled prijava</a>
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
          <h2>Pregled pristiglih prijava</h2>
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="logout.php">Odjava <span class="sr-only">(current)</span></a>
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
                        <th>ID prijave</th>
                        <th>Ime i prezime kandidata</th>
                        <th>Mail</th>
                        <th>Telefon</th>
                        <th>CV</th>
                        <th>ID i naslov oglasa</th>
                        <th>Traje do</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID prijave</th>
                        <th>Ime i prezime kandidata</th>
                        <th>Mail</th>
                        <th>Telefon</th>
                        <th width="10%">CV</th>
                        <th>ID i naslov oglasa</th>
                        <th>Traje do</th>
                    </tr>
                </tfoot>
                <tbody>
                        <tr>
                          <?php
                            $poslodavacuser = $_SESSION['username'];

                            $query = "SELECT * FROM prijava 
                            JOIN poslodavac on prijava.poslodavac_id=poslodavac.idPoslodavca 
                            JOIN korisnik on prijava.korisnik_user=korisnik.idKorisnika
                            JOIN oglas on prijava.oglas_id=oglas.idOglasa
                            WHERE poslodavac.user='$poslodavacuser' AND oglas.aktivan = 1";

                            $result = mysqli_query($db, $query) or die(mysqli_error($db));
                            if($result->num_rows>=1)
                            {
                              $message="";
                              while($row=$result->fetch_assoc())
                              {
                              $message.="<tr>".
                              "<td>".$row['idPrijave']."</td>".
                              "<td>".$row['ime']." ".$row['prezime']."</td>".
                              "<td><a href='mailto:".$row['email']."' target='_blank'>".$row['email']."</a></td>".
                              "<td>".$row['telefon']."</td>".
                              "<td><a href='../../media/resume/".$row['cv_file']."' target='_blank'>".$row['cv_file']."</a></td>".
                              "<td><a href='../../oglas.php?oId=".$row['idOglasa']."' target='_blank'>".$row['naslov']."</a></td>".
                              "<td>".$row['trajeDo']."</td>";
                              }
                              echo $message;
                            }
                          ?>
                        </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>
</body>
</html>