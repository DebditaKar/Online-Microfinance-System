<?php
        session_start();
        $a=$_SESSION['account'];
        $db = new PDO("mysql:host=localhost;dbname=oms","root","");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try 
        {
            $query = "SELECT * FROM user, account WHERE user.email=account.email AND account.accountno = '{$a}'";
            foreach ($db->query($query) as $row) 
            {
                $accountno=$row['accountno'];
                $balance=$row['balance'];
                $name=$row['name'];
                $address=$row['address'];
                $phone=$row['phone'];
                $email=$row['email'];
                $dob=$row['dob'];
                $gid=$row['gid'];
                $password=$row['password'];
            }
        }
        catch(PDOException $e)
	    {
		    echo $e->getMessage();
        }
?>
