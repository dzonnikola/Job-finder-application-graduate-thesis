<?php

	$con = new mysqli('localhost', 'root', '', 'satovividic') or die(mysqli_error);

	if(isset($_GET['deleteProduct'])){
		if(isset($_GET['id'])){

		$productId =(int)$_GET['id'];

		$query = "DELETE FROM proizvod WHERE id ='$productId'";

			if(mysqli_query($con, $query)){
				echo '<script>alert("Brisanje uspelo!")</script>';
				echo '<script>window.location="../proizvodi.php"</script>';
			}
			else{
				echo '<script>alert("Brisanje neuspelo!")</script>';
				echo '<script>window.location="../proizvodi.php"</script>';
			}
		}
		else{
			echo '<script>alert("Unesite ispravan ID!)</script>';
			echo '<script>window.location="../proizvodi.php"</script>';
		}
	}
?>