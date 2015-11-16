<?php

function createConnexion()
{
	return new PDO('mysql:host=localhost;dbname=algobreizh_gestion', 'algobreizh', '');
}

function getLastOrders()
{
	$db = createConnexion();
}

?>