<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" href="img/logo.jpg">

	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/btn.css">
	<link rel="stylesheet" type="text/css" href="css/table.css">

	<title>Deletion</title>
</head>
<body>
<?php
if($_SERVER['REQUEST_METHOD'] == 'GET')
{
	$localhost = 'localhost';
	$username = 'root';
	$password = '';
	$db = 'fdc';

	$mail = $_GET['id'];

	$conn = mysqli_connect($localhost, $username, $password, $db);
	if($conn)
	{
		//echo "Connection sucessful";
		header("Location: deletemember.php");
	}
	else
	{
		//echo "Error".mysqli_connect_error();
	}

	$sql = "Update application_data  Set Inactive = '1' Where Email = '$mail'";
	$result = $conn->query($sql);
	if($result)
	{}
	else
	{
		//echo "1";
	}

	$sql = "Update faculty  Set Inactive = '1' Where Email = '$mail'";
	$result = $conn->query($sql);
	if($result)
	{}
	else
	{
		//echo "2";
	}

	$sql = "Update fdc_leave_data  Set Inactive = '1' Where Faculty_Mailid = '$mail'";
	$result = $conn->query($sql);
	if($result)
	{}
	else
	{
		//echo "3";
	}

	$sql = "Update fdc_sanction_data  Set Inactive = '1' Where Faculty_Mail = '$mail'";
	$result = $conn->query($sql);
	if($result)
	{}
	else
	{
		//echo "4";
	}

	$sql = "Update leave_data  Set Inactive = '1' Where Email = '$mail'";
	$result = $conn->query($sql);
	if($result)
	{}
	else
	{
		//echo "5";
	}

	$sql = "Update leave_data_Files Set Inactive = '1' Where Email = '$mail'";
	$result = $conn->query($sql);
	if($result)
	{}
	else
	{
		//echo "6";
	}

	$sql = "Update resource_data  Set Inactive = '1' Where Email = '$mail'";
	$result = $conn->query($sql);
	if($result)
	{}
	else
	{
		//echo "7";
	}

	$sql = "Update admin_sanction_data  Set Inactive = '1' Where Faculty_Mail = '$mail'";
	$result = $conn->query($sql);
	if($result)
	{}
	else
	{
		//echo "7";
	}

}
?>
</body>
</html>