<?php

function createConnexion()
{
	return new PDO('mysql:host=localhost;dbname=algobreizh_gestion', 'algobreizh', '');
}

function getLastOrders($codeClient)
{
	$db = createConnexion();
	
	$sql = "select * from commandes where codeClient = :codeClient order by dateCommande";
	
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
	
	$stmt = $db->prepare($sql);
	
	if($stmt->execute(array("idCommande"=>$idCommand)))
	{
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}

function getItemInfoById($idArticle)
{
	$db = createConnexion();
	
	$sql = "select * from articles where idArticle = :idArticle";
	
	$stmt = $db->prepare($sql);
	
	if($stmt->execute(array("idArticle"=>$idArticle)))
	{
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}	
}

function getItemInfoByCode($codeArticle)
{
	$db = createConnexion();
	
	$sql = "select * from articles where codeArticle = :codeArticle";
	
	$stmt = $db->prepare($sql);
	
	if($stmt->execute(array("codeArticle"=>$codeArticle)))
	{
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}


function searchInCart ($id, $array) {
	foreach ($array as $key => $val) {
		if ($val['item'] == $id) {
			return $key;
		}
	}
	return null;
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

function getTotalCommande($tabProduit)
{
	$total = 0;
	
	foreach($tabProduit as $prod)
	{
		$total += getPrixTVA($prod);
	}
	
	return $total;
}

function getPrixTVA ($prod)
{
	$info = getItemInfoById($prod['item'])[0];
	
	return round($info['prix']/(1+$info['TVA']),2);
}

function getUserId($codeClient)
{
	$db = createConnexion();
	
	$sql = "select idUtilisateur from utilisateurs where codeClient = :codeClient";
	
	$stmt = $db->prepare($sql);
	
	if($stmt->execute(array("codeClient"=>$codeClient)))
	{
		return $stmt->fetch(PDO::FETCH_ASSOC)["idUtilisateur"];
	}
	else
	{
		return null;
	}
}

function insertDetails($tabProduit, $idCommande)
{
	$db = createConnexion();
	
	$sql = "INSERT INTO `details`(`codeArticle`, `qteArticle`, `montant`, `idCommande`, `idArticle`) VALUES (:codeArticle,:qte,:montant,:idCommande,:idArticle)";
	
	$stmt = $db->prepare($sql);
	
	foreach($tabProduit as $produit)
	{
		$info = getItemInfoById($produit["item"])[0];
		$stmt->execute(array("codeArticle"=>$info["codeArticle"],
							 "qte"=>$produit["qte"],
							 "montant"=>getPrixTVA($produit),
							 "idCommande"=>$idCommande,
		                     "idArticle"=>$info["idArticle"]));
	}
	
}

function createCommande($tabProduit)
{
	$db = createConnexion();
	
	$sql = "INSERT INTO `commandes`(`montant`, `dateCommande`, `codeClient`, `valide`,`idUtilisateur`) VALUES (:montant,:date,:codeClient,:valide,:idUser)";
	
	$stmt = $db->prepare($sql);
	
	if($stmt->execute(array(
		"montant"=>getTotalCommande($tabProduit),
		"date"=>date("Y-m-d H:i:s"),
		"codeClient"=>$_SESSION["code"],
		"valide"=>false,
		"idUser"=>getUserId($_SESSION["code"])
	)))
	{
		insertDetails($tabProduit, $db->lastInsertId());
	}
	
}
?>