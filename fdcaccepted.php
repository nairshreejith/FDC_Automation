<!DOCTYPE html>
<html>
<head>
	
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
	<title>FDCM accepted</title>
</head>
<body>
	<div class="shade">
	<ul>
		<li><a href="fdchome.php">Home</a></li>
		<li><a href="fdcrequest.php">Pending Request</a></li>
		<li><a href="fdcaccepted.php">Accepted</a></li>
		<li><a href="fdcrejected.php">Rejected</a></li>
		<?php include 'multiple.php';?>
		<li style="float:right"><a class="active" href="logout.php" onclick="preventBack()">Logout</a></li>
	</ul>
	<p style="text-align: center;">
	<label>Forwarded</label>
</p>
<table border = "1 solid black">
	<tr>
		<th>Faculty Name</th>
		<th>Branch</th>
		<th>Faculty Mailid</th>
		<th>Date of Meeting</th>
		<th>Amount Sanctioned</th>
		<th>ODs sanctioned</th>
		<th>Remark Reason</th>
	</tr>
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
				echo "Connection sucessful";
			}
			else
			{
				echo "Error".mysqli_connect_error();
			}*/

			$sql = "Select * from fdc_sanction_data where Branch = '$_SESSION[branch]' and Remark = 'Forward'";
			$result = $conn->query($sql);
			if($result->num_rows>0)
			{
				while($row = $result->fetch_assoc())
				{
					echo "<tr><td>".$row['Faculty_Name']."</td>".
					"<td>".$row['Branch']."</td>".
					"<td>".$row['Faculty_Mail']."</td>".
					"<td>".$row['Date_of_Meeting']."</td>".
					"<td>".$row['Amount_Sanctioned']."</td>".
					"<td>".$row['ODs_sanctioned']."</td>".
					"<td>".$row['Remark_Reason']."</td></tr>";
				}
			}


		}
	?>
</table>
</body>
</html>