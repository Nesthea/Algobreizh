<?php 
session_start();
if(!isset($_SESSION['log']))
{
	$_SESSION['log'] = 0;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Connexion</title>
	<link rel="stylesheet" type="text/css" href="styles/styles.css">
</head>
<body>
	<?php
		if($_SESSION['log'] == 0)
		{
			echo '<h1>Connexion</h1>';
			echo '<form name="connexion" method="post" action="pages/login.php">';
			echo 'Entrez votre adresse code client : <input type="text" name="code"/> <br/>';
			echo 'Entrez votre mot de passe : <input type="password" name="password"/><br/>';
			echo '<input type="submit" name="valider" value="OK"/>';
			echo '</form>';
		}
		else
		{
			echo 'Vous �tes connect� !<br/>';
			echo '<a href="pages/login.php?logout=1">Deconnexion</a>';
			
		}
	?>
</body>

</html>
