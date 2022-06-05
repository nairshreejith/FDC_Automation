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
			<li><a href="fdcadminhistory.php">History</a></li>
			<li><a href="conveyorcomment.php" class="active">Conveyor</a></li>

			<li style="float: right;"><a href="logout.php" onclick="preventBack()">Logout</a></li>
		</ul>


		<p style="text-align: center;font-size: 2em;">
	<label>Conveyor</label>
</p>
<table border = "1 solid black">
<tr>
<td>Name</td>
<td>Mail</td>
<td>Branch</td>
<td>Type</td>
<td>Title</td>
<td>Organization</td>
<td>Start Date</td>
<td>ODs sanctioned</td>
<td>Amount Sanctioned</td>
<td>Accept/Reject</td>
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

	$sql = "Select a.*,b.* from  application_data a left join fdc_sanction_data b On a.Email = b.Faculty_Mail Where a.Start_date = b.Start_Date and b.Conveyor_Remark = '' and Remark = 'Forward'";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
	{
		echo "<form action = 'conveyorcomment2.php' method = 'POST'>";
		while($row = $result->fetch_assoc())
		{
			$temp1 = $row['Faculty_Mail'];
			$temp2 = $row['Start_date'];
			$acc = 'Accept';
			$rej = 'Reject';
			$tempa = $temp1 . ',' . $temp2 . ',' . $acc;
			$tempr = $temp1 . ',' . $temp2 . ',' . $rej;
			echo "<tr><td>".$row['Faculty_Name']."</td>".
				"<td>".$row['Faculty_Mail']."</td>".
				"<td>".$row['Branch']."</td>".
				"<td>".$row['Type']."</td>".
				"<td>".$row['Title']."</td>".
				"<td>".$row['Name_of_Organization']."</td>".
				"<td>".$row['Start_date']."</td>".
				"<td>".$row['ODs_sanctioned']."</td>".
				"<td>".$row['Amount_Sanctioned']."</td>".
				"<td><select name = 'abc[]'><option value = '$tempa'>Accept</option><option value = '$tempr'>Reject</option></select></td>";
		}
		?>
		<p><?php
				if(isset($_SESSION["errMsg"]))
				{
						$errMsg = $_SESSION["errMsg"];
                        echo "<span>$errMsg</span>";
                }

                if(isset($_SESSION["err"]))
				{
						$errMsg = $_SESSION["err"];
                        echo "<span>$err</span>";
                }
				?>

				</p>
				<?php
   					 unset($_SESSION["errMsg"]);
   					 unset($_SESSION["err"]);
				?>
		</p>

		<?php
		echo "<input type = 'submit' value = 'submit'></form>";
	}
	else
	{
		//echo "error";
	}
}
?>
</table>
</table>
</body>
</html>