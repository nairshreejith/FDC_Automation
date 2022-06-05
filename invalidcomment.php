<!DOCTYPE html>
<html>
<head>
	<title>Invalid</title>
	<link rel="stylesheet" type="text/css" href="button.css">
	<link rel="stylesheet" type="text/css" href="logincss.css">
	<link rel="stylesheet" type="text/css" href="blackboard.css">
	<style type="text/css">
		body{
			background-image: url('laptop.jpg');
			background-repeat: no-repeat;  
			background-size: cover;
		}

		.login-box h1{
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
		<li><a href="fdcadminhome.php">Home</a></li>
		<li><a href="addmember.php">Add Member</a></li>
		<li><a href="deletemember.php">Delete Member</a></li>
		<li><a href="specialrequest.php">Special Request</a></li>
		<li style="float:right;"><a class="active" href="logout.php" onclick="preventBack()">Logout</a></li>
	</ul>

	<div class="login-box" style="margin-top: 200px">
		<h1>No of ODs or Amount Sanctioned Exceeds The Entered Value
		</h1>
	</div>


</body>
</html>