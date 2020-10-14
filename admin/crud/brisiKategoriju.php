<?php

	$con = new mysqli('localhost', 'root', '', 'itberza') or die(mysqli_error);

	if(isset($_GET['brisiKategoriju'])){
		if(!empty($_GET['id'])){

		$kategorijaId =(int)$_GET['id'];

		$query = "DELETE FROM kategorija WHERE id ='$kategorijaId'";

			if(mysqli_query($con, $query)){
				echo '<script>alert("Brisanje kategorije uspelo!")</script>';
				echo '<script>window.location="../kategorije.php"</script>';
			}
			else{
				echo '<script>alert("Brisanje kategorije neuspelo!\nProverite ID!")</script>';
				echo '<script>window.location="../kategorije.php"</script>';
			}
		}
		else{
			echo '<script>alert("Unesite ispravan ID!")</script>';
			echo '<script>window.location="../kategorije.php"</script>';
		}
	}
?>