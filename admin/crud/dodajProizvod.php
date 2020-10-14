<?php
// inicijalizujemo cas
session_start();
 
// da li je korisnik loginovan ako ne vrati ga nazad
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../index.php");
    exit;
}
?>

<?php 
  $con = new mysqli('localhost', 'root', '', 'itberza') or die(mysqli_error);

  if(isset($_POST['AddProizvod'])){
    $pId = rand(1, 10000);
    $naziv = $_POST['naziv'];
    $cena = $_POST['cena'];
    $jedMer = $_POST['jedMera'];
    $slika = $_POST['slika'];

    $query = "INSERT INTO proizvod(id, naziv, jedMera, cena, slika) VALUES ('$pId','$naziv', '$jedMer', '$cena', '$slika')";

    if(mysqli_query($con, $query)){
        echo '<script>alert("Proizvod dodat!")</script>';
        echo '<script>window.location="../proizvodi.php"</script>';
    }
    else{
        echo '<script>alert("Neuspesno dodavanje!")</script>';
        echo '<script>window.location="../proizvodi.php"</script>';
    }
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
        <a style="color:white;" href="../dobrodosli.php" class="list-group-item list-group-item-action bg-dark">Dashboard</a>
        <a style="color:white;" href="../korisnici.php" class="list-group-item list-group-item-action bg-dark">Korisnici</a>
        <a style="color:white;" href="../proizvodi.php" class="list-group-item list-group-item-action bg-dark">Proizvodi</a>
        <a style="color:white;" href="../narudzbenice.php" class="list-group-item list-group-item-action bg-dark">Narudzbenice</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <a href="welcome.php" class="navbar-brand"><img class="img-fulid" src="../../img/footicon2.png" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="../logout.php">Odjava <span class="sr-only">(current)</span></a>
            </li>
          </ul>
        </div>
      </nav>

    <section id="nalog">
      <form name='nalog' id="forma" action="" method="POST">
        <div class="container">
          <div class="form-row">

            <div class="form-group col-md-6">
              <label for="naziv">Naziv</label>
              <input type="text" class="form-control" name="naziv" id="naziv" placeholder="Naziv" value=''>
            </div>
            
            <div class="form-group col-md-6">
              <label for="cena">Cena</label>
              <input type="text" class="form-control" name="cena" id="cena" placeholder="Cena" value=''>
          </div>

            <div class="form-group col-md-6">
              <label for="jedMera">Jedinicna mera</label>
              <input type="text" class="form-control" name="jedMera" id="jedMera" placeholder="Jedinicna mera" value=''>
            </div>
            
            <div class="form-group col-md-6">
              <label for="slika">Slika</label>
              <input type="text" class="form-control" name="slika" id="slika" placeholder="Slika" value=''>
            </div>
          </div>
         
           <center><button type="submit" id="submitEdit" name="AddProizvod" class="btn btn-primary btn-block">Unesi</button></center>
        </div>
    </form>  

    </section>
</div>
</body>
</html>


