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
	
	$sql = "select * from commandes where codeClient = :codeClient order by dateCommande";
	
	$stmt = $db->prepare($sql);
	
	if($stmt->execute(array("codeClient"=>$codeClient)))
	{
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}

function getOrderItems($idCommand)
{
	$db = createConnexion();

	$sql = "select * from details where idCommande = :idCommande";
	
	if($stmt->execute(array("idCommand"=>$idCommand)))
	{
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}

function getItemInfo($codeArticle)
{
	$db = createConnexion();
	
	$sql = "select * from articles where codeArticle = :codeArticle";
	
	if($stmt->execute(array("codeArticle"=>$codeArticle)))
	{
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}

function getLibelleArticle($idArticle)
{
	$db = createConnexion();
	
	$sql = "select libelleArticle from articles where idArticle = :idArticle";
	
	$stmt = $db->prepare($sql);
	
	if($stmt->execute(array("idArticle" => $idArticle)))
	{
		return $stmt->fetch(PDO::FETCH_ASSOC)['libelleArticle'];
	}
}

function getUnprocessedOrders()
{
	$db = createConnexion();
	
	$sql = "select * from commandes where valide = 0";
	
	$stmt = $db->prepare($sql);
	
	if($stmt->execute())
	{
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
	if($stmt->execute())
	{
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}

function createCommande($tabProduit)
{
	$db = createConnexion();
	
	
}
?>