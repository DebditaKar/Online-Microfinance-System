<?php
    session_start();

        function dateDiff ($d1, $d2) {
        // Return the number of days between the two dates:    
            return round(abs(strtotime($d1) - strtotime($d2))/86400);
        }

        $date = date('Y-m-d');

        $db = new PDO("mysql:host=localhost;dbname=mfs","root","");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try{
        $querySql = $db->query("SELECT * FROM interests WHERE Type = 'Loan' LIMIT 1");
        $row = $querySql->fetch();
        $r = $row['Rate'];
        
        $query = $db->query("SELECT * FROM loan WHERE Account_No= '".$_SESSION["account"]."'");
        $row = $query->fetch();

            $n = $row['Installments'];
            $principal = $row['Amount'];
            $id = $row['Loan_Id'];
            $rate = ($r/12) / 100 ;

            $difference = round(dateDiff($date,$row["Creation_Date"])/30);      //No. of months 
            $remaining = $row["Installments"] - $difference;                     //Remaining duration of loan

            $emi = round(( $principal * $rate * pow(( 1 + $rate), $n) / ( pow(( 1 + $rate), $n ) - 1 ) ));
            $emi = $emi * $remaining;

            $queryStr1 = $db->query("SELECT Balance FROM accounts WHERE Account_No= '".$_SESSION["account"]."'");	//Get current balance of the account
	        $row2 = $queryStr1->fetch();

            $sql = $db->query("UPDATE accounts SET Balance= '".$row2['Balance']."' - '" .$emi. "' WHERE Account_No= '".$_SESSION["account"]."'");
            $sql->execute();

            //Delete entry from Loan table
	        $queryStr = "DELETE FROM loan WHERE Loan_Id='". $id ."'";
	        $query = $db->prepare($queryStr);
	        $query->execute();
        }
        catch(PDOException $e)
        {
	        echo $e->getMessage();
        }
    header('location:loan.php');
?>
