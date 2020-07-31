<?php
session_start();
$loan_amount = $_GET["amount"];
$installments = $_GET["slct1"];
$income= $_GET["ann"];
$date = date('Y-m-d');

$db = new PDO('mysql:host=localhost;dbname=mfs', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try
{
	$queryStr = "INSERT INTO loan(Account_No,Amount,Installments,Income,Creation_Date) VALUES(?,?,?,?,?)";
	$query = $db->prepare($queryStr);
	$query->execute([$_SESSION["account"],$loan_amount,$installments,$income,$date]);

	$queryStr1 = $db->query("SELECT Balance FROM accounts WHERE Account_No= '".$_SESSION["account"]."'");	//Get current balance of the account
	$row2 = $queryStr1->fetch();

	//Update balance with loan amount
	$sql = $db->query("UPDATE accounts SET Balance = '".$row2['Balance']."' + '" .$loan_amount. "' WHERE Account_No= '".$_SESSION["account"]."'");
	$sql->execute();
}
catch(PDOException $e)
{
	echo $e->getMessage();
}

header('location:loan.php');
?>