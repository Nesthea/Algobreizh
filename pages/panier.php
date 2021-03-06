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
<title>Panier</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link rel="icon" type="image/png" href="/Algobreizh/images/AlgoBreizh_Logo_48px.png"/>
</head>
<body style="background-image: url(../images/ChlorophyteVideo_FR-FR7444795778_1366x768.jpg); background-size: cover; background-repeat: no-repeat; background-attachment: fixed;">
	<?php 
		include ($__ROOT__."/includes/navbar.html");
	?>
	<div style="background: rgba(500, 500, 500, 0.8); width: 70%; margin-left: 15%; margin-right: 15%; position: absolute; height: 100%; padding-top: 5%">
		<table class="list-panier">
		<?php
		if(count($_SESSION['panier']) <= 0)
		{
			echo "<p>Vous n'avez pas d'article.</p>";
		}
		else
		{
			foreach($_SESSION['panier'] as $value)
			{
				$info = getItemInfoById($value['item'])[0];
		?>
			<tr>
				<td>
					<form class="form-item">
						<table>
							<tr>
								<td><img src=<?php echo "/Algobreizh/".$info["path"]?>></td>
								<td><p> <?php echo $info['libelleArticle']?><input type="hidden" name="remove_code" value=<?php echo $info['idArticle']?>></p></td>
								<td><p><?php echo round($info['prix']*$value['qte']/(1+$info['TVA']),2);?>�</p></td>
								<td><button type="submit">X</button></td>
							</tr>
						</table>
					</form>
				</td>
			</tr>
		<?php }}?>
		</table>
		<?php if(count($_SESSION['panier']) > 0){?>
		<input type="button" class="validate" value="Valider" />
		<?php }?>
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
		$('span.panier').text(data.items);
		location.reload();
	})

	e.preventDefault();
});

$(".validate").click(function(e) {
	alert("Commande envoy�e !");
	document.location.href = "validate.php";
});
</script>
</html>
