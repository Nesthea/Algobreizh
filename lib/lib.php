<?php

function createConnexion()
{
	return new PDO('mysql:host=localhost;dbname=algobreizh_gestion', 'algobreizh', '');
}

function getLastOrders($codeClient)
{
	$db = createConnexion();
	
	$sql = "select * from commandes where codeClient = :codeClient order by dateCommande limite 20";
	
	$stmt = $db->prepare($sql);
	
	if($stmt->execute(array("codeClient"=>$codeClient)))
	{
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}

function getLastBills($codeClient)
{
	$db = createConnexion();
	
	$sql = "";
	
	$stmt = $db->prepare($sql);
	
	if($stmt->execute(array("codeClient"=>$codeClient)))
	{
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}

function getOrderItems($idCommand)
{
	$db = createConnexion();

	$sql = "";
	
	if($stmt->execute(array("codeClient"=>$codeClient)))
	{
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}

function getItemInfo($codeArticle)
{
	$db = createConnexion();
	
	$sql = "";
	
	if($stmt->execute(array("codeClient"=>$codeClient)))
	{
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}

function getLibelleArticle($idArticle)
{
	$db = createConnexion();
	
	$sql = "select * from articles where idArticle = :idArticle";
	
	$stmt = $db->prepare($sql);
	
	if($stmt->execute(array("idArticle" => $idArticle)))
	{
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	
	return $idArticle;
}

function getUnprocessedOrders()
{
	$db = createConnexion();
	
	return array(0 => array("idCommande" => 1, "dateCommande" => "01/01/1995", "montant" => 45.45, "codeClient" => 24));
}
?>