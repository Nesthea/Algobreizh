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
	<title>Administration</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
	<body style="background-image: url(../images/ChlorophyteVideo_FR-FR7444795778_1366x768.jpg); background-size: cover; background-repeat: no-repeat; background-attachment: fixed;">
		<div class="container">
			<nav class="navbar-default navbar-inverse navbar-fixed-top">
					<div class="container-fluid">
						<div class="navbar-header">
		            		<a class="navbar-brand" href="#">Algobreizh</a>
		          		</div>
						<div id="navbar" class="navbar-collapse collapse">
		    				<ul class="nav navbar-nav navbar-right">
		    					<li><a href="/Algobreizh/pages/login.php?logout=1">Déconnexion</a></li>
		    				</ul>
						</div>
					</div>
				</nav>
			</div>
			<div style="background: rgba(500, 500, 500, 0.8); width: 70%; margin-left: 15%; margin-right: 15%; position: absolute; height: 100%; padding-top: 5%">
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					<?php
						$oders = getUnprocessedOrders();
						
						$i=0;
						foreach($oders as $lastOrder)
						{
							?>
							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="heading<?= $i ?>">
									<h4 class="panel-title">
										<a role="button" data-toggle="collapse" data-parent="#accordion" href="#accordion<?= $i ?>" aria-expanded="true" aria-controls=accordion<?= $i ?>>Numéro de commande : <?= $lastOrder['idCommande'] ?></a>
									</h4>
								</div>
								<div id="accordion<?= $i?>" class="accordion-body collapse">
								<div class="panel-body">
								<table style="width:100%">
									<tr><td>Le : <?= $lastOrder['dateCommande']?></td></tr>
									<tr><td><b>Libelle</b></td><td><b>Quantite</b></td><td><b>Prix</b></td></tr>
									<?php
										$items = getOrderItems($lastOrder['idCommande']);
							
										foreach($items as $item)
										{
											$info = getItemInfoByCode($item["codeArticle"])[0];
									?>
									<tr><td><?= $info["libelleArticle"]?></td><td><?= $item["qteArticle"]?><td><?= round($item["montant"],2)?>€</td></tr>
									<?php
										}
									?>
									<tr><td><b>Total :</b></td><td></td><td><?= round($lastOrder['montant'],2)?>€</td></tr>
									<tr><td><form class="form-item"><input type="hidden" name="idCommande" value=<?= $lastOrder["idCommande"];?>><button type="submit">Valider</button></form></td></tr>
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
<script type="text/javascript">
$(".form-item").submit(function(e) {
	var form_data = $(this).serialize();

	$.ajax({
		url:"ajax.php",
		type:"POST",
		dataType:"json",
		data:form_data
	}).done(function(data){
		location.reload();
	})

	e.preventDefault();
});
</script>
</html>
