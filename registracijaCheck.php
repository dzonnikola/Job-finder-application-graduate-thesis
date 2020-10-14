<?php

session_start();

	// konekcija
	$db = new mysqli('localhost', 'root', '', 'satovividic') or die(mysqli_error);

	$username = "";
	$email    = "";
	$ime = "";
	$prezime = "";
	$password = "";
	$errors   = array(); 

	
	if (isset($_POST['reg_button'])) {
		register();
	}


	function register(){
		global $db, $username, $errors;

		// grap form values
		$username = e($_POST['username']);
		$password = e($_POST['pwd']);
		$ime = e($_POST['ime']);
		$prezime = e($_POST['prezime']);
		$email = e($_POST['email']);


		$rand_id = rand(1, 10000);
		

		try {

			if (count($errors) == 0) {
			$password = $password;

			$query = "INSERT INTO user (id, ime, prezime, username, email, password, type) VALUES ('$rand_id','$ime', '$prezime', '$username', '$email', '$password', 'user')" or die(mysqli_error);

			if(mysqli_query($db, $query)){
			    echo '<script>alert("Uspešna registracija, pritisni OK za nastavak!")</script>';
			    echo '<script>window.location="login.php"</script>';
			}
			else{
				echo '<script>alert("Neuspešna registracija, bićete vraćeni na stranicu za registraciju!")</script>';
			    echo '<script>window.location="registracija.php"</script>';		
			}	
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

	function display_error() {
		global $errors;

		if (count($errors) > 0){
			echo '<div class="error">';
				foreach ($errors as $error){
					echo $error .'<br>';
				}
			echo '</div>';
		}
	}

?>