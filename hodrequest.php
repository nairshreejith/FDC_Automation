<!DOCTYPE html>
<html>
<head>
	
	<title>HOD REQUEST</title>

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
	<div class="shade">
	<ul>
		<li><a href="hodhome.php">Home</a></li>
		<li><a href="hodrequest.php">Pending Requests</a></li>
		<li><a href="hodhistory.php">History</a></li>
		<li><a href="hodspecialrequestview.php">Special Requests</a></li>
		<li style="float:right"><a class="active" href="logout.php" onclick="preventBack()">Logout</a></li>
	</ul>
<p style="text-align: center;  font-size: 20px;">
	<label>Pending Requests</label>
</p>
	<table border = "1 solid black">
		<tr>
			<th>Faculty Name</th>
			<th>Branch</th>
			<th>Mail id</th>
			<th>Start Date</th>
			<th>Number of Days</th>
			<th>Amount Claimed</th>
			<th>Reason</th>
			<th>Comment</th>
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

			$sql = "Select * from fdc_leave_data where Branch = '$_SESSION[branch]' and HOD_Remark = '' and Special_Request = 'No'";
			$result = $conn->query($sql);
			if($result->num_rows>0)
			{
				while($row = $result->fetch_assoc())
				{
					$temp1 = $row['Faculty_Mailid']; 
					$temp2 = $row['Start_Date'];
					$temp = $temp1.",".$temp2;
					echo "<tr><td>".$row['Faculty_Name']."</td>".
					"<td>".$row['Branch']."</td>".
					"<td>".$row['Faculty_Mailid']."</td>".
					"<td>".$row['Start_Date']."</td>".
					"<td>".$row['Number_of_ODs']."</td>".
					"<td>".$row['Amount']."</td>".
					"<td>".$row['Reason']."</td>".
					//"<td>ndxhjbfd</td></tr>";
					'<td><a href = "hodcomment.php?id='.$temp.'">Edit</a></td></tr>';
				}
			}


		}
		?>
	</table>
</div>
</body>
</html>