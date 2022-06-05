<?php
		session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Successful</title>
	<link rel="stylesheet" type="text/css" href="button.css">
	<link rel="stylesheet" type="text/css" href="logincss.css">
	<link rel="stylesheet" type="text/css" href="blackboard.css">

	<style type="text/css">
		body{
			background-image: url('laptop.jpg');
			background-repeat: no-repeat;  
			background-size: cover;
		}

		.login-box h4{
	float: left;
	font-size: 32px;
	border-bottom: 6px solid #4caf50;
	margin-bottom: 5px;
	margin-top: 2px;
	padding: 13px 0;
	color: black;
}
	</style>
</head>
<body>
	<div class="shade">
	<ul>
		<li><a href="fdchome.php">Home</a></li>
		<li><a href="fdcrequest.php">Pending Request</a></li>
		<li><a href="fdcaccepted.php">Accepted</a></li>
		<li><a href="fdcrejected.php">Rejected</a></li>
		<li style="float:right"><a class="active" href="logout.php" onclick="preventBack()">Logout</a></li>
	</ul>
	<?php

	$localhost = 'localhost';
			$username = 'root';
			$password = '';
			$db = 'fdc';

			$conn = mysqli_connect($localhost, $username, $password, $db); 
	$sql = "Select * from fdc_leave_data where Branch = '$_SESSION[branch]' and FDCM_Remark = '' and HOD_Remark != ''";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$temp1 = $row['Faculty_Mailid']; 
	$temp2 = $_SESSION['startdate'];
	$temp = $temp1.",".$temp2;
	echo '<li><a href="fdcrequest.php"><u><--Go Back</u></a></li>'
	?>
	<div class="login-box" style="margin-top: 200px">
		<h4>No of ods sanctioned or amount sanctioned is more</h4><br>
		<h4>Leave cannot be granted</h4>
	</div>


</body>
</html>