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
<body>
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
			<div class="row">
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<?php
					$oders = getUnprocessedOrders();
					
					$i=0;
					foreach($oders as $lastOrder)
					{
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
						
						$items = getOrderItems($lastOrder['idCommande']);
						
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
				?>
			</div>
			<a href="/Algobreizh/pages/login.php?logout=1">Deconnexion</a>
		</div>
	</div>
</body>
<script>
	$("submit").click(function(){
		var checked = [];

		$(":checkbox:checked").each(function() {
			checked.push($(this).val());
		}

		window.location = "process.php?data="+encodeURIComponent(JSON.stringify(t));
	}
</script>
</html>
