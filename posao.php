<?php
	session_start();

	require_once 'config.php';

	$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die(mysqli_error);
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
		<section id="bellow-header">
			<div class="container">      
		        <div class="row justify-content-md-center">
		          <div class="col-md-10">
		            <div class="contents text-center">
		              <h1>Poslovi</h1>
		              <p>Možda ovde započinje tvoja karijera u IT biznisu!</p>
		              <a href="#" class="btn btn-common">Pogledaj šta izdvajamo</a>
		            </div>
		          </div>
		        </div> 
		  	</div>           
		</section>

		<section id="sector">
			<div class="container">      
		        <div class="row justify-content-md-center">
		          <div class="col-md-10">
		            <div class="contents text-center">
		              <h1>Trenutno u ponudi</h1>
		            </div>
		          </div>
		        </div>

		        <div class="row justify-content-md-center">
		        		<?php
		        		$query = "SELECT * FROM oglas 
		        		JOIN kategorije on oglas.kategorijaId=kategorije.idKategorije 
		        		JOIN poslodavac on oglas.poslodavacId=poslodavac.idPoslodavca
		        		WHERE tipOglasa = 'posao' ORDER BY trajeOd ASC";
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