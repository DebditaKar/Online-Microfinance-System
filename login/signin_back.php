<?php
    $a= $_POST["username"];
	$b= $_POST["password"];

        $db = new PDO("mysql:host=localhost;dbname=oms","root","");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try 
        {
            $query = $db->query("SELECT * FROM admin WHERE username = '{$a}' AND password = '{$b}'");
            $row_count = $query->rowCount();
            if($row_count==0)
            {
                echo "UNSUCCESSFULL";
            }
            else
            {
                echo "SUCCESSFULL";
            }
        }
        catch(PDOException $e)
	    {
		    echo $e->getMessage();
	    }
    
?>
