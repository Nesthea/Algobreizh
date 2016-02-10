<?php 

	$__ROOT__ = dirname(__FILE__)."/..";
	
	require_once $__ROOT__.'/lib/lib.php';
	
	if(!isset($_SESSION))
	{
		session_start();
	}
	
	if($_SESSION['log'] == 0)
	{
		header("Location: ".$__ROOT__."/index.php");
		die();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Suivis</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body style="background-image:url(../images/ChlorophyteVideo_FR-FR7444795778_1366x768.jpg);background-size:cover;background-repeat:no-repeat;background-attachment:fixed;">
	<?php 
		include ($__ROOT__."/includes/navbar.html");
	?>
	<div style="background: rgba(500, 500, 500, 0.8);width:70%;margin-left:15%;margin-right:15%;position:absolute;height:100%;padding-top:5%" >
<?php
	$lastBills = null;
	$lastOrders = null;
	
	if(isset($_GET["m"]))
	{
		switch($_GET["m"])
		{
			case 1:
				$lastValues = getLastOrders($_SESSION['code']);
				break;
			case 2:
				$lastValues = getLastBills($_SESSION['code']);
				break;
				
			default:
				echo "Erreur, mode non supporté !";
				break;
		}
	}
	?>
	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	<?php
		$i = 0;
		foreach($lastValues as $lastValue)
		{
			$items = getOrderItems($lastValue['idCommande']);
			?>
			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="heading<?= $i?>">
					<h4 class="panel-title">
						<a role="button" data-toggle="collapse" href="#accordion<?= $i?>" aria-expanded="true" aria-controls="accordion<?= $i?>">Numéro de commande : <?= $lastValue['idCommande']?></a>
					</h4>
				</div>
				<div id="accordion<?= $i?>" class="accordion-body collapse">
					<div class="panel-body">
						<table style="width:100%">
							<tr><td>Le : <?= $lastValue['dateCommande']?></td><td>Statut : <?= $lastValue['valide'] ? "Validé" : "Non validé"?></tr>
							<tr><td><b>Libelle</b></td><td><b>Quantite</b></td><td><b>Prix</b></td></tr>
							
							<?php
							foreach($items as $item)
							{
								$info = getItemInfoByCode($item["codeArticle"])[0];
							?>
							
								<tr><td><?= $info["libelleArticle"]?></td><td><?= $item["qteArticle"]?></td><td><?= round($item["montant"],2)?>€</td></tr>
							<?php
							}
							?>
							<tr><td><b>Total :</b></td><td></td><td><?= round($lastValue['montant'],2)?>€</td></tr>
						</table>
					</div>
				</div>
			</div>
			<?php
			$i++;
		}
?>
</div>
</div>
</body>
</html>