<?php

	require_once 'config.php';

	$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die(mysqli_error);

?>


<!DOCTYPE html>
<html lang="sr">
	<head>
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="assets/css/main.css">
		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
		<title>Prijavi se - IT berza - portal za pretragu poslova u IT struci</title>
	</head>
		<header>
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
			  <a class="navbar-brand" href="index.php">IT Berza</a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>
			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			    <ul class="navbar-nav mr-auto">
			      <li class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          Oglasi
			        </a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			          <a class="dropdown-item" href="#">Prakse</a>
			          <a class="dropdown-item" href="#">Poslovi</a>
			        </div>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="#">Kontakt</a>
			      </li>
			    </ul>
			    <form class="form-inline my-2 my-lg-0">
			      <a href="prijava.php" class="btn btn-outline-info">Prijava</a>
			      <a href="registracija.php" class="btn btn-outline-warning">Registracija</a>
			    </form>
			  </div>
			</nav>
		</header>
	<body>
		<section id="bellow-header">
			<div class="container">      
		        <div class="row justify-content-md-center">
		          <div class="col-md-10">
		            <div class="contents text-center">
		              <h1>Prijavi se</h1>
		              	<center>
		              	  <form action="prijavaCheck.php" method="POST" style="width: 450px;">
		                  <div class="form-group">
		                    <label>Korisničko ime:</label>
		                    <input type="username" name="username" class="form-control" placeholder="Vaš username">
		                  </div>
		                  <div class="form-group">
		                    <label>Lozinka:</label>
		                    <input type="password" name="password" class="form-control" placeholder="Vaša lozinka">
		                  </div>
		                  <button type="submit" name="login_button" id="login_button" class="btn btn-primary">Prijavi se</button>
		                </form>	
		              	</center>
		                <br>
		                <h6>Nemaš nalog? <a href="registracija.php">Registruj se!</a></h6>
		                <a href="poslodavac/prijava.php" class="btn btn-warning">Za poslodavce</a>
		            </div>
		          </div>
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