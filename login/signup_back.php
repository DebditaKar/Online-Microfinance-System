<?php
	$a= $_POST["name"];
	$b= $_POST["password"];
	$c= $_POST["type"];
	$db = new PDO("mysql:host=localhost;dbname=oms","root","");
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try
		{
			$queryStr = "INSERT INTO admin(username, password, type)VALUES(?,?,?)";
			$query = $db->prepare($queryStr);
            $query->execute([$a,$b,$c]);
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
?>
