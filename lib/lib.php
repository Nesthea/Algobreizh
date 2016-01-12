<?php

function createConnexion()
{
	return new PDO('mysql:host=localhost;dbname=algobreizh_gestion', 'algobreizh', '');
}

function getLastOrders($codeClient)
{
	/*
	$db = createConnexion();
	
	$sql = "select * from commandes where codeClient = :codeClient order by dateCommande limite 20";
	
	$stmt = $db->prepare($sql);
	
	if($stmt->execute(array("codeClient"=>$codeClient)))
	{
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}*/
	
	return array(0 => array("idCommande" => 1, "dateCommande" => "01/01/1995", "montant" => 45.45));
}

function getLastBills($codeClient)
{
	/*
	$db = createConnexion();
	
	$sql = "";
	
	$stmt = $db->prepare($sql);
	
	if($stmt->execute(array("codeClient"=>$codeClient)))
	{
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}*/
	
	return array(0 => array("idCommande" => 1, "dateCommande" => "01/01/1995", "montant" => 45.45, "valide"=>0, "codeClient" => 24));
}

function getOrderItems($idCommand)
{
	/*
	$db = createConnexion();

	$sql = "";
	
	if($stmt->execute(array("codeClient"=>$codeClient)))
	{
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}*/
	
	return array(0 => array("codeArticle"=>1, "qteArticle"=>1, "montant"=>4.45, "idCommand"=>$idCommand),
				 1 => array("codeArticle"=>1, "qteArticle"=>1, "montant"=>4.45, "idCommand"=>$idCommand),
				 2 => array("codeArticle"=>1, "qteArticle"=>1, "montant"=>4.45, "idCommand"=>$idCommand));
}

function getItemInfo($codeArticle)
{
	/*
	$db = createConnexion();
	
	$sql = "";
	
	if($stmt->execute(array("codeClient"=>$codeClient)))
	{
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}*/

	return array("codeArticle"=>$codeArticle, "libelleArticle"=>"patate", "prix"=>4, "unite"=>"Sachet de 50g");
}

function getLibelleArticle($idArticle)
{
	return "blah";
}

function getUnprocessedOrders()
{
	//$db = createConnexion();
	
	return array(0 => array("idCommande" => 1, "dateCommande" => "01/01/1995", "montant" => 45.45, "codeClient" => 24));
}
?>