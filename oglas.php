<?php
	session_start();

	require_once 'config.php';

	$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die(mysqli_error($db));

	$oglId = $_GET['oId'];

	global $poslodavacId;

	if(isset($_POST['zapratiOglas'])){
		zapratiOglas($db, $oglId);
	}

	if(isset($_POST['posaljiPrijavu'])){
		if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
			echo '<script>alert("Prijavite se kako bi mogli da zapratite oglas!")</script>';
			echo '<script>window.location="prijava.php"</script>';
		}
	}

	if(isset($_POST['finalSaljiPrijavu'])){
		posaljiPrijavu($db, $oglId);
	}


	function zapratiOglas($dbconnection, $oglasId)
	{
		if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
			echo '<script>alert("Prijavite se kako bi mogli da zapratite oglas!")</script>';
			echo '<script>window.location="prijava.php"</script>';
		}
		else{
			
			$queryBeforeInsert = "SELECT * FROM korisnik_oglas WHERE oglasid_fk='$oglasId'";
			$result = mysqli_query($dbconnection, $queryBeforeInsert) or die(mysqli_error($db));
			if($result->num_rows > 0){
				echo '<script>alert("Ovaj oglas je već u zapraćenim oglasima!")</script>';

			}else{
	
				$user = $_SESSION['username'];

				$query = "INSERT INTO korisnik_oglas(id_korisnik_oglas, korisnik_user, oglasid_fk) VALUES ('', '$user','$oglasId')";

				$result = mysqli_query($dbconnection, $query) or die(mysqli_error($db));;

				if($result){
					echo '<script>alert("Dodato u omiljene oglase!")</script>';
				}
				else{
					echo '<script>alert("Greska pri dodavanju, pokusajte ponovo!")</script>';
				}
			}
		}
	}

	function posaljiPrijavu($dbconnection, $oglasId)
	{
		if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
			echo '<script>alert("Prijavite se kako bi mogli da posaljete prijavu!")</script>';
			echo '<script>window.location="prijava.php"</script>';
		}
		else{

			$queryTempPoslodavac = "SELECT * FROM oglas
			JOIN poslodavac on oglas.poslodavacId=poslodavac.idPoslodavca
			WHERE idOglasa = '$oglasId'";

			$result = mysqli_query($dbconnection, $queryTempPoslodavac) or die(mysqli_error($dbconnection));
			$row = mysqli_fetch_array($result);

			$poslodavacTempId = $row['poslodavacId'];


			$user = $_SESSION['username'];
			$targetDir = "media/resume/";
			$fileName = basename($_FILES["cv"]["name"]);
			$targetFilePath = $targetDir . $fileName;
			$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

			if(move_uploaded_file($_FILES["cv"]["tmp_name"], $targetFilePath)){

			$queryBeforeInsert = "SELECT * FROM prijava WHERE oglas_id='$oglasId' AND korisnik_user = '$user'";
			$result = mysqli_query($dbconnection, $queryBeforeInsert) or die(mysqli_error($db));
				if(mysqli_num_rows($result)>0){
					echo '<script>alert("Vec ste konkurisali za ovaj oglas!")</script>';
				}
				else{
					$query = mysqli_query($dbconnection, "INSERT INTO prijava (idPrijave, oglas_id, korisnik_user, poslodavac_id, cv_file) VALUES ('','$oglasId','$user', '$poslodavacTempId', '$fileName')") or die(mysqli_error($dbconnection));
		            if($query){
						echo '<script>alert("Prijava poslata!")</script>';
		            }
		            else{
						echo '<script>alert("Greska pri upisu!")</script>';
		            } 
				}           
	        }
	        else
	        {
				echo '<script>alert("Greska pri uploadovanju fajla!")</script>';
	        }
		}
	}
?>


