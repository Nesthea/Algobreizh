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
<body>
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
</body>
</html>