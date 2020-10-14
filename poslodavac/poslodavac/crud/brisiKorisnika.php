<?php

	$con = new mysqli('localhost', 'root', '', 'satovividic') or die(mysqli_error);

	if(isset($_GET['deleteUser'])){
		if(isset($_GET['id'])){

		$userId =(int)$_GET['id'];

		$query = "DELETE FROM user WHERE id ='$userId'";

			if(mysqli_query($con, $query)){
				echo '<script>alert("Brisanje uspelo!")</script>';
				echo '<script>window.location="../korisnici.php"</script>';
			}
			else{
				echo '<script>alert("Brisanje neuspelo!")</script>';
				echo '<script>window.location="../korisnici.php"</script>';
			}
		}
		else{
			echo '<script>alert("Unesite ispravan ID!)</script>';
			echo '<script>window.location="../korisnici.php"</script>';
		}
	}
?>