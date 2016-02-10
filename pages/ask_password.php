<?php 
	
	$__ROOT__ = dirname(__FILE__)."/..";
	
	require_once $__ROOT__.'/lib/lib.php';
	
	$Id = rand(10000, 99999);
	$mdp = base_convert($Id, 20, 36);
	$hash = hash('sha256', $mdp);
	$DB = createConnexion();
	
	?>
	<html>
	<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	</head>
	<body  style="background-image:url(../images/039665391adf84fa30eeb016481f7553_large.jpeg);background-size:cover;background-repeat:no-repeat;background-attachment:fixed;">
	<div>
	<h1 style="font-family:algerian;font-size:60px;text-align:center;color:black;">ALGOBREIZH</h1>
	</div>
	
	<?php 
	if ($DB)
	{
		$stmt = $DB->prepare('SELECT codeClient FROM utilisateurs WHERE codeClient = :code');
		if ($stmt->execute(array('code'=>$_POST['codeClient'])))
		{
			if($stmt->fetch(PDO::FETCH_ASSOC))
			{
				if(filter_var($_POST['mailClient'], FILTER_VALIDATE_EMAIL)){
						//L'email est bonne
					
					?>
					<div id="msgEnvoye" style="background: rgba(0, 0, 0, 0.7);margin-top:150px;padding:20px;margin-left:30%;margin-right:30%;" align="center">
					<label style="color:white;font-size:20px;">Nouveau mot de passe envoyé <br/> à l'adresse : <br/> <?php echo $_POST['mailClient']  ?> </label>
						</div>
						<?php
					echo $mdp;
					$request = 'REPLACE INTO utilisateurs (motDePasse,codeClient) VALUES (:hash,:code)';
					$stmt = $DB->prepare($request);
					if($stmt->execute(array('hash'=>$hash,'code'=>$_POST['codeClient'])))
					{
						$message = 'Code client : '.$_POST['codeClient'].'\r\nMot de passe : '.$mdp;
						mail($_POST['mailClient'],'Vos identifiants Algobreizh', $message);
					}
				}
				
				else
				{
					?>
								<div id="msgEnvoye" style="background: rgba(0, 0, 0, 0.8);margin-top:300px;padding:20px;margin-left:30%;margin-right:30%;" align="center">
								<label style="color:white;font-size:20px;">E-mail incorrect</label>
									</div>
									<?php
				}
			}
			else 
			{
				?>
								<div id="msgEnvoye" style="background: rgba(0, 0, 0, 0.8);margin-top:300px;padding:20px;margin-left:30%;margin-right:30%;" align="center">
								<label style="color:white;font-size:20px;">Code client incorrect</label>
									</div>
									<?php
			}
		}
		
		
	}
		
	?>
	</body>
	<script>
	</script>
	</html>
