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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="/Algobreizh/css/style.css"/>
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
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
        				<li><a href="/Algobreizh/pages/produit.php">Produits</a></li>
    				</ul>
    				<ul class="nav navbar-nav navbar-right">
    					<li><a href="/Algobreizh/pages/panier.php"><span class="glyphicon glyphicon-shopping-cart panier"><?php echo count($_SESSION['panier'])?></span></a>
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
						<table style="width:100%">
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
													<table class="table table-hover">
														<tr>
															<td style="width:20%"><img src=<?php echo "/Algobreizh/".$info["path"]?>></td>
															<td style="width:40%"><p> <?php echo $info['libelleArticle']?></p></td>
															<td style="width:10%"><p><?php echo round(($info['prix']/(1+$info['TVA'])),2);?>€</p></td>
															<td style="width:20%"><input class="quantite" type="number" name="quantite" min="0" value="0"><input type="hidden" name="product_code" value=<?php echo $info['idArticle']?>></td>
															<td style="width:10%"><button type="submit" >+</button></td>
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
	var json = $(this).serializeArray();
	
	if(json[0]['value'] != 0)
	{
		$.ajax({
			url:"ajax.php",
			type:"POST",
			dataType:"json",
			data:form_data
		}).done(function(data){
			alert("Ajouté au panier !");
			$('span.panier').text(data.items);
			$('input.quantite').val(0);
		})
	}

	e.preventDefault();
});

$(".validate").click(function(e) {
	document.location.href = "panier.php";
});
</script>
</html>