<!DOCTYPE html>
<html lang="sr">
	<head>
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="assets/css/main.css">
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
		<title>IT berza - portal za pretragu poslova u IT struci</title>
	</head>
	<?php
	 
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		include 'include/navbar.html';
	}
	else{
		include 'include/logged-in-navbar.php';
	}
	?>

	<body>
		<section id="sector">
			<div class="container">      
		        <div class="row justify-content-md-center">
		          <div class="col-lg-12 col-md-12 col-xs-12">
		            <div class="contents text-center">
		              <?php
		              $queryKategorija = "SELECT * FROM oglas
		              JOIN poslodavac on oglas.poslodavacId=poslodavac.idPoslodavca
		              JOIN kategorije on oglas.kategorijaId=kategorije.idKategorije
		              WHERE idOglasa='$oglId' LIMIT 1";
		              $result = mysqli_query($db,$queryKategorija) or die(mysqli_error($db));
		              while ($row = mysqli_fetch_array($result)) {		               	
		              ?>
		              <h1>Oglas: <?php echo $row['naslov'];?></h1>
		              <hr class="lines w-50"><br>
		              <div class="row">
		              	<div class="col-md-6">
		              	<img src="media/categoryImage/<?php echo $row["slikaKategorije"]; ?>" class="img-responsive"/>
		              	</div>
		              	<div class="col-md-6" align="left">
			              <h6 style="color:black;" ><b>Informacije o ovom oglasu:</b></h6><br>
			              <h6 style="color:black;">Pozicija : <?php echo $row['naslov']; ?></h6>
			              <h6 style="color:black;">Tip oglasa : <?php echo $row['tipOglasa']; ?></h6>
			              <h6 style="color:black;">Oglas traje do : <?php echo $row['trajeDo']; ?></h6>
			              <h6 style="color:black;">Poslodavac : <?php echo $row['naziv']; ?></h6>
			              <?php $poslodavacId = $row['poslodavacId']; ?>
		              	</div>
		              </div><br>
		              <div class="row">
		              	<div class="col-md-12">
		              		<h6 style="color:black;">Opis oglasa : <?php echo $row['opis']; ?></h6>
		              	</div>
		              </div>
		              <form method="POST">
			              <div class="row">
			              	<div class="col-md-4">
			              		<input type="submit" name="posaljiPrijavu" onclick="Unhide();return false;" class="btn btn-info" value="Posalji prijavu">
			              	</div>
			              	<div class="col-md-4">
			              		<input type="submit" name="zapratiOglas" class="btn btn-warning" value="Zaprati oglas">
			              	</div>
			              	<div class="col-md-4">
			              		<a href="" class="btn btn-danger">Prijavi oglas</a>
			              	</div>
			              </div>
		              </form>
		              <?php
		              }
		              ?>
		            </div>
		          </div>
		        </div>

		        <script type="text/javascript">
		        	function Unhide() {
		        		var e = document.getElementById('hiddendiv');
		        		if(e.getAttribute('hidden') == null){
		        			e.setAttribute('hidden', 'true');
		        		}
		        		else{
		        			e.removeAttribute('hidden');
		        		}
		        	}
		        </script>

		        <div id="hiddendiv" hidden="true" style="background-color:#f1f1f1; padding:20px;">

		        	<?php
		        		$loggedUser = $_SESSION['username'];
		        		$query = "SELECT * FROM korisnik WHERE user='$loggedUser'";
		        		$result = mysqli_query($db, $query) or die(mysqli_error($db));
		        		while($row=$result->fetch_assoc()){
		        	?>

			        <h1 style="color:black;" class="text-center">Prijava</h1>
			        <hr class="lines w-50">
	        		<form method="POST" enctype="multipart/form-data">
	        			<div class="row">
	        				<div class="col-md-6">
	        					<label class="label v1">Ime:</label>
	        					<input type="text" class="form-control v1" placeholder="Vaše ime" value="<?php echo $row['ime'] ?>" name="">
	        				</div>
	        				<div class="col-md-6">
	        					<label class="label v1">Prezime:</label>
	        					<input type="text" class="form-control v1" placeholder="Vaše prezime" value="<?php echo $row['prezime'] ?>" name="">
	        				</div>
	        				<div class="col-md-6">
	        					<label class="label v1">Mail:</label>
	        					<input type="text" class="form-control v1" placeholder="Vaš mail" value="<?php echo $row['email'] ?>" name="">
	        				</div>        
	        				<div class="col-md-6">
	        					<label class="label v1">Telefon:</label>
	        					<input type="text" class="form-control v1" placeholder="Vaš telefon" value="<?php echo $row['telefon'] ?>" name="">
	        				</div> 
	        				<div class="col-md-6">
	        					<label class="label v1">CV:</label>
	        					<input type="file" class="form-control v1 btn btn-file" placeholder="CV.." name="cv">
	        				</div> 
	        				<div class="col-md-6">
	        					<input type="submit" class="btn btn-info" name="finalSaljiPrijavu" value="Posalji prijavu">  				
	        				</div> 
	        			</div>
	        		</form>
	        		<?php
	        		}
	        		?>
		        </div>

		        <div class="row justify-content-md-center">
		        	<h5 style="color: black;">Jos oglasa od ovog poslodavca:</h5>
		        </div>
		        <div class="row justify-content-md-center">
		        		<?php
		        		$query = "SELECT * FROM oglas 
		        		JOIN kategorije on oglas.kategorijaId=kategorije.idKategorije 
		        		JOIN poslodavac on oglas.poslodavacId=poslodavac.idPoslodavca
		        		WHERE poslodavacId='$poslodavacId' AND idOglasa <> $oglId";
		        		$result = mysqli_query($db, $query) or die(mysqli_error($db));

		        		if(mysqli_num_rows($result) > 0){
		        			while ($row = mysqli_fetch_array($result)) {
		        		?>
		        		<div class="col-lg-6 col-md-6 col-xs-12">
		        			<a href="oglas.php?oId=<?php echo $row["idOglasa"];?>" method="GET">
			        			<div style="background-color:#f1f1f1; padding:16px; margin: 20px 0;">
			        				<div class="row">
				        				<div class="col-lg-3 col-md-3 col-xs-12" align="center">
				        					<img src="media/categoryImage/<?php echo $row["slikaKategorije"]; ?>" class="img-responsive"/>
				        				</div>
				        				<div class="col-lg-9 col-md-9 col-xs-12" align="center">
					        				<h5 align="center" style="color: black;"><b><?php echo $row["naslov"];?></b></h5>
							            	<p align="center" style="color: black;">Opis oglasa: <?php echo $row["opis"];?></p>
							            	<p align="center" style="color: black;">Tip zaposlenja: <?php echo $row["tipOglasa"];?></p>
							            	<p align="center" style="color: black;">Oglas traje do: <?php echo $row["trajeDo"];?></p>
							            	<p align="center" style="color: black;">Poslodavac: <?php echo $row["naziv"];?></p>	
							            	<input type="hidden" name="id" value="<?php echo $row["idOglasa"]; ?>">
				        				</div>
			        				</div>
					       		</div>
		        			</a>
		        		 </div>
			            <?php
			        		}
			        	}
			        	else{	
		        		?>
		        		<h2 style="color:black;" >Nema oglasa za prikazivanje</h2>
		        		<?php
		        		}
		        		?>
		        </div>
		    </div>
		</section>

		  <!-- Contact Section Start -->
	    <section id="contact" class="section" data-stellar-background-ratio="-0.2">      
	      <div class="contact-form">
	        <div class="container">
	          <div class="row">     
	            <div class="col-lg-6 col-sm-6 col-xs-12">
	              <div class="contact-us">
	                <h3>Imate pitanja?<br>Kontaktirajte nas!</h3>
	                <div class="contact-address">
	                  <p class="phone">Telefon: <span>+381 64 221 112</span></p>
	                  <p class="email">E-mail: <span>office@itberza.rs</span></p>
	                  <ul class="list-unstyled">
	                  	<li><a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook fa-2x"></i></a></li>
	                  	<li><a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram fa-2x"></i></a></li>
	                  	<li><a href="https://www.linkedin.com" target="_blank"><i class="fab fa-linkedin fa-2x"></i></a></li>
	                  	<li><a href="https://www.google.com" target="_blank"><i class="fab fa-google-plus-g fa-2x"></i></a></li>
	                  </ul>
	                </div>
	              </div>
	            </div>     
	            <div class="col-lg-6 col-sm-6 col-xs-12">
	              <div class="contact-block">
	                <form id="contactForm">
	                  <div class="row">
	                    <div class="col-md-12">
	                      <div class="form-group">
	                        <input type="text" class="form-control" id="name" name="name" placeholder="Vaše ime">
	                      </div>                                 
	                    </div>
	                    <div class="col-md-12">
	                      <div class="form-group">
	                        <input type="text" placeholder="Vaš e-mail" id="email" class="form-control" name="name">
	                      </div> 
	                    </div>
	                    <div class="col-md-12">
	                      <div class="form-group"> 
	                        <textarea class="form-control" id="message" placeholder="Vaša poruka" rows="8" required></textarea>
	                      </div>
	                      <div class="submit-button text-center">
	                        <button class="btn btn-common" id="submit" type="submit">Pošalji poruku</button>
	                        <div id="msgSubmit" class="h3 text-center hidden"></div> 
	                      </div>
	                    </div>
	                  </div>            
	                </form>
	              </div>
	            </div>
	          </div>
	        </div>
	      </div>           
	    </section>
	    <!-- Contact Section End -->

    	<!-- Footer Section Start -->
		<footer>          
	      <div class="container">
	        <div class="row">
	          <!-- Footer Links -->
	          <div class="col-lg-6 col-sm-6 col-xs-12">
	            <ul class="footer-links">
	              <li>
	                <a href="index.php">Početna</a>
	              </li>
	              <li>
	                <a href="#">Prakse</a>
	              </li>
	              <li>
	                <a href="#">Poslovi</a>
	              </li>
	              <li>
	                <a href="prijava.php">Prijava</a>
	              </li>
	            </ul>
	          </div>
	          <div class="col-lg-6 col-sm-6 col-xs-12">
	            <div class="copyright">
	              <p>Sva prava zadržana &copy; 2020 - ITBerza.rs</p>
	            </div>
	          </div>  
	        </div>
	      </div>
	    </footer>
	    <!-- Footer Section End --> 

		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</body>
</html>