<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Special Request</title>
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
			<li class="dropdown"><a href="#" class="dropbtn">Member <i class="fa fa-caret-down"></i></a>
					<div class="dropdown-content">
					<a href="addmember.php" >Add Member</a>
					<a href="deletemember.php">Delete Member</a>
				</div>
			</li>
			<li><a href="specialrequest.php" class="active">Special Request</a></li>
			<li><a href="fdcadminhistory.php">History</a></li>
			<li><a href="conveyorcomment.php">Conveyor</a></li>

			<li style="float: right;"><a href="logout.php" onclick="preventBack()">Logout</a></li>
		</ul>



		<p style="text-align: center;font-size: 2em;">
	<label>Special Requests</label>
</p>
<table border = "1 solid black">
	<tr>
		<th>Faculty Name</th>
		<th>Branch</th>
		<th>Mail id</th>
		<th>Number of Days</th>
		<th>Amount Claimed</th>
		<th>Reason</th>
		<th>Comment</th>
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

			$sql = "Select a.*, b.Admin_Mail from fdc_leave_data a left join admin_sanction_data b on a.Start_date=b.Start_date where a.Special_Request = 'Yes' and b.Admin_Mail = '' and a.Inactive = '0'";
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
					"<td>".$row['Number_of_ODs']."</td>".
					"<td>".$row['Amount']."</td>".
					"<td>".$row['Reason']."</td>".
					//"<td>ndxhjbfd</td></tr>";
					'<td><a href = "fdcadmincomment.php?id='.$temp.'">Edit</a></td></tr>';
				}
			}


		}
	?>
</table>
</body>