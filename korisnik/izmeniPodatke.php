<?php
	session_start();
			
	$con = new mysqli('localhost', 'root', '', 'itberza') or die(mysqli_error);

	if(isset($_POST['izmeniPodatke'])){

		$korisnikuser = $_SESSION['username'];

		$imeKorisnika = $_POST['imeKorisnika'];
		$prezimeKorisnika = $_POST['prezimeKorisnika'];
		$mailKorisnika = $_POST['mailKorisnika'];
		$passwordKorisnika = $_POST['password'];

		$query = "UPDATE korisnik SET ime = '$imeKorisnika', prezime = '$prezimeKorisnika', email = '$mailKorisnika', password = '$passwordKorisnika' WHERE korisnik.user='$korisnikuser'";

		$result = mysqli_query($con, $query) or die(mysqli_error);

		if($result){
			echo '<script>alert("Izmena podataka uspela!")</script>';
			echo '<script>window.location="podesavanja.php"</script>';
		}
		else{
			echo '<script>alert("Izmena podataka neuspela!")</script>';
			echo '<script>window.location="podesavanja.php"</script>';
		}
	}
	else{
		echo '<script>alert("Izmena podataka neuspela, greska pri upisu!")</script>';
		echo '<script>window.location="podesavanja.php"</script>';
	}
?>