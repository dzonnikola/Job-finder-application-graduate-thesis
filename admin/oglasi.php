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
    <title>IT Berza - Admin panel</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/sidebar.css">
<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-dark border-right" id="sidebar-wrapper">
      <div class="list-group list-group-flush">
        <a style="color:white;" href="dobrodosli.php" class="list-group-item list-group-item-action bg-dark">Dashboard</a>
        <a style="color:white;" href="oglasi.php" class="list-group-item list-group-item-action bg-dark">Oglasi</a>
        <a style="color:white;" href="korisnici.php" class="list-group-item list-group-item-action bg-dark">Korisnici</a>
        <a style="color:white;" href="poslodavci.php" class="list-group-item list-group-item-action bg-dark">Poslodavci</a>
        <a style="color:white;" href="kategorije.php" class="list-group-item list-group-item-action bg-dark">Kategorije</a>
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
          <h2>Pregled oglasa</h2>
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="logout.php">Odjava <span class="sr-only">(current)</span></a>
            </li>
          </ul>
        </div>
      </nav>

  <div class="card mb-3">
    <div class="card-header">
    <form method="GET" action="crud/brisiOglas.php">
        <input type="submit" name="brisiOglas" class="btn btn-danger pull-right" value="Obrisi oglas"> 
        <input type="text" placeholder="ID oglasa" name="id">
    </form>
    </div>
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
                    </tr>
                </tfoot>
                <tbody>
                        <tr>
                          <?php

                            $mysqli = new mysqli('localhost', 'root', '', 'itberza') or die($mysqli->error);
                            $result = $mysqli -> query("SELECT * FROM oglas") or die(mysqli_error($db));;
                            if($result->num_rows>=1)
                            {
                              $message="";
                              while($row=$result->fetch_assoc())
                              {
                              $message.="<tr>".
                              "<td>".$row['idOglasa']."</td>".
                              "<td>".$row['naslov']."</td>".
                              "<td>".$row['opis']."</td>".
                              "<td>".$row['tipOglasa']."</td>".
                              "<td>".$row['kategorijaId']."</td>".
                              "<td>".$row['trajeDo']."</td>".
                              "<td>".$row['poslodavacId']."</td>";
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