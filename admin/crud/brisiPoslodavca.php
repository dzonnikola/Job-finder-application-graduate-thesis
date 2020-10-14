<?php

	$con = new mysqli('localhost', 'root', '', 'itberza') or die(mysqli_error);

	if(isset($_GET['brisiPoslodavca'])){
		if(!empty($_GET['id'])){

		$poslodavacId =(int)$_GET['id'];

		$query = "DELETE FROM proizvod WHERE id ='$poslodavacId'";

			if(mysqli_query($con, $query)){
				echo '<script>alert("Brisanje poslodavca uspelo!")</script>';
				echo '<script>window.location="../poslodavci.php"</script>';
			}
			else{
				echo '<script>alert("Brisanje poslodavca neuspelo!\nProverite ID!")</script>';
				echo '<script>window.location="../poslodavci.php"</script>';
			}
		}
		else{
			echo '<script>alert("Unesite ispravan ID!")</script>';
			echo '<script>window.location="../poslodavci.php"</script>';
		}
	}
?>