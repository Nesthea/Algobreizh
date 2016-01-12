<?php
	if(!isset($_SESSION))
	{	
		session_start();
	}
	if(!isset($_SESSION['log']))
	{
		$_SESSION['log'] = 0;
		$_SESSION['adm'] = 0;
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
			if($_SESSION['adm'] == 0)
			{
				header("Location: pages/home.php");
				die();
			}
			else if($_SESSION['adm'] == 1)
			{
				header("Location: pages/admin.php");
				die();
			}
		}
	?>
</body>
</html>
