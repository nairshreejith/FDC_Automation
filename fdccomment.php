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
	<title>Comment of fdc</title>
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
	<div class="blackboard">
		<div class="form">
<form action = fdccomment2.php method = 'POST' class="myform">
<?php
session_start();
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
		//echo "Connection sucessful";
	}
	else
	{
		echo "Error".mysqli_connect_error();
	}*/

	$nod = 0;
	$namount = 0;

	$sql1 = "Select * from resource_data Where Email = '$facultymail'";
	$result1 = $conn->query($sql1);
	if($result1->num_rows>0)
	{
		while($row1 = $result1->fetch_assoc())
		{
			$nod = $row1['ODs'];
			$namount = $row1['Amount'];
		}
	}

	$sql = "Select a.*,b.HOD_name,b.HOD_email,b.HOD_Remark,b.HOD_Remark_Reason from application_data a left join fdc_leave_data b on a.Email=b.Faculty_Mailid Where b.Faculty_Mailid='$facultymail' and a.Start_date = '$startdate' and b.Start_date = '$startdate'";
	$result = $conn->query($sql);
	if($result->num_rows>0)
	{
		while($row = $result->fetch_assoc())
		{
			$_SESSION['title'] = $row['Title'];
			echo"<p><label>Name: ".$row['Name'].
					"</label> 

					&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".
				
				"<label>Branch: ".$row['Branch'].
					"</label>".
				"<p><label>Email id: ".$row['Email'].
					"</label>
				</p>".
				"<p><label>Type of Program: ".$row['Type'].
					"</label>
				</p>".					
				"<p><label>Title: ".$row['Title'].
					"</label>
				</p>".
				"<p><label>Name of Organization: ".$row['Name_of_Organization'].
					"</label>
				</p>".
				"<p><label>Address of Organization: ".$row['Address_of_organization'].
					"</label>
				</p>".
				"<p><label>Other Organizations: ".$row['Other_Organizations'].
					"</label>
				</p>".
				"<p><label>Special Request: ".$row['Special_Request'].
					"</label>
				</p>".					
				"<p><label>Training Start Date: ".$row['Start_date'].
					"</label>
				</p>".
				"<p><label>Training End Date:".$row['End_date'].
					"</label>
				</p>".
				"<p><label>Number of ODs claimed: ".$row['Total_no_of_ods'].
					"</label>
				</p>".
				"<p><label>Last date of Registration: ".$row['Last_date_for_registration'].
					"</label>
				</p>".
				"<p><label>Period: ".$row['Period'].
					"</label>
				</p>".
				"<p><label>Registration fee: ".$row['Registration_fee'].
					"</label>
				</p>".
				"<p><label>Period: ".$row['Period'].
					"</label>
				</p>".
				"<p><label>Amount Claimed: ".$row['Amount_claimed'].
					"</label>
				</p>".
				"<p><label>Reason: ".$row['Purpose'].
					"</label>
				</p>".
				"<p><label>HOD name: ".$row['HOD_name'].
					"</label>
				</p>".
				"<p><label>HOD email: ".$row['HOD_email'].
					"</label>
				</p>".
				"<p><label>HOD Remark: ".$row['HOD_Remark'].
					"</label>
				</p>".
				"<p><label>HOD  Remark Reason: ".$row['HOD_Remark_Reason'].
					"</label>
				</p>";


			echo"<p><label>Remark: </label>
						<select name = 'remark'>
							<option>Forward</option>
							<option>Revert</option>
						</select>
				</p>";
			echo"<p><label>Reason for Remark:</label>
						<textarea rows = '4' cols = '50' name = 'remark_reason' maxlength = '400'></textarea>
				</p>";
			echo "<p><label>Date of Meeting: </label>
						<input type = 'date' name = 'date_of_meeting'>
				</p>";
			echo "<p><label>Amount available: ".$namount."</label></p>";
			echo "<p><label>Amount Sanctioned:</label>
						<input type = 'number' name = 'amount_sanctioned' class='amount'>
				</p>";
			echo "<p><label>ODs available: ".$nod."</label></p>";
			echo "<p><label>ODs Sanctioned:</label>
						<input type = 'number' name = 'ods_sanctioned' class='ods'>
				</p>";
		}
	}

}
?>
<br>
<p class="wipeout">
<input type= "submit" value = "submit">
</p>
</form>
</body>
</html>