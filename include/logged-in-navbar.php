<?php
	require_once 'config.php';

	$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die(mysqli_error);
?>


<header>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="index.php">IT Berza</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item dropdown">
	        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          Oglasi
	        </a>
	        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	          <a class="dropdown-item" href="prakse.php">Prakse</a>
	          <a class="dropdown-item" href="posao.php">Poslovi</a>
	        </div>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#">Kontakt</a>
	      </li>
	    </ul>
	    <div class="form-inline">
	      <ul class="navbar-nav mr-auto">
	      <li class="nav-item dropdown">
		    <?php  if (isset($_SESSION['username'])) : ?> 
	        <a class="btn btn-info nav-link dropdown-toggle" href="#" id="navbarDropdown" data-toggle="dropdown">
	        <?php echo $_SESSION['username']; ?>
	        </a>
	        <?php endif ?>
	        <div class="dropdown-menu" id="navbarDropdown" aria-labelledby="navbarDropdown">
		      <a href="korisnik/mojprofil.php" class="btn btn-info">Moj profil</a>
		      <a href="logout.php" class="btn btn-outline-warning">Odjava</a>
	        </div>
	      </li>
	    </ul>
	    </div>
	  </div>
	</nav>
</header>