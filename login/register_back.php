<?php
	$a= $_POST["username"];
	$b= $_POST["email"];
	$c= $_POST["password"];
	$d= $_POST["address"];
	$e= $_POST["phone"];
	$f= $_POST["dob"];
	$g= $_POST["gid"];
	$h= date('Y/m/d H:i:s');
	$db = new PDO("mysql:host=localhost;dbname=oms","root","");
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try
		{
			$sql = $db->query("SELECT * FROM user WHERE email='{$b}'");
			$row_count = $sql->rowCount();
			if($row_count==0)
			{
				$queryStr = "INSERT INTO user(name, address, phone, email,  gid, password, dob)VALUES(?,?,?,?,?,?,?)";
				$query = $db->prepare($queryStr);
            	$query->execute([$a,$d,$e,$b, $g, $c, $f]);
            	$queryStr = "INSERT INTO account(cdate, email)VALUES(?,?)";
				$query = $db->prepare($queryStr);
				$query->execute([$h,$b]);
				echo "<script type='text/javascript' >
                alert('Registerred successfully! Now login to the system')
                document.location='../html/login.html'
				</script>";
			}
			else
			{
				echo "<script type='text/javascript' >
                alert('Email id already registerred!')
                document.location='../html/login.html'
				</script>";
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
?>
