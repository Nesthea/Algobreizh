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
	
		$quantite = $_POST["quantite"];
		$codeProduit = $_POST["product_code"];
		
		array_push($_SESSION['panier'], array("item" => $codeProduit, "qte" => $quantite));
		
		$total_items = count($_SESSION["panier"]);
    	die(json_encode(array('items'=>$total_items)));
?>
