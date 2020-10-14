<?php
	session_start();
			
	$con = new mysqli('localhost', 'root', '', 'itberza') or die(mysqli_error);

    $poslodavacuser = $_SESSION['username'];

	$nazivKompanije = $_POST['nazivKompanije'];
	$adresaKompanije = $_POST['adresaKompanije'];
	$mailKompanije = $_POST['mailKompanije'];
	$telefonKompanije = $_POST['telefonKompanije'];

	if(isset($_POST['izmeniPodatke'])){

		$query = "UPDATE poslodavac SET naziv = '$nazivKompanije', adresa = '$adresaKompanije', mail = '$mailKompanije', telefon = '$telefonKompanije' WHERE poslodavac.user='$poslodavacuser'";

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