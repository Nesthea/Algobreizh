<?php 

	include("../lib/lib.php");

	/*
	 * TODO : - connexion à la bdd
	 * 		  - stockage du hash
	 * 	      - login en fonction du hash
	 *        - Inscription
	 */

	session_start();
	
	$connexion = createConnexion();
	
	if($connexion)
	{
		$hash = hash('sha256', $_POST['password']);
		$request = 'select hash from alg_identifiants where code="'.$_POST['code'].'"';
		$res = $connexion->query($request);
		
		if($res->fetch()['hash'] == $hash)
		{
			$_SESSION['log'] = 1;
			header("Location: ../index.php");
			
			die();
		}
		else
		{
			echo("Erreur de connexion<br/>");
			echo('<a href="../index.php">Retourner à la page précédente</a>');
		}
	}
	
	if(isset($_GET['logout']) && $_GET['logout'] == 1)
	{
		$_SESSION['log'] = 0;
		header("Location: ../index.php");
		
		die();
	}
?>