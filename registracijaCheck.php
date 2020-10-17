<?php

session_start();

	// konekcija
	$db = new mysqli('localhost', 'root', '', 'itberza') or die(mysqli_error);

	
	if (isset($_POST['reg_button'])) {
		register();
	}


	function register(){

		global $db;

		$ime = e($_POST['ime']);
		$prezime = e($_POST['prezime']);
		$email = e($_POST['email']);
		$username = e($_POST['username']);
		$password = e($_POST['pwd']);		

		try {
			
			$query = "INSERT INTO korisnik (idKorisnika, ime, prezime, user, email, password, type) VALUES ('', $ime','$prezime','$username','$email', '$password', 'user')" or die(mysqli_error);

			if(mysqli_query($db, $query)){
			    echo '<script>alert("Uspešna registracija, pritisni OK za nastavak!")</script>';
			    echo '<script>window.location="prijava.php"</script>';
			}
			else{
				echo '<script>alert("Neuspešna registracija, bićete vraćeni na stranicu za registraciju!")</script>';
				echo '<script>window.location="registracija.php"</script>';
			}

		} 
		catch (Exception $e) {
			echo "Greska : " . $e->getMessage();
		}
	}
	
		function e($val){
		global $db;
		return mysqli_real_escape_string($db, trim($val));
	}

?>