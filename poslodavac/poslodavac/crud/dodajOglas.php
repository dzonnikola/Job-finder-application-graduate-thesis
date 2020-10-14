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

  if(isset($_POST['kreirajOglas'])){

    $naslovOglasa = $_POST['naslov'];
    $opisOglasa = $_POST['opis'];
    $kategorijaOglasa = $_POST['kategorija'];
    $tipOglasa = $_POST['tipoglasa'];
    $trajanjeoglasa = $_POST['trajeDo'];

    $query = "INSERT INTO oglas(idOglasa, naslov, opis, tipOglasa, kategorijaId, trajeDo, aktivan, poslodavacId) VALUES ('','$naslovOglasa', '$opisOglasa', '$tipOglasa', '$kategorijaOglasa', '$trajanjeoglasa', 1, '$poslodavacuser')";

    if(mysqli_query($con, $query)){
        echo '<script>alert("Oglas dodat!")</script>';
        echo '<script>window.location="../oglasi.php"</script>';
    }
    else{
        echo '<script>alert("Neuspesno dodavanje!")</script>';
        echo '<script>window.location="../oglasi.php"</script>';
    }
  }
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Berza - Poslodavac panel</title>
    <link rel="stylesheet" type="text/css" href="../../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../../assets/css/sidebar.css">

    <script type="text/javascript">
      
      function checkInput(form) {
        var naslov = form.naziv.value;
        var opis = form.opis.value;
        var kategorija = form.kategorija.value;
        var tip = form.tipoglasa.value;
        var trajeDo = form.trajeDo.value;

        if(naslov == "" || naslov == null){
          alert("Unesite naslov oglasa!");
          return false;
        }
        if(opis == "" || opis == null){
          alert("Unesite opis oglasa!");
          return false;
        }
        if(kategorija == "Odaberi kategoriju.."){
          alert("Unesite kategoriju oglasa!");
          return false;
        }
        if(tip == "Odaberi tip oglasa.."){
          alert("Unesite tip oglasa!");
          return false;
        }
        if(trajeDo == "" || trajeDo == ""){
          alert("Unesite trajanje oglasa!");
          return false;
        }

      }


    </script>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-dark border-right" id="sidebar-wrapper">
      <div class="list-group list-group-flush">
        <a style="color:white;" href="../dobrodosli.php" class="list-group-item list-group-item-action bg-dark">Početna</a>
        <a style="color:white;" href="../oglasi.php" class="list-group-item list-group-item-action bg-dark">Moji oglasi</a>
        <a style="color:white;" href="../aktivniOglasi.php" class="list-group-item list-group-item-action bg-dark">Aktivni oglasi</a>
        <a style="color:white;" href="../neaktivniOglasi.php" class="list-group-item list-group-item-action bg-dark">Neaktivni oglasi</a>
        <a style="color:white;" href="../neaktivniOglasi.php" class="list-group-item list-group-item-action bg-dark">Pregled prijava</a>
        <a style="color:white;" href="../podesavanja.php" class="list-group-item list-group-item-action bg-dark">Podešavanja</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <h2>Kreiraj novi oglas</h2>
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

    <section style="margin-top: 20px;">
      <center>
        <form class="form-group" action="" method="POST" onsubmit="checkInput(this)" style="width: 450px;">
              <label for="naziv">Naslov:</label>
              <input type="text" class="form-control" name="naslov" id="naziv" placeholder="Naslov oglasa...">            
              <label for="opis">Opis:</label>
              <textarea class="form-control" name="opis" id="opis" placeholder="Opis oglasa..." rows="4"></textarea>
              <label for="tipoglasa">Kategorija oglasa:</label>
              <select class="form-control" id="kategorija" name="kategorija">
                <option selected>Odaberi kategoriju..</option>
                <?php
                $queryTip = "SELECT idKategorije, nazivKategorije FROM kategorije";
                $result = mysqli_query($con, $queryTip);

                if($result->num_rows>0){
                  while ($row=$result->fetch_assoc()) {
                ?>               
                <option><?php echo $row['idKategorije']." ". $row['nazivKategorije'];?></option>
                <?php
                  }
                }
                ?>
              </select>
              <label for="tipoglasa">Tip oglasa:</label>
              <select class="form-control" name="tipoglasa">
                <option selected>Odaberi tip oglasa..</option>
                <option>Praksa</option>
                <option>Posao</option>
              </select>
              <label>Traje do:</label>
              <input type="date" class="form-control" name="trajeDo" id="trajedo" placeholder="Popunite trajanje oglasa.."><br>
           <center><button type="submit" id="kreirajOglas" name="kreirajOglas" class="btn btn-primary btn-block">Kreiraj oglas</button></center>
        </form>  
      </center>
    </section>
</div>
</body>
</html>


