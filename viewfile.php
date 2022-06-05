<?php

$dbh = new PDO("mysql:host=localhost;dbname=fdc","root","");
if(isset($_GET['id']))
{
	$temp = $_GET['id'];
	$arr = explode(",", $temp);
	$mail = $arr[0];
	$startdate = $arr[1];
}
$stat = $dbh->prepare("Select * from leave_data_files where Email = ? and Start_Date = ?");
$stat->bindParam(1,$mail);
$stat->bindParam(2,$startdate);
$stat->execute();
$row = $stat->fetch();
header("Content-Type:".$row['file_mime']);
echo $row['file_data'];
?>