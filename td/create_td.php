<?php
session_start();

$amount = $_GET["amount"];
$tenure = $_GET["slct1"];
$date = date('Y-m-d');

$db = new PDO('mysql:host=localhost;dbname=mfs', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try
{
	$queryStr = "INSERT INTO td(Account_No,Amount,Tenure,Creation_Date) VALUES(?,?,?,?)";
	$query = $db->prepare($queryStr);
	$query->execute([$_SESSION["account"],$amount,$tenure,$date]);
}
catch(PDOException $e)
{
	echo $e->getMessage();
}

header('location:td.php');