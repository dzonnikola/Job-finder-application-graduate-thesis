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
          <h2>Pregled kategorija</h2>
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="logout.php">Odjava <span class="sr-only">(current)</span></a>
            </li>
          </ul>
        </div>
      </nav>

      <div class="card mb-3">
        <div class="card-header">
          <a href="crud/dodajKategoriju.php" class="btn btn-success pull-right"> Dodavanje kategorija</a>
          <form method="GET" action="crud/brisiKategoriju.php">
              <input type="submit" name="brisiKategoriju" class="btn btn-danger pull-right" value="Obrisi kategoriju"> 
              <input type="text" size="10" placeholder="ID kategorije" name="id">
          </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID kategorije</th>
                            <th>Naziv kategorije</th>
                            <th>Naziv slike</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID kategorije</th>
                            <th>Naziv kategorije</th>
                            <th>Naziv slike</th>
                        </tr>
                    </tfoot>
                    <tbody>
                            <tr>
                              <?php

                                $mysqli = new mysqli('localhost', 'root', '', 'itberza') or die($mysqli->error);
                                $result = $mysqli -> query("SELECT * FROM kategorije");
                                if($result->num_rows>=1)
                                {
                                  $message="";
                                  while($row=$result->fetch_assoc())
                                  {
                                  $message.="<tr>".
                                  "<td>".$row['idKategorije']."</td>".
                                  "<td>".$row['nazivKategorije']."</td>".
                                  "<td>".$row['slikaKategorije']."</td>";
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

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>