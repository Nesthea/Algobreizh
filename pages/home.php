<?php 

	$__ROOT__ = dirname(__FILE__)."/..";

	if(!isset($_SESSION))
	{
		session_start();
	}
	
	if($_SESSION['log'] == 0)
	{
		header("Location: ".$__ROOT__."/index.php");
		die();
	}
?>

<!DOCTYPE html>
<html>
<head>
<head>
	<title>Accueuil</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<nav class="navbar-default navbar-inverse navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
            		<a class="navbar-brand" href="#">Algobreizh</a>
          		</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
    					<li><a href="/Algobreizh/pages/home.php">Accueil</a></li>
        				<li><a href="/Algobreizh/pages/suivi.php?m=1">Commandes</a></li>
        				<li><a href="/Algobreizh/pages/suivi.php?m=2">Factures</a></li>
        				<li><a href="/Algobreizh/pages/produit.php">Pré-commande</a></li>
    				</ul>
    				<ul class="nav navbar-nav navbar-right">
    					<li><a href="/Algobreizh/pages/login.php?logout=1">Déconnexion</a></li>
    				</ul>
				</div>
			</div>
		</nav>
	</div>
</body>
</html>