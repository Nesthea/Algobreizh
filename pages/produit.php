<html lang="fr">
<head>
	<link rel="stylesheet" href="test.css"/>
	<META charset="utf-8"/>
	<title>Sélection de la Famille de produit</title>
</head>



<?php 
$__ROOT__ = dirname(__FILE__)."/..";

require_once $__ROOT__.'/lib/lib.php';
$connexion= createConnexion();
if($connexion)
{
	$request='SELECT idFamille,libelleFamille FROM familles ';
	$res = $connexion->query($request);?>
	<form action="listeproduit.php" method="post">
	<select name="choix">
		<?php
	while ($donnes= $res->fetch()){
		echo '<option value='.$donnes['idFamille'].'>'. $donnes['libelleFamille']. '</option>';
	}
echo '<input type="submit" value="Valider" />';
echo"</select>";
}
?>