<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET')
{
	$localhost = 'localhost';
	$username = 'root';
	$password = '';
	$db = 'fdc';

	$conn = mysqli_connect($localhost, $username, $password, $db);
	/*if($conn)
	{
		echo "Connection sucessful<br>";
	}
	else
	{
		echo "Error".mysqli_connect_error();
	}*/

	$ftype = $_GET['facultytype'];
	echo $ftype;
	if($ftype == 'FDC_Member')
	{
		$ftype = 'FDC Member';
	}
	if($ftype == 'FDC_Admin')
	{
		$ftype = 'FDC Admin';
	}
	if($ftype == "Faculty")
	{
		header("Location: facultyhome.php");
	}
	else if($ftype == "HOD")
	{
		header("Location: hodhome.php");
	}
	else if($ftype == "FDC Member")
	{
		header("Location: fdchome.php");
	}
	else if($ftype == "FDC Admin")
	{
		header("Location: fdcadminhome.php");
	}
	else
	{
		echo "Bhai ek select karle";
	}
}
?>