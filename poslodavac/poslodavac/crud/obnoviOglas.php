<?php
	session_start();

	$con = new mysqli('localhost', 'root', '', 'itberza') or die(mysqli_error);

	if(isset($_GET['obnoviOglas'])){
		if(!empty($_GET['id'])){

		$poslodavacuser = $_SESSION['username'];

		$oglasId =(int)$_GET['id'];

		$query = "UPDATE oglas JOIN poslodavac on oglas.poslodavacId = poslodavac.idPoslodavca SET oglas.aktivan = 1 WHERE oglas.idOglasa ='$oglasId' AND poslodavac.user = '$poslodavacuser'";

			if(mysqli_query($con, $query)){
				echo '<script>alert("Obnavljanje oglasa uspelo!")</script>';
				echo '<script>window.location="../aktivniOglasi.php"</script>';
			}
			else{
				echo '<script>alert("Obnavljanje oglasa neuspelo!\nProverite ID oglasa!")</script>';
				echo '<script>window.location="../neaktivniOglasi.php"</script>';
			}
		}
		else{
			echo '<script>alert("Unesite ispravan ID!")</script>';
			echo '<script>window.location="../neaktivniOglasi.php"</script>';
		}
	}
?>