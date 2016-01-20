<?php 
	
	$__ROOT__ = dirname(__FILE__)."/..";
	
	require_once $__ROOT__.'/lib/lib.php';
	
	$Id = rand(10000, 99999);
	$mdp = base_convert($Id, 20, 36);
	$hash = hash('sha256', $mdp);
	$DB = createConnexion();
	
	if ($DB)
	{
		$stmt = $DB->prepare('SELECT codeClient FROM utilisateurs WHERE codeClient = :code');
		if ($stmt->execute(array('code'=>$_POST['codeClient'])))
		{
			if($stmt->fetch(PDO::FETCH_ASSOC))
			{
				echo $mdp;
				$request = 'REPLACE INTO utilisateurs (motDePasse,codeClient) VALUES (:hash,:code)';
				$stmt = $DB->prepare($request);
				if($stmt->execute(array('hash'=>$hash,'code'=>$_POST['codeClient'])))
				{
					$message = 'Code client : '.$_POST['codeClient'].'\r\nMot de passe : '.$mdp;
					mail('flavien-huot-44@hotmail.fr','Vos identifiants Algobreizh', $message);
				}
			}
			else 
			{
				echo 'Code client inexistant';
			}
		}
		
		
	}
		
	


?>