<?php 
$__ROOT__ = dirname(__FILE__)."/..";

require_once $__ROOT__.'/lib/lib.php';

$tabLangages = null;

if(isset($_POST['choix']))
{
	$tabLangages = $_POST['choix'];
}

if (!empty($tabLangages)) {

	echo "Voici les produits que vous avez choisi:<br>";
	
	foreach($tabLangages as $cle => $valeur) {
		echo getLibelleArticle($valeur).'<br>';
	}
}
?>