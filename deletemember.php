<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Delete Member</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" href="img/logo.jpg">


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/btn.css">
	<link rel="stylesheet" type="text/css" href="css/table.css">

	
	<style type="text/css">
		body{
			background-image: url('img/background.jpg');
			background-repeat: no-repeat;  
			background-size: cover;
		}

	</style>
</head>
<body>
		<ul>
			<a href="fdcadminhome.php"><img src="img/logo.jpg" class="img"></a>
			<li><a href="fdcadminhome.php">Home</a></li>
			<li class="dropdown"><a href="#" class="dropbtn active">Member <i class="fa fa-caret-down"></i></a>
					<div class="dropdown-content">
					<a href="addmember.php" >Add Member</a>
					<a href="deletemember.php">Delete Member</a>
				</div>
			</li>
			<li><a href="specialrequest.php">Special Request</a></li>
			<li><a href="fdcadminhistory.php">History</a></li>
			<li><a href="conveyorcomment.php">Conveyor</a></li>

			<li style="float: right;"><a href="logout.php" onclick="preventBack()">Logout</a></li>
		</ul>

		<p style="text-align: center;font-size: 2em;">
	<label>Delete Member</label>
</p>

<table border = "1 solid black">
<tr>
<th>Name</th>
<th>Mail</th>
<th>Branch</th>
<th>Member Type</th>
<th>Delete</th>
</tr>
<?php
if($_SERVER['REQUEST_METHOD'] == 'GET')
{
	$localhost = 'localhost';
	$username = 'root';
	$password = '';
	$db = 'fdc';

	$conn = mysqli_connect($localhost, $username, $password, $db);
	/*if($conn)
	{
		echo "Connection sucessful";
	}
	else
	{
		echo "Error".mysqli_connect_error();
	}*/

	$sql = "Select * from faculty Where Inactive = '0'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$temp = $row['Email'];
			if($row['MemberType'] != 'FDC Admin')
			{
			echo "<tr><td>".$row['Name']."</td>".
			"<td>".$row['Email']."</td>".
			"<td>".$row['Branch']."</td>".
			"<td>".$row['MemberType']."</td>".
			'<td><a href = "fdcdelete.php?id='.$temp.'">Delete</a></td></tr>';
			}
		}
	}
}
?>
</table>
</table>
</body>
</html>