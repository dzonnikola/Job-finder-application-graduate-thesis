<?php

	$con = new mysqli('localhost', 'root', '', 'satovividic') or die(mysqli_error);

	if(isset($_GET['deleteOrder'])){
		if(isset($_GET['id'])){

		$narudzbenicaId =(int)$_GET['id'];

		$query = "DELETE FROM narudzbenica WHERE NarudzbenicaId ='$narudzbenicaId'";

			if(mysqli_query($con, $query)){
				echo '<script>alert("Brisanje uspelo!")</script>';
				echo '<script>window.location="../narudzbenice.php"</script>';
			}
			else{
				echo '<script>alert("Brisanje neuspelo!")</script>';
				echo '<script>window.location="../narudzbenice.php"</script>';
			}
		}
		else{
			echo '<script>alert("Unesite ispravan ID!)</script>';
			echo '<script>window.location="../narudzbenice.php"</script>';
		}
	}
?>