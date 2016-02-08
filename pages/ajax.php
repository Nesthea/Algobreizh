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
	
	if(isset($_POST["product_code"]))
	{
		$quantite = $_POST["quantite"];
		$codeProduit = $_POST["product_code"];
	
		$index = array_search($codeProduit, array_column($_SESSION["panier"], 'item'));
	
		if($index === FALSE)
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
   		
   		$index = array_search($_POST["remove_code"], array_column($_SESSION["panier"], 'item'));
   		
   		if($index !== FALSE)
   		{
   			unset($_SESSION["products"][$index]);
   		}
   		 
   		$total_items = count($_SESSION["panier"]);
   		die(json_encode(array('items'=>$total_items)));
   	}
?>