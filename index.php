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
			include("includes/login.html");
		}
		else
		{
			echo 'Vous êtes connecté !<br/>';
			echo '<a href="pages/login.php?logout=1">Deconnexion</a>';
		}
	?>
</body>
</html>
