<?php
    session_start();
    $a= $_POST["email"];
    $b= $_POST["address"];
    $c= $_POST["phone"];
    $d= $_POST["gid"];
    $e= $_POST["password"];
    $db = new PDO("mysql:host=localhost;dbname=oms","root","");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try 
        {
            $query = $db->query("UPDATE user SET address='{$b}' , phone='{$c}' , gid='{$d}' , password='{$e}' WHERE email='{$a}'");
            echo "<script type='text/javascript' >
            alert('Updated Successfully')
            document.location='../php/main.php'
            </script>";
        }
        catch(PDOException $e)
	    {
		    echo $e->getMessage();
        }
?>
