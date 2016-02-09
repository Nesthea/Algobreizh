<?php

	$__ROOT__ = dirname(__FILE__)."/..";
	
	require_once $__ROOT__.'/lib/lib.php';
	
	if(!isset($_SESSION))
	{
		session_start();
	}
	
	if($_SESSION['log'] == 0)
	{
		header("Location: ".$__ROOT__."/index.php");
		die();
	}
	
	createCommande($_SESSION['panier']);
	unset($_SESSION['panier']);
	header("Location: home.php");
	$_SESSION['panier'] = array();
	die();
?>