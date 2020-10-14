<?php

	$con = new mysqli('localhost', 'root', '', 'itberza') or die(mysqli_error);

	if(isset($_GET['brisiOglas'])){
		if(!empty($_GET['id'])){

		$id =(int)$_GET['id'];

		$query = "DELETE FROM oglas WHERE idOglasa ='$id'";

			if(mysqli_query($con, $query)){
				echo '<script>alert("Brisanje oglasa uspelo!")</script>';
				echo '<script>window.location="../oglasi.php"</script>';
			}
			else{
				echo '<script>alert("Brisanje oglasa neuspelo!\nProverite ID!")</script>';
				echo '<script>window.location="../oglasi.php"</script>';
			}
		}
		else{
			echo '<script>alert("Unesite ispravan ID!")</script>';
			echo '<script>window.location="../oglasi.php"</script>';
		}
	}
?>