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
	$queryStr = "INSERT INTO loan(Account_No,amount,installments,income,creation_date) VALUES(?,?,?,?,?)";
	//$queryStr = "INSERT INTO loan(amount,installments,income,creation_date) VALUES(?,?,?,?)";
	$query = $db->prepare($queryStr);
	$query->execute([$_SESSION["account"],$loan_amount,$installments,$income,$date]);
	//$query->execute([$loan_amount,$installments,$income,$date]);

	$sql = $db->query("UPDATE accounts SET Balance = Balance + '" .$loan_amount. "' WHERE Account_No= '".$_SESSION["account"]."'");
	$sql->execute();

}
catch(PDOException $e)
{
	echo $e->getMessage();
}

header('location:loan.php');
?>