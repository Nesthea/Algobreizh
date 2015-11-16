<?php 

	$__ROOT__ = dirname(__FILE__)."/..";

	require_once $__ROOT__.'/lib/lib.php';
	
	session_start();
	
	$db = createConnexion();
	
	if($db)
	{
		$hash = hash('sha256', $_POST['password']);
		$sql = "SELECT hash FROM alg_identifiants WHERE code = :code AND hash = :hash";
		
		$stmt = $db->prepare($sql);
		
		if($stmt->execute(array("code" =>$_POST['code'], "hash" => $hash)))
		{
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			
			if($row)
			{
				$_SESSION['log'] = 1;
				header("Location: ..");
				die();
			}
			else
			{
				include($__ROOT__."/includes/error_login.html");
			}
		}
	}
	
	if(isset($_GET['logout']) && $_GET['logout'] == 1)
	{
		$_SESSION['log'] = 0;
		header("Location: ..");
		
		die();
	}
?>