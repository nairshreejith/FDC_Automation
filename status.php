<?php 
session_start();
?>

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


	<script type="text/javascript">
        function preventBack() { window.history.forward(); }
        setTimeout("preventBack()", 0);
        window.onunload = function () { null };
    </script>
	<link rel="stylesheet" type="text/css" href="button.css">
	<link rel="stylesheet" type="text/css" href="table.css">
	<link rel="stylesheet" type="text/css" href="blackboard.css">
	<title>Faculty Homepage</title>
	
</head>
<body>
	<div class="shade">
	<ul>
		<li><a href="facultyhome.php">Home</a></li>
		<li><a href="facultyleave.php">Apply For Training Program</a></li>
		<li><a href="status.php">Status</a></li>
		<li><a href="facultyspecialrequeststatus.php">Special Request Status</a></li>
		<?php include 'multiple.php';?>
		<li style="float:right"><a class="active" href="logout.php" onclick="preventBack()">Logout</a></li>
	</ul>
	<p style="text-align: center;  font-size: 20px;">
	<label>Status</label>
</p>
	<table border = "1 solid black">
		<tr>
			<th>Title</th>
			<th>Start Date</th>
			<th>End date</th>
			<th>ODs</th>
			<th>Amount Claimed</th>
			<th>Reason</th>
			<th>HOD Comment</th>
			<th>FDCmember Comment</th>
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
			$facultymail = $_SESSION['mail'];
			$sql = "Select a.*,b.HOD_Remark,b.FDCM_Remark,b.Faculty_Mailid from application_data a left join fdc_leave_data b on a.Start_date = b.Start_Date Where b.Faculty_Mailid='$facultymail' and a.Email = '$facultymail' and b.Special_Request = 'No'";
			$result = $conn->query($sql);
			if($result->num_rows>0)
			{
				while($row = $result->fetch_assoc())
				{

					$temp1 = $row['Faculty_Mailid']; 
					$temp2 = $row['Start_date'];
					$temp = $temp1.",".$temp2;

					echo "<tr><td>".$row['Title']."</td>".
					"<td>".$row['Start_date']."</td>".
					"<td>".$row['End_date']."</td>".
					"<td>".$row['Total_no_of_ods']."</td>".
					"<td>".$row['Amount_claimed']."</td>".
					"<td>".$row['Purpose']."</td>".
					"<td>".$row['HOD_Remark']."</td>".
					"<td>".$row['FDCM_Remark']."</td></tr>";
					//"<td>ndxhjbfd</td></tr>";
					//'<td><a href = "status2.php?id='.$temp.'">View</a></td></tr>';
				
				}
			}

		}
		?>
</div>
</body>
</html>