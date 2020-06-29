<?php
    session_start();
    $a= $_POST["email"];
	$b= $_POST["password"];
    $db = new PDO("mysql:host=localhost;dbname=oms","root","");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try 
    {
        $query = $db->query("SELECT * FROM user WHERE email = '{$a}' AND password = '{$b}'");
        $sql = "SELECT * FROM account WHERE email = '{$a}'";
        foreach ($db->query($sql) as $row)
        {
             $ano=$row['accountno'];
        }
        $row_count = $query->rowCount();
        if($row_count==0)
        {
            echo "<script type='text/javascript' >
            document.location='../html/login.html'
            alert('Wrong email or password')
            </script>";     
        }
        else
        {
            header("Location: ../php/main.php");
        }
    }

    catch(PDOException $e)
	{
		echo $e->getMessage();
    }

    $_SESSION['account'] = $ano;
    echo $_SESSION['account'];
        
?>
