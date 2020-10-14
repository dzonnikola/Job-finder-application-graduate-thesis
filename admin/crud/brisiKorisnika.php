<?php

	$con = new mysqli('localhost', 'root', '', 'itberza') or die(mysqli_error);

	if(isset($_GET['deleteKorisnika'])){
		if(!empty($_GET['id'])){

		$userId =(int)$_GET['id'];

		$query = "DELETE FROM korisnik WHERE idKorisnika ='$userId'";

			if(mysqli_query($con, $query)){
				echo '<script>alert("Brisanje korisnika uspelo!")</script>';
				echo '<script>window.location="../korisnici.php"</script>';
			}
			else{
				echo '<script>alert("Brisanje korisnika neuspelo!\nProverite ID!")</script>';
				echo '<script>window.location="../korisnici.php"</script>';
			}
		}
		else{
			echo '<script>alert("Unesite ispravan ID!")</script>';
			echo '<script>window.location="../korisnici.php"</script>';
		}
	}
?>