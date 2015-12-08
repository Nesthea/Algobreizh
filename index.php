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
	<title>Suivis</title>
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
			header("Location: pages/home.php");
			die();
		}
	?>
</body>

</html>
