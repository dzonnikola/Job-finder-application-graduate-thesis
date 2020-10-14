<?php

require_once '../config.php';

session_start();

	// konekcija
	$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die(mysqli_error);
	
	if (isset($_POST['login_button'])) {
		login();
	}


	function login(){
		global $db, $username, $errors;

		// grap form values
		$username = e($_POST['username']);
		$password = e($_POST['password']);

		// make sure form is filled properly
		if (empty($username)) {
			echo '<script>alert("Korisničko ime je obavezno!")</script>';				
			echo '<script>window.location="prijava.php"</script>';

		}
		if (empty($password)) {
			echo '<script>alert("Šifra je obavezna!")</script>';
			echo '<script>window.location="prijava.php"</script>';
		}
		else{

			$query = "SELECT * FROM poslodavac WHERE user='$username' AND password='$password' LIMIT 1";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) { 
				    
				    session_start();
				    $_SESSION['loggedin'] = true;
				    $_SESSION['username'] = $username;
					header('location: poslodavac/dobrodosli.php');

			}else{
						
				echo '<script>alert("Greška u prijavljivanju, pokušajte ponovo sa ispravnim parametrima!")</script>';
				echo '<script>window.location="prijava.php"</script>';
			}
		}
	}

	
	function e($val){
		global $db;
		return mysqli_real_escape_string($db, trim($val));
	}

?>