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
	<link rel="stylesheet" type="text/css" href="css/login.css">

	
	<style type="text/css">
		body{
			background-image: url('img/background.jpg');
			background-repeat: no-repeat;  
			background-size: 3000px;
		}

		input[type="checkbox"]{
			width: 1em;
			height:1.1em;
		}

		.login-box{
			height: 1225px;
			margin-top:400px;
			width: 500px;
		}
		label{
			font-size: 1.3em;
		}

		input[type="number"]{
			font-size: 1em;
		}
		input[type="date"]{
			font-size: 1.2em;
		}
		select, textarea{
			font-size: 1.2em;
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

		<div class="login-box">
			<a href="#.php"><img src="img/logo.jpg" alt="KJSCE" class="avatar"></a>
			<h1 style="color: black;">Admin Comment</h1>

			<form action = fdcadmincomment2.php method = "POST">

				<?php
				$temp = $_GET['id'];
$arr = explode(",", $temp);
$_SESSION['facultymail'] = $facultymail = $arr[0];
$_SESSION['startdate'] = $startdate = $arr[1];
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


	$sql = "Select a.*,b.HOD_name,b.HOD_email,b.HOD_Remark,b.HOD_Remark_Reason from application_data a left join fdc_leave_data b on a.Email = b.Faculty_Mailid Where b.Faculty_Mailid='$facultymail' and a.Start_date = '$startdate' and b.Start_Date = '$startdate' and a.Special_Request = 'Yes' and b.Special_Request = 'Yes'";
	$result = $conn->query($sql);
	if($result->num_rows>0)
	{
		while($row = $result->fetch_assoc())
		{
			echo "<center><label>Name: ".$row['Name'].
				  "</label><br><br>".

				  	"<label>Branch: ".$row['Branch'].
						"</label><br><br>".

					"<label>Email id: ".$row['Email'].
						"</label><br><br>".

					"<label>Type of Program: ".$row['Type'].
						"</label><br><br>".		

					"<label>Title: ".$row['Title'].
						"</label><br><br>".

					"<label>Name of Organization: ".$row['Name_of_Organization'].
						"</label><br><br>".

					"<label>Address of Organization: ".$row['Address_of_organization'].
						"</label><br><br>".

					"<label>Other Organizations: ".$row['Other_Organizations'].
						"</label><br><br>".

					"<label>Special Request: ".$row['Special_Request'].
						"</label><br><br>".	

					"<label>Training Start Date: ".$row['Start_date'].
						"</label><br><br>".

					"<label>Training End Date:".$row['End_date'].
						"</label><br><br>".

					"<label>Number of ODs claimed: ".$row['Total_no_of_ods'].
						"</label><br><br>".

					"<label>Last date of Registration: ".$row['Last_date_for_registration'].
						"</label><br><br>".

					"<label>Period: ".$row['Period'].
						"</label><br><br>".

					"<label>Registration fee: ".$row['Registration_fee'].
						"</label><br><br>".

					"<label>Period: ".$row['Period'].
						"</label><br><br>".

					"<label>Amount Claimed: ".$row['Amount_claimed'].
						"</label><br><br>".

					"<label>Reason: ".$row['Purpose'].
						"</label></center>";


			echo "<br>";


			echo "<label>Remark: </label>
						<select name = 'remark' required>
							<option value=''></option>
							<option>Accepted</option>
							<option>Rejected</option>
						</select><br><br>";

			echo "<label>Reason for Remark:</label>
							<textarea rows = '4' cols = '45' name = 'remark_reason' maxlength = '400' required>
							</textarea><br><br>";

			echo "<label>Date: </label>&nbsp &nbsp
						<input type = 'date' name = 'date_of_meeting' required style='width:auto;'><br>";

			echo "<label>Amount Sanctioned:</label>&nbsp &nbsp
						<input type = 'number' name = 'amount_sanctioned' required style='width:auto;'><br>";

			echo "<label>ODs Sanctioned:</label> &nbsp &nbsp &nbsp &nbsp &nbsp
						<input type = 'number' name = 'ods_sanctioned' required style='width:auto;'><br>";
				
}
}
}
?>
<br>
<input type="submit" value="Submit">
</form>
</div>
</body>
</html>
