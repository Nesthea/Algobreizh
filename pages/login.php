<?php 

	$__ROOT__ = dirname(__FILE__)."/..";

	require_once $__ROOT__.'/lib/lib.php';
	
	if(!isset($_SESSION))
	{
		session_start();
	}
	
	if(!isset($_SESSION['log']))
	{
		$_SESSION['log'] = 0;
	}
	
	$db = createConnexion();
	
	if($db)
	{
		$hash = hash('sha256', $_POST['password']);
		$sql = "SELECT * FROM utilisateurs WHERE codeClient = :code AND motDePasse = :hash";
		
		$stmt = $db->prepare($sql);
		
		if($stmt->execute(array("code" =>$_POST['code'], "hash" => $hash)))
		{
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			
			if($row)
			{
				$_SESSION['log'] = 1;
				$_SESSION['code'] = $_POST['code'];
				$_SESSION['panier'] = array();
				if($row["teleprospecteur"] == 1)
				{
					$_SESSION['adm'] = 1;
				}
				
				header("Location: ..");
				die();
			}
			else
			{
				include($__ROOT__."/includes/error_login.html");
			}
		}

		if(isset($_GET['logout']) && $_GET['logout'] == 1)
		{
			$_SESSION['log'] = 0;
			$_SESSION['adm'] = 0;
			$_SESSION['code'] = 0;
			header("Location: ..");
		
			die();
		}
	}
?>