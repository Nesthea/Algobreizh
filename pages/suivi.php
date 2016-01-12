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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>

<?php
	$lastBills = null;
	$lastOrders = null;
	
	if(isset($_GET["m"]))
	{
		switch($_GET["m"])
		{
			case 1:
				$lastOrders = getLastOrders($_SESSION['code']);
				break;
			case 2:
				$lastBills = getLastBills($_SESSION['code']);
				break;
				
			default:
				echo "Erreur, mode non supporté !";
				break;
		}
	}
	?>
	<div class="container">
	<div class="row">
	<?php
	if($lastBills != null)
	{
		$i = 0;
		foreach($lastBills as $lastBill)
		{
			$valide = $lastBill['valide'] ? "valide" : "non valide";
			echo '<h4>Numéro de commande : '.$lastBill['idCommande'].'</h4>';
			echo '<table>';
			echo '<tr><td>Le : '.$lastBill['dateCommande'].'</td><td>'.$lastBill['montant'].'€</td><td>Statut :'.$valide.'</td></tr>';
			echo '</table>';
			$i++;
		}
	}
	else if($lastOrders != null)
	{
		?>
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		<?php
		$i = 0;
		foreach($lastOrders as $lastOrder)
		{
			$items = getOrderItems($lastOrder['idCommande']);

			echo '<div class="panel panel-default">';
			echo '<div class="panel-heading" role="tab" id="heading'.$i.'">';
			echo '<h4 class="panel-title">';
			echo '<a role="button" data-toggle="collapse" data-parent="#accordion" href="#accordion'.$i.'" aria-expanded="true" aria-controls="accordion'.$i.'">Numéro de commande : '.$lastOrder['idCommande'].'</a>';
			echo '</h4>';
			echo '</div>';
			echo '<div id="accordion'.$i.'" class="accordion-body collapse">';
			echo '<div class="panel-body">';
			echo '<table>';
			echo '<tr><td>Le : '.$lastOrder['dateCommande'].'</td><td>'.$lastOrder['montant'].'€</td></tr>';
			echo '<tr><td>Details :</td></tr>';
			foreach($items as $item)
			{
				$info = getItemInfo($item["codeArticle"]);
				
				echo '<tr><td>'.$info["libelleArticle"].'</td><td>'.$item["montant"].'</td></tr>';
			}
			echo '</table>';
			echo '</div>';
			echo '</div>';
			echo '</div>';
			$i++;
		}
	}
?>
</div>
</div>
</div>
</div>
</body>
</html>