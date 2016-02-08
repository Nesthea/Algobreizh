<?php 
$__ROOT__ = dirname(__FILE__)."/..";

require_once $__ROOT__.'/lib/lib.php';

if(!isset($_SESSION))
{
	session_start();
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Sélection de la Famille de produit</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="/Algobreizh/css/style.css"/>
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body style="background-image:url(../images/ChlorophyteVideo_FR-FR7444795778_1366x768.jpg);background-size:cover;background-repeat:no-repeat;background-attachment:fixed;">
	<div class="container">
		<nav class="navbar-default navbar-inverse navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
            		<a class="navbar-brand" href="#">Algobreizh</a>
          		</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
    					<li><a href="/Algobreizh/pages/home.php">Accueil</a></li>
        				<li><a href="/Algobreizh/pages/suivi.php?m=1">Commandes</a></li>
        				<li><a href="/Algobreizh/pages/suivi.php?m=2">Factures</a></li>
        				<li><a href="/Algobreizh/pages/produit.php">Pré-commande</a></li>
    				</ul>
    				<ul class="nav navbar-nav navbar-right">
    					<li><a href="/Algobreizh/pages/login.php?logout=1">Déconnexion</a></li>
    				</ul>
				</div>
			</div>
		</nav>
	</div>
	<div  style="background: rgba(500, 500, 500, 0.8);width:70%;margin-left:15%;margin-right:15%;position:absolute;padding-top:5%;margin-top:-5%" >
				<?php
				$connexion= createConnexion();
				if($connexion)
				{
					$request='SELECT idFamille,libelleFamille FROM familles ';
					$resfamille = $connexion->query($request);
					
				while ($donnes= $resfamille->fetch())
				{
					?>
						<h4><?php echo '<p>'. $donnes['libelleFamille']. '</p>';?></h4>
						<table>
							<?php $connexion= createConnexion();
							if($connexion){
								$request='SELECT * FROM articles WHERE idFamille = :idFamille';
								$stmt = $connexion->prepare($request);
								
								if($stmt->execute(array("idFamille"=>$donnes['idFamille'])))
								{
									$array = $stmt->fetchAll(PDO::FETCH_ASSOC);
									foreach($array as $info)
									{?>
										<tr>
											<td>
												<form class="form-item">
													<table>
														<tr>
															<td><img src=<?php echo "/Algobreizh/".$info["path"]?>></td>
															<td><p> <?php echo $info['libelleArticle']?></p></td>
															<td><input type="number" name="quantite" value="0"><input type="hidden" name="product_code" value=<?php echo $info['idArticle']?>></td>
															<td><button type="submit" >+</button></td>
														</tr>
													</table>
												</form>
											</td>
										</tr>
						     <?php }?>
						</table>
				<?php
								}}
			}}
			?>
			<input type="button" class="validate" value="Valider"/>
		</div>
</body>
<script type="text/javascript">
$(".form-item").submit(function(e) {
	var form_data = $(this).serialize();

	$.ajax({
		url:"ajax.php",
		type:"POST",
		dataType:"json",
		data:form_data
	}).done(function(data){
		alert("Produit ajouté !");
	})

	e.preventDefault();
});

$(".validate").click(function(e) {
	document.location.href = "panier.php";
});
</script>
</html>

