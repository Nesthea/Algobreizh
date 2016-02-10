<?php 

	$__ROOT__ = dirname(__FILE__)."/..";

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
<head>
	<title>Accueuil</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body style="background-image:url(../images/ChlorophyteVideo_FR-FR7444795778_1366x768.jpg);background-size:cover;background-repeat:no-repeat;background-attachment:fixed;">
	<?php 
		include ($__ROOT__."/includes/navbar.html");
	?>
	<div  style="background: rgba(500, 500, 500, 0.8);width:70%;margin-left:15%;margin-right:15%;position:absolute;height:100%;padding-top:5%" >
				<h1></h1>
				<h3></h3>
			</div>
</body>
</html>
