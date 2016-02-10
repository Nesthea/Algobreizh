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
	<title>Produits</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="/Algobreizh/css/style.css"/>
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body class="background-site padded">
	<?php 
		include ($__ROOT__."/includes/navbar.html");
	?>
	<div style="background: rgba(500, 500, 500, 0.8);width:70%;margin-left:15%;margin-right:15%;position:absolute;padding-top:5%;margin-top:-5%" >
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<?php
				$connexion= createConnexion();
				if($connexion)
				{
					$request='SELECT idFamille,libelleFamille FROM familles ';
					$resfamille = $connexion->query($request);
					$i = 0;
					
				while ($donnes= $resfamille->fetch())
				{
					?>
								<div class="panel panel-default">
									<div class="panel-heading" role="tab" id="heading<?= $i ?>">
										<h4 class="panel-title">
											<a role="button" data-toggle="collapse" href="#accordion<?= $i ?>" aria-expanded="true" aria-controls="accordion<?= $i ?>"><?php echo  $donnes['libelleFamille']?></a>
										</h4>
									</div>
									<div id="accordion<?= $i ?>" class="accordion-body collapse collapse in">
										<div class="panel-body">
								<table style="width:100%">
							<?php
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
				<?php
								}}?>
								</table>
							</div>
						</div>
					</div>
			<?php 
			$i++;
				}}
			?>
		</div>
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

