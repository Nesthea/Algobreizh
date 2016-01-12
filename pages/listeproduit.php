<?php
	$__ROOT__ = dirname(__FILE__)."/..";
	
	require_once $__ROOT__.'/lib/lib.php';
$connexion= createConnexion();
if($connexion)
{
	$request='SELECT libelleArticle ,idArticle FROM articles WHERE idFamille = "'.$_POST['choix'].'" ';
	$res = $connexion->query($request);
	
?>


<html lang="fr">
<head>
	<link rel="stylesheet" href="test.css"/>
	<META charset="utf-8"/>
	<title>Remplissez le panier</title>
</head>
<body>
	<h1>Sélectionner les produit que vous souhaiter </h1>
	<form action="recuperation.php" method="post">
		
	<?php while ($donnes= $res->fetch()){?>
		
			<div class="container">
			<input type="checkbox" name="choix[]" value=<?php echo $donnes['idArticle']?> /> <?php echo $donnes['libelleArticle']?> 
		</div>
		<?php }?>
<div>
		<input class="validation" type="submit" value="Valider" />
		<?php }?>
</div>
	</form>
</body>
</html>
