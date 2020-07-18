<?php
    //$today_day = date("d");
    //echo $today_day+1;
    $today= date('d/m/Y');
    //echo $today;
    //$today_cd=("+1 days", $today);
    //$today_date = date("d/m/Y", $today_cd);
    //echo $today_date;
    $db = new PDO("mysql:host=localhost;dbname=oms","root","");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try 
        {
            $query = $db->query("SELECT * FROM termdeposits");
            foreach ($query as $row) 
            {
                $creation_date=$row['Creation_Date'];
                $account=$row['Account_No'];
                $tenure=($row['Tenure']);
                $amount=$row['Td_Amount'];
                $years=$tenure/12;
                $timestamp = strtotime($creation_date);
                $mature_date=strtotime("+$years years", $timestamp);
                $break_date=strtotime("+1 days", $mature_date);
                $break_date = date("d/m/Y", $break_date);
                if($break_date == $today) 
                {
                    $query = $db->query("SELECT * FROM interests WHERE Type='TermDeposit' AND Tenure='{$tenure}'");
                    $row = $query->fetch();
                    $rate = $row['Rate'];
                    $td_amount=$amount*pow((1+($rate/100)), $years);
                    echo $td_amount;
                    $query = $db->query("SELECT * FROM accounts WHERE Account_No='{$account}'");
                    $row = $query->fetch();
                    $balance = $row['Balance']+$td_amount;
                    $query = $db->query("UPDATE accounts SET Balance='{$balance}' WHERE Account_No='{$account}'");
                }
            }
        }
        catch(PDOException $e)
	    {
		    echo $e->getMessage();
	    }
?>
