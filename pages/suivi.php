<?php 

	$__ROOT__ = dirname(__FILE__)."..";
	
	require_once $__ROOT__.'/lib/lib.php';

	if(isset($_GET["m"]))
	{
		switch($_GET["m"])
		{
			case 1:
				$lastOrders = getLastOrders();
				break;
			case 2:
				$lastBills = getLastBills();
				break;
				
			default:
				echo "Erreur, mode non supporté !";
				break;
		}
	}

?>