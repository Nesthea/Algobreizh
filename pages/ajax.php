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
	
	if(isset($_POST["product_code"]))
	{
		$quantite = $_POST["quantite"];
		$codeProduit = $_POST["product_code"];
	
		$index = searchInCart($codeProduit, $_SESSION['panier']);
	
		if($index === null)
		{
			array_push($_SESSION['panier'], array("item" => $codeProduit, "qte" => $quantite));
		}
		else
		{
			$_SESSION["panier"][$index]["qte"] += $quantite;
		}
	
		$total_items = count($_SESSION["panier"]);
   		die(json_encode(array('items'=>$total_items)));
	}
	
   	if(isset($_POST["remove_code"]) && isset($_SESSION["panier"]))
   	{
   		$index = searchInCart($_POST["remove_code"], $_SESSION["panier"]);
 		
   		unset($_SESSION["panier"][$index]);
   		
   		$total_items = count($_SESSION["panier"]);
   		die(json_encode(array('items'=>$total_items)));
   	}
?>