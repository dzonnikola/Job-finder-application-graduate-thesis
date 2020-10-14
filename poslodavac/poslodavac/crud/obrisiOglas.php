<?php
	session_start();
	
	$con = new mysqli('localhost', 'root', '', 'itberza') or die(mysqli_error);

	if(isset($_GET['obrisiOglas'])){
		if(!empty($_GET['id'])){

		$poslodavacuser = $_SESSION['username'];
		$oglasId =(int)$_GET['id'];

		$query = "DELETE FROM oglas JOIN poslodavac on oglas.poslodavacId = poslodavac.idPoslodavca WHERE oglas.idOglasa = '$oglasId' AND poslodavac.user = '$poslodavacuser'";

			if(mysqli_query($con, $query)){
				echo '<script>alert("Brisanje oglasa uspelo!")</script>';
				echo '<script>window.location="../aktivniOglasi.php"</script>';
			}
			else{
				echo '<script>alert("Brisanje oglasa neuspelo!")</script>';
				echo '<script>window.location="../aktivniOglasi.php"</script>';
			}
		}
		else{
			echo '<script>alert("Unesite ispravan ID!")</script>';
			echo '<script>window.location="../aktivniOglasi.php"</script>';
		}
	}
?>