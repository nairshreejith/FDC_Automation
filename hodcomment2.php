<!DOCTYPE html>
<html>
<head>
	<title>Addition</title>
</head>
<body>
<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST')
{

	$localhost = 'localhost';
	$username = 'root';
	$password = '';
	$db = 'fdc';

	$remark = $_POST['remark'];
	$remark_reason = $_POST['remarkreason'];


	$conn = mysqli_connect($localhost, $username, $password, $db);
	/*if($conn)
	{
		echo "Connection sucessful";
	}
	else
	{
		echo "Error".mysqli_connect_error();
	}*/

	$mid = $_SESSION['facultymail'];
	$startdate = $_SESSION['startdate'];
	//echo "$remark";
	//$sql = "Insert into leave_data(HOD_name,HOD_email,HOD_Remark) values ('$_SESSION[name]','$_SESSION[mail]',$remark)";
	$sql = "Update leave_data Set HOD_name = '$_SESSION[name]', HOD_email = '$_SESSION[mail]', HOD_Remark = '$remark', HOD_Remark_Reason = '$remark_reason' Where Email = '$mid' and Start_Date = '$startdate'";
	$result = $conn->query($sql);
	if($result)
	{
		header("Location: hodrequest.php");
	}
	else
	{
		header("Location: leavemessage.php");
	}

	$sql = "Update fdc_leave_data Set HOD_name = '$_SESSION[name]', HOD_email = '$_SESSION[mail]', HOD_Remark = '$remark', HOD_Remark_Reason = '$remark_reason'  Where Faculty_Mailid = '$mid' and Start_Date = '$startdate'";
	$result = $conn->query($sql);
	if($result)
	{
		header("Location: hodrequest.php");
	}
	else
	{
		header("Location: leavemessage.php");
	}

}
else
{
	header("Location: hodhome.php");
}
?>
</body>
</html>