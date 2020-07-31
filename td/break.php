<?php 
session_start();

function dateDiff ($d1, $d2) {
	// Return the number of days between the two dates:    
		return round(abs(strtotime($d1) - strtotime($d2))/86400);
}

$id = $_GET['id'];
$date = date('Y-m-d');

$db = new PDO('mysql:host=localhost;dbname=mfs', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try
{
	//Fetch selected TD details
	$query = $db->query("SELECT * FROM td where Account_No= '".$_SESSION["account"]."' AND TD_ID='". $id ."'");
    $row = $query->fetch();

    $tenure = $row['Tenure'];
	$amount = $row['Amount'];
	
	//get TD interest rate
	$querySql = $db->query("SELECT * FROM interests WHERE Type = 'TermDeposit' AND Tenure= '". $tenure ."'");
    $row1 = $querySql->fetch();
	$rate = $row1['Rate'];
	
	//Calculate return amount
	$difference = (round(dateDiff($date,$row["Creation_Date"])/30)/12);      //No. of years passed b/w now and creation date

	$td_amount = $amount*pow((1+($rate/100)), $difference);
	
	//Delete entry from TD table
	$queryStr = "DELETE FROM `TD` WHERE `Td_ID`='". $id ."'";
	$query = $db->prepare($queryStr);
	$query->execute();

	//Get old balance
	$queryStr1 = $db->query("SELECT Balance FROM accounts WHERE Account_No= '".$_SESSION["account"]."'");
	$row2 = $queryStr1->fetch();
	
	//update balance
	$sql = $db->query("UPDATE accounts SET Balance = ".$row2['Balance']." + ".$td_amount." WHERE Account_No= '".$_SESSION["account"]."'");
	$sql->execute();
}
catch(PDOException $e)
{
	echo $e->getMessage();
}

header('location:td.php');
?>