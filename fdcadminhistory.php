<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin History</title>
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


		table {
  border-collapse: collapse;
  width: 100%;
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-color: purple;
   border: 1px solid rgba(255,255,255,0.3);
}

th{
	
  text-align: left;
  font-weight: 500;
  
  background-color: transparent;
  padding: 20px 15px;
  font-size: 18px;
  color: #fff;
  text-transform: uppercase;
  background-color: rgba(255,255,255,0.3);
}
 td {
	padding: 15px;
  text-align: left;
  vertical-align:middle;
  font-weight: 300;
  font-size: 12px;
  color: #fff;
  border-bottom: solid 1px rgba(255,255,255,0.1);
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
			<li><a href="specialrequest.php">Special Request</a></li>
			<li><a href="fdcadminhistory.php"  class="active">History</a></li>
			<li><a href="conveyorcomment.php">Conveyor</a></li>

			<li style="float: right;"><a href="logout.php" onclick="preventBack()">Logout</a></li>
		</ul>


		<p style="text-align: center;font-size: 2em;">
	<label>Special Request History</label>
</p>
	<table border = "1 solid black">
		<tr>
			<th>Faculty Mail</th>
			<th>Title</th>
			<th>Start Date</th>
			<th>End date</th>
			<th>ODs Claimed</th>
			<th>Amount Claimed</th>
			<th>Reason</th>
			<th>Admin Comment</th>
			<th>ODs Granted</th>
			<th>Amount Granted</th>
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
			$sql = "Select a.*,b.* from application_data a left join admin_sanction_data b on a.Start_date = b.Start_Date Where b.Faculty_Mail=a.Email and a.Special_Request = 'Yes' and Admin_mail != ''";
			$result = $conn->query($sql);
			if($result->num_rows>0)
			{
				while($row = $result->fetch_assoc())
				{
					echo "<tr><td>".$row['Faculty_Mail']."</td>".
					"<td>".$row['Title']."</td>".
					"<td>".$row['Start_date']."</td>".
					"<td>".$row['End_date']."</td>".
					"<td>".$row['Total_no_of_ods']."</td>".
					"<td>".$row['Amount_claimed']."</td>".
					"<td>".$row['Purpose']."</td>".
					"<td>".$row['Remark']."</td>".
					"<td>".$row['Sanctioned_Ods']."</td>".
					"<td>".$row['Sanctioned_Amount']."</td></tr>";
					//"<td>ndxhjbfd</td></tr>";
					//'<td><a href = "status2.php?id='.$temp.'">View</a></td></tr>';
				
				}
			}

		}
		?>
</div>
</body>